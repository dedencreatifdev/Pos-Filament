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
        Schema::create('members', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->string('nama_company');
            $table->string('alamat')->nullable();
            $table->string('email')->unique();
            $table->string('no_telepon')->unique();
            $table->string('logo')->nullable();

            $table->string('nama_pemilik')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('bank')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('no_telepon2')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();

            $table->date('member_expired')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
