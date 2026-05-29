<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }
 
    public function create()
    {
        return view('admin.menu.create');
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|in:coffee,non-coffee',
            'harga'     => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok'      => 'required|integer|min:0',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tersedia'  => 'boolean',
        ]);
 
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menus', 'public');
        }
 
        Menu::create($data);
 
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }
 
    public function destroy(Menu $menu)
    {
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }
 
        $menu->delete();
 
        return back()->with('success', 'Menu berhasil dihapus.');
    }
}