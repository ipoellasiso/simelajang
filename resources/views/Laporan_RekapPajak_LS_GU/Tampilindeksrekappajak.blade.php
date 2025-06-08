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
                                        </div>
                                    </div>

                                    {{-- isi --}}
                                    <div class="modal-body">
                                        <form method="get" action="">
                                        {{-- @method('get') --}}
                                        @csrf
                                            <div class="row">
                                                <div class="row mb-4" id="formcheck">
                                                    <div class="col-4">
                                                        <label>Filter Berdasarkan</label>
                                                        
                                                            <div class="form-check">
                                                                <br>
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" onclick="text1(0)">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                Rekapitulasi Penyetoran Pajak LS dan GU
                                                                </label>
                                                            </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-center" id="forminput1a">
                                                            <label>Cari Berdasarkan Rekapitulasi Penyetoran Pajak LS dan GU</label>
                                                        </div>
                                                        {{-- === form input rekapitulasi penyetoran pajak === --}}
                                                        <div class="text-center" id="forminput2a">
                                                            {{-- <label>Cari Berdasarkan Rekapitulasi Penyetoran Pajak</label> --}}
                                                        </div>
                                                        <br>
                                                        <div id="forminput1d">
                                                            <label>Tanggal Awal</label>
                                                            <input type="date" class="form-select" name="tgl_awal" id="tgl_awal" value="" required>
                                                            </input>
                                                        </div>
                                                        <br>
                                                        <div id="forminput2d">
                                                            <label>Tanggal Akhir</label>
                                                            <input type="date" class="form-select" name="tgl_akhir" id="tgl_akhir" value="" required>
                                                            </input>
                                                        </div>
                                                        <br>
                                                        <div id="forminput1b">
                                                            <label>Pilih OPD2</label>
                                                            <select class="form-select" name="nama_skpd24" id="nama_skpd24" value="" required>
                                                                <option value="">Pilih Semua</option>
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div id="forminput1c">
                                                            <label>Pilih Akun Pajak</label>
                                                            <select class="form-select" name="akun_pajak" id="akun_pajak" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="411211">411211</option>
                                                                <option value="411121">411121</option>
                                                                <option value="411122">411122</option>
                                                                <option value="411124">411124</option>
                                                                <option value="411128">411128</option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput1e"><br>
                                                            
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div class="col-2">
                                                    </div>
                                                    
                                                </div>

                                                <div class="row mb-4" id="formbutton">
                                                    <div class="col-4">
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <button type="submit" id="tcari1" class="btn btn-outline-primary m-b-xs caribaru">
                                                            <i class="fa fa-enter"></i>Terapkan
                                                        </button>
                                                        <button type="submit" id="treset1" class="btn btn-outline-danger m-b-xs resetbaru">
                                                            <i class="fa fa-enter"></i>Reset
                                                        </button>
                                                    </div>
                                                    <div class="col-2">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body tampillaporanrekappajak">
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Fungsi ################################### --}}
    
        @include('Laporan_RekapPajak_LS_GU.Fungsi.Fungsi')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

    </body>
</html>