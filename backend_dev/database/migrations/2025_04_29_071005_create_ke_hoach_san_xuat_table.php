<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ke_hoach_san_xuat', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->integer('id_thuong_mai');
            $table->foreign('id_thuong_mai')->references('id')->on('khach_hang_thuong_mai')->onDelete('cascade');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');
            $table->string('po');
            $table->string('nhom_size');
            $table->integer('slhd_tong');
            $table->integer('slhd');
            $table->integer('slhd_oval');
            $table->integer('slhd_ban');
            $table->integer('slhd_k3');
            $table->integer('thuc_in_po');
            $table->integer('thuc_in_oval');
            $table->integer('thuc_in_ban');
            $table->integer('thuc_in_k3');
            $table->integer('xac_nhan_dm_muc');
            $table->dateTime('so_phut_start');
            $table->dateTime('so_phut_end');
            $table->integer('tong_so_phut');
            $table->integer('status_so_phut');
            $table->string('uni_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ke_hoach_san_xuat');
    }
};
