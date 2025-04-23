<?php

namespace App\Http\Controllers;

use App\Models\PajakguModel;
use App\Models\PotonganguModel;
use App\Models\Sp2dModel;
use App\Models\TbpModel;
use App\Models\UserModel;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TarikdataController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'             => 'Tarik Data Pajak LS SIPD RI',
            'active_side_tarik' => 'active',
            'active_tarik'      => 'active',
            'page_title'        => 'Pengaturan',
            'breadcumd1'        => 'Kelola User',
            'breadcumd2'        => 'List User',
            'userx'             => UserModel::where('id',$userId)->first(['fullname','role','gambar']),
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

            $dt = DB::table('sp2d')
                        ->select('jenis', 'nomor_sp2d','tanggal_sp2d','nama_skpd','keterangan_sp2d','nilai_sp2d','nomor_spm')
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-07-01', '2024-07-30'])
                        ->where('jenis',['LS'])
                        ->whereBetween('sp2d.tanggal_sp2d', ['2025-01-01', '2025-12-31'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-07-01', '2024-07-30'])
                        ->get();

            return DataTables::of($dt)
                    ->addIndexColumn()
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    ->rawColumns(['nilai_sp2d'])
                    ->make(true);
        }

        return view('Tarik_data.Pajakls', $data);
    }

    public function indexgu(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'             => 'Tarik Data Pajak GU SIPD RI',
            'active_side_tarik' => 'active',
            'active_tarikgu'      => 'active',
            'page_title'        => 'Pengaturan',
            'breadcumd1'        => 'Kelola User',
            'breadcumd2'        => 'List User',
            'userx'             => UserModel::where('id',$userId)->first(['fullname','role','gambar']),
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

            $dt1 = DB::table('sp2d')
                        ->select('nomor_sp2d','tanggal_sp2d','nama_skpd','keterangan_sp2d','nilai_sp2d','nomor_spm', 'jenis')
                        ->whereIn('jenis',['GU'])
                        ->whereBetween('sp2d.tanggal_sp2d', ['2025-01-01', '2025-12-31'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-07-01', '2024-07-30'])
                        ->get();

            return DataTables::of($dt1)
                    ->addIndexColumn()
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    ->rawColumns(['nilai_sp2d'])
                    ->make(true);
        }


        return view('Tarik_data.Pajakgu', $data);
    }

    public function indextbp(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                     => 'Pengajuan TBP',
            'active_side_pengajuantbp'  => 'active',
            'active_pengajuantbp'       => 'active',
            'page_title'                => 'Penatausahaan',
            'breadcumd1'                => 'Pengajuan TBP',
            'breadcumd2'                => 'Pembuatan',
            'userx'                     => UserModel::where('id',$userId)->first(['fullname','role','gambar']),
            'opd'                       => DB::table('users')
                                        // ->join('opd',  'opd.id', 'users.id_opd')
                                        // ->select('fullname','nama_opd')
                                        ->where('nama_opd', auth()->user()->nama_opd)
                                        ->first(),
        );

        if ($request->ajax()) {

            $dt1 = DB::table('tb_potongangu')
                    ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_potongangu.id_billing', 'tb_potongangu.nilai_tbp_pajak_potongan', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.status1', 'tb_potongangu.id', 'tb_potongangu.status3', 'tb_potongangu.status4')
                    ->join('tb_tbp', 'tb_tbp.id_tbp', 'tb_potongangu.id_tbp')
                    ->where('tb_potongangu.status1',['Terima'])
                    // ->where('tb_potongangu.status3',['0'])
                    // ->whereBetween('sp2d.tanggal_sp2d', ['2024-07-01', '2024-07-30'])
                    ->where('tb_tbp.nama_skpd', auth()->user()->nama_opd)
                    ->get();

            return DataTables::of($dt1)
                    ->addIndexColumn()
                    ->addColumn('nilai_tbp', function($row) {
                        return number_format($row->nilai_tbp);
                    })
                    ->addColumn('status', function($row){
                        if($row->status3 == '1')
                        {
                            $btn1 = '
                                    <a class="badge bg-danger"> Pajak Sudah Final
                                    </a>
                                  ';
                        }elseif($row->status4 == 'TolakInput') {
                            $btn1 = '
                                    <a class="badge bg-secondary"> Pajak Sudah Diinput<br> Klik Tombol -->
                                        <div href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->id_billing.'"        class="Ubahstatuspajakgu btn btn-outline-danger btn-sm">Ubah
                                        </div>
                                    <br>Untuk Merubah Status Pajak TBP Tersebut
                                    </a>
                                  ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->id_billing.'" class="tolaktbp btn btn-outline-danger m-b-xs"> <i class="fas fa-thumbs-down"></i> Tolak
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->addColumn('nilai_tbp_pajak_potongan', function($row) {
                        return number_format($row->nilai_tbp_pajak_potongan);
                    })
                    ->rawColumns(['nilai_tbp', 'status'])
                    ->make(true);
        }


        return view('Tarik_data.Pajaktbp', $data);
    }

    public function indextbptolak(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                     => 'Pengajuan TBP',
            'active_side_pengajuantbp'  => 'active',
            'active_pengajuantbp'       => 'active',
            'page_title'                => 'Penatausahaan',
            'breadcumd1'                => 'Pengajuan TBP',
            'breadcumd2'                => 'Pembuatan',
            'userx'                     => UserModel::where('id',$userId)->first(['fullname','role','gambar']),
            'opd'                       => DB::table('users')
                                        // ->join('opd',  'opd.id', 'users.id_opd')
                                        // ->select('fullname','nama_opd')
                                        ->where('nama_opd', auth()->user()->nama_opd)
                                        ->first(),
        );

        if ($request->ajax()) {

            $dt1 = DB::table('tb_potongangu')
                    ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_potongangu.id_billing', 'tb_potongangu.nilai_tbp_pajak_potongan', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.status1', 'tb_potongangu.id')
                    ->join('tb_tbp', 'tb_tbp.id_tbp', 'tb_potongangu.id_tbp')
                    ->where('tb_potongangu.status1',['Tolak'])
                    // ->whereBetween('sp2d.tanggal_sp2d', ['2024-07-01', '2024-07-30'])
                    ->where('tb_tbp.nama_skpd', auth()->user()->nama_opd)
                    ->get();

            return DataTables::of($dt1)
                    ->addIndexColumn()
                    ->addColumn('nilai_tbp', function($row) {
                        return number_format($row->nilai_tbp);
                    })
                    ->addColumn('status', function($row){
                        if($row->status1 == 'Tolak')
                        {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->nomor_tbp.'" class="editperbaikitbp btn btn-outline-danger m-b-xs">
                                        <i class="fa fa-edit"> Perbaiki</i> 
                                    </a>
                                  ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->nomor_tbp.'" class="tolaktbp btn btn-outline-primary m-b-xs"> <i class="fas fa-thumbs-up"></i> Terima
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->addColumn('nilai_tbp_pajak_potongan', function($row) {
                        return number_format($row->nilai_tbp_pajak_potongan);
                    })
                    ->rawColumns(['nilai_tbp', 'status'])
                    ->make(true);
        }


        return view('Tarik_data.Pajaktbp', $data);
    }

    public function indextbpbelumverifikasi(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                     => 'Pengajuan TBP',
            'active_side_pengajuantbp'  => 'active',
            'active_pengajuantbp'       => 'active',
            'page_title'                => 'Penatausahaan',
            'breadcumd1'                => 'Pengajuan TBP',
            'breadcumd2'                => 'Pembuatan',
            'userx'                     => UserModel::where('id',$userId)->first(['fullname','role','gambar']),
            'opd'                       => DB::table('users')
                                        // ->join('opd',  'opd.id', 'users.id_opd')
                                        // ->select('fullname','nama_opd')
                                        ->where('nama_opd', auth()->user()->nama_opd)
                                        ->first(),
        );

        if ($request->ajax()) {

            $dt1 = DB::table('tb_potongangu')
                        ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_potongangu.id_billing', 'tb_potongangu.nilai_tbp_pajak_potongan', 'tb_potongangu.nama_pajak_potongan', 'tb_potongangu.status1', 'tb_potongangu.id')
                        ->join('tb_tbp', 'tb_tbp.id_tbp', 'tb_potongangu.id_tbp')
                        ->where('tb_potongangu.status1',['Belum_Verifikasi'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-07-01', '2024-07-30'])
                        ->where('tb_tbp.nama_skpd', auth()->user()->nama_opd)
                        ->get();

            return DataTables::of($dt1)
                    ->addIndexColumn()
                    ->addColumn('nilai_tbp', function($row) {
                        return number_format($row->nilai_tbp);
                    })
                    ->addColumn('nilai_tbp_pajak_potongan', function($row) {
                        return number_format($row->nilai_tbp_pajak_potongan);
                    })
                    ->addColumn('status', function($row){
                        if($row->status1 == 'Belum_Verifikasi')
                        {
                            // $btn1 = '
                            //         <a href="javascript:void(0)" data-id="'.$row->id.'" class="deletepengajuantbp btn btn-outline-danger m-b-xs"> <i class="fa fa-trash"></i> Hapus
                            //         </a>
                            //       ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->nomor_tbp.'" class="tolaktbp btn btn-outline-primary m-b-xs"> <i class="fas fa-thumbs-up"></i> Terima
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->rawColumns(['nilai_tbp', 'status'])
                    ->make(true);
        }


        return view('Tarik_data.Pajaktbp', $data);
    }

    public function indextbplist(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                     => 'Pengajuan TBP',
            'active_side_pengajuantbp'  => 'active',
            'active_pengajuantbp'       => 'active',
            'page_title'                => 'Penatausahaan',
            'breadcumd1'                => 'Pengajuan TBP',
            'breadcumd2'                => 'Pembuatan',
            'userx'                     => UserModel::where('id',$userId)->first(['fullname','role','gambar']),
            'opd'                       => DB::table('users')
                                        // ->join('opd',  'opd.id', 'users.id_opd')
                                        // ->select('fullname','nama_opd')
                                        ->where('nama_opd', auth()->user()->nama_opd)
                                        ->first(),
        );

        if ($request->ajax()) {

            $dt1 = DB::table('tb_tbp')
                        ->select('tb_tbp.nomor_tbp','tb_tbp.tanggal_tbp','tb_tbp.nilai_tbp','tb_tbp.keterangan_tbp','tb_tbp.no_npd','tb_tbp.no_spm', 'tb_tbp.tgl_spm', 'tb_tbp.nilai_spm', 'tb_tbp.nama_skpd', 'tb_tbp.id', 'tb_tbp.status', 'tb_tbp.id')
                        // ->join('tb_tbp', 'tb_tbp.id_tbp', 'tb_potongangu.id_tbp')
                        // ->where('tb_potongangu.status1',['Belum_Verifikasi'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-07-01', '2024-07-30'])
                        ->where('tb_tbp.nama_skpd', auth()->user()->nama_opd)
                        ->get();

                        // Tombol Hapus yg ada dibawah dipindahkan sementara
                        // <a href="javascript:void(0)" data-id="'.$row->id.'" class="deletepengajuantbplist btn btn-outline-danger m-b-xs"> <i class="fa fa-trash"></i> Hapus
                        //  </a>

            return DataTables::of($dt1)
                    ->addIndexColumn()
                    ->addColumn('nilai_tbp', function($row) {
                        return number_format($row->nilai_tbp);
                    })
                    ->addColumn('status', function($row){
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-outline-danger m-b-xs"> <i class="fa fa-trash"></i> Hapus
                                    </a>
                                  ';
                            return $btn1;
                    })
                    ->rawColumns(['nilai_tbp', 'status'])
                    ->make(true);
        }


        return view('Tarik_data.Pajaktbp', $data);
    }

    public function save_json(Request $request)
    {
        // Validasi input
        $nomoracak = Str::random(10);

        $datasp2d = $request->input('jsontextarea');
        $dt = json_decode($datasp2d, true);
        $detail_belanja = $dt["ls"]["detail_belanja"];
        $pajak_potongan = $dt["ls"]["pajak_potongan"];

        $ceksp2d = Sp2dModel::where('nomor_sp2d', $dt["ls"]["header"]["nomor_sp_2_d"])->count();
        if($ceksp2d > 0)
        {
            return redirect()->back()->with('error', 'SP2D Sudah Ada');
        }

        // Simpan data JSON ke dalam database
        $datasp2d = new Sp2dModel();
        $datasp2d->idhalaman = $nomoracak;
        $datasp2d->jenis = $dt["jenis"];
        $datasp2d->tahun = $dt["ls"]["header"]["tahun"];
        $datasp2d->nomor_rekening = $dt["ls"]["header"]["nomor_rekening"];
        $datasp2d->nama_bank = $dt["ls"]["header"]["nama_bank"];
        $datasp2d->nomor_sp2d = $dt["ls"]["header"]["nomor_sp_2_d"];
        $datasp2d->tanggal_sp2d = Carbon::Parse($dt["ls"]["header"]["tanggal_sp_2_d"])->format('Y-m-d');
        $datasp2d->nama_skpd = $dt["ls"]["header"]["nama_skpd"];
        $datasp2d->nama_sub_skpd = $dt["ls"]["header"]["nama_sub_skpd"];
        $datasp2d->nama_pihak_ketiga = $dt["ls"]["header"]["nama_pihak_ketiga"];
        $datasp2d->no_rek_pihak_ketiga = $dt["ls"]["header"]["no_rek_pihak_ketiga"];
        $datasp2d->nama_rek_pihak_ketiga = $dt["ls"]["header"]["nama_rek_pihak_ketiga"];
        $datasp2d->bank_pihak_ketiga = $dt["ls"]["header"]["bank_pihak_ketiga"];
        $datasp2d->npwp_pihak_ketiga = $dt["ls"]["header"]["npwp_pihak_ketiga"];
        $datasp2d->keterangan_sp2d = $dt["ls"]["header"]["keterangan_sp2d"];
        $datasp2d->nilai_sp2d = $dt["ls"]["header"]["nilai_sp2d"];
        $datasp2d->nomor_spm =  $dt["ls"]["header"]["nomor_spm"];
        $datasp2d->tanggal_spm = Carbon::Parse( $dt["ls"]["header"]["tanggal_spm"])->format('Y-m-d');
        $datasp2d->nama_ibu_kota = $dt["ls"]["header"]["nama_ibu_kota"];
        $datasp2d->nama_bud_kbud = $dt["ls"]["header"]["nama_bud_kbud"];
        $datasp2d->jabatan_bud_kbud = $dt["ls"]["header"]["jabatan_bud_kbud"];
        $datasp2d->nip_bud_kbud = $dt["ls"]["header"]["nip_bud_kbud"];
        $datasp2d->save();

        foreach($detail_belanja as $row){
            $databelanja1 = [
                'norekening' => $row["kode_rekening"],
                'uraian' => $row["uraian"],
                'nilai' => $row["jumlah"],
                'id_sp2d' => $nomoracak
            ];
            DB::table('belanja1')->insert($databelanja1);
        }

        if ($pajak_potongan == null){
            echo "<h3>SP2D ini tidak memiliki Potongan</h3>";
        }else{
            foreach($pajak_potongan as $row1){
                $datapotongan2 = [
                // $belanja1 = new ModelBelanja1;
                // $belanja1->norekening = $row["kode_rekening"];
                // $belanja1->uraian = $row["uraian"];
                // $belanja1->nilai = $row["jumlah"];
                // $belanja1->id_sp2d = $nomordok;

                'jenis_pajak' => $row1["nama_pajak_potongan"],
                'ebilling' => $row1["id_billing"],
                'nilai_pajak' => $row1["nilai_sp2d_pajak_potongan"],
                'id_potongan' => $nomoracak,
                'status1' => '0'
                ];
                DB::table('potongan2')->insert($datapotongan2);
            }
        }   

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }


    public function save_jsongu(Request $request)
    {
        // Validasi input
        $nomoracak = Str::random(10);

        $datasp2d = $request->input('jsontextareagu');
        $dt = json_decode($datasp2d, true);

        $detail = $dt["gu"]["detail"];
        
        $ceksp2d = Sp2dModel::where('nomor_sp2d', $dt["gu"]["nomor_sp_2_d"])->count();
        if($ceksp2d > 0)
        {
            return redirect()->back()->with('error', 'SP2D Sudah Ada');
        }
            $datasp2d = new Sp2dModel();
            $datasp2d->idhalaman = $nomoracak;
            $datasp2d->jenis = $dt["jenis"];
            $datasp2d->tahun = $dt["gu"]["tahun"];
            $datasp2d->nomor_rekening = $dt["gu"]["nomor_rekening"];
            $datasp2d->nama_bank = $dt["gu"]["nama_bank"];
            $datasp2d->nomor_sp2d = $dt["gu"]["nomor_sp_2_d"];
            $datasp2d->tanggal_sp2d = Carbon::Parse($dt["gu"]["tanggal_sp_2_d"])->format('Y-m-d');
            $datasp2d->nama_skpd = $dt["gu"]["nama_skpd"];
            $datasp2d->keterangan_sp2d = $dt["gu"]["keterangan_sp2d"];
            $datasp2d->nilai_sp2d = $dt["gu"]["nilai_sp2d"];
            $datasp2d->nomor_spm =  $dt["gu"]["nomor_spm"];
            $datasp2d->tanggal_spm = Carbon::Parse( $dt["gu"]["tanggal_spm"])->format('Y-m-d');
            $datasp2d->nama_ibu_kota = $dt["gu"]["nama_ibu_kota"];
            $datasp2d->nama_bud_kbud = $dt["gu"]["nama_bud_kbud"];
            $datasp2d->jabatan_bud_kbud = $dt["gu"]["jabatan_bud_kbud"];
            $datasp2d->nip_bud_kbud = $dt["gu"]["nip_bud_kbud"];
            $datasp2d->save();

            foreach($detail as $row){
                $databelanja1 = [
                    'norekening' => $row["kode_rekening"],
                    'uraian' => $row["uraian"],
                    'nilai' => $row["nilai"],
                    'id_sp2d' => $nomoracak
                ];
                DB::table('belanja1')->insert($databelanja1);
            } 
        
        return redirect()->back()->with('status', 'Data Berhasil diSimpan');

        }

    public function save_jsontbp(Request $request)
    {
        // Validasi input
        $nomoracak = Str::random(10);

        $datatbp = $request->input('jsontextareatbp');
        $dt = json_decode($datatbp, true);

        $detail = $dt["detail"];
        $potongantbp = $dt["pajak_potongan"];
        
        $cektbp = TbpModel::where('nomor_tbp', $dt["nomor_tbp"])->count();
        if($cektbp > 0)
        {
            return redirect()->back()->with('error', 'TBP Sudah Ada');
        }

        if ($potongantbp == null){
            return redirect()->back()->with('error', 'Maaf TBP ini tidak Punya Pajak');
        }
            // foreach($dt  as $row3){
                $datatbp = [
                    'id_tbp' => $nomoracak,
                    'nomor_tbp' => $dt["nomor_tbp"],
                    'nilai_tbp' => $dt["nilai_tbp"],
                    'npwp' => $dt["npwp"],
                    'keterangan_tbp' => $dt["keterangan_tbp"],
                    'no_npd' => $dt["nomor_npd"],
                    'nama_skpd' => $dt["nama_skpd"],
                    'tanggal_tbp' => Carbon::Parse($dt["tanggal_tbp"])->format('Y-m-d'),
                    'no_spm' => $request->no_spm,
                ];

                // if ($files = $request->file('bukti_pemby')){
                //     $destinationPath = 'app/assets/images/bukti_pemby_pajak/';
                //     $profileImage = "Simelajang" . "-" .date('YmdHis')."-" .$files->getClientOriginalName();
                //     $files->move($destinationPath, $profileImage);
                //     $datatbp['bukti_pemby'] = "$profileImage";
                // }

                DB::table('tb_tbp')->insert($datatbp);

            foreach($detail as $row){
                $data1 = [
                    'kode_rekening' => $row["kode_rekening"],
                    'uraian' => $row["uraian"],
                    'jumlah' => $row["jumlah"],
                    'id_tbp' => $nomoracak
                ];
                DB::table('tb_belanjagu')->insert($data1);
            } 

            // if ($potongantbp == null){
            //     return redirect()->back()->with('error', 'Maaf TBP ini tidak Punya Pajak');
            // }

                foreach($potongantbp as $row1){
                $data2 = [
                    'nama_pajak_potongan' => $row1["nama_pajak_potongan"],
                    'id_billing' => $row1["id_billing"],
                    'nilai_tbp_pajak_potongan' => $row1["nilai_tbp_pajak_potongan"],
                    'id_tbp' => $nomoracak,
                    'status1' => 'Belum_Verifikasi'
                ];
                DB::table('tb_potongangu')->insert($data2);
                }
            
        
        return redirect()->back()->with('status', 'Data Berhasil diSimpan');

    }

    public function tariktolaktbp($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PotonganguModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function tariktolaktbpupdate(Request $request, string $id)
    {

        PotonganguModel::where('id',$request->get('id'))
        ->update([
            'status1' => 'Tolak',
        ]);

        return redirect()->back()->with('success','Data Berhasil Ditolak');
    }

    public function tarikterimatbp($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PotonganguModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function tarikterimatbpupdate(Request $request, string $id)
    {

        PotonganguModel::where('id',$request->get('id'))
        ->update([
            'status1' => 'Terima',
        ]);

        return redirect()->back()->with('success','Data Berhasil Ditolak');
    }

    public function ubahstatustbp($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PotonganguModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function ubahstatustbpupdate(Request $request, string $id)
    {

        PotonganguModel::where('id',$request->get('id'))
        ->update([
            'status4' => 'Belum',
        ]);

        PajakguModel::where('ebilling',$request->get('ebilling'))
        ->update([
            'status1' => 'Tolak',
        ]);

        return redirect('/tarikpajaksipdritbp')->with('success','Data Berhasil Dirubah');
    }

    public function indexstatus4($id)
    {
        $dtpotongan = PotonganguModel::findOrFail($id);
        
        $dtpotongan->update([
            'status1' => 'Belum_Verifikasi',
        ]);

        return response()->json(['success'=>'Data Berhasil Diubah']);
    }

    public function getDataakunpajak()
    {
        $akunpajak = DB::table('tb_akun_pajak')
        ->select('id', 'akun_pajak')
        ->get();
        return response()->json($akunpajak);
        // return view('Penatausahaan.Pajakls.Pajakls', compact('akunpajak'));
    }

    public function destroy(Request $request, $id)
    {
        // $data = TbpModel::where('id',$id)->first(['bukti_pemby']);
        // unlink("app/assets/images/bukti_pemby_pajak/".$data->bukti_pemby);
        // PotonganguModel::where('id',$id)
        // ->update([
        //     'status4' => 'Belum',
        // ]);

        PotonganguModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

    public function destroylist(Request $request, $id)
    {
        // $data = TbpModel::where('id',$id)->first(['bukti_pemby']);
        // unlink("app/assets/images/bukti_pemby_pajak/".$data->bukti_pemby);

        TbpModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

}
