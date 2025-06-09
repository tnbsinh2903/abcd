<?php

namespace App\Services;

use App\DTOs\NhanVienDTO;
use App\Models\NhanSu\NhanVien;

class NhanSuService
{

    public function  getAll()
    {
        try {

            // $nhanVien = NhanVien::all()->toArray();
            // $dto = NhanVienDTO::fromArray_getAll($nhanVien);
            // return response(['DATA' => $dto], 200);
            // $data = NhanVienDTO::fromArray($nhanVien);
            $dtoList = NhanVien::leftJoin('chuc_vu', 'nhan_vien.id_chuc_vu', '=', 'chuc_vu.id')
                ->leftJoin('bo_phan', 'bo_phan.id', '=', 'nhan_vien.id_bo_phan')
                ->leftJoin('nhom_lam_viec as vl', 'vl.id', '=', 'nhan_vien.id_nhom_lam_viec')
                // ->select(['nhan_vien.*', 'chuc_vu.ten_chuc_vu as chuc_vu', 'bo_phan.ten_bo_phan as bo_phan', 'vl.ten_nhom as ten'])
                ->cursor()
                ->map(fn($item) => NhanVienDTO::fromArray_getAll($item->toArray()));

            // $dtoList = NhanVien::leftJoin('chuc_vu', 'nhan_vien.id_chuc_vu', '=', 'chuc_vu.id')
            //     ->select(['nhan_vien.id', 'nhan_vien.ho_ten', 'chuc_vu.ten as chuc_vu'])
            //     ->get();

            // $dtoList = NhanVien::with(['chuc_vu', 'bo_phan', 'nhom_lam_viec'])
            //     ->cursor()
            //     ->map(fn($item) => NhanVienDTO::fromArray_getAll($item->toArray()));


            // $dtoList = NhanVien::leftJoin('chuc_vu', 'nhan_vien.id_chuc_vu', '=', 'chuc_vu.id')->leftJoin('bo_phan', 'bo_phan.id', '=', 'nhan_vien.id_bo_phan')
            //     ->leftJoin('nhom_lam_viec as vl', 'vl.id', '=', 'nhan_vien.id_nhom_lam_viec')->get()->map(fn($item) => NhanVienDTO::fromArray_getAll($item->toArray()));

            return response($dtoList, 200);

            // echo " ppop";
            // $nhanVien = NhanVien::all();
            // return response($nhanVien, 200);
        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
