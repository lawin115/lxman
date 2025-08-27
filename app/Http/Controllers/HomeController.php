<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // Heman mantiqa berê ji bo anîna daneyan
        $services = Service::all();
        $packages = Package::all();

        // Bi Inertia rûpelê render bike
        // 'Home' navê fayla Vue ye di nav 'resources/js/Pages/' de
        return Inertia::render('Home', [
            'services' => $services,
            'packages' => $packages,
        ]);
    }
}