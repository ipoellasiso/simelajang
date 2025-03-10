<?php

namespace App\Http\Controllers;

use App\Models\PajakguModel;
use App\Models\PajaklsModel;
use App\Models\ProfilModel;
use App\Models\Sp2dModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
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
                                    // ->select('users.fullname','users.role','users.gambar','profil.nip','profil.instansi','profil.alamat','profil.no_hp','profil.hobi')
                                    // ->join('profil',  'profil.fullname', 'users.fullname')
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
            'profilx'               => DB::table('profil')
            //                         ->select('users.fullname','users.role','users.gambar','profil.nip','profil.instansi','profil.alamat','profil.no_hp','profil.hobi')
            //                         ->join('profil',  'profil.fullname', 'users.fullname')
            //                         ->where('nama_opd', auth()->user()->nama_opd)->first(),
                                    ->where('fullname', auth()->user()->fullname)
                                    ->first(),
                                    
        );

        // $dtidopd = DB::table('pajakkpp')->where('jenis_pajak', ['Pajak Pertambahan Nilai'])->sum('nilai_pajak')->first();

        // $dtppnls = DB::select('SELECT SUM(nilai_pajak) as nilai_pajak1 FROM pajakkpp WHERE jenis_pajak="Pajak Penghasilan Ps 4 (2)"');
        // $dtppnls = PajaklsModel::sum('nilai_pajak');

        // $total_kas_masjid = $kas_masjid_masuk - $kas_masjid_keluar;
      
        return view('Profil.Profil', $data);

        // return view('Dashboard', $data);
    }
}
