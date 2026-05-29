<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
/**
 * @property int $user_id
 * @property float|null $total_harga
 */
class Pesanan extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'user_id',
        'total_harga',
        'status_pesanan',
        'status_pembayaran',
        'metode_pembayaran',
        'catatan',
    ];
 
    protected $casts = [
        'total_harga' => 'decimal:2',
    ];
 
    // ─── Relationships ─────────────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
 
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
 
    public function struk()
    {
        return $this->hasOne(Struk::class);
    }
 
    // ─── Helpers ───────────────────────────────────────────────────
    public function sudahBayar(): bool
    {
        return $this->status_pembayaran === 'sudah_bayar';
    }
 
    public function getTotalFormatAttribute(): string
    {
        return 'Rp ' . number_format((float) ($this->total_harga ?? 0), 0, ',', '.');
    }
 
    public function hitungTotal(): void
    {
        $this->total_harga = $this->detailPesanans()->sum('subtotal');
        $this->save();
    }
}
 