<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\PotonganModel;
use App\Models\RincianBpjsModel;
use App\Models\RincianTaspenModel;
use App\Models\TaspenModel;

class TaspenController extends Controller
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
            'title'                => 'Data Potongan Taspen',
            'active_side_potbpjs'  => 'active',
            'active_potbpjs'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'Data Potongan',
            'breadcumd2'           => 'Taspen',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'total_4'              => RincianTaspenModel::join('potongan2',  'potongan2.id_rinciantaspen', 'tb_rinciantaspen.id_rinciantaspen')->where('tb_rinciantaspen.akun_potongan', '800001')->sum('potongan2.nilai_pajak'),
            'total_1'              => RincianTaspenModel::join('potongan2',  'potongan2.id_rinciantaspen', 'tb_rinciantaspen.id_rinciantaspen')->where('tb_rinciantaspen.akun_potongan', '800002')->sum('potongan2.nilai_pajak'),
            'total_potongan'       => RincianTaspenModel::join('potongan2',  'potongan2.id_rinciantaspen', 'tb_rinciantaspen.id_rinciantaspen')->sum('potongan2.nilai_pajak'),

        );

        if ($request->ajax()) {

            $datataspen = DB::table('tb_rinciantaspen')
                        ->select('tb_rinciantaspen.id_rinciantaspen', 'tb_rinciantaspen.ebilling', 'tb_rinciantaspen.nomor_npwp', 'tb_rinciantaspen.akun_potongan', 'tb_rinciantaspen.ntpn', 'tb_rinciantaspen.jenis_potongan', 'tb_rinciantaspen.rek_belanja','tb_rinciantaspen.nama_npwp', 'tb_rinciantaspen.id', 'tb_rinciantaspen.status1', 'tb_rinciantaspen.status2', 'tb_rinciantaspen.created_at', 'tb_rinciantaspen.bukti_pemby', 'tb_rinciantaspen.nilai_potongan')
                        ->orderBy('tb_rinciantaspen.id', 'DESC')
                        ->get();

            return Datatables::of($datataspen)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status1 == 'Terima')
                        {
                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="lihatTaspen dropdown-item" data-id_rinciantaspen="'.$row->id_rinciantaspen.'" href="/dttaspen/detail/'.$row->id_rinciantaspen.'">Lihat</a></li>
                                                <li><a class="cetakTaspen dropdown-item" data-id_rinciantaspen="'.$row->id_rinciantaspen.'" href="/dttaspen/cetak/'.$row->id_rinciantaspen.'">Cetak</a></li>
                                            </ul>
                                        </div>
                                ';
                        }else{

                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" data-id="'.$row->id.'" href="/datataspen/edit/'.$row->id_rinciantaspen.'">Edit</a></li>
                                                <li><a class="deleteTaspen dropdown-item" data-id="'.$row->id.'" href="javascript:void(0)">Delete</a></li>
                                            </ul>
                                        </div>
                                ';
                        }

                        return $btn;
                    })
                    ->addColumn('status1', function($row){
                        if($row->status1 == 'Tolak')
                        {
                            $btn1 = '
                                    
                                  <a href="javascript:void(0)" data-id_rinciantaspen="'.$row->id_rinciantaspen.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="terimaTaspen btn btn-outline-danger m-b-xs"><i class="fas fa-thumbs-down"></i> Tolak
                                    </a>
                                  ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id_rinciantaspen="'.$row->id_rinciantaspen.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="tolakTaspen btn btn-outline-primary m-b-xs"> <i class="fas fa-thumbs-up"></i> Terima
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->addColumn('nilai_potongan', function($row) {
                        return number_format($row->nilai_potongan);
                    })
                    ->rawColumns(['action', 'status1', 'nilai_potongan'])
                    ->make(true);
                    
        }  

        return view('Taspen.Taspen', $data);
    }

    // Add to Cart
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart[$request->id] = [
            "id"                => $request->id,
            "tanggal_sp2d"      => $request->tanggal_sp2d,
            "nomor_sp2d"        => $request->nomor_sp2d,
            "nilai_sp2d"        => $request->nilai_sp2d,
            "jenis_pajak"       => $request->jenis_pajak,
            "nilai_pajak"       => $request->nilai_pajak,
        ];

        session()->put('cart', $cart);
        // echo $this->load_cart($request);
        echo $this->show_cart();
    }

    public function load_cart(Request $request)
    {
        echo $this->show_cart();

		// if ($request->ajax()) {

        //     $total     = 0;
        //     $cart = session()->get('cart', []);
            
        //     return Datatables::of($cart)
        //     ->addIndexColumn()
        //     ->addColumn('action', function($row){

        //            $btn = '
        //                     <center>
        //                         <button type="button" id="'.$row['id'].'" class="hapus_cart btn btn-outline-primary m-b-xs">
        //                         <i class="fa fa-trash"></i> Hapus
        //                         </button>
        //                     </center>
        //                   ';

        //             return $btn;
        //     })
        //     ->addColumn('nilai_pajak1', function($row) {
        //         return number_format($row['nilai_pajak']);
        //     })
        //     ->addColumn('nilai_sp2d1', function($row) {
        //         return number_format($row['nilai_sp2d']);
        //     })
        //     ->addColumn('totalcart', function($row, $total=0) {
        //         return number_format($total += $row['nilai_pajak']);
        //     })
        //     ->rawColumns(['action', 'nilai_pajak1', 'nilai_sp2d1'])
        //     ->make(true);
        // }
    }

    public function show_cart()
    {
        $output    = '';
		$no        = 0;
        $total     = 0;
        $cart      = session()->get('cart', []);

		foreach ($cart as $id => $items) {
                $total += $items['nilai_pajak'];
                $no++;
                $output .='
                    <tr data-id="'.$id.'">
                        <td>'.$no.'</td>
                        <td>'.$items['tanggal_sp2d'].'</td>
                        <td>'.$items['nomor_sp2d'].'</td>
                        <td>'.number_format($items['nilai_sp2d']).'</td>
                        <td>'.$items['jenis_pajak'].'</td>
                        <td>'.number_format($items['nilai_pajak']).'</td>
                        <td>
                            <center>
                                 <button type="button" id="'.$items['id'].'" class="hapus_cart btn btn-outline-danger m-b-xs">
                                 <i class="fa fa-trash"></i> Hapus
                                 </button>
                             </center>
                        </td>
                    </tr>
                ';
		}
        
            $output .= '
                    <tr>
                        <td colspan="5" align="right"><strong>Total Potongan</strong></td>
                        <td colspan="2"><strong>'.number_format($total).'</strong></td>
                    </tr>';

            return $output;

    }

    public function deleteCart(Request $request, $id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            echo $this->load_cart($request);
        }
    }

    // ======================== INSERT DATA ===================================

    public function create(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Data Potongan Taspen',
            'active_side_potbpjs'  => 'active',
            'active_potbpjs'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'Data Potongan',
            'breadcumd2'           => 'Taspen',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'total_4'              => RincianTaspenModel::join('potongan2',  'potongan2.id_rinciantaspen', 'tb_rinciantaspen.id_rinciantaspen')->where('tb_rinciantaspen.akun_potongan', '800001')->sum('potongan2.nilai_pajak'),
            'total_1'              => RincianTaspenModel::join('potongan2',  'potongan2.id_rinciantaspen', 'tb_rinciantaspen.id_rinciantaspen')->where('tb_rinciantaspen.akun_potongan', '800002')->sum('potongan2.nilai_pajak'),
            'total_potongan'       => RincianTaspenModel::join('potongan2',  'potongan2.id_rinciantaspen', 'tb_rinciantaspen.id_rinciantaspen')->sum('potongan2.nilai_pajak'),
        );

        if ($request->ajax()) {

            $datataspensipd = DB::table('potongan2')
                            ->select('potongan2.ebilling', 'potongan2.id', 'potongan2.status1', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'sp2d.npwp_pihak_ketiga', 'sp2d.no_rek_pihak_ketiga', 'potongan2.jenis_pajak', 'potongan2.nilai_pajak', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->whereIn('potongan2.jenis_pajak', ['Askes', 'Iuran Jaminan Kesehatan 4%', 'Belanja Iuran Jaminan Kesehatan PPPK', 'Belanja Iuran Jaminan Kesehatan PNS', 'Iuran Wajib Pegawai 1%'])
                            ->where('potongan2.status1',['0'])
                            ->where('sp2d.jenis',['LS'])
                            ->get();

            return Datatables::of($datataspensipd)
                    ->addIndexColumn()
                    ->addColumn('status1', function($row){
                        $btn1 = '
                                    <button href="javascript:void(0)" id="add_cart" 
                                    data-id="'.$row->id.'"
                                    data-tanggal_sp2d="'.$row->tanggal_sp2d.'" 
                                    data-nomor_sp2d="'.$row->nomor_sp2d.'" 
                                    data-nilai_sp2d="'.$row->nilai_sp2d.'" 
                                    data-jenis_pajak="'.$row->jenis_pajak.'" 
                                    data-nilai_pajak="'.$row->nilai_pajak.'"
                                    
                                    class="editpotcartsipd btn btn-outline-info m-b-xs btn-sm">Pilih
                                    </button>
                                ';

                        return $btn1;
                    })
                    ->addColumn('nilai_pajak1', function($row) {
                        return number_format($row->nilai_pajak);
                    })
                    ->addColumn('nilai_sp2d1', function($row1) {
                        return number_format($row1->nilai_sp2d);
                    })
                    ->rawColumns(['status1', 'nilai_pajak1', 'nilai_sp2d1'])
                    ->make(true);
        }

        return view('Taspen.CreateTaspen', $data);
    }

    public function store(Request $request)
    {
        $nomoracak = Str::random(10);
        $total = 0;
        $cart = session()->get('cart');

        foreach($cart as $g){

            $id_taspen = $g['id'];

        }

        $noid_taspen = TaspenModel::where('id_taspen', $id_taspen)->where('id', '!=', $id_taspen)->first();

        if($noid_taspen)
        {
            return redirect()->back()->with(['error'=>'Potongan Taspen sudah ada']);
        }
        else
        {   
            foreach($cart as $rows){
                PotonganModel::where('id', $rows)
                            ->update([
                                'status1' => '1',
                                'id_rinciantaspen'    => $nomoracak,
                                // 'id_pajakkpp' => $request->id_potonganls,
                                // 'ebilling' => $request->ebilling,
                            ]);
            }

            $rinciantaspen = new RincianTaspenModel();
            $rinciantaspen->id_rinciantaspen  = $nomoracak;
            $rinciantaspen->ebilling          = $request->ebilling;
            $rinciantaspen->akun_potongan     = $request->akun_potongan;
            $rinciantaspen->nama_npwp         = $request->nama_npwp;
            $rinciantaspen->nomor_npwp        = $request->nomor_npwp;
            $rinciantaspen->ntpn              = $request->ntpn;
            $rinciantaspen->rek_belanja       = $request->rek_belanja;
            // $rincianbpjs->kode_pot          = $request->kode_pot;
            $rinciantaspen->status1           = 'Terima';

            if ($files = $request->file('bukti_pemby')){
                $destinationPath = 'app/assets/images/bukti_pemby_potongan/';
                $profileImage = "Simelajangpotongan" . "-" .date('YmdHis')."-" .$files->getClientOriginalName();
                $files->move($destinationPath, $profileImage);
                $rinciantaspen['bukti_pemby'] = "$profileImage";
            }

            $rinciantaspen->save();
                
            foreach($cart as $items){

                $total += $items['nilai_pajak'];

                $tanggal_sp2d   = $items['tanggal_sp2d'];
                $nomor_sp2d     = $items['nomor_sp2d'];
                $nilai_sp2d     = $items['nilai_sp2d'];
                $jenis_pajak    = $items['jenis_pajak'];
                $nilai_pajak    = $items['nilai_pajak'];

                TaspenModel::create([
                    'id_taspen'         => $items['id'],
                    'tanggal_sp2d'      => $tanggal_sp2d,
                    'nomor_sp2d'        => $nomor_sp2d,
                    'nilai_sp2d'        => $nilai_sp2d,
                    'jenis_potongan'    => $jenis_pajak,
                    'nilai_potongan'    => $nilai_pajak,

                    'ebilling'          => $request->ebilling,
                    'akun_potongan'     => $request->akun_potongan,
                    'nama_npwp'         => $request->nama_npwp,
                    'nomor_npwp'        => $request->nomor_npwp,
                    'ntpn'              => $request->ntpn,
                    'rek_belanja'       => $request->rek_belanja,
                    // 'bukti_pemby'       => $profileImage,
                    'status1'           => 'Terima',
                    'id_rinciantaspen'    => $nomoracak,

                ]);
            }

            RincianTaspenModel::where('id', $rinciantaspen->id)->update(['nilai_potongan' => $total]);
            session()->forget('cart');
            return redirect('/tampiltaspen')->with('success', 'Data Disimpan');
        }
    }

    // ======================== EDIT DATA ===================================

    public function edit($id)
    {

        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Edit Potongan TASPEN',
            'active_side_potbpjs'  => 'active',
            'active_potbpjs'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'edit Potongan',
            'breadcumd2'           => 'TASPEN',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),

            'dttaspen'               => DB::table('tb_taspen')
                                        ->select('tb_taspen.akun_potongan', 'tb_taspen.nilai_potongan', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.nomor_spm', 'potongan2.jenis_pajak', 'tb_taspen.id')
                                        ->join('potongan2', 'potongan2.id', 'tb_taspen.id_taspen')
                                        ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                        ->where('tb_taspen.id_rinciantaspen', $id)
                                        ->get(),
            'dtrinciantaspen'        => DB::table('tb_rinciantaspen AS a')
                                        ->select('a.ebilling', 'a.ntpn', 'a.akun_potongan', 'a.nilai_potongan', 'a.bukti_pemby', 'a.id', 'a.id_rinciantaspen')
                                        ->where('a.id_rinciantaspen', $id)
                                        ->first(),
        );
        // dd($data);

        return view('Taspen.Modal.EditTaspen', $data);
    }

    public function pilihtaspensipdedit(Request $request)
    {

        if ($request->ajax()) {

            $datataspensipd = DB::table('potongan2')
                            ->select('potongan2.ebilling', 'potongan2.id', 'potongan2.status1', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'sp2d.npwp_pihak_ketiga', 'sp2d.no_rek_pihak_ketiga', 'potongan2.jenis_pajak', 'potongan2.nilai_pajak')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->whereIn('potongan2.jenis_pajak', ['Askes', 'Iuran Jaminan Kesehatan 4%', 'Belanja Iuran Jaminan Kesehatan PPPK', 'Belanja Iuran Jaminan Kesehatan PNS', 'Iuran Wajib Pegawai 1%'])
                            ->where('potongan2.status1',['0'])
                            ->where('sp2d.jenis',['LS'])
                            ->get();

            return Datatables::of($datataspensipd)
                    ->addIndexColumn()
                    ->addColumn('status1', function($row){
                        $btn1 = '
                                    <button href="javascript:void(0)" id="add_cart" 
                                    data-id1="'.$row->id.'"
                                    data-tanggal_sp2d1="'.$row->tanggal_sp2d.'" 
                                    data-nomor_sp2d1="'.$row->nomor_sp2d.'" 
                                    data-nilai_sp2d1="'.$row->nilai_sp2d.'" 
                                    data-jenis_pajak1="'.$row->jenis_pajak.'" 
                                    data-nilai_pajak1="'.$row->nilai_pajak.'" 
                                    
                                    class="editpotcartsipdtaaspen btn btn-outline-info m-b-xs btn-sm">Pilih
                                    </button>
                                ';

                        return $btn1;
                    })
                    ->addColumn('nilai_pajak1', function($row) {
                        return number_format($row->nilai_pajak);
                    })
                    ->addColumn('nilai_sp2d1', function($row1) {
                        return number_format($row1->nilai_sp2d);
                    })
                    ->rawColumns(['status1', 'nilai_pajak1', 'nilai_sp2d1'])
                    ->make(true);
        }

        return view('Taspen.Modal.EditTaspen');
    }

    public function storedetailedit(Request $request)
    {

        $cek   = RincianTaspenModel::where('id_rinciantaspen', $request->id_rinciantaspen)
                                ->first(); 

        if($cek)
        {
            return redirect()->back()->with('error', 'Data Taspen Sudah Di Ada');
        }
        else
        {
            RincianTaspenModel::create([
                // 'id_gurumapelheader' => $request->id_gurumapelheader,
                // 'id_mapel'           => $request->id_mapel,
            ]);
            
            return redirect()->back();
        }
        
    }

    public function update(Request $request, $id)
    {
        $cek       = RincianTaspenModel::where('id_rinciantaspen', $request->id_rinciantaspen)->where('id', '!=', $id)->first();
        $rinciantaspen = RincianTaspenModel::findOrFail($id);

        if($cek)
        {
            return redirect()->back()->with('error', 'Data Potongan BPJS Sudah Ada');
        }
        else 
        {
            $rinciantaspen->update([
                'ebilling'          => $request->ebilling,
                'akun_potongan'     => $request->akun_potongan,
                'nama_npwp'         => $request->nama_npwp,
                'nomor_npwp'        => $request->nomor_npwp,
                'ntpn'              => $request->ntpn,
                'rek_belanja'       => $request->rek_belanja,
                'status1'           => 'Terima',
            ]);

            if ($request->file('bukti_pemby')) {
                if ($rinciantaspen->bukti_pemby){
                    File::delete('app/assets/images/bukti_pemby_potongan/'.$rinciantaspen->bukti_pemby);
                }
                $file = $request->file('bukti_pemby');
                $nama_file = "Simelajang" . "-" .date('YmdHis')."-" .$file->getClientOriginalName();
                $file->move('app/assets/images/bukti_pemby_potongan/', $nama_file);
                $rinciantaspen->bukti_pemby = $nama_file;
            }
            
            $rinciantaspen->save();
            return redirect('/tampiltaspen')->with('success', 'Data Berhasil Di Ubah');   
        }
    }

    // ======================== DELETE DATA ===================================

    public function destroy($id) 
    {
        TaspenModel::where('id',$id)->delete();
      
        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

    public function destroyAll() 
    {
        TaspenModel::truncate();
      
        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }


    // Get Data
    public function getdatasp2d(Request $request)
    {
        $search = $request->searchSp2d;
  
        if($search == ''){
            $dttaspen = PotonganModel::join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')->orderBy('sp2d.nomor_sp2d','asc')->select('potongan2.id','sp2d.nomor_sp2d')->get();
        }else{
            $dttaspen = PotonganModel::join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')->orderBy('nomor_sp2d','asc')->select('potongan2.id','sp2d.nomor_sp2d')->where('sp2d.nomor_sp2d', 'like', '%' .$search . '%')->get();
        }
  
        $response = array();
        foreach($dttaspen as $row){
            $response[] = array(
                "id"   => $row->id,
                "text" => $row->nomor_sp2d
            );
        }

        return response()->json($response); 
    }



}
