<?php

namespace App\Http\Controllers;

use App\Models\PajakguModel;
use App\Models\PajaklsModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboarduserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    $userId = Auth::guard('web')->user()->id;
    $data = array(
            'title'                => 'Home User',
            'active_side_home'     => 'active',
            'active_home'          => 'active',
            'page_title'           => 'Main',
            'breadcumd1'           => 'Dashboard',
            'breadcumd2'           => 'Dashboard',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('opd')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    // ->join('opd', 'users.id_opd', 'opd.id',)
                                    ->first(),
            'total_ppngu'          => PajakguModel::where('jenis_pajak', 'Pajak Pertambahan Nilai')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph21gu'        => PajakguModel::where('jenis_pajak', 'PPH 21')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph22gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 22')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph23gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 23')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph24gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 24')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pajakgu'        => PajakguModel::where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pajakls'        => PajaklsModel::join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')->where('status2', 'Terima')->where('sp2d.nama_skpd', auth()->user()->nama_opd)->sum('pajakkpp.nilai_pajak'),
        );

        return view('Dashboarduser', $data);
    }
}
