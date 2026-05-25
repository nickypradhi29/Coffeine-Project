<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Pembayaran extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'pesanan_id',
        'metode',
        'payment_gateway',
        'payment_ref',
        'snap_token',
        'payment_url',
        'qr_string',
        'status',
        'paid_at',
    ];
 
    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
        ];
    }
 
    // ─── Relationships ─────────────────────────────────────────────
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
 
    // ─── Helpers ───────────────────────────────────────────────────
    public function berhasil(): bool
    {
        return $this->status === 'berhasil';
    }
 
    public function markAsBerhasil(): void
    {
        $this->update([
            'status'  => 'berhasil',
            'paid_at' => now(),
        ]);
 
        $this->pesanan->update(['status_pembayaran' => 'sudah_bayar']);
    }
}