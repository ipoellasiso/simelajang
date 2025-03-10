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
                                                    <a class="dropdown-item" href="javascript:void(0)" id="createOpd" data-toggle="tooltip" data-placement="top" title="klik"> Tambah </a>
                                                    <a class="dropdown-item" href="javascript:void(0)" id="uploadPajakls" data-toggle="tooltip" data-placement="top" title="klik"> Upload </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="zero-conf" class="tabelopd display table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Nama OPD</th>
                                                <th>Nama Bendahara</th>
                                                <th>Alamat</th>
                                                <th class="text-center">Action</th>
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
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        
        @include('OPD.Modal.Tambah')

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('OPD.Fungsi.Fungsi')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>