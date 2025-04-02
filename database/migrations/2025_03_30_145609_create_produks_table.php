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
            // $table->id();
            $table->uuid('id');

            $table->string('kode_barang', 50);
            $table->string('nama_barang', 100);
            $table->string('unit_id', 100);
            $table->string('kategori_id', 100);
            $table->string('merk_id', 100);

            $table->text('detail')->nullable();
            $table->string('image', 100)->nullable()->default('no_image.png');
            $table->text('product_detail')->nullable();

            $table->double('harga', 15, 8)->nullable()->default(0);
            $table->double('stok_minimal', 15, 8)->nullable()->default(0);
            $table->double('harga_beli', 15, 8)->nullable()->default(0);

            $table->boolean('promosi')->nullable()->default(false);
            $table->double('harga_promo', 15, 8)->nullable()->default(0);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_berahir')->nullable();

            $table->string('member_id', 100);
            $table->string('gudang_id', 100);
            $table->string('dibuat_oleh', 100);

            $table->string('cf1', 100)->nullable();
            $table->string('cf2', 100)->nullable();
            $table->string('cf3', 100)->nullable();
            $table->string('cf4', 100)->nullable();
            $table->string('cf5', 100)->nullable();

            $table->string('supplier1', 100)->nullable();
            $table->string('supplier1_part_no', 100)->nullable();
            $table->double('supplier1price', 15, 8)->nullable();

            $table->string('supplier2', 100)->nullable();
            $table->string('supplier2_part_no', 100)->nullable();
            $table->double('supplier2_price', 15, 8)->nullable();

            $table->string('supplier3', 100)->nullable();
            $table->string('supplier3_part_no', 100)->nullable();
            $table->double('supplier3_price', 15, 8)->nullable();

            $table->string('supplier4', 100)->nullable();
            $table->string('supplier4_part_no', 100)->nullable();
            $table->double('supplier4_price', 15, 8)->nullable();

            $table->string('supplier5', 100)->nullable();
            $table->string('supplier5_part_no', 100)->nullable();
            $table->double('supplier5_price', 15, 8)->nullable();

            $table->softDeletes();
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
