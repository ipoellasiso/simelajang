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
                                                    <a class="dropdown-item" href="javascript:void(0)" id="createPajakls" data-toggle="tooltip" data-placement="top" title="klik"> Tambah </a>
                                                    <a class="dropdown-item" href="javascript:void(0)" id="uploadPajakls" data-toggle="tooltip" data-placement="top" title="klik"> Upload </a>
                                                </ul> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="zero-conf" class="tabelpajakgubeluminput table table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 1%;" class="text-center">No</th>
                                                    <!-- <th></th> -->
                                                    <th style="width: 17%;">Nomor SPM</th>
                                                    <th style="width: 5%;">Tanggal SP2D</th>
                                                    <th style="width: 17%;">Nomor SP2D</th>
                                                    <th style="width: 25%;">Keterangan</th>
                                                    <th style="width: 7%;">Nilai SP2D</th>
                                                    <th style="width: 8%;">Jenis Pajak</th>
                                                    <th class="text-right" style="width: 7%;">Nilai Pajak</th>
                                                    <th class="text-right" style="width: 8%;">E-Biling</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- datatable ajax --}}
                                            </tbody>
                                        </table>
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
        
        {{-- @include('Pajak_GU.Modal.Terima') --}}
        {{-- @include('Pajak_GU.Modal.Tolak') --}}
        {{-- @include('Pajak_GU.Modal.Tambah') --}}
        {{-- @include('Pajak_GU.Modal.Datapajakls') --}}

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Pajak_GU.Fungsi.Fungsi')
        @include('Pajak_GU.Fungsi.Fungsipajaklssipd')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>