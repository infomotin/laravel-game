<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Get;

class DashBoardContorller extends Controller
{
    #[Get('/dashboard', name: 'dashboard', middleware: ['web', 'auth', 'verified'])]
    public function index()
    {
        return Inertia::render('Dashboard');
    }
}
