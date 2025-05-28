<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeHoachSanXuat extends Model
{
    // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'ke_hoach_san_xuat';
    protected $fillable = [
        'id_thuong_mai',
        'po',
        'nhom_size',
        'slhd_tong',
        'slhd',
        'slhd_oval',
        'slhd_ban',
        'slhd_k3',
        'thuc_in_po',
        'thuc_in_oval',
        'thuc_in_ban',
        'thuc_in_k3',
        'xac_nhan_dm_muc',
        'so_phut_start',
        'so_phut_end',
        'tong_so_phut',
        'status_so_phut',
        'uni_code'
    ];
}
