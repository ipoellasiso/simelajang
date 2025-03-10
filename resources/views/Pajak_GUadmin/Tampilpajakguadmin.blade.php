<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
    </head>
    <body>
        {{-- <div class='loader'> --}}
            {{-- @include('Template.Loading') --}}
        {{-- </div> --}}

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
                                                {{-- <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <!-- <a class="dropdown-item" href="javascript:void(0)" id="createPajakgu" data-toggle="tooltip" data-placement="top" title="klik"> Tambah </a> -->
                                                    <a class="dropdown-item" href="/datapajakgu/export" id="uploadPajakgu" data-toggle="tooltip" data-placement="top" title="klik"> Download Excel </a>
                                                </ul> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <table id="zero-conf" class="tabelpajakgu1 display table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Nama OPD</th>
                                                <th>Nomor SPM</th>
                                                <th>Tanggal SP2D</th>
                                                <th>Nomor SP2D</th>
                                                <th>Nilai SP2D</th>
                                                <th>Rek. Belanja</th>
                                                <th>Akun Pajak</th>
                                                <th>Jenis Pajak</th>
                                                <th>Nilai Pajak</th>
                                                <th>E-Biling</th>
                                                <th>NTPN</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        {{-- <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>
                                </div>
                            </div>
                            <div class="row invoice-last">
                                <div class="col-9">
                                  {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut ante id elit molestie<br>dapibus id sollicitudin vel, luctus sit amet justo</p> --}}
                                </div>
                                <div class="col-3">
                                    <div class="invoice-info">
                                        {{-- @foreach ($total as $d) --}}
                                        <p>Pajak Pertambahan Nilai <span>{{ number_format($total_ppngu) }}</span></p>
                                            <p>PPH 21<span>{{ number_format($total_pph21gu) }}</span></p>
                                            <p>Pajak Penghasilan Ps 22<span>{{ number_format($total_pph22gu) }}</span></p>
                                            <p>Pajak Penghasilan Ps 23<span>{{ number_format($total_pph23gu) }}</span></p>
                                            <p>Pajak Penghasilan Ps 24<span>{{ number_format($total_pph24gu) }}</span></p>
                                            <p class="bold">Total Pajak <span>{{ number_format($total_pajakgu) }}</span></p>
                                        {{-- @endforeach --}}
                                        <div class="d-grid gap-2">
                                          {{-- <button class="btn btn-danger m-t-xs" type="button">Print Invoice</button> --}}
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
        
        @include('Pajak_GUadmin.Modal.Terima')
        @include('Pajak_GUadmin.Modal.Tolak')
        @include('Pajak_GUadmin.Modal.Tambah')
        @include('Pajak_GUadmin.Modal.Datapajakls')
        @include('Pajak_GUadmin.Modal.AjukanTBP')

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Pajak_GUadmin.Fungsi.Fungsi')
        @include('Pajak_GUadmin.Fungsi.Fungsipajaklssipd')
        @include('Pajak_GUadmin.Fungsi.Fungsitbp')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>