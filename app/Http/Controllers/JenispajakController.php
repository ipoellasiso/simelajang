<?php

namespace App\Http\Controllers;

use App\Models\JenispajakModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JenispajakController extends Controller
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
            'title'                  => 'Data Jenis Pajak',
            'active_sidemdata'       => 'active',
            'active_akunpajak'       => 'active',
            'page_title'             => 'Pengaturan',
            'breadcumd1'             => 'Master Data',
            'breadcumd2'             => 'Data Jenis Pajak',
            'userx'                  => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
        );

        if ($request->ajax()) {

            // $datauser = UserModel::select('id', 'id_opd', 'fullname', 'email', 'role', 'gambar')
            //             ->leftjoin('opd', 'users.id_opd', 'opd.id',)
            //             ->get();

            $datajenispajak = DB::table('tb_jenis_pajak')
                        ->select('id', 'jenis_pajak')
                        ->get();

            return Datatables::of($datajenispajak)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id="'.$row->id.'" class="editJenispajak btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id="'.$row->id.'" class="deleteJenispajak btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Jenis_Pajak.Jenisopd', $data);
    }


    public function store(Request $request)
    {

        $jenispajakId = $request->id;

        $details = [
            'jenis_pajak'  => $request->jenis_pajak,
        ];

        JenispajakModel::updateOrCreate(['id' => $jenispajakId], $details);
        return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $jenispajak = JenispajakModel::where($where)->first();

        return response()->json($jenispajak);
    }

    public function destroy($id)
    {

        JenispajakModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

}
