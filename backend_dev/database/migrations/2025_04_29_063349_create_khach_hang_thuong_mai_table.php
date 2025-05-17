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
        Schema::create('khach_hang_thuong_mai', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');
            $table->string('nha_may');
            $table->string('khach_hang');
            $table->string('ma_hang');
            $table->string('mau_model');
            $table->string('mua');
            $table->string('hinh_in');
            $table->integer('so_hinh_in');
            $table->decimal('so_phut_ban', 8, 2);
            $table->decimal('so_phut_oval',  8,  2);
            $table->decimal('so_phut_kiem',  8,  2);
            $table->decimal('so_phut_say_ep',  8,  2);
            $table->decimal('so_phut_ui',  8,  2);
            $table->decimal('so_phut_chup_bang');
            $table->integer('thuc_in');
            $table->decimal('so_phut_pha_mau', 8, 2);
            $table->decimal('don_gia', 8, 0);
            $table->decimal('gia_von', 8, 0);
            $table->string('sku');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hang_thuong_mai');
    }
};
