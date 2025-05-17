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
        Schema::create('nhan_vien', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->string('ho_ten');
            $table->string('email')->unique();
            $table->string('sdt')->unique();
            $table->string('dia_chi');
            $table->string('trang_thai')->default('active');
            $table->string('mat_khau');
            $table->string('anh_dai_dien')->nullable();
            $table->string('ma_so')->nullable();
            $table->string('id_chuc_vu')->nullable();
            $table->integer('id_bo_phan')->nullable();
            $table->dateTime('ngay_vao')->nullable();
            $table->dateTime('ngay_ki_hd')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('bo_phan', function (Blueprint $table) {
            $table->id();
            $table->string('ten_bo_phan');
            $table->string('viet_tac');
        });
        Schema::create('chuc_vu', function (Blueprint $table) {
            $table->id();
            $table->string('ten_chuc_vu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_vien');
        Schema::dropIfExists('bo_phan');
        Schema::dropIfExists('chuc_vu');
    }
};
