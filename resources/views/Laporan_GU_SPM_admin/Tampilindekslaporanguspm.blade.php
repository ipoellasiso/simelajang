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
                                                                Rincian Penyetoran Pajak GU
                                                                </label>
                                                            </div>
                                                            <br>
                                                            <!-- <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onclick="text1(1)">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                Rekapitulasi Penyetoran Pajak GU
                                                                </label>
                                                            </div> -->
                                                            
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-floating" id="pilihrekap">
                                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                              <option selected>Pilih</option>
                                                              <option value="1" onclick="pilih(0)">Semua OPD</option>
                                                              <option value="2" onclick="pilih(1)">Per OPD</option>
                                                            </select>
                                                            <label for="floatingSelect">Cari Berdasarkan Rekapitulasi Penyetoran Pajak</label>
                                                        </div>

                                                        <div class="text-center" id="forminput1a">
                                                            <label>Cari Berdasarkan Rincian Penyetoran Pajak</label>
                                                        </div>
                                                        {{-- === form input rekapitulasi penyetoran pajak === --}}
                                                        <div class="text-center" id="forminput2a">
                                                            {{-- <label>Cari Berdasarkan Rekapitulasi Penyetoran Pajak</label> --}}
                                                        </div>
                                                        <br>
                                                        <div id="forminput1d">
                                                            <label>Pilih OPD</label>
                                                            <select class="form-select" name="nama_skpd" id="nama_skpd" value="" required>
                                                                <option value="">Pilih Semua</option>
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div id="forminput1c">
                                                            <label>Pilih Jenis Pajak</label>
                                                            <select class="form-select" name="nama_pajak_potongan" id="nama_pajak_potongan" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="411211">Pajak Pertambahan Nilai</option>
                                                                <option value="411121">PPh 21</option>
                                                                <option value="411122">Pajak Penghasilan PS 22</option>
                                                                <option value="411124">Pajak Penghasilan PS 23</option>
                                                                <option value="411128">Pajak Penghasilan PS 24</option>
                                                                <option value="411128">(Pajak Pertambahan Nilai, PPh21, Pajak Penghasilan PS 22,23, dan 24)</option>
                                                            </select>
                                                        </div>
                                                        {{-- <br> --}}
                                                        <div id="forminput1e"><br>
                                                            <label>Pilih Status</label>
                                                            <select class="form-select" name="status1" id="status1" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Terima">Terima</option>
                                                                <option value="Tolak">Belum_Verifikasi</option>
                                                            </select>
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
                                                            <i class="fa fa-enter"></i>Cari
                                                        </button>
                                                        <button type="submit" id="tcari2" class="btn btn-outline-primary m-b-xs caribarurekapsemuaopd">
                                                            <i class="fa fa-enter"></i>Cari 2
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
                                <div class="card-body tampillaporanguspm1">
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Fungsi ################################### --}}
    
        @include('Laporan_GU_SPM_admin.Fungsi.Fungsi')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

    </body>
</html>