<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class WelcomeController extends Controller
{
    public function index()
    {
        // Ambil 8 menu tersedia untuk ditampilkan di landing page
        $menus = Menu::tersedia()->limit(8)->get();

        return view('welcome', compact('menus'));
    }
}