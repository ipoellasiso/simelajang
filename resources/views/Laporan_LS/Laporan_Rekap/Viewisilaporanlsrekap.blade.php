<!DOCTYPE html>
<html lang="en">
    <head>
    </head>

    <body style="background-color: white;">

        <style>
            .line-title{
                border: 0;
                border-style: inset;
                border-top: 1px solid #dee117;
            }
        
            .table-borderless td,
            .table-borderless th {
                border: 0;
            }
        </style>
    
        {{-- <div class="page-container"> --}}
            
            {{-- ######################### Isi Tampil Pajak LS ########################## --}}
            
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                    </div>
                    <div class="col-2">
                        <button id="cetakpdflsrekap" target="blank" type="button" class="btn btn-outline-primary m-b-xs text-center" style="text-align: center">
                            <i class="fa fa-enter"></i>PDF  
                        </button>
                        {{-- <button id="cetakexcells" target="blank" type="button" class="btn btn-outline-info m-b-xs">
                            <i class="fa fa-enter"></i>Excel
                        </button> --}}
                        {{-- <button class="btn btn-outline-info m-b-xs" onclick="tablesToExcel(['tbl2'], ['RekapPajak_Ls'], 'Rekap_Pajakls.xls', 'Excel')">
                            <i class="fa fa-enter" ></i>Excel
                        </button> --}}
                    </div>
                </div>
            
                <br>
            
                <div class="row" border="0" align="center" style="width: 200%">
                    <div class="col-1 text-center" align="center" style="width: 15%">
                        <td colspan="0" style="width: 5%;"><center><img src="/theme/assets/images/13.png" width="100" height="100"></center></td>
                    </div>
                    <div class="col-4 align-middle fw-bold text-center" style="width: 20%; margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                        <td colspan="6" style="width: 55%;">
                            <font style="font-size: 20pt;font-weight: bold;"><center>PEMERINTAH KOTA PALU</center></font>
                            <font style="font-size: 13pt;font-weight: bold;"><center>REKAPITULASI PAJAK REALISASI BELANJA</center></font>
                            <font style="font-size: 13pt;font-weight: bold;"><center>{{ $bulanrekap->nama_skpd }}</center></font>
                            <font style="font-size: 13pt;font-weight: bold;"><center>TAHUN ANGGARAN 2025</center></font>
                            <!-- <font style="font-size: 11pt;font-weight:13"><center>Alamat : Jl. Baruga No. 2 No.Tlp : 0451-9384 Kode Pos : 94362</center></font> -->
                        </td>
                    </div>
                    <div class="col-5">

                    </div>
                </div>
                <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                        
                                    <table id="tbl2" class="table-bordered" border="0" cellpadding="10" align="center" cellspacing="20" style="width: 80%">
                                        
            
                                        <!-- DATA SUPPLIER -->
                                        <!-- <tr style="border: 10;">
                                            <td colspan="6"></td>
                                        </tr> -->
            
                                        <!-- DATA BARANG -->
            
                                        <!-- <tr style="border: 10;">
                                            <td colspan="6"></td>
                                        </tr> -->
                                        <br>
                                        <tbody>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Kode Akun Pajak</th>
                                                <th class="text-center">Jenis Pajak</th>
                                                <th class="text-center">Nilai Pajak</th>
                                            </tr>
                                            <!-- @php $no=1; @endphp -->
                                            <tr>
                                                <td style="width: 2%">1</td>
                                                <td class="text-center" style="width: 10%">
                                                    411211 <br>
                                                    411121 <br>
                                                    411122 <br>
                                                    411124 <br>
                                                    411128
                                                </td>
                                                <td class="text-center" style="width: 15%">
                                                    Pajak Pertambahan Nilai <br>
                                                    PPh 21 <br>
                                                    Pajak Penghasilan PS 22 <br>
                                                    Pajak Penghasilan PS 23 <br>
                                                    Pajak Penghasilan PS 24 
                                                </td>
                                                @php $total2 = 0; @endphp
                                                <td class="text-right" style="width: 5%" align="right">
                                                    Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411211')->sum('nilai_pajak'), 0) }} <br>
                                                    Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411121')->sum('nilai_pajak'), 0) }} <br>
                                                    Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411122')->sum('nilai_pajak'), 0) }} <br>
                                                    Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411124')->sum('nilai_pajak'), 0) }} <br>
                                                    Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411128')->sum('nilai_pajak'), 0) }}
                                                </td>
                                            </tr>

                                            @php $total = 0; @endphp
                                                <tr style="border: 10;" align="left">
                                                    <td colspan="3" align="right"><b>TOTAL</b></td>
                                                    <td align="right"> Rp. <b>{{ number_format($total = $datapajaklsrekap->sum('nilai_pajak'), 0) }}</b></td>
                                                </tr>
                                    </table>
                                </div>

                                <br><br><br>
                                <div class="row" border="0" align="center" style="width: 150%">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-4">
                                        </td>
                                    </div>
                                    <div class="col-5" style="width: 15%;">
                                        Palu, {{ now()->format('d M Y') }}<br>
                                        <td><center><b>{{ $bulanrekap->jabatan_bud_kbud }}</b></center></td><br><br><br><br>
                                        <u><b>{{ $bulanrekap->nama_bud_kbud }}</b></u><br>
                                        <b>NIP. {{ $bulanrekap->nip_bud_kbud }}</b>
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        {{-- ################################# Modal ################################### --}}
        

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}
        <script>
        $(document).ready(function(){
                $("#cetakpdflsrekap").click(function(e){
                    var periode3 = $('#periode3').val();
                    var status23 = $("#status23").val();
                    var nama_skpd24 = $("#nama_skpd24").val();
                    // alert( nama_skpd + "" + periode + "" + akun_pajak + "" + status2);
                    params = "?page=rekaplaporan&nama_skpd24=" + nama_skpd24 + "&periode3=" + periode3 + "&status23=" + status23
                    window.open("/laporanpajaklsrekap-cetak"+params,"_blank");
                });
            });

        $(document).ready(function(){
            $("#cetakexcells").click(function(e){
                var periode = $('#periode').val();
                var akun_pajak = $("#akun_pajak").val();
                var status2 = $("#status2").val();
                var nama_skpd = $("#nama_skpd").val();
                // alert( nama_skpd + "" + periode + "" + akun_pajak + "" + status2);
                params = "?page=downloadexcel&nama_skpd=" + nama_skpd + "&periode=" + periode + "&akun_pajak=" + akun_pajak + "&status2=" + status2
                window.open("/laporan.downloadlaporanexcel"+params,"_blank");
            });
        });
        </script>
        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        {{-- @include('Template.Script') --}}

        

    </body>
</html>
