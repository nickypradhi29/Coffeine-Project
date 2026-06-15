<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class WelcomeController extends Controller
{
    public function index()
    {
        $menus = Menu::tersedia()
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->limit(8)
            ->get();

        return view('welcome', compact('menus'));
    }
}