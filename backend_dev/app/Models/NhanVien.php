<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhanVien extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'nhan_vien';
    protected $fillable = [
        'ho_ten',
        'email',
        'mat_khau',
        'sdt',
        'dia_chi',
        'trang_thai',
        'ma_so',
        'id_chuc_vu',
        'id_bo_phan',
        'ngay_vao',
        'ngay_ki_hd',
        'ngay_sinh',
        'created_at',
        'updated_at',
    ];
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'id',
        'email',
    ];
}
