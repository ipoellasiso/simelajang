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
                                            {{-- <div class="float-end">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="javascript:void(0)" id="createPajakls" data-toggle="tooltip" data-placement="top" title="klik"> Tambah Data </a>
                                                    <a class="dropdown-item" href="/datapajak/export" data-toggle="tooltip" data-placement="top" title="klik"> Download Data </a>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    </div>

                                    {{-- isi --}}
                                    <div class="modal-body">
                                        <form method="get" target="blank" action="{{ route('cetaklaporanls') }}">
                                        {{-- @method('get') --}}
                                        @csrf
                                            <div class="row">

                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label>Filter Berdasarkan</label>
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label>Bulan</label>
                                                        <select class="form-select" name="periode" id="periode" value="">
                                                            <option value=""></option>
                                                            <option value="Januari">Januari</option>
                                                            <option value="Februari">Februari</option>
                                                            <option value="Maret">Maret</option>
                                                            <option value="April">April</option>
                                                            <option value="Mei">Mei</option>
                                                            <option value="Juni">Juni</option>
                                                            <option value="Juli">Juli</option>
                                                            <option value="Agustus">Agustus</option>
                                                            <option value="September">September</option>
                                                            <option value="Oktober">Oktober</option>
                                                            <option value="November">November</option>
                                                            <option value="Desember">Desember</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label>Akun Pajak</label>
                                                        <select class="form-select" name="akun_pajak" id="akun_pajak" value="">
                                                            <option value=""></option>
                                                            <option value="411211">411211</option>
                                                            <option value="411121">411121</option>
                                                            <option value="411122">411122</option>
                                                            <option value="411124">411124</option>
                                                            <option value="411128">411128</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        {{-- <label>Jenis Pajak</label>
                                                        <select class="form-select" name="jenis_pajak" id="jenis_pajak" value="">
                                                            <option value=""></option>
                                                            <option value="Pajak Pertambahan Nilai">Pajak Pertambahan Nilai</option>
                                                            <option value="PPh 21">PPh 21</option>
                                                            <option value="Pajak Penghasilan PS 22">Pajak Penghasilan PS 22</option>
                                                            <option value="Pajak Penghasilan PS 23">Pajak Penghasilan PS 23</option>
                                                            <option value="Pajak Penghasilan PS 24">Pajak Penghasilan PS 24</option>
                                                        </select> --}}
                                                    </div>
                                                    
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-outline-primary m-b-xs">
                                                            <i class="fa fa-enter"></i>Tampilkan
                                                        </button>
                                                        <button type="submit" class="btn btn-outline-success m-b-xs">
                                                            <i class="fa fa-enter"></i>Export Excel
                                                        </button>
                                                    </div>
                                                    <div class="col">
                                                        
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
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
        
        

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>