<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property float|null $harga
 */
class Menu extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'deskripsi',
        'stok',
        'gambar',
        'tersedia',
    ];
 
    protected $casts = [
        'harga'    => 'decimal:2',
        'tersedia' => 'boolean',
    ];
 
    // ─── Scopes ────────────────────────────────────────────────────
    public function scopeTersedia(Builder $query): Builder
    {
        return $query->where('tersedia', true)->where('stok', '>', 0);
    }
 
    public function scopeKategori(Builder $query, string $kategori): Builder
    {
        return $query->where('kategori', $kategori);
    }
 
    // ─── Relationships ─────────────────────────────────────────────
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
 
    // ─── Accessors ─────────────────────────────────────────────────
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format((float) ($this->harga ?? 0), 0, ',', '.');
    }
 
    public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('storage/' . $this->gambar)
            : asset('images/menu-default.png');
    }
}