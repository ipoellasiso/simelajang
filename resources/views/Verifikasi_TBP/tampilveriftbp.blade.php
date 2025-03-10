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
                                <div class="card-body">
                                    <div class="d-flex flex-row">
                                        <h4 class="card-title">{{ $title }}</h4>
                                    </div>
                            
                                    <div class="table-responsive">
                                        <table id="zero-conf" class="datatableveriftbp display table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama OPD</th>
                                                    <th>Nomor TBP</th>
                                                    <th>Tanggal TBP</th>
                                                    <th>Nilai TBP</th>
                                                    <th>Nomor NPD</th>
                                                    {{-- <th>Nomor SPM</th> --}}
                                                    {{-- <th>Tanggal SPM</th> --}}
                                                    {{-- <th>Nomor SP2D</th> --}}
                                                    <!-- <th width="100px">Keterangan TBP</th> -->
                                                    <th></th>
                                                    <th></th>
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
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        
        @include('Verifikasi_TBP.Modal.Terima')
        @include('Verifikasi_TBP.Modal.Tolak')

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Verifikasi_TBP.Fungsi.Fungsiveriftbp')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>