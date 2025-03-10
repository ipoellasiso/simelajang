<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
    </head>
    <body>
        <div class='loader'>
            @include('Template.Loading')
        </div>

        <div class="page-container">
            @include('Template.Navbar')
            @include('Template.Sidebar')
            
            {{-- ######################### Isi Tampil Pajak LS ########################## --}}
            <div class="page-content">
                <div class="main-wrapper">

                    <div class="row">
                        <nav class="breadcrumb breadcrumb-dash">
                            <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ $page_title }}</a>
                            <a class="breadcrumb-item" href="#">{{ $breadcumd1 }}</a>
                            <span class="breadcrumb-item active">{{ $breadcumd2 }}</span>
                        </nav>
                        
                        <div class="col">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <div class="row mb-5">
                                        <div class="col-8">
                                            <h5 class="card-title">{{ $title }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <div class="float-end">
                                                <a href="/tampilbpjs" type="button" class="btn btn-outline-danger m-b-xs" data-dismiss="modal">
                                                    <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td><strong>E-Billing</strong></td>
                                                        <td><strong>:  {{ $dtrincianbpjs->ebilling }}</strong> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>NTPN</strong></td>
                                                        <td><strong>:  {{ $dtrincianbpjs->ntpn }}</strong> </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td><strong>Akun Potongan</strong></td>
                                                        <td><strong>:  {{ $dtrincianbpjs->akun_potongan }}</strong> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Nilai Potongan</strong></td>
                                                        <td><strong>: Rp. {{ number_format($dtrincianbpjs->nilai_potongan) }}</strong> </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <hr/>
                                        <font style="font-size: 11pt;font-weight: ;"><center>Rincian Potongan</center></font>
                                    <hr/>
                                    <table class="display table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Nomor SPM</th>
                                                <th>Tanggal SP2D</th>
                                                <th>Nomor SP2d</th>
                                                <th>Nilai SP2D</th>
                                                <th>Jenis Potongan</th>
                                                <th>Akun Potongan</th>
                                                <th>Nilai Potongan</th>
                                            </tr>
                                        
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @foreach ($dtbpjs as $d)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $d->nomor_spm }}</td>
                                                        <td>{{ $d->tanggal_sp2d }}</td>
                                                        <td>{{ $d->nomor_sp2d }}</td>
                                                        <td>{{ number_format($d->nilai_sp2d) }}</td>
                                                        <td>{{ $d->jenis_pajak }}</td>
                                                        <td>{{ $d->akun_potongan }}</td>
                                                        <td>{{ number_format($d->nilai_potongan) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="7" align="right"><strong>Total Potongan</strong></td>
                                                    <td colspan="2"><strong>{{ number_format($dtrincianbpjs->nilai_potongan) }} </strong></td>
                                                </tr>
                                            </tbody>
                                            
                                        </thead>
                                    </table>

                                    
                                    <div class="row">
                                        <div class="card">
                                            <div class="card-body">
                                                <hr/>
                                                <font style="font-size: 11pt;font-weight: ;"><center>Bukti Pembayaran</center></font>
                                                <hr/>
                                                <img class="card-img-top" src="/app/assets/images/bukti_pemby_potongan/{{ $dtrincianbpjs->bukti_pemby }}" width="100" height="600" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        
        @include('Bpjs.Modal.Tambah')
        @include('Bpjs.Modal.Databpjs')
        @include('Bpjs.Modal.Terima')
        @include('Bpjs.Modal.Tolak')

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Bpjs.Fungsi.Fungsi')
        @include('Bpjs.Fungsi.Fungsibpjssipd')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>