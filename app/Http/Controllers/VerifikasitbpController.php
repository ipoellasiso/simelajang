<?php

namespace App\Http\Controllers;

use App\Models\PotonganguModel;
use App\Models\TbpModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifikasitbpController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'             => 'Verifikasi TBP',
            'active_side_tarik' => 'active',
            'active_tarikgu'    => 'active',
            'page_title'        => 'Pengaturan',
            'breadcumd1'        => 'Verifikasi',
            'breadcumd2'        => 'TBP',
            'userx'             => UserModel::where('id',$userId)->first(['fullname','role','gambar']),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
        );

        if ($request->ajax()) {
            $datapajakls = DB::table('tb_tbp')
                        ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status')
                        // ->join('sp2d', 'sp2d.nomor_spm', 'tb_tbp.no_spm')
                        ->where('status',['Belum_Verifikasi'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                        ->get();

            return DataTables::of($datapajakls)
                    ->addIndexColumn()
                    ->addColumn('nilai_tbp', function($row) {
                        return number_format($row->nilai_tbp);
                    })
                    ->addColumn('status', function($row){
                        if($row->status == 'Belum_Verifikasi')
                        {
                            $btn1 = '
                                    
                                  <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->nomor_tbp.'" class="verifikasiterimatbp btn btn-outline-primary m-b-xs"><i class="fas fa-thumbs-up"></i> Terima
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->addColumn('statustolak', function($row){
                        if($row->status == 'Belum_Verifikasi')
                        {
                            $btn1 = '
                                    
                                  <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->nomor_tbp.'" class="verifikasitolaktbp btn btn-outline-danger m-b-xs"><i class="fas fa-thumbs-down"></i> Tolak
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->rawColumns(['nilai_tbp', 'status', 'statustolak'])
                    ->make(true);
        }


        return view('Verifikasi_TBP.tampilveriftbp', $data);
    }

    public function indexnew(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'             => 'Verifikasi TBP',
            'active_side_tarik' => 'active',
            'active_tarikgu'    => 'active',
            'page_title'        => 'Pengaturan',
            'breadcumd1'        => 'Verifikasi',
            'breadcumd2'        => 'TBP',
            'userx'             => UserModel::where('id',$userId)->first(['fullname','role','gambar']),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
        );

        if ($request->ajax()) {
            $datapajakls = DB::table('tb_potongangu')
                        ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_potongangu.id_billing', 'tb_potongangu.nilai_tbp_pajak_potongan', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.status1', 'tb_potongangu.id')
                        ->join('tb_tbp', 'tb_tbp.id_tbp', 'tb_potongangu.id_tbp')
                        ->where('tb_potongangu.status1',['Belum_Verifikasi'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                        ->get();

            return DataTables::of($datapajakls)
                    ->addIndexColumn()
                    ->addColumn('nilai_tbp', function($row) {
                        return number_format($row->nilai_tbp);
                    })
                    ->addColumn('nilai_tbp_pajak_potongan', function($row) {
                        return number_format($row->nilai_tbp_pajak_potongan);
                    })
                    ->addColumn('status', function($row){
                        if($row->status1 == 'Belum_Verifikasi')
                        {
                            $btn2 = '
                                    
                                  <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->nomor_tbp.'" class="verifikasiterimatbp btn btn-outline-primary m-b-xs"><i class="fas fa-thumbs-up"></i> Terima
                                    </a>
                                  ';
                        }
                        return $btn2;
                    })
                    ->addColumn('statustolak', function($row){
                        if($row->status1 == 'Belum_Verifikasi')
                        {
                            $btn1 = '
                                    
                                  <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->nomor_tbp.'" class="verifikasitolaktbp btn btn-outline-danger m-b-xs"><i class="fas fa-thumbs-down"></i> Tolak
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->rawColumns(['nilai_tbp', 'status', 'statustolak','nilai_tbp_pajak_potongan'])
                    ->make(true);
        }


        return view('Verifikasi_TBP.tampilveriftbpnew', $data);
    }

    public function tolaktbp($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PotonganguModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function tolaktbpupdate(Request $request, string $id)
    {

        PotonganguModel::where('id',$request->get('id'))
        ->update([
            'status1' => 'Tolak',
        ]);

        return redirect()->back()->with('success','Data Berhasil Ditolak');
    }

    public function terimatbp($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PotonganguModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function terimatbpupdate(Request $request, string $id)
    {

        PotonganguModel::where('id',$request->get('id'))
        ->update([
            'status1' => 'Terima',
            'status4' => 'Belum',
            'status3' => 0,
        ]);

            return redirect()->back()->with('success','Data Berhasil Ditolak');
    }

}
