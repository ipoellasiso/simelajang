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
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="/datataspen/create" id="createTaspenoff" data-toggle="tooltip" data-placement="top" title="klik"> Tambah </a>
                                                    <a class="dropdown-item" href="javascript:void(0)" id="uploadTaspen" data-toggle="tooltip" data-placement="top" title="klik"> Upload </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="tabelbpjs" class="display table table-hover" style="width:100%">
                                        <thead>
                                            <!-- <tr>
                                                <th rowspan="2">NO</th>
                                                <th class="text-center" colspan ="4">SP2D</th>
                                                <th class="text-center" colspan="5">POTONGAN</th>
                                                <th class="text-center" colspan="2">KETERANGAN</th>
                                            </tr> -->
                                            <tr>
                                                <th>NO</th>
                                                <th>Akun Potongan</th>
                                                <th>Nilai Potongan</th>
                                                <th>E-Biling</th>
                                                <th>NTPN</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
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
                                        <p>Iuran Jaminan Kesehatan 4 %<span>{{ number_format($total_4) }}</span></p>
                                        <p>Iuran Jaminan Kesehatan 1 %<span>{{ number_format($total_1) }}</span></p>
                                        <p class="bold">Total Pajak <span>{{ number_format($total_potongan) }}</span></p>
                                        {{-- <input type="text" class="amount" id="totalnp"> --}}
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
        @include('Taspen.Modal.Tambah')
        @include('Taspen.Modal.DataTaspen')

        {{-- @include('Bpjs.Modal.Tambah')
        @include('Bpjs.Modal.Databpjs')
        @include('Bpjs.Modal.Terima')
        @include('Bpjs.Modal.Tolak')
        @include('Bpjs.Modal.Ubah')
        @include('Bpjs.Modal.Databpjsedit') --}}

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}
        @include('Taspen.Fungsi.Fungsi')

        {{-- @include('Bpjs.Fungsi.Fungsi') --}}
        {{-- @include('Bpjs.Fungsi.Fungsibpjssipd')
        @include('Bpjs.Fungsi.Fungsibpjssipdedit') --}}

        {{-- ############################## Batas Fungsi ################################ --}}
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>