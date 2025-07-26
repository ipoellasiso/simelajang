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
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onclick="text1(1)">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                Rekapitulasi Penyetoran Pajak GU
                                                                </label>
                                                            </div>
                                                            
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
                                                        <div id="forminput2d">
                                                            <label>Pilih OPD2</label>
                                                            <select class="form-select" name="nama_skpd24" id="nama_skpd24" value="" required>
                                                                {{-- <option value="">Pilih Semua</option> --}}
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div id="forminput1b">
                                                            <label>Pilih Bulan</label>
                                                            <select class="form-select" name="periode" id="periode" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Jan">Jan</option>
                                                                <option value="Feb">Feb</option>
                                                                <option value="Mar">Mar</option>
                                                                <option value="Apr">Apr</option>
                                                                <option value="May">May</option>
                                                                <option value="Jun">Jun</option>
                                                                <option value="Jul">Jul</option>
                                                                <option value="Aug">Aug</option>
                                                                <option value="Sep">Sep</option>
                                                                <option value="Oct">Oct</option>
                                                                <option value="Nov">Nov</option>
                                                                <option value="Des">Des</option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput2b">
                                                            <label>Pilih Bulan 2</label>
                                                            <select class="form-select" name="periode2" id="periode2" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Jan">Jan</option>
                                                                <option value="Feb">Feb</option>
                                                                <option value="Mar">Mar</option>
                                                                <option value="Apr">Apr</option>
                                                                <option value="May">May</option>
                                                                <option value="Jun">Jun</option>
                                                                <option value="Jul">Jul</option>
                                                                <option value="Aug">Aug</option>
                                                                <option value="Sep">Sep</option>
                                                                <option value="Oct">Oct</option>
                                                                <option value="Nov">Nov</option>
                                                                <option value="Des">Des</option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput3b">
                                                            <label>Pilih Bulan 3</label>
                                                            <select class="form-select" name="periode3" id="periode3" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Jan">Jan</option>
                                                                <option value="Feb">Feb</option>
                                                                <option value="Mar">Mar</option>
                                                                <option value="Apr">Apr</option>
                                                                <option value="May">May</option>
                                                                <option value="Jun">Jun</option>
                                                                <option value="Jul">Jul</option>
                                                                <option value="Aug">Aug</option>
                                                                <option value="Sep">Sep</option>
                                                                <option value="Oct">Oct</option>
                                                                <option value="Nov">Nov</option>
                                                                <option value="Des">Des</option>
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
                                                                <option value="411618">411618</option>
                                                                <option value="411619">411619</option>
                                                                <option value="411212">411212</option>
                                                                <option value="411222">411222</option>
                                                            </select>
                                                        </div>
                                                        {{-- <br> --}}
                                                        {{-- <div id="forminput1c">
                                                            <label>Pilih Akun Pajak</label>
                                                            <select class="form-select" name="akun_pajak" id="akun_pajak" value="" required>
                                                                <option value="">Pilih Semua</option>
                                                                <option value="411211">411211</option>
                                                                <option value="411121">411121</option>
                                                                <option value="411122">411122</option>
                                                                <option value="411124">411124</option>
                                                                <option value="411128">411128</option>
                                                            </select>
                                                        </div> --}}
                                                        <div id="forminput1e"><br>
                                                            <label>Pilih Status</label>
                                                            <select class="form-select" name="status2" id="status2" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Terima">Terima</option>
                                                                <option value="Tolak">Tolak</option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput2e">
                                                            <label>Pilih Status2</label>
                                                            <select class="form-select" name="status22" id="status22" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Terima">Terima</option>
                                                                <option value="Tolak">Tolak</option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput3e">
                                                            <label>Pilih Status3</label>
                                                            <select class="form-select" name="status23" id="status23" value="" required>
                                                                {{-- <option value=""></option> --}}
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Terima">Terima</option>
                                                                <option value="Tolak">Tolak</option>
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
                                                        <button type="submit" id="tcari3" class="btn btn-outline-primary m-b-xs caribarurekap_per_opd">
                                                            <i class="fa fa-enter"></i>Cari 3
                                                        </button>
                                                        <button type="submit" id="treset1" class="btn btn-outline-danger m-b-xs resetbaru">
                                                            <i class="fa fa-enter"></i>Reset
                                                        </button>
                                                        <button type="submit" id="treset2" class="btn btn-outline-danger m-b-xs resetbaru2">
                                                            <i class="fa fa-enter"></i>Reset 2
                                                        </button>
                                                        <button type="submit" id="treset3" class="btn btn-outline-danger m-b-xs resetbaru3">
                                                            <i class="fa fa-enter"></i>Reset 3
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
                                <div class="card-body tampillaporangu1 tampillaporangu1rekapsemuaopd tampillaporangu1rekap tampillaporangu1rekap2">
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Fungsi ################################### --}}
    
        @include('Laporan_GU.Fungsi.Fungsi')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

    </body>
</html>