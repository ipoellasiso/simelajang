<?php

namespace App\Http\Controllers;

use App\Models\PajaklsModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;

class PajaklsuserController extends Controller
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
            'title'                => 'Data Pajak LS',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'Data Pajak',
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

        if ($request->ajax()) {

            $datapajakls = DB::table('pajakkpp')
                        ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'pajakkpp.no_penguji')
                        ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                        ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                        ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                        ->get();

            return Datatables::of($datapajakls)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status2 == 'Terima')
                        {
                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="lihatPajakls dropdown-item" data-id="'.$row->id.'" href="/pajakls1/lihat/'.$row->id.'">Lihat</a></li>
                                            </ul>
                                        </div>
                                ';
                        }else{

                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" data-id="'.$row->id.'" href="/pajakls1/edit/'.$row->id.'">Ubah</a></li>
                                                <li><a class="deletePajakls dropdown-item" data-id="'.$row->id.'" href="javascript:void(0)">Delete</a></li>
                                            </ul>
                                        </div>
                                ';
                        }

                        return $btn;
                    })
                    ->addColumn('status2', function($row){
                        if($row->status2 == 'Tolak')
                        {
                            $btn1 = '
                                    
                                  <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="terimaPajakls1 btn btn-outline-danger m-b-xs"><i class="fas fa-thumbs-down"></i> Tolak
                                    </a>
                                  ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="tolakPajakls1 btn btn-outline-primary m-b-xs"> <i class="fas fa-thumbs-up"></i> Terima
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->addColumn('nilai_pajak', function($row) {
                        return number_format($row->nilai_pajak);
                    })
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    ->editColumn('keterangan', function($row) {
                        return $row->periode.'  '.$row->no_penguji.'  ';
                    })
                    ->rawColumns(['action', 'status2', 'nilai_pajak', 'nilai_sp2d', 'keterangan'])
                    ->make(true);
                    
        }  

        return view('Pajak_LS_User.Tampilpajaklsuser', $data);
    }

    public function export()
    {
        $nama_file = 'Data Pajak-'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new DataExport, $nama_file);
    }
    
}
