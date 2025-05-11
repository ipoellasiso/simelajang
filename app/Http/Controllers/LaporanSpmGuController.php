<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PajaklsModel;
use App\Exports\DataExport2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use Maatwebsite\Excel\Facades\Excel;

class LaporanSpmGuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Laporan Pajak SPM GU',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Laporan',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'total_ppn'            => PajaklsModel::where('jenis_pajak', 'Pajak Pertambahan Nilai')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph21'          => PajaklsModel::where('jenis_pajak', 'PPH 21')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph22'          => PajaklsModel::where('jenis_pajak', 'Pajak Penghasilan PS 22')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph23'          => PajaklsModel::where('jenis_pajak', 'Pajak Penghasilan PS 23')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph24'          => PajaklsModel::where('jenis_pajak', 'Pajak Penghasilan PS 24')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pajakls'        => PajaklsModel::where('status2', 'Terima')->sum('nilai_pajak'),
        );

        return view('Laporan_GU_SPM_Admin.Tampilindekslaporanguspm', $data);
    }

    public function laporangu(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Cetak Pajak SPM GU',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Laporan',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'LS',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'total_ppn'            => PajaklsModel::where('jenis_pajak', 'Pajak Pertambahan Nilai')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph21'          => PajaklsModel::where('jenis_pajak', 'PPH 21')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph22'          => PajaklsModel::where('jenis_pajak', 'Pajak Penghasilan PS 22')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph23'          => PajaklsModel::where('jenis_pajak', 'Pajak Penghasilan PS 23')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph24'          => PajaklsModel::where('jenis_pajak', 'Pajak Penghasilan PS 24')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pajakls'        => PajaklsModel::where('status2', 'Terima')->sum('nilai_pajak'),
        );

        if ($request->tampilawal) {
            return view('Laporan_GU_SPM_Admin.Viewkosonglaporanguspm',[]);
        } else {
            // $bulan1 = PajaklsModel::findOrFail($request->periode);
            // $bulan = 'Satu'. ' '. $bulan1->periode;
            // $cari_bulan = '';
            $datapajakguspm = DB::table('tb_tbp')
                            ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_tbp.id', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.nilai_tbp_pajak_potongan', 'tb_potongangu.status1')
                            ->join('tb_potongangu', 'tb_potongangu.id_tbp', 'tb_tbp.id_tbp')
                            ->where('tb_tbp.nama_skpd','like', "%".$request->nama_skpd."%") 
                            ->where('tb_potongangu.nama_pajak_potongan','like',"%".$request->nama_pajak_potongan."%")
                            ->where('tb_potongangu.status1','like', "%".$request->status1."%")
                            ->get();

            $bulanspm =      DB::table('tb_tbp')
                            ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_tbp.id', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.nilai_tbp_pajak_potongan', 'tb_potongangu.status1')
                            ->join('tb_potongangu', 'tb_potongangu.id_tbp', 'tb_tbp.id_tbp')
                            ->where('tb_tbp.nama_skpd','like', "%".$request->nama_skpd."%") 
                            ->where('tb_potongangu.nama_pajak_potongan','like',"%".$request->nama_pajak_potongan."%")
                            ->where('tb_potongangu.status1','like', "%".$request->status1."%")
                            ->first();
            
            

            // return view('Laporan_LS.Viewisilaporanls',$data, compact('datapajakls'));
            return view('Laporan_GU_SPM_Admin.Viewisilaporanguspm',[
                'data' => $data,
                'datapajakguspm' => $datapajakguspm,
                'bulanspm' => $bulanspm,
            ]);
        }
    }

    public function Exportexcelguspm(Request $request)
    {
        $datapajakguspm = DB::table('tb_tbp')
                            ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_tbp.id', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.nilai_tbp_pajak_potongan', 'tb_potongangu.status1')
                            ->join('tb_potongangu', 'tb_potongangu.id_tbp', 'tb_tbp.id_tbp')
                            ->where('tb_tbp.nama_skpd','like', "%".$request->nama_skpd."%") 
                            ->where('tb_potongangu.nama_pajak_potongan','like',"%".$request->nama_pajak_potongan."%")
                            ->where('tb_potongangu.status1','like', "%".$request->status1."%")
                            ->get();
        
        $bulanspm = DB::table('tb_tbp')
                    ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_tbp.id', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.nilai_tbp_pajak_potongan', 'tb_potongangu.status1')
                    ->join('tb_potongangu', 'tb_potongangu.id_tbp', 'tb_tbp.id_tbp')
                    ->where('tb_tbp.nama_skpd','like', "%".$request->nama_skpd."%") 
                    ->where('tb_potongangu.nama_pajak_potongan','like',"%".$request->nama_pajak_potongan."%")
                    ->where('tb_potongangu.status1','like', "%".$request->status1."%")
                    ->first();

        if ($request->page == 'downloadexcel'){
            return Excel::download(new DataExport2($datapajakguspm, $bulanspm), 'pajakguspm.xlsx');
            // return view('Laporan_LS.cetakisilaporanls', $data, compact('cetakpajakls', 'cetakbulan'));
        }
    }


}
