<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Struk extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'pesanan_id',
        'nomor_struk',
        'kasir_id',
        'printed_at',
    ];
 
    protected function casts(): array
    {
        return [
            'printed_at' => 'datetime',
        ];
    }
 
    // ─── Relationships ─────────────────────────────────────────────
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
 
    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
 
    // ─── Generate Nomor Struk ───────────────────────────────────────
    public static function generateNomor(): string
    {
        $prefix = 'STR-' . date('Ymd') . '-';
        $last   = self::where('nomor_struk', 'like', $prefix . '%')
                      ->orderByDesc('id')
                      ->first();
        $urutan = $last ? ((int) substr($last->nomor_struk, -4)) + 1 : 1;
 
        return $prefix . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }
}