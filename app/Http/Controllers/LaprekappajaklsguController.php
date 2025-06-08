<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaprekappajaklsguController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Rekapitulasi Pajak LS dan GU',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Rekapitulasi',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'LS dan GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
        );

        return view('Laporan_RekapPajak_LS_GU.Tampilindeksrekappajak', $data);
    }

    public function Rekappajak(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Rekapitulasi Pajak LS dan GU',
            'active_side_pajakls'  => 'active',
            'active_pajakls'       => 'active',
            'page_title'           => 'Rekapitulasi',
            'breadcumd1'           => 'Pajak',
            'breadcumd2'           => 'LS dan GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
        );

        if ($request->tampilawal) {
            return view('Laporan_RekapPajak_LS_GU.Viewkosongrekappajak',[]);
        } else {
            // $bulan1 = PajaklsModel::findOrFail($request->periode);
            // $bulan = 'Satu'. ' '. $bulan1->periode;
            // $cari_bulan = '';
            
            $datapajakls = DB::table('sp2d')
                            ->select('sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'potongan2.status1',  'sp2d.nilai_sp2d', 'potongan2.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'potongan2.jenis_pajak', 'potongan2.ebilling')
                            // ->join('potongan2',  'potongan2.id_pajakkpp', 'pajakkpp.id_potonganls')
                            ->join('potongan2', 'potongan2.id_potongan', 'sp2d.idhalaman')
                            ->where('potongan2.jenis_pajak', 'PPH 21')
                            // ->join('pajakkpp', 'pajakkpp.id_potonganls', 'potongan2.id_pajakkpp')
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            // ->where('pajakkpp.periode','like',"%".$request->periode."%")
                            // ->where('pajakkpp.akun_pajak','like',"%".$request->akun_pajak."%")
                            // ->where('pajakkpp.status2','like', "%".$request->status2."%")
                            ->get();               

            $bulan = DB::table('pajakkpp')
                            ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd', 'pajakkpp.periode', 'sp2d.nama_bud_kbud', 'sp2d.jabatan_bud_kbud', 'sp2d.nip_bud_kbud')
                            ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('pajakkpp.periode','like',"%".$request->periode."%")
                            ->where('pajakkpp.akun_pajak','like',"%".$request->akun_pajak."%")
                            ->where('pajakkpp.status2','like', "%".$request->status2."%")
                            ->first();
            
            

            // return view('Laporan_LS.Viewisilaporanls',$data, compact('datapajakls'));
            return view('Laporan_RekapPajak_LS_GU.Viewisirekappajak',[
                'data' => $data,
                'datapajakls' => $datapajakls,
                'bulan' => $bulan,
            ]);
        }
    }
    
}
