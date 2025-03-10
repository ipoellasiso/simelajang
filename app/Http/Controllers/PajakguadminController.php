<?php

namespace App\Http\Controllers;

use App\Models\AkunpajakModel;
use App\Models\PajakguModel;
use App\Models\PajaklsModel;
use App\Models\Potongan2Model;
use App\Models\PotonganguModel;
use App\Models\PotonganModel;
use App\Models\TbpModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;
use App\Exports\DataExportGU;
use App\Imports\DataImport;
use Maatwebsite\Excel\Row;

class PajakguadminController extends Controller
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
            'title'                => 'Data Pajak GU',
            'active_side_pajakls'    => 'active',
            'active_pajakgu'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'Data Pajak',
            'breadcumd2'           => 'GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'total_ppngu'          => PajakguModel::where('jenis_pajak', 'Pajak Pertambahan Nilai')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph21gu'        => PajakguModel::where('jenis_pajak', 'PPH 21')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph22gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 22')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph23gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 23')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph24gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 24')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pajakgu'        => PajakguModel::where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),                        
        );

        if ($request->ajax()) {

            $datapajakgu = DB::table('pajakkppgu')
                        ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode', 'pajakkppgu.rek_belanja', 'pajakkppgu.status1')
                        // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                        // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                        // ->join('tb_tbp',  'tb_tbp.ntpn', 'pajakkppgu.ntpn')
                        ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                        // ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')

                        // ->where('pajakkppgu.id_opd', auth()->user()->nama_opd)
                        // ->where('pajakkpp.status2', ['Terima'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                        ->get();

            return Datatables::of($datapajakgu)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status2 == 'Terima')
                        {
                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="lihatPajakgu dropdown-item" data-id="'.$row->id.'" href="/pajakgu/lihat/'.$row->id.'">Lihat</a></li>
                                            </ul>
                                        </div>
                                ';
                        } if($row->status1 == 'Terima')
                        {
                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="lihatPajakgu dropdown-item" data-id="'.$row->id.'" href="/pajakgu/lihat/'.$row->id.'">Lihat</a></li>
                                            </ul>
                                        </div>
                                ';
                        } else{

                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" data-id="'.$row->id.'" href="/pajakgu/editadmin/'.$row->id.'">Ubah</a></li>
                                                <li><a class="deletePajakgu dropdown-item" data-id="'.$row->id.'" href="javascript:void(0)">Delete</a></li>
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
                                    
                                  <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="terimaPajakgu btn btn-outline-danger m-b-xs"><i class="fas fa-thumbs-down"></i> Tolak
                                    </a>
                                  ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="tolakPajakgu btn btn-outline-primary m-b-xs"> <i class="fas fa-thumbs-up"></i> Terima
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
                    ->rawColumns(['action', 'status2', 'nilai_pajak', 'nilai_sp2d'])
                    ->make(true);
                    
        }  

        return view('Pajak_GUadmin.Tampilpajakguadmin', $data);
    }

    public function tampilpajakgusipdbeluminput(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Data Pajak LS Belum Diinput',
            'active_side_pajakls'    => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'Data Pajak Belum Diinput',
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
            'total_pph24'          => PajaklsModel::where('jenis_pajak', 'Pajak Penghasilan PS 22')->where('status2', 'Terima')->sum('nilai_pajak'),
            'total_pajakls'          => PajaklsModel::where('status2', 'Terima')->sum('nilai_pajak'),
        );

        if ($request->ajax()) {

            $datapajaklssipdgu = DB::table('tb_potongangu')
                                ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'sp2d.nama_skpd', 'tb_tbp.status', 'tb_potongangu.id', 'sp2d.jenis', 'sp2d.nomor_spm', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.tanggal_sp2d', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.id_billing', 'tb_potongangu.nilai_tbp_pajak_potongan', 'sp2d.keterangan_sp2d')
                                ->join('tb_tbp', 'tb_tbp.id_tbp', 'tb_potongangu.id_tbp')
                                ->join('sp2d', 'sp2d.nomor_spm', 'tb_tbp.no_spm')
                                ->where('sp2d.jenis',['GU'])
                                // ->where('tb_potongangu.statuspil',['0'])
                                ->where('tb_potongangu.status1',['Terima'])
                                ->where('tb_potongangu.status3',['0'])
                                ->get();

            return Datatables::of($datapajaklssipdgu)
                    ->addIndexColumn()
                    ->addColumn('status2', function($row){
                        $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="editPajaklssipd btn btn-outline-info m-b-xs btn-sm">Pilih
                                    </a>
                                ';

                        return $btn1;
                    })
                    ->addColumn('nilai_tbp_pajak_potongan', function($row) {
                        return number_format($row->nilai_tbp_pajak_potongan);
                    })
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    ->rawColumns(['status2','nilai_tbp_pajak_potongan','nilai_sp2d'])
                    ->make(true);
        }

        return view('Pajak_GUadmin.Tampilpajakgubeluminputadmin', $data);
    }

    public function totalpajakgu()
    {
        // $data = array(
        //     'totalnilai' => PajaklsModel::sum('nilai_pajak')->first(),
        // );

        $total = PajaklsModel::sum('nilai_pajak'); 
        // return response()->json(['total' => number_format($total)]);
        return view('Pajak_GU.Modal.Datapajakls', $total);
    }

    public function pilihspmsp2dgusipd(Request $request)
    {

        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Data Pajak GU Belum Diinput',
            'active_side_pajakls'    => 'active',
            'active_pajakgu'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'Data Pajak Belum Diinput',
            'breadcumd2'           => 'GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'total_ppngu'          => PajakguModel::where('jenis_pajak', 'Pajak Pertambahan Nilai')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph21gu'        => PajakguModel::where('jenis_pajak', 'PPH 21')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph22gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 22')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph23gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 23')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pph24gu'        => PajakguModel::where('jenis_pajak', 'Pajak Penghasilan PS 24')->where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),
            'total_pajakgu'        => PajakguModel::where('status2', 'Terima')->where('pajakkppgu.id_opd', auth()->user()->nama_opd)->sum('nilai_pajak'),                        
        );

        if ($request->ajax()) {

            $datapajaklssipdgu = DB::table('tb_potongangu')
                                ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'sp2d.nama_skpd', 'tb_tbp.status', 'tb_potongangu.id', 'sp2d.jenis', 'sp2d.nomor_spm', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.tanggal_sp2d', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.id_billing', 'tb_potongangu.nilai_tbp_pajak_potongan')
                                ->join('tb_tbp', 'tb_tbp.id_tbp', 'tb_potongangu.id_tbp')
                                ->join('sp2d', 'sp2d.nomor_spm', 'tb_tbp.no_spm')
                                ->where('sp2d.jenis',['GU'])
                                // ->where('tb_potongangu.statuspil',['0'])
                                ->where('tb_potongangu.status1',['Terima'])
                                ->where('tb_potongangu.status3',['0'])
                                // ->where('tb_tbp.nama_skpd', auth()->user()->nama_opd)
                                ->get();

            return Datatables::of($datapajaklssipdgu)
                    ->addIndexColumn()
                    ->addColumn('status2', function($row){
                        $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="editPajakgusipd btn btn-outline-info m-b-xs btn-sm">Pilih
                                    </a>
                                ';

                        return $btn1;
                    })
                    ->addColumn('nilai_tbp_pajak_potongan', function($row) {
                        return number_format($row->nilai_tbp_pajak_potongan);
                    })
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    ->rawColumns(['status2'])
                    ->make(true);
        }

        return view('Pajak_GUadmin.Tampilpajakgubeluminputadmin', $data);
    }

    public function store(Request $request)
    {
        // request()->validate([
        //     'bukti_pemby' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5000',
        // ]);

        $dtidopd = DB::table('opd')
            ->select ('nama_opd')
            ->where('id', auth()->user()->id_opd)
            ->get();
            

            foreach ($dtidopd as $row1){
                $id_opd = $row1->nama_opd;
            }

        request()->validate([
            'bukti_pemby' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5000',
        ]);

        // $nomoracak = Str::random(10);
        $pajakguId = $request->id;
        // $pajaklsId_potonganls = $request->id_potonganls;
        // $pajaklsebill = $request->ebilling;

        $cek_ebilling = PajakguModel::where('ebilling', $request->id_billing)->where('id', '!=', $request->id)->first();
        $cek_ntppn = PajakguModel::where('ntpn', $request->ntpn)->where('id', '!=', $request->id)->first();

        if($cek_ebilling)
        {
            return response()->json(['error'=>'Ebilling sudah ada']);
        }
        elseif($cek_ntppn)
        {
            return response()->json(['error'=>'NTPN sudah ada']);
        }
        else
        {
            PotonganguModel::where('id_billing',$request->get('id_billing'))
            ->update([
                'status3' => '1',
                'status4' => 'Input',
                // 'id_pajakkpp' => $request->id_potonganls,
                // 'ebilling' => $request->ebilling,
            ]);

            $detailspajakgu = [
                'ebilling' => $request->id_billing,
                'ntpn' => $request->ntpn, 
                'akun_pajak' => $request->akun_pajak,
                'jenis_pajak' => $request->nama_pajak_potongan,
                'nilai_pajak' =>str_replace('.','', $request->nilai_tbp_pajak_potongan),
                'rek_belanja' => $request->nomor_rekening,
                'nama_npwp' => $request->nama_npwp,
                'nomor_npwp' => $request->npwp,
                'no_spm' => $request->nomor_spm,
                'id_opd' => $id_opd,
                'status2' => 'Terima',
            ];

            if ($files = $request->file('bukti_pemby')){
                $destinationPath = 'app/assets/images/bukti_pemby_pajak/';
                $profileImage = "Simelajang" . "-" .date('YmdHis')."-" .$files->getClientOriginalName();
                $files->move($destinationPath, $profileImage);
                $detailspajakgu['bukti_pemby'] = "$profileImage";
            }
        }

            PajakguModel::updateOrCreate(['id' => $pajakguId], $detailspajakgu);
            return redirect()->back()->with(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function updateadmin(Request $request, $id)
    {
        request()->validate([
            'bukti_pemby' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5000',
        ]);

        $updatepajakgu = PajakguModel::where('id', $id)->first();
        // $updatepajakls = Pajakkpp::where('id', $id)->first();

        $cek_ebilling = PajakguModel::where('ebilling', $request->ebilling)->where('id', '!=', $request->id)->first();
        $cek_ntppn = PajakguModel::where('ntpn', $request->ntpn)->where('id', '!=', $request->id)->first();

        if($cek_ebilling)
        {
            return redirect('tampilpajakguadmin')->with(['error'=>'Ebilling sudah ada']);
        }
        elseif($cek_ntppn)
        {
            return redirect('tampilpajakguadmin')->with(['error'=>'NTPN sudah ada']);
        }
        else
        {
            TbpModel::where('ntpn',$request->get('ntpn'))
                        ->update([
                            'statuspilihtbp' => '1',
                            // 'id_pajakkpp' => $request->id_potonganls,
                            'id_billing' => $request->ebilling,
                            'ntpn' => $request->ntpn,
                            'akun_pajak' => $request->akun_pajak,
                        ]);

            // $updatepajakgu->id_potonganls = $request->get('id_potonganls');
            $updatepajakgu->akun_pajak = $request->get('akun_pajak');
            $updatepajakgu->ebilling = $request->get('ebilling');
            $updatepajakgu->ntpn = $request->get('ntpn');
            $updatepajakgu->nama_npwp = $request->get('nama_npwp');
            $updatepajakgu->nomor_npwp = $request->get('nomor_npwp');
            $updatepajakgu->jenis_pajak = $request->get('jenis_pajak');
            $updatepajakgu->rek_belanja = $request->get('rek_belanja');
            $updatepajakgu->periode = $request->get('periode');
            // $updatepajakgu->id_opd = $request->get('id_opd');
            $updatepajakgu->nilai_pajak = str_replace('.','', $request->get('nilai_pajak'));
            $updatepajakgu->status2 = 'Terima';
            $updatepajakgu->status1 = 'Terima';
            
            

            if ($request->file('bukti_pemby')) {
                if ($updatepajakgu->bukti_pemby){
                    File::delete('app/assets/images/bukti_pemby_pajak/'.$updatepajakgu->bukti_pemby);
                }
                $file = $request->file('bukti_pemby');
                $nama_file = "Simelajang" . "-" .date('YmdHis')."-" .$file->getClientOriginalName();
                $file->move('app/assets/images/bukti_pemby_pajak/', $nama_file);
                $updatepajakgu->bukti_pemby = $nama_file;
            }
            
        }
            $updatepajakgu->save();
            return redirect('/tampilpajakguadmin')->with(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function editadmin($id)
    {

        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Edit Data Pajak GU',
            'active_dtpajakguedit'       => 'active',
            'active_pajakguedit'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => ' Edit Data Pajak',
            'breadcumd2'           => 'GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'dtpajakgu'            => DB::table('pajakkppgu')
                                    ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd', 'pajakkppgu.periode')
                                    // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                                    // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                                    // ->join('tb_tbp',  'tb_tbp.ntpn', 'pajakkppgu.ntpn')
                                    ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                                    // ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')
                                    ->where('pajakkppgu.id', $id)
                                    // ->where('pajakkppgu.id_opd', auth()->user()->nama_opd)
                                    // ->where('pajakkpp.status2', ['Terima'])
                                    // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                                    ->first(),
        );
        // return response()->json($pajakls);
        return view('Pajak_GUadmin.Modal.Ubahdata',$data);
    }

    public function lihat($id)
    {

        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Preview Data Pajak GU',
            'active_dtpajakgulihat'       => 'active',
            'active_pajakgulihat'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => ' Preview Data Pajak',
            'breadcumd2'           => 'GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'lihatpajakgu'          => DB::table('pajakkppgu')
                                    ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'pajakkppgu.id_opd')
                                    // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                                    // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                                    // ->join('tb_tbp',  'tb_tbp.ntpn', 'pajakkppgu.ntpn')
                                    ->join('sp2d', 'sp2d.nomor_spm', 'pajakkppgu.no_spm')
                                    // ->join('users', 'users.nama_opd', 'pajakkppgu.id_opd')

                                    // ->where('pajakkppgu.id_opd', auth()->user()->nama_opd)
                                    // ->where('pajakkpp.status2', ['Terima'])
                                    // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                                    ->where('pajakkppgu.id', $id)
                                    ->first(),
        );

        return view('Pajak_GUadmin.Modal.Lihat',$data);
    }

    public function editpajakguadmin($id)
    {
        $where = array('id' => $id);
        $pajakgu = PajakguModel::where($where)->first();

        return response()->json($pajakgu);
    }

    public function editpajakgusipd($id)
    {
        $where = array('tb_potongangu.id' => $id);
        $pajaklssipdgu = PotonganguModel::select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'sp2d.nama_skpd', 'tb_tbp.status', 'tb_potongangu.id', 'sp2d.jenis', 'sp2d.nomor_spm', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.tanggal_sp2d', 'tb_potongangu.id_billing', 'tb_tbp.ntpn', 'tb_potongangu.nama_pajak_potongan', 'tb_tbp.akun_pajak', 'tb_potongangu.nilai_tbp_pajak_potongan', 'sp2d.nomor_rekening', 'tb_tbp.npwp', 'tb_tbp.nama_npwp', 'tb_tbp.bukti_pemby')
        ->join('tb_tbp', 'tb_tbp.id_tbp', 'tb_potongangu.id_tbp')
        ->join('sp2d', 'sp2d.nomor_spm', 'tb_tbp.no_spm')
        ->where($where)->first();
        // $pajaklssipdgu = TbpModel::select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'sp2d.nama_skpd', 'tb_tbp.status', 'tb_tbp.id', 'sp2d.jenis', 'sp2d.nomor_spm', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.tanggal_sp2d', 'tb_tbp.id_billing', 'tb_tbp.ntpn', 'tb_potongangu.nama_pajak_potongan', 'tb_tbp.akun_pajak', 'tb_potongangu.nilai_tbp_pajak_potongan', 'sp2d.nomor_rekening', 'tb_tbp.npwp', 'tb_tbp.nama_npwp', 'tb_tbp.bukti_pemby')
        // ->join('tb_potongangu', 'tb_potongangu.id_tbp', 'tb_tbp.id_tbp')
        // ->join('sp2d', 'sp2d.nomor_spm', 'tb_tbp.no_spm')
        // ->where($where)->first();

        return response()->json($pajaklssipdgu);
    }

    public function getDataakunpajak()
    {
        $akunpajak = DB::table('tb_akun_pajak')
        ->select('id', 'akun_pajak')
        ->get();
        return response()->json($akunpajak);
        // return view('Penatausahaan.Pajakls.Pajakls', compact('akunpajak'));
    }

    public function getDatajenispajak()
    {
        $jenispajak = DB::table('tb_jenis_pajak')
        ->select('id', 'jenis_pajak')
        ->get();
        return response()->json($jenispajak);
        // return view('Penatausahaan.Pajakls.Pajakls', compact('akunpajak'));
    }

    public function tolakguadmin($id)
    {
        $where = array('id' => $id);
        $pajakgusipd = PajakguModel::where($where)->first();

        return response()->json($pajakgusipd);
    }

    public function tolakguupdateadmin(Request $request, string $id)
    {

        PotonganguModel::where('id_billing',$request->get('ebilling'))
        ->update([
            'status3' => '0',
            'status4' => 'TolakInput',
        ]);

        PajakguModel::where('ebilling',$request->get('ebilling'))
        ->update([
            'status2' => 'Tolak',
            'status1' => 'Tolak',
        ]);

            return redirect('tampilpajakguadmin')->with('success','Data Berhasil Ditolak');
    }

    public function terimaguadmin($id)
    {
        $where = array('id' => $id);
        $pajakgusipd = PajakguModel::where($where)->first();

        return response()->json($pajakgusipd);
    }

    public function terimaguupdateadmin(Request $request, string $id)
    {

        PotonganguModel::where('id_billing',$request->get('ebilling'))
        ->update([
            'status3' => '1',
            'status4' => 'Input',
            
        ]);

        PajakguModel::where('ntpn',$request->get('ntpn'))
        ->update([
            'status2' => 'Terima',
            'status1' => 'Terima',
        ]);

            return redirect('tampilpajakguadmin')->with('success','Data Berhasil Ditolak');
    }
        

    public function terima(Request $request, $id)
    {
        // $where = array('id_pajakkpp' => $id);

        $pajakgudt = PajakguModel::findOrFail($id);
        
        $pajakgudt->update([
            'status2' => 'Terima',
        ]);

        // $pajaklsdt = PotonganModel::findOrFail($id);
        // $pajaklsdt->update([
        //     'status1' => '1',
        // ]);

        // $pajaklsdt = PotonganModel::where('id_pajakkpp',$request->id_potonganls);
        // $pajaklsdt->update([
        //     'status1' => '1',
        // ]);
        // dd($pajaklsdt);

        // PajaklsModel::where('ebilling',$request->get('ebilling'))
        // ->update([
        //     'status2' => 'Terima',
        //     // 'ebilling' => $request->get('ebilling'),
        //     // 'jenis_pajak' => $request->get('jenis_pajak'),
        // ]);

        // PotonganModel::where('ebilling',$request->get('ebilling'))
        // ->update([
        //     'status1' => '0',
        //     // 'ebilling' => $request->get('ebilling'),
        //     // 'jenis_pajak' => $request->get('jenis_pajak'),
        // ]);

        return response()->json(['success'=>'Data Berhasil Terima']);
    }

    public function destroyadmin($id)
    {
        // $data = PajakguModel::where('id',$id)->first(['bukti_pemby']);
        // unlink("app/assets/images/bukti_pemby_pajak/".$data->bukti_pemby);

        PajakguModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

    public function export()
    {
        $nama_file = 'Data Pajak GU-'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new DataExportGU, $nama_file);
    }

}
