<?php

namespace App\Http\Controllers;

use App\Models\KeHoachSanXuat;
use App\Models\KhachHangThuongMai;
use Illuminate\Http\Request;

class KeHoachController extends Controller
{

    public function getDataThuongMai()
    {
        try {
            $data = KhachHangThuongMai::select(
                'id',
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
                'so_phut_pha_mau',
                'thuc_in',
                'don_gia',
                'gia_von',
            )->orderByDesc('id')->get();
            return response(['data' => $data], 200);
        } catch (\Exception $e) {
            return response(['error' => "Lỗi khi lấy dữ liệu" . $e->getMessage()], 500);
        }
    }

    public function getDataById($id)
    {
        try {
            $data_ke_hoach = KeHoachSanXuat::select('po', 'slhd_tong', 'slhd', 'nhom_size')->where("id_thuong_mai", $id)->get();
            $data_khach_hang = KhachHangThuongMai::select('khach_hang', 'ma_hang', 'mau_model', 'mua', 'so_hinh_in', 'hinh_in')->where('id', $id)->get();
            $data = [
                'ke_hoach' => $data_ke_hoach,
                'thuong_mai' => $data_khach_hang
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response(['error' => "Lỗi khi lấy dữ liệu" . $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {

            $data = $request->all();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            KeHoachSanXuat::create($data);
            return response(['message' => 'Kế hoạch sản xuất đã được tạo thành công'], 201);
        } catch (\Exception $e) {
            return response(['error' => "Lỗi khi tạo kế hoạch sản xuất: " . $e->getMessage()], 500);
            //throw $th;
        }
    }
}
