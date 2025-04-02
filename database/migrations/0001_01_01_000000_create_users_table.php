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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->uuid('id')->primary();
            $table->string('nama_lengkap', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('jenis_kelamin',50)->nullable();
            $table->string('no_telepon',50)->nullable();
            $table->string('image',100)->nullable();

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();


            $table->string('member_id', 100)->nullable();
            $table->string('gudang_id', 100)->nullable();
            $table->string('biller_id', 100)->nullable();
            $table->tinyInteger('show_cost')->nullable();
            $table->tinyInteger('show_price')->nullable();
            $table->integer('award_points')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
