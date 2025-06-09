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
        Schema::create('bo_phan', function (Blueprint $table) {
            $table->id();
            $table->string('ten_bo_phan');
            $table->string('viet_tac');
        });
        Schema::create('chuc_vu', function (Blueprint $table) {
            $table->id();
            $table->string('ten_chuc_vu');
        });
        Schema::create("nhom_lam_viec", function (Blueprint $table) {
            $table->id();
            $table->string('ten_nhom');
        });

        Schema::create('nhan_vien', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->string('ho_ten');
            $table->string('email')->unique();
            $table->string('sdt')->unique();
            $table->string('dia_chi');
            $table->string('gioi_tinh');
            $table->string('trang_thai')->default('active');
            $table->string('mat_khau');
            $table->string('url_image')->nullable();
            $table->foreignId('id_nhom_lam_viec')->constrained('nhom_lam_viec');
            $table->integer('ma_so');
            $table->foreignId('id_chuc_vu')->constrained('chuc_vu');
            $table->foreignId('id_bo_phan')->constrained('bo_phan');
            $table->string('ngay_vao');
            $table->string('ngay_ki_hd')->nullable();
            $table->string('ngay_sinh');
            $table->integer('tham_nien');
            $table->integer('phep_ton')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('nhom_lam_viec');
    }
};
