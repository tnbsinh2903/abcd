<?php

namespace App\Models\NhanSu;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    //

    protected $table = "nhan_vien";

    protected $fillable = [
        'ho_ten',
        'ma_so',
        'email',
        'mat_khau',
        'sdt',
        'dia_chi',
        'trang_thai',
        'id_chuc_vu',
        'id_bo_phan',
        'id_nhom_lam_viec',
        'ngay_vao',
        'ngay_ki_hd',
        'ngay_sinh',
        'created_at',
        'updated_at',
        'gioi_tinh',
        'url_image',
        'tham_nien',
        'phep_ton',
    ];
    protected $hidden = [
        'mat_khau'
    ];
    public $incrementing;
}
