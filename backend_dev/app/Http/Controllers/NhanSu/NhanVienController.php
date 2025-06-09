<?php

namespace App\Http\Controllers\NhanSu;

use App\DTOs\NhanVienDTO;
use App\Http\Controllers\Controller;

date_default_timezone_set('Asia/Ho_Chi_Minh');

use App\Models\NhanSu\NhanVien;
use App\Services\NhanSuService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NhanVienController extends Controller
{

    public function __construct(private NhanSuService $nhanSuService) {}
    use HasApiTokens, HasFactory, Notifiable;

    public function findAll()
    {
        return   $this->nhanSuService->getAll();
    }
    public function create(Request $request)
    // dd($request->all());
    // $request->validate([
    //     'ho_ten' => 'required|string|max:255',
    //     'email' => 'required|string|email|max:255|unique:users',
    //     'mat_khau' => 'required|string|min:8',
    //     'sdt' => 'required|string|max:15',
    //     'dia_chi' => 'required|string|max:255',
    //     'trang_thai' => 'required|boolean',
    //     'ma_so' => 'required|string|max:10',
    //     'id_chuc_vu' => 'required|integer',
    //     'id_bo_phan' => 'required|integer',
    //     'ngay_vao' => 'required|date',
    //     'ngay_ki_hd' => 'nullable|date',
    //     'ngay_sinh' => 'nullable|date',
    // ]);
    {
        try {
            $data = $request->all();
            // dd($data);

            $nhanVienDto = NhanVienDTO::fromArray_Create($data);
            $data['mat_khau'] = bcrypt($data['mat_khau']);
            $data['ngay_vao'] = date('Y-m-d');


            // NhanVien::create($data);

            return response()->json($nhanVienDto, 200);
            // return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            echo $id;

            // $data['mat_khau'] = bcrypt($data['mat_khau']);

            NhanVien::where('id', $id)->update($data);

            return response()->json(['mesage' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            NhanVien::find($id)->delete();
            // NhanVien::withTrashed()->get(); // lấy danh sách  xóa mền
            // NhanVien::withTrashed()->find($id)->restore(); // khôi phục lại xóa mềm
            // NhanVien::forceDelete($id); // xóa vĩnh viễn khi dingf xóa mền
            return response()->json(['meseage' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
}
