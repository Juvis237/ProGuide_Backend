<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $local = \Session::get('locale','en');

        if($local == 'en' && $request->hasHeader('Content-Language')){
            $local = substr($request->header('Content-Language'), 0, 2);
        }elseif($local == 'en' && $request->hasHeader('Accept-Language')){
            $local = substr($request->header('Accept-Language'), 0,2);
        }elseif($local != 'en' && $local != 'fr'){
            $local = 'en';
        }
        app()->setLocale($local);

        $locale = $request->route('locale');
        if (in_array($locale, ['en', 'fr'])) {
            session()->put('locale', $locale);
        }

        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
        return $next($request);
    }
}
