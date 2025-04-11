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
        Schema::create('produks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tipe_id', 100);
            $table->string('kode_produk', 25)->unique();
            $table->string('nama_barang', 50);
            $table->string('satuan_id', 100);
            $table->string('kategori_id', 100);
            $table->string('merk_id', 100);

            $table->double('harga_jual', 18,8)->nullable()->default(0.00);
            $table->double('stok_alert', 18,8)->nullable()->default(0.00);

            $table->string('gudang_id', 100);
            $table->string('lokasi_id', 100);
            $table->string('rak_id', 100);

            $table->string('barcode', 100);
            $table->string('barcode_type', 100);


            $table->string('keterangan', 100);
            $table->string('foto', 100);

            $table->boolean('status');

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('produk_team', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('produk_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('team_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
