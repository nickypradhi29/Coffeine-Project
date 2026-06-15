<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $coffeeMenus = Menu::tersedia()
            ->kategori('coffee')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->get();

        $nonCoffeeMenus = Menu::tersedia()
            ->kategori('non-coffee')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->get();

        return view(
            'member.menu.index',
            compact('coffeeMenus', 'nonCoffeeMenus')
        );
    }
}