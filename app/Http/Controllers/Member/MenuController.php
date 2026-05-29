<?php
 
namespace App\Http\Controllers\Member;
 
use App\Http\Controllers\Controller;
use App\Models\Menu;
 
class MenuController extends Controller
{
    public function index()
    {
        $coffeeMenus    = Menu::tersedia()->kategori('coffee')->get();
        $nonCoffeeMenus = Menu::tersedia()->kategori('non-coffee')->get();
 
        return view('member.menu.index', compact('coffeeMenus', 'nonCoffeeMenus'));
    }
}
 