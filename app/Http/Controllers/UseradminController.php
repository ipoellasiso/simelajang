<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UseradminController extends Controller
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
            'title'             => 'Data User',
            'active_side'       => 'active',
            'active_kuser'       => 'active',
            'page_title'        => 'Pengaturan',
            'breadcumd1'        => 'Kelola User',
            'breadcumd2'        => 'List User',
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

            $datauser = DB::table('users')
                        ->select('users.fullname', 'users.email', 'users.id_opd', 'users.role', 'users.gambar', 'is_active', 'users.id', 'opd.nama_opd')
                        ->join('opd', 'users.id_opd', 'opd.id',)
                        // ->where('nama_opd', auth()->user()->nama_opd)
                        ->get();

            return Datatables::of($datauser)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id="'.$row->id.'" class="editUser btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id="'.$row->id.'" class="deleteUser btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    // ->addColumn('is_active', function($row1){
                    //     $status = '';
                    //     if($row1->is_active == 'Aktif') {
                    //         $status = '<div class="badge bg-success">'.$row1->is_active.'</div>';
                    //     }else {
                    //         $status = '<div class="badge bg-danger">'.$row1->is_active.'</div>';
                    //     }
                    //     return $status;
                    // })
                    ->addColumn('is_active1', function($row){
                        if($row->is_active == 'Nonaktif')
                        {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="aktifUser btn btn-danger btn-sm">
                                        <i class="fa fa-thumbs-down"></i> nonaktif
                                    </a>
                                  ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="nonaktifUser btn btn-success btn-sm">
                                        <i class="fa fa-thumbs-up"></i> aktif
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->rawColumns(['action', 'is_active1'])
                    ->make(true);
        }

        return view('UserAdmin.Useradmin', $data);
    }


    public function store(Request $request)
    {
        request()->validate([
            'gambar' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5000',
        ]);

        $userId = $request->id;
        $user = UserModel::where('id', $userId)->first(['password']);

        $hashPassword ="";
        if($request->password == "" || $request->password == null){
            $hashPassword = $user->password;
        }else{
            $hashPassword = Hash::make($request->password);
        }

        $cek_email = UserModel::where('email', $request->email)->where('id', '!=', $request->id)->first();

        if($cek_email)
        {
            return response()->json(['error'=>'Email sudah ada']);
        }
        else
        {
            $details = [
                'id_opd'  => $request->id_opd,
                'fullname'  => $request->fullname,
                'email'  => $request->email,
                'password'  => $hashPassword,
                'role'  => $request->role,
                'is_active' => 'Nonaktif',
                'nama_opd'  => $request->nama_opd1,
            ];

            if ($files = $request->file('gambar')){
                $destinationPath = 'app/assets/images/user/';
                $profileImage = date('YmdHis').".".$files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $details['gambar'] = "$profileImage";
            }
        }

            UserModel::updateOrCreate(['id' => $userId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $user = UserModel::where($where)->first();

        return response()->json($user);
    }

    public function nonaktif($id)
    {
        $userdt = UserModel::findOrFail($id);
        $userdt->update([
            'is_active' => 'Nonaktif',
        ]);

        return response()->json(['success'=>'Data Berhasil Dinonaktifkan']);
    }

    public function aktif($id)
    {
        $userdt = UserModel::findOrFail($id);
        
        $userdt->update([
            'is_active' => 'Aktif',
        ]);

        return response()->json(['success'=>'Data Berhasil Diaktifkan']);
    }

    public function getDataopd()
    {
        $opd = DB::table('opd')
        ->select('id', 'nama_opd')
        ->get();
        return response()->json($opd);
        // return view('Penatausahaan.Pajakls.Pajakls', compact('akunpajak'));
    }

    public function destroy($id)
    {
        $data = UserModel::where('id',$id)->first(['gambar']);
        unlink("app/assets/images/user/".$data->gambar);

        UserModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
