<?php

namespace App\Http\Controllers;

use App\Models\PajakguModel;
use App\Models\PajaklsModel;
use App\Models\Sp2dModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 'Pajakgu21' => $this->ModelJumlah->Pajakgunanggotapph21($id_anggota),

    $userId = Auth::guard('web')->user()->id;
    $data = array(
            'title'                => 'Home Admin',
            'active_side_home'     => 'active',
            'active_home'          => 'active',
            'page_title'           => 'Main',
            'breadcumd1'           => 'Dashboard',
            'breadcumd2'           => 'Dashboard',
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
            'total_ppngu'          => PajakguModel::where('jenis_pajak', 'Pajak Pertambahan Nilai')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph21gu'        => PajakguModel::where('jenis_pajak', 'PPH 21')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph22gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 22')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph23gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 23')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pph24gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 24')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pajakgu'        => PajakguModel::where('status2', 'Terima')->sum('nilai_pajak'),
            'total1'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-01-01', '2025-01-31'])->sum('nilai_sp2d'),
            'total2'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-02-01', '2025-02-29'])->sum('nilai_sp2d'),
            'total3'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-03-01', '2025-03-31'])->sum('nilai_sp2d'),
            'total4'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-04-01', '2025-04-30'])->sum('nilai_sp2d'),
            'total5'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-05-01', '2025-05-31'])->sum('nilai_sp2d'),
            'total6'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-06-01', '2025-06-30'])->sum('nilai_sp2d'),
            'total7'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-07-01', '2025-07-31'])->sum('nilai_sp2d'),
            'total8'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-08-01', '2025-08-31'])->sum('nilai_sp2d'),
            'total9'               => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-09-01', '2025-09-30'])->sum('nilai_sp2d'),
            'total10'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-10-01', '2025-10-31'])->sum('nilai_sp2d'),
            'totall11'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-11-01', '2025-11-30'])->sum('nilai_sp2d'),
            'total12'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-12-01', '2025-12-31'])->sum('nilai_sp2d'),
            'total11'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-01-01', '2025-01-31'])->count('nomor_sp2d'),
            'total21'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-02-01', '2025-02-29'])->count('nomor_sp2d'),
            'total31'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-03-01', '2025-03-31'])->count('nomor_sp2d'),
            'total41'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-04-01', '2025-04-30'])->count('nomor_sp2d'),
            'total51'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-05-01', '2025-05-31'])->count('nomor_sp2d'),
            'total61'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-06-01', '2025-06-30'])->count('nomor_sp2d'),
            'total71'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-07-01', '2025-07-31'])->count('nomor_sp2d'),
            'total81'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-08-01', '2025-08-31'])->count('nomor_sp2d'),
            'total91'              => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-09-01', '2025-09-30'])->count('nomor_sp2d'),
            'total101'             => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-10-01', '2025-10-31'])->count('nomor_sp2d'),
            'total111'             => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-11-01', '2025-11-30'])->count('nomor_sp2d'),
            'total121'             => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-12-01', '2025-12-31'])->count('nomor_sp2d'),
        );

        // $dtidopd = DB::table('pajakkpp')->where('jenis_pajak', ['Pajak Pertambahan Nilai'])->sum('nilai_pajak')->first();

        // $dtppnls = DB::select('SELECT SUM(nilai_pajak) as nilai_pajak1 FROM pajakkpp WHERE jenis_pajak="Pajak Penghasilan Ps 4 (2)"');
        // $dtppnls = PajaklsModel::sum('nilai_pajak');

        // $total_kas_masjid = $kas_masjid_masuk - $kas_masjid_keluar;
      
        return view('Dashboard', $data);

        // return view('Dashboard', $data);
    }
}
