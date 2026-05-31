<?php
 
namespace Database\Seeders;
 
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Users ─────────────────────────────────────────────────────────
        User::create([
            'name'     => 'Admin Coffeineé',
            'email'    => 'admin@coffeeinee.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
 
        User::create([
            'name'     => 'Kasir 1',
            'email'    => 'kasir@coffeeinee.com',
            'password' => Hash::make('password'),
            'role'     => 'kasir',
        ]);
 
        User::create([
            'name'     => 'Member Test',
            'email'    => 'member@coffeeinee.com',
            'password' => Hash::make('password'),
            'role'     => 'member',
        ]);
 
        // ─── Menu Coffee ────────────────────────────────────────────────────
        $coffeeMenus = [
            ['nama_menu' => 'Espresso',       'harga' => 18000,  'deskripsi' => 'Espresso murni, kuat dan pekat.'],
            ['nama_menu' => 'Americano',      'harga' => 22000,  'deskripsi' => 'Espresso diencerkan dengan air panas.'],
            ['nama_menu' => 'Cappuccino',     'harga' => 28000,  'deskripsi' => 'Espresso dengan susu busa yang lembut.'],
            ['nama_menu' => 'Latte',          'harga' => 30000,  'deskripsi' => 'Espresso dengan susu steamed yang creamy.'],
            ['nama_menu' => 'Caramel Latte',  'harga' => 35000,  'deskripsi' => 'Latte dengan sirup karamel manis.'],
            ['nama_menu' => 'Mocha',          'harga' => 33000,  'deskripsi' => 'Espresso, cokelat, dan susu.'],
            ['nama_menu' => 'Cold Brew',      'harga' => 32000,  'deskripsi' => 'Kopi seduh dingin 12 jam, smooth tanpa pahit berlebih.'],
            ['nama_menu' => 'Vietnamese Drip','harga' => 25000,  'deskripsi' => 'Kopi tetes vietnam dengan susu kental manis.'],
        ];
 
        foreach ($coffeeMenus as $menu) {
            Menu::create(array_merge($menu, [
                'kategori' => 'coffee',
                'stok'     => 50,
                'tersedia' => true,
            ]));
        }
 
        // ─── Menu Non-Coffee ────────────────────────────────────────────────
        $nonCoffeeMenus = [
            ['nama_menu' => 'Matcha Latte',    'harga' => 32000, 'deskripsi' => 'Matcha premium Jepang dengan susu segar.'],
            ['nama_menu' => 'Taro Latte',      'harga' => 30000, 'deskripsi' => 'Minuman ungu manis dari umbi talas.'],
            ['nama_menu' => 'Chocolate',       'harga' => 28000, 'deskripsi' => 'Cokelat panas klasik yang menghangatkan.'],
            ['nama_menu' => 'Lemon Tea',       'harga' => 20000, 'deskripsi' => 'Teh segar dengan perasan lemon.'],
            ['nama_menu' => 'Croissant',       'harga' => 25000, 'deskripsi' => 'Croissant butter panggang, renyah di luar lembut di dalam.'],
            ['nama_menu' => 'Banana Bread',    'harga' => 22000, 'deskripsi' => 'Roti pisang homemade dengan taburan kenari.'],
        ];
 
        foreach ($nonCoffeeMenus as $menu) {
            Menu::create(array_merge($menu, [
                'kategori' => 'non-coffee',
                'stok'     => 30,
                'tersedia' => true,
            ]));
        }
    }
}
 