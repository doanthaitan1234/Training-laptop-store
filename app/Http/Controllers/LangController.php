<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LangController extends Controller
{
    private $langActive = [
        'vi',
        'en',
    ];
    
    public function changeLanguage($language)
    {
        
       if (in_array($language, $this->langActive)) {
           Session::put('website_language', $language);
           
           return redirect()->back();
       }
    }
}
