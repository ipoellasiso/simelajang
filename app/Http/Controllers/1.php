<?php

namespace App\Http\Controllers;

use App\Models\AkunpajakModel;
use App\Models\PajaklsModel;
use App\Models\Potongan2Model;
use App\Models\PotonganModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;
use App\Imports\DataImport;
use Maatwebsite\Excel\Row;

class LaporanlsController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Laporan Pajak LS',
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
            'total_pajakls'          => PajaklsModel::where('status2', 'Terima')->sum('nilai_pajak'),
        );

        return view('Laporan_LS.Tampilindekslaporanls', $data);
    }

    public function laporanls(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Cetak Pajak LS',
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
            'total_pajakls'          => PajaklsModel::where('status2', 'Terima')->sum('nilai_pajak'),
        );

        if ($request->tampilawal) {
            return view('Laporan_LS.Viewkosonglaporanls',[]);
        } else {
            // $bulan1 = PajaklsModel::findOrFail($request->periode);
            // $bulan = 'Satu'. ' '. $bulan1->periode;
            // $cari_bulan = '';
            $datapajakls = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan');
                            
            
            if ($request->filled('periode')) {
                $datapajakls = $datapajakls->where('periode', $request->periode);
                
            }

            if ($request->filled('akun_pajak')) {
                $datapajakls = $datapajakls->where('akun_pajak', $request->akun_pajak);
            }

            if ($request->filled('jenis_pajak')) {
                $datapajakls = $datapajakls->where('jenis_pajak', $request->jenis_pajak);
            }

            if ($request->filled('jenis_pajak')) {
                $datapajakls = $datapajakls->where('jenis_pajak', $request->jenis_pajak);
            }

            $datapajakls = $datapajakls->get();

            $totalpajakls = DB::table('pajakkpp')
                            ->select('pajakkpp.nilai_pajak')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->where('pajakkpp.nilai_pajak', $request)
                            ->first();

            return view('Laporan_LS.Viewisilaporanls',$data, compact('datapajakls','totalpajakls'));
        }
    }
}
