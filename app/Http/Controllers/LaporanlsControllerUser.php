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
use App\Exports\DataExportbeluminput;
use App\Imports\DataImport;
use Maatwebsite\Excel\Row;

use Barryvdh\DomPDF\Facade\Pdf;

class LaporanlsControllerUser extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'total_ppn'            => PajaklsModel::where('potongan2.jenis_pajak', 'Pajak Pertambahan Nilai')
                                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    ->where('status2', 'Terima')
                                    ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                                    ->sum('potongan2.nilai_pajak'),
            'total_pph21'          => PajaklsModel::where('potongan2.jenis_pajak', 'PPH 21')
                                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    ->where('status2', 'Terima')
                                    ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                                    ->sum('potongan2.nilai_pajak'),
            'total_pph22'          => PajaklsModel::where('potongan2.jenis_pajak', 'Pajak Penghasilan PS 22')
                                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    ->where('status2', 'Terima')
                                    ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                                    ->sum('potongan2.nilai_pajak'),
            'total_pph23'          => PajaklsModel::where('potongan2.jenis_pajak', 'Pajak Penghasilan PS 23')
                                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    ->where('status2', 'Terima')
                                    ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                                    ->sum('potongan2.nilai_pajak'),
            'total_pph24'          => PajaklsModel::where('potongan2.jenis_pajak', 'Pajak Penghasilan PS 24')
                                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    ->where('status2', 'Terima')
                                    ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                                    ->sum('potongan2.nilai_pajak'),
            'total_pajakls'          => PajaklsModel::where('status2', 'Terima')
                                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    // ->where('status2', 'Terima')
                                    ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                                    ->sum('potongan2.nilai_pajak'),
        );

        return view('Laporan_LS_User.Tampilindekslaporanlsuser', $data);
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
            return view('Laporan_LS_User.Viewkosonglaporanlsuser',[]);
        } else {
            // $bulan1 = PajaklsModel::findOrFail($request->periode);
            // $bulan = 'Satu'. ' '. $bulan1->periode;
            // $cari_bulan = '';
            $datapajakls = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->join('users', 'users.nama_opd', 'sp2d.nama_skpd')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode."%")
                            ->where('pajakkpp.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkpp.status2','like', "%".$request->status2."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->get();

            $bulan = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->join('users', 'users.nama_opd', 'sp2d.nama_skpd')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->where('pajakkpp.periode','like',"%".$request->periode."%")
                            ->where('pajakkpp.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkpp.status2','like', "%".$request->status2."%")
                            ->first();
            
            

            // return view('Laporan_LS.Viewisilaporanls',$data, compact('datapajakls'));
            return view('Laporan_LS_User.Viewisilaporanlsuser',[
                'data' => $data,
                'datapajakls' => $datapajakls,
                'bulan' => $bulan,
            ]);
        }
    }

    public function laporanlsrekap(Request $request)
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

        if ($request->tampilawalrekap) {
            return view('Laporan_LS_User.Viewkosonglaporanlsuser',[]);
        } else {
            // $bulan1 = PajaklsModel::findOrFail($request->periode);
            // $bulan = 'Satu'. ' '. $bulan1->periode;
            // $cari_bulan = '';
            $datapajaklsrekap = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->join('users', 'users.nama_opd', 'sp2d.nama_skpd')
                            // ->where('pajakkpp.akun_pajak', 'Pajak Pertambahan Nilai')->where('status2', 'Terima')->sum('nilai_pajak')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode2."%")
                            ->where('pajakkpp.status2','like', "%".$request->status22."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode3."%")
                            ->where('pajakkpp.status2','like', "%".$request->status23."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->get();

            $bulanrekap = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->join('users', 'users.nama_opd', 'sp2d.nama_skpd')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode2."%")
                            ->where('pajakkpp.status2','like', "%".$request->status22."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode3."%")
                            ->where('pajakkpp.status2','like', "%".$request->status23."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->first();
            
            

            // return view('Laporan_LS.Laporan_Rekap.Viewisilaporanlsrekap',$data, compact('datapajaklsrekap', 'bulanrekap'));
            return view('Laporan_LS_User.Laporan_Rekap.Viewisilaporanlsrekapuser' ,[
                'data' => $data,
                'datapajaklsrekap' => $datapajaklsrekap,
                'bulanrekap' => $bulanrekap,
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
            'title'                => 'Cetak Pajak LS PDF',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Laporan',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'LS',
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

        $cetakpajakls = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->join('users', 'users.nama_opd', 'sp2d.nama_skpd')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode."%")
                            ->where('pajakkpp.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkpp.status2','like', "%".$request->status2."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode3."%")
                            ->where('pajakkpp.status2','like', "%".$request->status23."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->get();

            $cetakbulan = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->join('users', 'users.nama_opd', 'sp2d.nama_skpd')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode."%")
                            ->where('pajakkpp.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkpp.status2','like', "%".$request->status2."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode3."%")
                            ->where('pajakkpp.status2','like', "%".$request->status23."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->first();
        
        if ($request->page == 'laporan'){
            return view('Laporan_LS_User.cetakisilaporanlsuser', $data, compact('cetakpajakls', 'cetakbulan'));
        }
    }

    public function cetakrekapls(Request $request)
    {
        // $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Cetak Rekap Pajak LS',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Rekapan',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'LS',
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

        $datapajaklsrekap = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode' , 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->join('users', 'users.nama_opd', 'sp2d.nama_skpd')
                            // ->where('pajakkpp.akun_pajak', 'Pajak Pertambahan Nilai')->where('status2', 'Terima')->sum('nilai_pajak')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode2."%")
                            ->where('pajakkpp.status2','like', "%".$request->status22."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode3."%")
                            ->where('pajakkpp.status2','like', "%".$request->status23."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->get();
            
            $bulanrekap = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud', 'users.nama_pa_kpa', 'users.nip_pa_kpa')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->join('users', 'users.nama_opd', 'sp2d.nama_skpd')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd24."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode2."%")
                            ->where('pajakkpp.status2','like', "%".$request->status22."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode3."%")
                            ->where('pajakkpp.status2','like', "%".$request->status23."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->first();
        
        if ($request->page == 'rekaplaporan'){
            return view('Laporan_LS_User.Laporan_Rekap.cetakisilaporanlsrekapuser', $data, compact('datapajaklsrekap', 'bulanrekap'));
        }

        // return view('Laporan_LS.cetakisilaporanls', $data, compact('cetakpajakls', 'cetakbulan'));
    }

    public function Exportexcells(Request $request)
    {
        $datapajakls = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode."%")
                            ->where('pajakkpp.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkpp.status2','like', "%".$request->status2."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->get();
        
        $bulan = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode."%")
                            ->where('pajakkpp.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkpp.status2','like', "%".$request->status2."%")
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->first();

        if ($request->page == 'downloadexcel'){
            return Excel::download(new DataExport2($datapajakls, $bulan), 'pajakls.xlsx');
            // return view('Laporan_LS.cetakisilaporanls', $data, compact('cetakpajakls', 'cetakbulan'));
        }
    }

}
