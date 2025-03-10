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
            $table->foreignId('pinjam_id')->constrained('pinjams')->onDelete('cascade'); // Relasi ke tabel pinjaman
            $table->decimal('jumlah_bayar', 15, 2); // Jumlah pembayaran
            $table->date('tanggal_bayar'); // Tanggal pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
