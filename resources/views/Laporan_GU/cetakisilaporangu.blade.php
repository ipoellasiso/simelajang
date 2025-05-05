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
          border: 0;
          border-style: inset;
          border-top: 1px solid #000;
        }
    
        .table-borderless td,
        .table-borderless th {
            border: 0;
        }
      </style>

        {{-- <a onclick="this.href='/laporanpajakls-cetak/' + 'nama_skpd=' + document.getElementById('nama_skpd').value + '&periode=' + document.getElementById('periode').value + '&akun_pajak=' + document.getElementById('akun_pajak').value + '&status2=' + document.getElementById('status2').value " target="blank" type="submit" class="btn btn-outline-primary m-b-xs text-center" style="text-align: center">
            <i class="fa fa-enter"></i>PDF   --}}

        <div class="page-container">

            <div class="">
                <div class="card">
                    <div class="row">
                        <div class="col-1 text-center">
                            <img src="{{ URL::asset('app/assets/images/Palu.png')}}" style="margin-top: 15px; text-align: center; width: 70px; right: 50px;" alt="" />
                        </div>
                        <div class="col-10 align-middle fw-bold text-center text-uppercase" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                            PEMERINTAH KOTA PALU <br>
                            REKAPITULASI PENYETORAN PAJAK <br>
                            TAHUN ANGGARAN 2025<br>
                        </div>
                        <div class="col-1">
                        </div>
                    </div>
                
                {{-- <form method="get" target="blank" action="{{ route('cetaklaporanls') }}"> --}}
                @csrf
                    <div class="">
                        <div class="row">
                            
                            <div class="col">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table border="1" cellpadding="10" align="center" cellspacing="20" id="" class="display table table-bordered" style="width:100%">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama OPD</th>
                                                    <th>Nomor SPM</th>
                                                    <th>Tanggal SP2D</th>
                                                    <th>Nomor SP2D</th>
                                                    <th>Nilai SP2D</th>
                                                    <th>Akun Pajak</th>
                                                    <th>Jenis Pajak</th>
                                                    <th>Nilai Pajak</th>
                                                    <th>E-Biling</th>
                                                    <th>NTPN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total = 0; @endphp
                                                @php $no = 1; @endphp
                                                @foreach ($cetakpajakgu as $d )
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td style="border: 2;width: 30%;">{{ $d->nama_skpd }}</td>
                                                        <td style="border: 2;width: 30%;">{{ $d->nomor_spm }}</td>
                                                        <td style="border: 2;width: 10%;">{{ $d->tanggal_sp2d }}</td>
                                                        <td style="border: 2;width: 30%;">{{ $d->nomor_sp2d }}</td>
                                                        <td style="border: 2;width: 10%;">{{ number_format($d->nilai_sp2d) }}</td>
                                                        <td style="border: 2;width: 10%;">{{ $d->akun_pajak }}</td>
                                                        <td style="border: 2;width: 10%;">{{ $d->jenis_pajak }}</td>
                                                        <td style="border: 2;width: 20%;">{{ number_format($d->nilai_pajak) }}</td>
                                                        <td style="border: 2;width: 10%;">{{ $d->ebilling }}</td>
                                                        <td style="border: 2;width: 10%;">{{ $d->ntpn }}</td>
                                                    </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                            {{-- <tfoot> --}}
                                                <tr>
                                                    <th colspan="8" style="text-align: right">Total Pajak</th>
                                        
                                                    <td style="text-align: right"> {{ number_format($total = $cetakpajakgu->sum('nilai_pajak'), 0) }}</td>
                                                </tr>
                                            {{-- </tfoot> --}}
                                        </table>

                                        <br><br>
                                        <div class="row">
                                            <div class="col-2 text-center">
                                            </div>
                                            <div class="col-6">
                                            </div>
                                            <div class="col-4 align-middle fw-bold text-center" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                                                Palu, {{ now()->format('d M Y') }}<br>
                                                PENGGUNA ANGGARAN<br><br><br><br><br><br>
                                                {{ $cetakbulan->nama_pa_kpa }}<br>
                                                NIP. {{ $cetakbulan->nip_pa_kpa }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

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
                window.location.href = '/laporanpajakgu-cetak';
            }, 1000);
        </script>

    </body>
</html>
