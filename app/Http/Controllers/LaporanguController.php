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
use App\Exports\DataExport2;
use App\Imports\DataImport;
use Maatwebsite\Excel\Row;

use Barryvdh\DomPDF\Facade\Pdf;

class LaporanguController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Laporan Pajak GU',
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
            'total_pajakls'          => PajaklsModel::where('status2', 'Terima')->sum('nilai_pajak'),
        );

        return view('Laporan_GU.Tampilindekslaporangu', $data);
    }

    public function laporangu(Request $request)
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
            return view('Laporan_GU.Viewkosonglaporangu',[]);
        } else {
            // $bulan1 = PajaklsModel::findOrFail($request->periode);
            // $bulan = 'Satu'. ' '. $bulan1->periode;
            // $cari_bulan = '';
            $datapajakgu = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode."%")
                            ->where('pajakkppgu.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status2."%")
                            ->get();

            $bulan =      DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode."%")
                            ->where('pajakkppgu.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status2."%")
                            ->first();
            
            

            // return view('Laporan_LS.Viewisilaporanls',$data, compact('datapajakls'));
            return view('Laporan_GU.Viewisilaporangu',[
                'data' => $data,
                'datapajakgu' => $datapajakgu,
                'bulan' => $bulan,
            ]);
        }
    }

    public function laporangurekap(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Cetak Pajak GU',
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
            'total_pajakls'          => PajaklsModel::where('status2', 'Terima')->sum('nilai_pajak'),
        );

        if ($request->tampilawalrekap) {
            return view('Laporan_GU.Viewkosonglaporangu',[]);
        } else {
            // $bulan1 = PajaklsModel::findOrFail($request->periode);
            // $bulan = 'Satu'. ' '. $bulan1->periode;
            // $cari_bulan = '';
            $datapajakgurekap = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode2."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status22."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->get();

            $bulanrekap = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode2."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status22."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->first();
            
            

            // return view('Laporan_LS.Laporan_Rekap.Viewisilaporanlsrekap',$data, compact('datapajaklsrekap', 'bulanrekap'));
            return view('Laporan_GU.Laporan_Rekap.Viewisilaporangurekap',[
                'data' => $data,
                'datapajakgurekap' => $datapajakgurekap,
                'bulanrekap' => $bulanrekap,
            ]);
        }
    }

    public function laporangurekapsemuaopd(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Cetak Pajak GU',
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
            'total_pajakls'          => PajaklsModel::where('status2', 'Terima')->sum('nilai_pajak'),
        );

        if ($request->tampilawalrekap) {
            return view('Laporan_GU.Viewkosonglaporangu',[]);
        } else {
            // $bulan1 = PajaklsModel::findOrFail($request->periode);
            // $bulan = 'Satu'. ' '. $bulan1->periode;
            // $cari_bulan = '';
            $datapajakgurekapsemuaopd = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode2."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status22."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->get();

            $bulanrekapsemuaopd = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode2."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status22."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->first();
            
            

            // return view('Laporan_LS.Laporan_Rekap.Viewisilaporanlsrekap',$data, compact('datapajaklsrekap', 'bulanrekap'));
            return view('Laporan_GU.Laporan_Rekap.Viewisilaporangurekapsemuaopd',[
                'data' => $data,
                'datapajakgurekapsemuaopd' => $datapajakgurekapsemuaopd,
                'bulanrekapsemuaopd' => $bulanrekapsemuaopd,
            ]);
        }
    }

    public function getDataopd()
    {
        $opd = DB::table('opd')
        ->select('id', 'nama_opd')
        ->get();
        return response()->json($opd);
    }

    public function cetak(Request $request)
    {
        // $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Cetak Pajak GU PDF',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Laporan',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'GU',
            // 'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
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

        // dd(["Nama OPD : ".$nama_skpd, "Periode : ".$periode, "Akun Pajak : ".$akun_pajak, "Status : ".$status2]);

        $cetakpajakgu = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode."%")
                            ->where('pajakkppgu.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status2."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->get();

            $cetakbulan = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode."%")
                            ->where('pajakkppgu.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status2."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->first();
        
        if ($request->page == 'laporan'){
            return view('Laporan_GU.cetakisilaporangu', $data, compact('cetakpajakgu', 'cetakbulan'));
        }

        // return view('Laporan_LS.cetakisilaporanls', $data, compact('cetakpajakls', 'cetakbulan'));
    }

    public function cetakrekapgu(Request $request)
    {
        // $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Cetak Rekap Pajak GU',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Rekapan',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'GU',
            // 'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
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

        // dd(["Nama OPD : ".$nama_skpd, "Periode : ".$periode, "Akun Pajak : ".$akun_pajak, "Status : ".$status2]);

        $datapajakgurekap = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode2."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status22."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->get();
            
            $bulanrekap = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode2."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status22."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->first();
        
        if ($request->page == 'rekaplaporan'){
            return view('Laporan_GU.Laporan_Rekap.cetakisilaporangurekap', $data, compact('datapajakgurekap', 'bulanrekap'));
        }

        // return view('Laporan_LS.cetakisilaporanls', $data, compact('cetakpajakls', 'cetakbulan'));
    }

    public function cetakrekapgusemuaopd(Request $request)
    {
        // $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Cetak Rekap Pajak GU',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Rekapan',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'GU',
            // 'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
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

        // dd(["Nama OPD : ".$nama_skpd, "Periode : ".$periode, "Akun Pajak : ".$akun_pajak, "Status : ".$status2]);

        $datapajakgurekap = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode2."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status22."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->get();
            
            $bulanrekap = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode2."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status22."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode3."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status23."%")
                            ->first();
        
        if ($request->page == 'rekaplaporansemuaopd'){
            return view('Laporan_GU.Laporan_Rekap.cetakisilaporangurekapsemuaopd', $data, compact('datapajakgurekap', 'bulanrekap'));
        }

        // return view('Laporan_LS.cetakisilaporanls', $data, compact('cetakpajakls', 'cetakbulan'));
    }

    public function Exportexcelgu(Request $request)
    {
        $datapajakgu = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode."%")
                            ->where('pajakkppgu.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status2."%")
                            ->get();
        
        $bulan = DB::table('pajakkppgu')
                            ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.status1', 'sp2d.nama_skpd', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                            ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkppgu.periode','like',"%".$request->periode."%")
                            ->where('pajakkppgu.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkppgu.status2','like', "%".$request->status2."%")
                            ->first();

        if ($request->page == 'downloadexcel'){
            return Excel::download(new DataExport2($datapajakgu, $bulan), 'pajakgu.xlsx');
            // return view('Laporan_LS.cetakisilaporanls', $data, compact('cetakpajakls', 'cetakbulan'));
        }
    }

}
