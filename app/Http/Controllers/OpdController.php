<?php

namespace App\Http\Controllers;

use App\Models\OpdModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OpdController extends Controller
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
            'title'             => 'Data OPD',
            'active_sidemdata'       => 'active',
            'active_opd'       => 'active',
            'page_title'        => 'Pengaturan',
            'breadcumd1'        => 'Master Data',
            'breadcumd2'        => 'Data OPD',
            'userx'             => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
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

            $dataopd = DB::table('opd')
                        ->select('id', 'nama_opd', 'nama_bendahara', 'alamat')
                        ->get();

            return Datatables::of($dataopd)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id="'.$row->id.'" class="editOpd btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id="'.$row->id.'" class="deleteOpd btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('OPD.tampilopd', $data);
    }


    public function store(Request $request)
    {

        $opdId = $request->id;

        $cekopd = OpdModel::where('nama_opd', $request->nama_opd)->where('id', '!=', $request->id)->first();

        if($cekopd)
        {
            return response()->json(['error'=>'Ebilling sudah ada']);
        }
            $details = [
                'nama_opd'  => $request->nama_opd,
                'nama_bendahara'  => $request->nama_bendahara,
                'alamat'  => $request->alamat,
            ];
        

            OpdModel::updateOrCreate(['id' => $opdId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $opd = OpdModel::where($where)->first();

        return response()->json($opd);
    }

    public function destroy($id)
    {

        OpdModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
