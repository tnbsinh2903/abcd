<?php

namespace App\DTOs;

class NhanVienDTO
{
    public function __construct(
        public string $hoTen,
        public string $maSo,
        public string $email,
        public string $sdt,
        public string $diaChi,
        public string $gioiTinh,
        public string $trangThai,
        public string $nhomViecLam,
        public string $chucVu,
        public string $boPhan,
        public string $ngayVao,
        public string $ngayKiHD,
        public string $ngaySinh,
        public string $thamNien,
        public string $phepTon,

    ) {}
    /**
     * Summary of fromArrays
     * @param array $data
     * @return NhanVienDTO
     */
    public static function fromArray_getAll($data): self
    {
        // echo json_encode((object)$data, JSON_UNESCAPED_UNICODE);
        return new self(
            hoTen: $data['ho_ten'],
            maSo: $data['ma_so'],
            email: $data['email'],
            sdt: $data['sdt'],
            diaChi: $data['dia_chi'],
            gioiTinh: $data['gioi_tinh'],
            trangThai: $data['trang_thai'],
            nhomViecLam: $data['ten_nhom'],
            chucVu: $data['ten_chuc_vu'],
            boPhan: $data['ten_bo_phan'],
            ngayVao: $data['ngay_vao'],
            ngayKiHD: $data['ngay_ki_hd'],
            ngaySinh: $data['ngay_sinh'],
            thamNien: $data['tham_nien'],
            phepTon: $data['phep_ton'],
        );
    }
    public static function fromArray_Create($data): self
    {
        // echo json_encode((object)$data, JSON_UNESCAPED_UNICODE);
        return new self(
            hoTen: $data['ho_ten'],
            maSo: $data['ma_so'],
            email: $data['email'],
            sdt: $data['sdt'],
            diaChi: $data['dia_chi'],
            gioiTinh: $data['gioi_tinh'],
            trangThai: $data['trang_thai'],
            nhomViecLam: $data['id_nhom_lam_viec'],
            chucVu: $data['id_chuc_vu'],
            boPhan: $data['id_bo_phan'],
            ngayVao: $data['ngay_vao'],
            ngayKiHD: $data['ngay_ki_hd'],
            ngaySinh: $data['ngay_sinh'],
            thamNien: $data['tham_nien'],
            phepTon: $data['phep_ton'],
        );
    }
}
