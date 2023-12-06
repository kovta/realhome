<?php

namespace App\Http\Controllers;

use App\Models\TextContentPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TextContentPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = TextContentPage::all();
        return view('TextContentPage.list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity = new TextContentPage();
        return view('TextContentPage.create', ['record' => $entity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(TextContentPage::validationRules());

        $entity = new TextContentPage();
        $entity->inner_name = $request->inner_name;
        foreach(config('translatable.locales') as $locale) {
            $entity->translateOrNew($locale)->title = $request->input("$locale.title");
            $entity->translateOrNew($locale)->content = $request->input("$locale.content");
        }

        $entity->save();
        return redirect(route('textContentPages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param TextContentPage $textContentPage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(TextContentPage $textContentPage)
    {
        return view('TextContentPage.edit', ['record' => $textContentPage ]);

    }

    /**
     * @param Request $request
     * @param TextContentPage $textContentPage
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, TextContentPage $textContentPage)
    {
        $request->validate(TextContentPage::validationRules());

        $textContentPage->inner_name = $request->inner_name;
        foreach(config('translatable.locales') as $locale) {
            $textContentPage->translateOrNew($locale)->title = $request->input("$locale.title");
            $textContentPage->translateOrNew($locale)->content = $request->input("$locale.content");
        }
        $textContentPage->save();
        return redirect(route('textContentPages.index'));
    }

    /**
     * @param TextContentPage $textContentPage
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(TextContentPage $textContentPage)
    {
        $textContentPage->delete();
        return redirect(route('textContentPages.index'));
    }
}
