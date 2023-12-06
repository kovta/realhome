<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Session;


class LanguageController extends Controller
{

    public function changeLanguage(String $language){
        // hu, en, es, ...
        if (preg_match('/^([a-zA-Z]{2})$/', $language)){
            App::setLocale($language);
            setLocale(LC_ALL, App::getLocale());
            Carbon::setLocale(App::getLocale());
            Session::put('language', $language);
        }
        return redirect()->back();
    }


    public function changeEditedLanguage(String $language){
        if (preg_match('/^([a-zA-Z]{2})$/', $language)){
            Session::put('editedLanguage', $language);
        }
        return redirect()->back();
    }

}
