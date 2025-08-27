<?php

namespace App\Http\Controllers;

use App\Models\BelanjalsguModel;
use App\Models\Sp2dModel;
use App\Models\Sp2dtppModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LapRekaptppController extends Controller
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
            'title'                => 'Data SP2D TPP',
            'active_side_regsp2d'  => 'active',
            'active_regsp2d'       => 'active',
            'page_title'           => 'Pengaturan',
            'breadcumd1'           => 'Data',
            'breadcumd2'           => 'SP2D TPP',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            // 'total_1'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-01-01', '2025-01-31'])->sum('nilai_sp2d'),
            // 'total_2'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-02-01', '2025-02-28'])->sum('nilai_sp2d'),
            // 'total_3'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-03-01', '2025-03-31'])->sum('nilai_sp2d'),
            // 'total_4'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-04-01', '2025-04-30'])->sum('nilai_sp2d'),
            // 'total_5'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-05-01', '2025-05-31'])->sum('nilai_sp2d'),
            // 'total_6'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-06-01', '2025-06-30'])->sum('nilai_sp2d'),
            // 'total_7'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-07-01', '2025-07-31'])->sum('nilai_sp2d'),
            // 'total_8'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-08-01', '2025-08-31'])->sum('nilai_sp2d'),
            // 'total_9'            => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-09-01', '2025-09-30'])->sum('nilai_sp2d'),
            // 'total_10'           => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-10-01', '2025-10-31'])->sum('nilai_sp2d'),
            // 'total_11'           => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-11-01', '2025-11-30'])->sum('nilai_sp2d'),
            // 'total_12'           => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-12-01', '2025-12-31'])->sum('nilai_sp2d'),
            // 'totalsp2d'          => Sp2dModel::sum('nilai_sp2d'),
            // 'totalcount1'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-01-01', '2025-01-31'])->count('nomor_sp2d'),
            // 'totalcount2'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-02-01', '2025-02-28'])->count('nomor_sp2d'),
            // 'totalcount3'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-03-01', '2025-03-31'])->count('nomor_sp2d'),
            // 'totalcount4'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-04-01', '2025-04-30'])->count('nomor_sp2d'),
            // 'totalcount5'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-05-01', '2025-05-31'])->count('nomor_sp2d'),
            // 'totalcount6'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-06-01', '2025-06-30'])->count('nomor_sp2d'),
            // 'totalcount7'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-07-01', '2025-07-31'])->count('nomor_sp2d'),
            // 'totalcount8'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-08-01', '2025-08-31'])->count('nomor_sp2d'),
            // 'totalcount9'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-09-01', '2025-09-30'])->count('nomor_sp2d'),
            // 'totalcount10'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-10-01', '2025-10-31'])->count('nomor_sp2d'),
            // 'totalcount11'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-11-01', '2025-11-30'])->count('nomor_sp2d'),
            // 'totalcount12'        => Sp2dModel::whereBetween('sp2d.tanggal_sp2d', ['2025-12-01', '2025-12-31'])->count('nomor_sp2d'),
            // 'totalcount13'        => Sp2dModel::count('nomor_sp2d'),
        );

        if ($request->ajax()) {

            $datapajakls = DB::table('sp2d')
                        ->select('tanggal_sp2d', 'nomor_sp2d', 'nama_skpd', 'nama_pihak_ketiga', 'keterangan_sp2d', 'jenis', 'nilai_sp2d', 'nomor_spm', 'belanja1.norekening', 'belanja1.uraian', 'belanja1.id', 'belanja1.nilai', 'belanja1.status1')
                        ->join('belanja1', 'belanja1.id_sp2d', 'sp2d.idhalaman')
                        ->whereIn('belanja1.uraian', ['Tambahan Penghasilan berdasarkan Beban Kerja PNS', 'Tambahan Penghasilan berdasarkan Kondisi Kerja PNS', 'Tambahan Penghasilan berdasarkan Prestasi Kerja PNS', 'Iuran Jaminan Kesehatan 4%', 'Belanja Iuran Jaminan Kesehatan PPPK', 'Belanja Iuran Jaminan Kesehatan PNS', 'askes'])
                        // ->where('belanja1.status1',['Belum'])
                        ->get();

            return Datatables::of($datapajakls)
                    ->addIndexColumn()
                    ->addColumn('action1', function($row){
                        if($row->status1 == 'Input')
                        {
                        $btn1 = '
                                   
                                ';
                        }else{
                        
                            $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="editsp2dtpp btn btn-outline-danger m-b-xs btn-sm">Input
                                    </a>
                                ';
                        }

                        return $btn1;
                    })
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    ->addColumn('nilai', function($row) {
                        return number_format($row->nilai);
                    })
                    ->rawColumns(['nilai_sp2d', 'action1', 'nilai'])
                    ->make(true);
                    
        }  

        return view('Sp2d_tpp.Sp2dtpp', $data);   
    }

    public function store(Request $request)
    {

        $sp2dtppid = $request->id;

        $cekopd = Sp2dtppModel::where('id_sp2d', $request->id_sp2d)->where('id', '!=', $request->id)->first();

        if($cekopd)
        {
            return response()->json(['error'=>'Ebilling sudah ada']);
        }

            $belanja1 = [
                'status1' => 'Input',
            ];

            $details = [
                'id_belanja1'   => $request->id,
                'id_sp2d'       => $request->id_sp2d,
                'periode'       => $request->periode,
                'status1'       => $request->status1,
                'status2'       => 'Input',
            ];
        

            Sp2dtppModel::updateOrCreate(['id' => $sp2dtppid], $details);
            BelanjalsguModel::updateOrCreate(['id' => $sp2dtppid], $belanja1);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function editsp2dtpp($id)
    {
        $where = array('id' => $id);
        $sp2dtpp = DB::table('sp2d')
                        ->select('tanggal_sp2d', 'nomor_sp2d', 'nama_skpd', 'nama_pihak_ketiga', 'keterangan_sp2d', 'jenis', 'nilai_sp2d', 'nomor_spm', 'belanja1.norekening', 'belanja1.uraian', 'belanja1.id', 'belanja1.nilai', 'belanja1.id_sp2d')
                        ->join('belanja1', 'belanja1.id_sp2d', 'sp2d.idhalaman')
                        ->where($where)
                        ->first();

        return response()->json($sp2dtpp);
    }
}
