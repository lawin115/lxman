<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
 public function handle(Request $request, Closure $next)
{
    if (Session::has('locale')) {
        $locale = Session::get('locale');
        App::setLocale($locale);

        // Ji bo piştrastkirinê
        // dd('Middleware kar dike, ziman bû:', $locale); 
    }
    
    return $next($request);
}
}