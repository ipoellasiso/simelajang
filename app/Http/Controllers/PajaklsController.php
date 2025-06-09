<?php

namespace App\Http\Controllers;

use App\Models\AkunpajakModel;
use App\Models\PajaklsModel;
use App\Models\Potongan2Model;
use App\Models\PotonganModel;
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
use App\Exports\DataExportbeluminput;
use Illuminate\Support\Facades\Validator;

class PajaklsController extends Controller
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
            'active_side_pajakls'    => 'active',
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
                        // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                        // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                        ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                        ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                        // ->where('pajakkpp.status2', ['Terima'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-12-31'])
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
                    // })
                    // ->addColumn('status1', function($row1){
                    //     $status = '';
                    //     if($row1->status1 == '1') {
                    //         $status = '<div class="badge bg-success">'.$row1->status1.'</div>';
                    //     }else {
                    //         $status = '<div class="badge bg-danger">'.$row1->status1.'</div>';
                    //     }
                    //     return $status;
                    })
                    // <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" class="aktifPajakls btn btn-danger btn-sm">Tolak
                    // </a>
                    // <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" class="tolakPajakls btn btn-secondary btn-sm">Terima
                    // </a>
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

        return view('Pajak_LS.Tampilpajakls', $data);
    }

    public function totalpajakls()
    {
        // $data = array(
        //     'totalnilai' => PajaklsModel::sum('nilai_pajak')->first(),
        // );

        $total = PajaklsModel::sum('nilai_pajak'); 
        // return response()->json(['total' => number_format($total)]);
        return view('Pajak_LS.Tampilpajakls', $total);
    }

    public function pilihpajaklssipd(Request $request)
    {

        if ($request->ajax()) {

            $datapajaklssipd = DB::table('potongan2')
                            ->select('potongan2.ebilling', 'potongan2.id', 'potongan2.status1', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'sp2d.npwp_pihak_ketiga', 'sp2d.no_rek_pihak_ketiga', 'potongan2.jenis_pajak', 'potongan2.nilai_pajak')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->whereIn('potongan2.jenis_pajak', ['Pajak Pertambahan Nilai','Pajak Penghasilan Ps 22','Pajak Penghasilan Ps 23','PPh 21','Pajak Penghasilan Ps 4 (2)', 'Pajak Penghasilan PS 24'])
                            ->where('potongan2.status1',['0'])
                            ->where('sp2d.jenis',['LS'])
                            ->get();

            return Datatables::of($datapajaklssipd)
                    ->addIndexColumn()
                    ->addColumn('status2', function($row){
                        $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="editPajaklssipd btn btn-outline-info m-b-xs btn-sm">Pilih
                                    </a>
                                ';

                        return $btn1;
                    })
                    ->rawColumns(['status2'])
                    ->make(true);
        }

        return view('Pajak_LS.Tampilpajakls');
    }

    public function tampilpajaklssipdbeluminput(Request $request)
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

            $datapajaklssipd1 = DB::table('potongan2')
                            ->select('potongan2.ebilling', 'potongan2.id', 'potongan2.status1', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'sp2d.npwp_pihak_ketiga', 'sp2d.no_rek_pihak_ketiga', 'potongan2.jenis_pajak', 'potongan2.nilai_pajak', 'sp2d.keterangan_sp2d')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->whereIn('potongan2.jenis_pajak', ['Pajak Pertambahan Nilai','Pajak Penghasilan Ps 22','Pajak Penghasilan Ps 23','PPh 21','Pajak Penghasilan Ps 4 (2)', 'Pajak Penghasilan PS 24'])
                            ->where('potongan2.status1',['0'])
                            ->where('sp2d.jenis',['LS'])
                            ->get();

            return Datatables::of($datapajaklssipd1)
                    ->addIndexColumn()
                    ->addColumn('status2', function($row){
                        $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="editPajaklssipd btn btn-outline-info m-b-xs btn-sm">Pilih
                                    </a>
                                ';

                        return $btn1;
                    })
                    ->addColumn('nilai_pajak', function($row) {
                        return number_format($row->nilai_pajak);
                    })
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    ->rawColumns(['status2','nilai_pajak','nilai_sp2d'])
                    ->make(true);
        }

        return view('Pajak_LS.Tampilpajaklsbeluminputadmin', $data);
    }

    public function store(Request $request)
    {
        // request()->validate([
        //     // 'bukti_pemby' => 'required|mimes:pdf',
        //     'ntpn' => 'required|string|max:16',
        // ]);

        $rules = [
            'ebilling' => 'required|max:15|min:15',
            'ntpn' => 'required|max:16|min:16',
        ];

        $text = [
            'ebilling.required' => 'Ebiling Tidak Boleh Kosong',
            'ebilling.max' => 'Ebiling Maximal 15 digit',
            'ebilling.min' => 'Ebiling Tidak Boleh Kurang dari 15 Digit',
            'ntpn.required' => 'NTPN Tidak Boleh Kosong',
            'ntpn.max' => 'NTPN Maximal 16 digit',
            'ntpn.min' => 'NTPN Tidak Boleh Kurang dari 16 Digit',
        ];

        $validasi = validator::make($request->all(), $rules, $text);
        if ($validasi->fails())
        {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()]);
        }

        $nomoracak = Str::random(10);
        $pajaklsId = $request->id;
        $pajaklsId_potonganls = $request->id_potonganls;
        $pajaklsebilling = $request->ebilling;

        $cek_ebilling = PajaklsModel::where('ebilling', $request->ebilling)->where('id', '!=', $request->id)->first();
        $cek_ntppn = PajaklsModel::where('ntpn', $request->ntpn)->where('id', '!=', $request->id)->first();

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
            $detailspotongan2 = [
                'status1' => '1',
                'id_pajakkpp' => $request->id,
                'ebilling' => $request->ebilling,
                // 'jenis_pajak' => $request->jenis_pajak,
                // 'nilai_pajak' =>str_replace('.','', $request->nilai_pajak),
            ];

            $detailspajakls = [
                'ebilling' => $request->ebilling, 
                'ntpn' => $request->ntpn, 
                'akun_pajak' => $request->akun_pajak,
                'jenis_pajak' => $request->jenis_pajak,
                'nilai_pajak' =>str_replace('.','', $request->nilai_pajak),
                'rek_belanja' => $request->rek_belanja,
                'nama_npwp' => $request->nama_npwp,
                'nomor_npwp' => $request->nomor_npwp,
                // 'periode' => $request->periode,
                // 'bukti_pemby' => $request->bukti_pemby,
                'status2' => 'Terima',
                // 'id_potonganls' => $request->id_potonganls,
                // 'id_potonganls' => $request->id,
                'id_potonganls' => $request->id,
                'periode' => date('M'),
                'no_penguji' => $request->no_penguji,
            ];

            if ($files = $request->file('bukti_pemby')){
                $destinationPath = 'app/assets/images/bukti_pemby_pajak/';
                $profileImage = "Simelajang" . "-" .date('YmdHis')."-" .$files->getClientOriginalName();
                $files->move($destinationPath, $profileImage);
                $detailspajakls['bukti_pemby'] = "$profileImage";
            }
        }

            PajaklsModel::updateOrCreate(['id' => $pajaklsId], $detailspajakls);
            PotonganModel::updateOrCreate(['id' => $pajaklsId], $detailspotongan2);
            // PotonganModel::updateOrCreate(['id' => $pajaklsId_potonganls], $detailspotongan);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'bukti_pemby' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5000',
        ]);

        $updatepajakls = PajaklsModel::where('id', $id)->first();
        // $updatepajakls = Pajakkpp::where('id', $id)->first();

        $cek_ebilling = PajaklsModel::where('ebilling', $request->ebilling)->where('id', '!=', $request->id)->first();
        $cek_ntppn = PajaklsModel::where('ntpn', $request->ntpn)->where('id', '!=', $request->id)->first();

        if($cek_ebilling)
        {
            return redirect('tampilpajakls')->with(['error'=>'Ebilling sudah ada']);
        }
        elseif($cek_ntppn)
        {
            return redirect('tampilpajakls')->with(['error'=>'NTPN sudah ada']);
        }
        else
        {
            PotonganModel::where('id',$request->get('id_potonganls'))
                        ->update([
                            'status1' => '1',
                            'id_pajakkpp' => $request->id_potonganls,
                            'ebilling' => $request->ebilling,
                            'jenis_pajak' => $request->jenis_pajak,
                        ]);

            // $updatepajakls->id_potonganls = $request->get('id_potonganls');
            $updatepajakls->akun_pajak = $request->get('akun_pajak');
            $updatepajakls->ebilling = $request->get('ebilling');
            $updatepajakls->ntpn = $request->get('ntpn');
            $updatepajakls->nama_npwp = $request->get('nama_npwp');
            $updatepajakls->nomor_npwp = $request->get('nomor_npwp');
            $updatepajakls->jenis_pajak = $request->get('jenis_pajak');
            $updatepajakls->rek_belanja = $request->get('rek_belanja');
            $updatepajakls->nilai_pajak = str_replace('.','', $request->get('nilai_pajak'));
            $updatepajakls->periode = $request->get('periode');
            $updatepajakls->no_penguji = $request->get('no_penguji');
            $updatepajakls->status2 = 'Terima';

            if ($request->file('bukti_pemby')) {
                if ($updatepajakls->bukti_pemby){
                    File::delete('app/assets/images/bukti_pemby_pajak/'.$updatepajakls->bukti_pemby);
                }
                $file = $request->file('bukti_pemby');
                $nama_file = "Simelajang" . "-" .date('YmdHis')."-" .$file->getClientOriginalName();
                $file->move('app/assets/images/bukti_pemby_pajak/', $nama_file);
                $updatepajakls->bukti_pemby = $nama_file;
            }
            $updatepajakls->save();
        }
                
            // PajaklsModel::updateOrCreate(['id' => $pajaklsId], $detailspajakls);
            // Potongan2Model::updateOrCreate(['id' => $pajaklsId], $detailspotongan2);
            // PotonganModel::updateOrCreate(['id' => $pajaklsId_potonganls], $detailspotongan);
            // return response()->json(['success' =>'Data Berhasil Disimpan']);
            return redirect('/tampilpajakls')->with(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function edit($id)
    {

        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Edit Data Pajak LS',
            'active_dtpajak'       => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => ' Edit Data Pajak',
            'breadcumd2'           => 'LS',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'dtpajakls'            => DB::table('pajakkpp')
                                    ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp', 'pajakkpp.periode', 'pajakkpp.no_penguji')
                                    // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                                    // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    // ->where('pajakkpp.status2', ['Terima'])
                                    // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                                    ->where('pajakkpp.id', $id)
                                    ->first(),
        );
        // return response()->json($pajakls);
        return view('Pajak_LS.Modal.Ubahdata',$data);
    }

    public function lihat($id)
    {

        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Preview Data Pajak LS',
            'active_dtpajak'       => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => ' Preview Data Pajak',
            'breadcumd2'           => 'LS',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'lihatpajakls'            => DB::table('pajakkpp')
                                    ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp')
                                    // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                                    // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    // ->where('pajakkpp.status2', ['Terima'])
                                    // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                                    ->where('pajakkpp.id', $id)
                                    ->first(),
        );
        // return response()->json($pajakls);
        return view('Pajak_LS.Modal.Lihat',$data);
    }

    public function editpajakls($id)
    {
        $where = array('id' => $id);
        $pajakls = PajaklsModel::where($where)->first();

        return response()->json($pajakls);
    }

    public function editpajaklssipd($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PotonganModel::where($where)->first();

        return response()->json($pajaklssipd);
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

    public function tolakls($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PajaklsModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function tolaklsupdate(Request $request, string $id)
    {

        PotonganModel::where('id',$request->get('id_potonganls'))
        ->update([
            'status1' => '0',
        ]);

        PajaklsModel::where('id_potonganls',$request->get('id_potonganls'))
        ->update([
            'status2' => 'Tolak',
        ]);

            return redirect('tampilpajakls')->with('success','Data Berhasil Ditolak');
    }

    public function terimals($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PajaklsModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function terimalsupdate(Request $request, string $id)
    {

        PotonganModel::where('id',$request->get('id_potonganls'))
        ->update([
            'status1' => '1',
        ]);

        PajaklsModel::where('id_potonganls',$request->get('id_potonganls'))
        ->update([
            'status2' => 'Terima',
        ]);

            return redirect('tampilpajakls')->with('success','Data Berhasil Ditolak');
    }
        

    public function terima(Request $request, $id)
    {
        // $where = array('id_pajakkpp' => $id);

        $pajaklsdt = PajaklsModel::findOrFail($id);
        
        $pajaklsdt->update([
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

    public function destroy($id)
    {
        // $data = PajaklsModel::where('id',$id)->first(['bukti_pemby']);
        // unlink("app/assets/images/bukti_pemby_pajak/".$data->bukti_pemby);

        PajaklsModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

    public function export()
    {
        $nama_file = 'Data Pajak-'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new DataExport, $nama_file);
    }

    public function exportlsbeluminput()
    {
        $nama_file = 'Data Pajak-'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new DataExportbeluminput, $nama_file);
    }

    
}
