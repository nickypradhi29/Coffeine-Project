<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'member') {
            abort(403, 'Hanya member yang dapat memberikan rating.');
        }

        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'menu_id' => $request->menu_id,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return back()->with('success', 'Rating berhasil disimpan.');
    }
}