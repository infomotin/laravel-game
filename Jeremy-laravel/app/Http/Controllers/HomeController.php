<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Inertia\Inertia;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Spatie\RouteAttributes\Attributes\Defaults;

class HomeController extends Controller
{
    #[Get('/')]
    public function index()
    {
        return 'Home';
    //     return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    }
    #[Get('/about/{id?}', name: 'about')]
    #[Defaults('id',1)]
    public function about($id)
    {
        return 'About'.$id;
    }
}
