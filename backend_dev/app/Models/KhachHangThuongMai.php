<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhachHangThuongMai extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'khach_hang_thuong_mai';

    protected $fillable = [
        'nha_may',
        'khach_hang',
        'ma_hang',
        'mau_model',
        'mua',
        'hinh_in',
        'so_hinh_in',
        'so_phut_ban',
        'so_phut_oval',
        'so_phut_kiem',
        'so_phut_say_ep',
        'so_phut_ui',
        'so_phut_chup_bang',
        'thuc_in',
        'so_phut_pha_mau',
        'don_gia',
        'gia_von',
        'sku'
    ];
}
