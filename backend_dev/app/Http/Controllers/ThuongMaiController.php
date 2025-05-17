<?php

namespace App\Http\Controllers;

date_default_timezone_set("Asia/Ho_Chi_Minh");

use App\Models\KhachHangThuongMai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ThuongMaiController extends Controller
{
    public function getAll(Request $request)
    {
        try {

            // $data = KhachHangThuongMai::all();
            // $tm = KhachHangThuongMai::f    
            // echo json_encode(response()->json($data['current_page']));
            // echo response($data['to'], 200);
            // return response($data, 200);
            // return response(['data' => $data], 200);
            $search =  $request->input('search') ?? 'empty';
            $arr_key = explode(' ', $search);
            // echo json_encode($abc, JSON_UNESCAPED_UNICODE);
            // return response(['search' => $abc], 200);
            if ($search == 'empty') {
                // $data = KhachHangThuongMai:: orderBy('id', 'desc')->get();
                // $data = KhachHangThuongMai::select('id','nha_may')->get() ;
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
                    'gia_von'
                )->orderByDesc('id')->get();
                $count = count($data);
                // $getColumn = Schema::getColumnListing('khach_hang_thuong_mai');
                // $getColumn = array_diff($getColumn, ['updated_at,created_at']);

                // $data = KhachHangThuongMai::select($getColumn)->get();
                return response(['data' => $data, 'count' => $count], 200);
            } else {
                // echo "12";
                $data = KhachHangThuongMai::where(function ($query) use ($arr_key) {
                    foreach ($arr_key as $key) {
                        $query->where(function ($subQuery) use ($key) {
                            $subQuery->orWhere('khach_hang', 'like', "%$key%")
                                ->orWhere('nha_may', 'like', "%$key%")
                                ->orWhere('ma_hang', 'like', "%$key%")
                                ->orWhere('mau_model', 'like', "%$key%")
                                ->orWhere('mua', 'like', "%$key%")
                                ->orWhere('hinh_in', 'like', "%$key%");
                        });
                    }
                })->get();
                $count = $data->count();
                // $count = count($data);
                return response(['count' => $count, 'data' => $data], 200);
            }

            // echo json_encode($search, JSON_UNESCAPED_UNICODE);
            // $data = KhachHangThuongMai::where(function ($q) use ($arr_key) {
            //     foreach ($arr_key as $key) {
            //         $q->where(function ($subQuery) use ($key) {
            //             $subQuery->orWhere('khach_hang', 'like', "%$key%")->orWhere('ma_hang', 'like', "%$key%");
            //         });
            //     }
            // })->get();

            // foreach ($arr_key as $keys) {
            //     $data = KhachHangThuongMai::where('khach_hang', 'like', "%$keys%")->orWhere('ma_hang', 'like', "%$keys%")
            //         ->orWhere('mau_model', 'like', "%$keys%")->orWhere('mua', 'like', "%$keys%")
            //         ->orWhere('hinh_in', 'like', "%$keys%")
            //         ->orWhere('nha_may', 'like', "%$keys%")
            //         ->get();
            // }
            // $start = microtime(true);


            // $data = KhachHangThuongMai::where(function ($query) use ($arr_key) {
            //     foreach ($arr_key as $key) {
            //         $query->where(function ($subQuery) use ($key) {
            //             $subQuery->orWhere('khach_hang', 'like', "%$key%")
            //                 ->orWhere('nha_may', 'like', "%$key%")
            //                 ->orWhere('ma_hang', 'like', "%$key%")
            //                 ->orWhere('mau_model', 'like', "%$key%")
            //                 ->orWhere('mua', 'like', "%$key%")
            //                 ->orWhere('hinh_in', 'like', "%$key%");
            //         });
            //     }
            // })->get();

            // $end = microtime(true);
            // $executionTime = $end - $start;

            // echo "Thời gian thực thi: " . round($executionTime, 4) . " giây";
            // $data = KhachHangThuongMai::where('sku', 'like', '%' . $search . '%')
            //     ->orWhere('nha_may', 'like', "%$search%")
            //     ->orWhere('khach_hang', 'like', '%' . $search . '%')
            //     ->orWhere('ma_hang', 'like', '%' . $search . '%')
            //     ->orWhere('mau_model', 'like', '%' . $search . '%')
            //     ->get();
            // $count = count($data);

            // return response(['count' => $count, 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function uploadFile(Request $request)
    {
        // echo json_encode($request, JSON_UNESCAPED_UNICODE);
        try {
            $request->validate([
                'excel' => 'required|mimes:xlsx,xls,csv|max:2048',
            ]);
            $file = $request->file('excel');
            $date = date('Y.m.d_H.i.s');

            $filename = "tm_$date." . $file->getClientOriginalExtension();
            // $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
            $path = $file->storeAs('uploads', $filename);

            $target_file = storage_path('app/private/uploads/') . $filename;
            // $target_file = $target_dir . basename($_FILES["excel"]["name"]);
            // move_uploaded_file($file, $target_file);

            $reader = IOFactory::load($target_file);
            $sheetData = $reader->getActiveSheet()->toArray(null, true, true, true);
            array_shift($sheetData);
            $arrData = [];
            $abcData = [];
            foreach ($sheetData as $row) {
                $abc = array_values($row);
                array_push($abcData, $abc);

                $sku = trim($row['A']) . trim($row['B']) . trim($row['C']) . trim($row['D']) . trim($row['E']) . trim($row['F']) . trim($row['G']);

                if (strlen($sku) > 0) array_push($arrData, $sku);
            }

            $check_same = count($arrData) == count(array_unique($arrData));

            if ($check_same) {

                foreach ($sheetData as $row) {

                    $row['nha_may'] = $row['A'] ?? '';
                    $row['khach_hang'] = $row['B'] ?? '';
                    $row['ma_hang'] = $row['C'] ?? '';
                    $row['mau_model'] = $row['D'] ?? '';
                    $row['mua'] = $row['E'] ?? '';
                    $row['hinh_in'] = $row['F'] ?? 0;
                    $row['so_hinh_in'] = $row['G'] ?? 0;
                    $row['so_phut_ban'] = $row['H'] ?? 0;
                    $row['so_phut_oval'] = $row['I'] ?? 0;
                    $row['so_phut_kiem'] = $row['J'] ?? 0;
                    $row['so_phut_say_ep'] = $row['K'] ?? 0;
                    $row['so_phut_ui'] = $row['L'] ?? 0;
                    $row['so_phut_chup_bang'] = $row['M'] ?? 0;
                    $row['so_phut_pha_mau'] = $row['N'] ?? 0;
                    $row['don_gia'] = $row['O'] ?? 0;
                    $row['gia_von'] = $row['P'] ?? 0;
                    $row['sku'] =  trim($row['A']) . trim($row['B']) . trim($row['C']) . trim($row['D']) . trim($row['E']) . trim($row['F']) . trim($row['G']);

                    $check_sku = KhachHangThuongMai::where('sku', $row['sku'])->count();

                    if ($check_sku > 0) continue;
                    // echo "sinh1";
                    // echo json_encode($rows, JSON_UNESCAPED_UNICODE);
                    KhachHangThuongMai::create($row);
                }
                return response()->json(['message' => 'Success'], 200);
            } else {
                return response()->json(['message' => 'Duplicate'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['errosr' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {

        try {
            $dataRes = $request->collect();
            // echo json_encode($dataRes, JSON_UNESCAPED_UNICODE);
            foreach ($dataRes as $key) {
                $day =  date("Y-m-d H:i:s");

                $key['updated_at'] = $day;
                unset($key['created_at']);
                KhachHangThuongMai::where('id', $key['id'])->update($key['data']);
                // echo json_encode($key['data']['id'], JSON_UNESCAPED_UNICODE);
            }
            return response()->json(['message' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 500]);
            //throw $th;
        }
    }

    public function delete(Request $request)
    {
        try {
            $arrId = $request->collect();

            // echo json_encode($arrId, JSON_UNESCAPED_UNICODE);
            foreach ($arrId as $value) {
                KhachHangThuongMai::where('id', $value)->delete();
            }
            return response()->json(['message' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
