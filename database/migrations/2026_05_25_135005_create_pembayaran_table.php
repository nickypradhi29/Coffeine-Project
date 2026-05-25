<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->enum('metode', ['qris', 'cash']);
            $table->string('payment_gateway')->nullable(); // e.g. Midtrans
            $table->string('payment_ref')->nullable();     // ID transaksi dari gateway
            $table->text('snap_token')->nullable();        // Token Midtrans Snap
            $table->text('payment_url')->nullable();       // URL pembayaran Midtrans
            $table->text('qr_string')->nullable();         // Data QRIS
            $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
