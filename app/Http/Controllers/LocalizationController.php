<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LocalizationController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->get('locale');
        // get the previous route and change the locale parameter
        $url = url()->previous();
        $route = app('router')
            ->getRoutes($url)
            ->match(app('request')->create($url));
        session()->put('locale', $locale);
        
        $route->setParameter('locale', $locale);
        return redirect()->route($route->getName(), $route->parameters());
    }
}
