<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
    <form method="get" target="blank" action="">
    @csrf
        <div class="page-container">
            
            {{-- ######################### Isi Tampil Pajak LS ########################## --}}
            
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                    </div>
                    <div class="col-2">
                        <!-- <button id="cetakpdfguspm" target="blank" type="button" class="btn btn-outline-primary m-b-xs text-center" style="text-align: center">
                            <i class="fa fa-enter"></i>PDF  
                        </button> -->
                        <button class="btn btn-outline-info m-b-xs" onclick="tablesToExcel(['tbl1'], ['Pajak_GU_SPM'], 'Pajakguspm.xls', 'Excel')">
                            <i class="fa fa-enter" ></i>Excel
                        </button>
                    </div>
                </div>
            
                <br>

                <div class="row">
                    <div class="col-1 text-center">
                        <img src="{{ URL::asset('app/assets/images/Palu.png')}}" style="margin-top: 15px; text-align: center; width: 70px; right: 50px;" alt="" />
                    </div>
                    <div class="col-10 align-middle fw-bold text-center text-uppercase" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                        PEMERINTAH KOTA PALU <br>
                        REKAPITULASI PENYETORAN PAJAK GU <br>
                        TAHUN ANGGARAN 2025<br>
                    </div>
                    <div class="col-1">
                    </div>
                </div>


                <div class="">
                        <div class="">
                            <div class="row">
                                
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body table-responsive">
                                            <table id="tbl1" class="display table table-bordered" style="width:100%">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama OPD</th>
                                                        <th>Nomor SPM</th>
                                                        <th>Tanggal TBP</th>
                                                        <th>Nomor TBP</th>
                                                        <th>Nilai TBP</th>
                                                        <th>Jenis Pajak</th>
                                                        <th>Nilai Pajak</th>
                                                        <th>Ket</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $total = 0; @endphp
                                                    @php $no = 1; @endphp
                                                    @foreach ($datapajakguspm as $d )
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $d->nama_skpd }}</td>
                                                            <td>{{ $d->no_spm }}</td>
                                                            <td>{{ $d->tanggal_tbp }}</td>
                                                            <td>{{ $d->nomor_tbp }}</td>
                                                            <td>{{ number_format($d->nilai_tbp) }}</td>
                                                            <td>{{ $d->nama_pajak_potongan }}</td>
                                                            <td>{{ number_format($d->nilai_tbp_pajak_potongan) }}</td>
                                                            <td>{{ $d->status1 }}</td>

                                                        </tr>
                                                        
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="text-align: right">Total Pajak</th>
                                            
                                                        <td style="text-align: right"> {{ number_format($total = $datapajakguspm->sum('nilai_tbp_pajak_potongan'), 0) }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            <br><br>
                                            <div class="row">
                                                <div class="col-2 text-center">
                                                </div>
                                                <div class="col-4">
                                                </div>
                                                <div class="col-6 align-middle fw-bold text-center" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                                                    Palu, {{ now()->format('d M Y') }}<br>
                                                    PENGGUNA ANGGARAN<br><br><br><br><br><br>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
        </div>
        </form>
        {{-- ################################# Modal ################################### --}}
        

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}
        <script>
        $(document).ready(function(){
                $("#cetakpdfguspm").click(function(e){
                    var periode = $('#periode').val();
                    var akun_pajak = $("#akun_pajak").val();
                    var status2 = $("#status2").val();
                    var nama_skpd = $("#nama_skpd").val();
                    // alert( nama_skpd + "" + periode + "" + akun_pajak + "" + status2);
                    params = "?page=laporan&nama_skpd=" + nama_skpd + "&periode=" + periode + "&akun_pajak=" + akun_pajak + "&status2=" + status2
                    window.open("/laporanpajakgu-cetak"+params,"_blank");
                });
            });

        $(document).ready(function(){
            $("#cetakexcelspmgu").click(function(e){
                var nama_pajak_potongan = $("#nama_pajak_potongan").val();
                var status1 = $("#status1").val();
                var nama_skpd = $("#nama_skpd").val();
                // alert( nama_skpd + "" + periode + "" + akun_pajak + "" + status2);
                params = "?page=downloadexcel&nama_skpd=" + nama_skpd + "&nama_pajak_potongan=" + nama_pajak_potongan + "&status1=" + status1
                window.open("/laporan.downloadlaporanexcel"+params,"_blank");
            });
        });
        </script>
        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        {{-- @include('Template.Script') --}}

        

    </body>
</html>
