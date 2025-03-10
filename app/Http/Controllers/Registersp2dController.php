<?php

namespace App\Http\Controllers;

use App\Models\AkunpajakModel;
use App\Models\PajaklsModel;
use App\Models\Potongan2Model;
use App\Models\PotonganModel;
use App\Models\Sp2dModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Registersp2dController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Get data
    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Register SP2D',
            'active_side_regsp2d'  => 'active',
            'active_regsp2d'       => 'active',
            'page_title'           => 'Pengaturan',
            'breadcumd1'           => 'Register',
            'breadcumd2'           => 'SP2D',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'total_1'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-01-01', '2025-01-31'])->sum('nilai_sp2d'),
            'total_2'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-02-01', '2025-02-28'])->sum('nilai_sp2d'),
            'total_3'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-03-01', '2025-03-31'])->sum('nilai_sp2d'),
            'total_4'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-04-01', '2025-04-30'])->sum('nilai_sp2d'),
            'total_5'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-05-01', '2025-05-31'])->sum('nilai_sp2d'),
            'total_6'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-06-01', '2025-06-30'])->sum('nilai_sp2d'),
            'total_7'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-07-01', '2025-07-31'])->sum('nilai_sp2d'),
            'total_8'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-08-01', '2025-08-31'])->sum('nilai_sp2d'),
            'total_9'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-09-01', '2025-09-30'])->sum('nilai_sp2d'),
            'total_10'           => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-10-01', '2025-10-31'])->sum('nilai_sp2d'),
            'total_11'           => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-11-01', '2025-11-30'])->sum('nilai_sp2d'),
            'total_12'           => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-12-01', '2025-12-31'])->sum('nilai_sp2d'),
            'totalsp2d'          => Sp2dModel::sum('nilai_sp2d'),
            'totalcount1'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-01-01', '2025-01-31'])->count('nomor_sp2d'),
            'totalcount2'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-02-01', '2025-02-28'])->count('nomor_sp2d'),
            'totalcount3'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-03-01', '2025-03-31'])->count('nomor_sp2d'),
            'totalcount4'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-04-01', '2025-04-30'])->count('nomor_sp2d'),
            'totalcount5'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-05-01', '2025-05-31'])->count('nomor_sp2d'),
            'totalcount6'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-06-01', '2025-06-30'])->count('nomor_sp2d'),
            'totalcount7'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-07-01', '2025-07-31'])->count('nomor_sp2d'),
            'totalcount8'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-08-01', '2025-08-31'])->count('nomor_sp2d'),
            'totalcount9'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-09-01', '2025-09-30'])->count('nomor_sp2d'),
            'totalcount10'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-10-01', '2025-10-31'])->count('nomor_sp2d'),
            'totalcount11'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-11-01', '2025-11-30'])->count('nomor_sp2d'),
            'totalcount12'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-12-01', '2025-12-31'])->count('nomor_sp2d'),
            'totalcount13'        => Sp2dModel::count('nomor_sp2d'),
        );

        if ($request->ajax()) {

            $datapajakls = DB::table('sp2d')
                        ->select('tanggal_sp2d', 'nomor_sp2d', 'nama_skpd', 'nama_pihak_ketiga', 'keterangan_sp2d', 'jenis', 'nilai_sp2d', 'nomor_spm')
                        ->get();

            return Datatables::of($datapajakls)
                    ->addIndexColumn()
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    ->rawColumns(['nilai_sp2d'])
                    ->make(true);
                    
        }  

        return view('Register_Sp2d.Registersp2d', $data);   
    }


}
