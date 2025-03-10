<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
        
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body style="background-color: white;">

        <style>
        .line-title{
          border: 10;
          border-style: inset;
          border-top: 1px solid #000;
        }
    
        .table-borderless td,
        .table-borderless th {
            border: 10;
        }
      </style>

        {{-- <a onclick="this.href='/laporanpajakls-cetak/' + 'nama_skpd=' + document.getElementById('nama_skpd').value + '&periode=' + document.getElementById('periode').value + '&akun_pajak=' + document.getElementById('akun_pajak').value + '&status2=' + document.getElementById('status2').value " target="blank" type="submit" class="btn btn-outline-primary m-b-xs text-center" style="text-align: center">
            <i class="fa fa-enter"></i>PDF   --}}
            <br>
            <div class="row" border="0" align="center" style="width: 200%">
                <div class="col-1 text-right" align="center" style="width: 5%;  margin-top: 20px;">
                    <td colspan="0" style="width: 5%;"><center><img src="/theme/assets/images/13.png" width="80" height="100"></center></td>
                </div>
                <div class="col-4 align-middle fw-bold text-center" style="width: 40%; margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                    <td colspan="6" style="width: 55%;">
                        <font style="font-size: 20pt;font-weight: bold;"><center>PEMERINTAH KOTA PALU</center></font>
                        <font style="font-size: 13pt;font-weight: bold;"><center>REKAPITULASI PAJAK REALISASI BELANJA GU</center></font>
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
                                    
                                <table class="table-bordered" border="1" cellpadding="10" align="center" cellspacing="20" style="width: 100%">
                                    
        
                                    <!-- DATA SUPPLIER -->
                                    <!-- <tr style="border: 10;">
                                        <td colspan="6"></td>
                                    </tr> -->
        
                                    <!-- DATA BARANG -->
        
                                    
                                    <br><br>
                                    <tbody>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Kode Akun Pajak</th>
                                            <th class="text-center">Jenis Pajak</th>
                                            <th class="text-center">Nilai Pajak</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="width: 1%">
                                                1<br><br>
                                                <br>
                                                <br>
                                                <br>

                                            </td>
                                            <td class="" style="width: 10%">
                                                411211 <br>
                                                411121 <br>
                                                411122 <br>
                                                411124 <br>
                                                411128
                                            </td>
                                            <td class="" style="width: 15%">
                                                Pajak Pertambahan Nilai <br>
                                                PPh 21 <br>
                                                Pajak Penghasilan PS 22 <br>
                                                Pajak Penghasilan PS 23 <br>
                                                Pajak Penghasilan PS 24 <br>
                                            </td>
                                            @php $total2 = 0; @endphp
                                            <td class="text-right" style="width: 5%" align="right">
                                                {{ number_format($total2 = $datapajakgurekap->where('akun_pajak', '411211')->sum('nilai_pajak'), 0) }} <br>
                                                {{ number_format($total2 = $datapajakgurekap->where('akun_pajak', '411121')->sum('nilai_pajak'), 0) }} <br>
                                                {{ number_format($total2 = $datapajakgurekap->where('akun_pajak', '411122')->sum('nilai_pajak'), 0) }} <br>
                                                {{ number_format($total2 = $datapajakgurekap->where('akun_pajak', '411124')->sum('nilai_pajak'), 0) }} <br>
                                                {{ number_format($total2 = $datapajakgurekap->where('akun_pajak', '411128')->sum('nilai_pajak'), 0) }}
                                            </td>
                                        </tr>

                                        @php $total = 0; @endphp
                                            <tr style="border: 10;" align="left">
                                                <td colspan="3" align="right"><b>TOTAL</b></td>
                                                <td align="right"><b>{{ number_format($total = $datapajakgurekap->sum('nilai_pajak'), 0) }}</b></td>
                                            </tr>
                                </table>
                            </div>

                            <br><br><br>
                            <div class="row" border="0" align="center" style="width: 145%">
                                <div class="col-1">
                                </div>
                                <div class="col-4">
                                    </td>
                                </div>
                                <div class="col-7" style="width: 20%;">
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

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            window.print();

            setTimeout(() => {
                window.close();
                window.location.href = '/laporanpajaklsrekap-cetak';
            }, 1000);
        </script>

    </body>
</html>
