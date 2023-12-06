<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
// use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
// use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
// use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
// use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Exceptions\DiskDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|Factory|Application
    {
        $records = Post::all();
        return view('Post.list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View|Factory|Application
    {
        $entity = new Post();
        return view('Post.create', ['record' => $entity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $request->validate(Post::validationRules());

        $entity = new Post();
        foreach(config('translatable.locales') as $locale) {
            $entity->translateOrNew($locale)->title = $request->input("$locale.title");
            $entity->translateOrNew($locale)->lead = $request->input("$locale.lead");
            $entity->translateOrNew($locale)->description = $request->input("$locale.description");
        }

        $entity->save();
        return redirect(route('posts.index'));
    }

    /**
     * @param Post $post
     * @return Factory|View
     */
    public function edit(Post $post): Factory|View
    {
        $hasImage = $post->getMedia()->isEmpty();
//        dd($hasImage);
        $translation = $post->translateOrDefault(Session::get('editedLanguage'));
        return view('Post.edit', [
            'hasImage' => $hasImage,
            'record' => $post,
            'translation' => $translation
        ]);

    }

    /**
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Post $post): Redirector|RedirectResponse
    {
        $request->validate(Post::validationRules());

        foreach(config('translatable.locales') as $locale) {
            $post->translateOrNew($locale)->title = $request->input("$locale.title");
            $post->translateOrNew($locale)->lead = $request->input("$locale.lead");
            $post->translateOrNew($locale)->description = $request->input("$locale.description");
        }
        $post->save();
        return redirect(route('posts.index'));
    }

    /**
     * @param Post $post
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Post $post): Redirector|RedirectResponse
    {
        $post->delete();
        return redirect(route('posts.index'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadImage(Request $request): JsonResponse
    {
        $id = $request->input('postId');
        $entity = Post::find($id);
        // TODO: ez itt totál hülyeség:
        $pathToImage = $request->file('dokumentumNev')->getPathname();
        $originalName = $request->file('dokumentumNev')->getClientOriginalName();
        try {
            $entity->addMedia($pathToImage)->
            withCustomProperties(['featured' => 1,])->
            usingName($originalName)->
            usingFileName($originalName)->
            toMediaCollection('images','public');
        }
        catch(DiskDoesNotExist|FileDoesNotExist|FileIsTooBig $e) {
            return response()->json([
                'status' => 'error',
                'exception' => $e
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'imagePath' => $entity->getFirstMediaUrl('images', 'admin-list-thumb')
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function eraseImage(Request $request)
    {
        $id = $request->post('id');
        $entity = Post::find($id);
        $media = $entity->getFirstMedia('images');
        if ($media !== null) {
            $media->delete();
        }
        return response()->json([
            'status' => 'ok',
            'imagePath' => asset('/images/no-pics/no-pic_70px.jpg')
        ]);
    }
}
