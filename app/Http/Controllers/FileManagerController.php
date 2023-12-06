<?php

namespace App\Http\Controllers;

use App\Http\FileManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
// use Spatie\MediaLibrary\HasMedia\HasMediaTrait; régi
use Spatie\MediaLibrary\InteractsWithMedia;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

// új verizó


class FileManagerController extends Controller
{

    /**
     * @param Request $request
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function loadItems(Request $request): \Illuminate\Contracts\View\View|Factory|Application
    {
        $fmKey = $request->input('fmKey');
        $fm = FileManager::loadFromSession($fmKey);
        $className = $fm->ownerClassName;
        $entity = $className::find($fm->ownerId);
        $mediaItems = $entity->getMedia($fm->mediaCollectionName);
        return view('FileManager.'.$fm->mediaCollectionName.'.items-'.$fm->viewType, ['files' => $mediaItems, 'fileManager' => $fm] );
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\View\View|Factory|Application
    {
        $ownerEntityId = $request->input('entityId', null);
        $ownerEntityClassWithNS = $request->input('entityType', null);
        $ownerEntityMediaCollection = $request->input('lib', null);
        $fm = FileManager::createInSession($ownerEntityClassWithNS, $ownerEntityId, $ownerEntityMediaCollection);
        $className = $fm->ownerClassName;
        $fm->ownerName = $fm->ownerId;
        $entity = $className::find($fm->ownerId);
        if (($entity !== null) && str_contains($className, 'RealEstate')) {
            $fm->ownerName = $entity->code;
        }
        return view('FileManager.'.$ownerEntityMediaCollection.'.index', ['fileManager' => $fm]);
    }


    /**
     * @param FileManager $fileManager
     * @return array
     */
    protected function getUploadValidationRules(FileManager $fileManager): array
    {
        $validatorRules = [];
        if ($fileManager->mediaCollectionName == 'images') {
            $validatorRules = [
                'dokumentumNev' => 'required',
                'dokumentumNev.*' => 'image|mimes:jpeg,bmp,png',
            ];
        }
        if ($fileManager->mediaCollectionName == 'files') {
            $validatorRules = [
                //  'dokumentumNev' => 'required|mimes:pdf',
                'dokumentumNev' => 'required',
                'dokumentumNev.*' => 'mimes:pdf‬',
            ];
        }
        return $validatorRules;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function upload(Request $request): JsonResponse
    {
        $fmKey = $request->input('fmKey');
        $fm = FileManager::loadFromSession($fmKey);
        $mediaCollectionName = $fm->mediaCollectionName;
        $className = $fm->ownerClassName;
        $entity = $className::find($fm->ownerId);
        $this->validate($request, $this->getUploadValidationRules($fm));
        if($request->hasfile('dokumentumNev'))
        {
            /**
             * @var InteractsWithMedia $entity
             */
            $entity->addAllMediaFromRequest()->each(function($fileAdder) use($mediaCollectionName) {
                // paraméterezés: toMediaCollection( collection name, diskName )
                $fileAdder->toMediaCollection($mediaCollectionName, $this->fileIsPrivateByMediaCollectionName($mediaCollectionName));
            });
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $id = $request->post('id');
        $fmKey = $request->input('fmKey');
        $fm = FileManager::loadFromSession($fmKey);
        $className = $fm->ownerClassName;
        $entity = $className::find($fm->ownerId);
        $media = $entity->getMedia($fm->mediaCollectionName)->get($id);
        //  csak akkor fusson, ha fájlról van szó (kép esetén felesleges az adott media id-re update-elni, mivel sosem lesz ilyen találat)
        if($fm->mediaCollectionName === 'files') {
            $className::where('commission_contract_id', '=', $entity->commission_contract_id)->update(['commission_contract_id' => null]);
        }
        $media?->delete();
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function setFeatured(Request $request): JsonResponse
    {
        $id = $request->post('id');
        $fmKey = $request->input('fmKey');
        $fm = FileManager::loadFromSession($fmKey);
        $className = $fm->ownerClassName;
        $entity = $className::find($fm->ownerId);
        $medias = $entity->getMedia($fm->mediaCollectionName)->all();
        foreach ($medias as $key => $item){
            $item->setCustomProperty('featured', (($id == $key) ? 1 : 0) );
            $item->save();
        }
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function reorder(Request $request): JsonResponse
    {
        $newOrder = $request->post('newOrder');
        $newOrder = trim($newOrder);
        $newOrder = explode(' ', $newOrder);

        $fmKey = $request->input('fmKey');
        $fm = FileManager::loadFromSession($fmKey);
        $className = $fm->ownerClassName;
        $entity = $className::find($fm->ownerId);
        $mediaCollection = $entity->getMedia($fm->mediaCollectionName);
        $order = 1;
        foreach ($newOrder as $key){
            $media = $mediaCollection->get($key);
            if ($media !== null) {
                $media->order_column = $order;
                $media->save();
                $order++;
            }
        }
        return response()->json([
            'status' => 'ok'
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function dragReorder(Request $request): JsonResponse
    {
        $id = $request->post('id');
        $oldIndex = $request->post('oldIndex');
        $newIndex = $request->post('newIndex');

        $fmKey = $request->input('fmKey');
        $fm = FileManager::loadFromSession($fmKey);
        $className = $fm->ownerClassName;
        $entity = $className::find($fm->ownerId);
        $mediaCollection = $entity->getMedia($fm->mediaCollectionName);

        $mediaItem_1 = $mediaCollection->pull($oldIndex);
        $mediaItem_2 = $mediaCollection->pull($newIndex);
        $mediaCollection->put($newIndex, $mediaItem_1);
        $mediaCollection->put($oldIndex, $mediaItem_2);
        $mediaItem_1->order_column = $newIndex+1;
        $mediaItem_1->save();
        $mediaItem_2->order_column = $oldIndex+1;
        $mediaItem_2->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'dragReordered'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeView(Request $request): JsonResponse
    {
        $newView = $request->get('newView');
        $fmKey = $request->input('fmKey');
        $fm = FileManager::loadFromSession($fmKey);
        $fm->viewType = $newView;
        return response()->json([
            'status' => 'ok'
        ]);
    }


    /**
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function download(Request $request): BinaryFileResponse
    {
        $key = $request->input('key');
        $fmKey = $request->input('fmkey');
        $fm = FileManager::loadFromSession($fmKey);
        $className = $fm->ownerClassName;
        $entity = $className::find($fm->ownerId);
        $mediaItem = $entity->getMedia($fm->mediaCollectionName)->get($key);
        return response()->download($mediaItem->getPath(), $mediaItem->name);
    }

    /**
     * @param string $mediaCollectionName
     * @return string
     */
    private function fileIsPrivateByMediaCollectionName(string $mediaCollectionName): string
    {
        if ($mediaCollectionName !== 'images') {
            return 'private';
        }
        return 'public';
    }
}
