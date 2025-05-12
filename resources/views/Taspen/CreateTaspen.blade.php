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
                                <div class="modal-body">
                                    <form id="userFormtaspen" name="userFormtaspen" method="POST" action="/dtbpjs/store" enctype="multipart/form-data">
                                        @csrf
                                        <br><br>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" id="id5">
                                            <input type="hidden" name="kode_pot" id="kode_pot5">
                                            {{-- <input type="text" class="amount" id="detail_cart"> --}}
                                            <div class="row">
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        
                                                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editTaspensipd" data-bs-dismiss="modal">
                                                        <i data-feather="search"></i>Tambah Potongan Dari SIPD RI
                                                        </button>
                                                        {{-- <label><= Tambah Potongan Dari SIPD RI</label> --}}
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <table id="tblTampil" class="display table table-hover" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Tanggal SP2D</th>
                                                                    <th>Nomor SP2D</th>
                                                                    <th>Nilai SP2D</th>
                                                                    <th>Jenis Potongan</th>
                                                                    <th>Nilai Potongan</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="detail_cart">
                                                                
                                                            </tbody>
                                                            
                                                        </table>

                                                        {{-- <div class="row invoice-last"> --}}
                                                            {{-- <div id="detail_cart" class="col-9"> --}}
                                                            {{-- </div> --}}
                                                            {{-- <div class="col-3"> --}}
                                                                {{-- <div class="invoice-info"> --}}
                                                                {{-- </div> --}}
                                                            {{-- </div> --}}
                                                        {{-- </div> --}}


                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label>Ebilling</label>
                                                        <input type="text" class="form-control" name="ebilling" id="ebilling" value="" placeholder="" required>
                                                    </div>
                                                    <div class="col">
                                                        <label>Rekening Belanja</label>
                                                        <input type="text" class="form-control" name="rek_belanja" id="rek_belanja" value="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label>Nama NPWP</label>
                                                        <input type="text" class="form-control" name="nama_npwp" id="no_rek_pihak_ketiga5" value="" placeholder="" required>
                                                    </div>
                                                    <div class="col">
                                                        <label>Nomor NPWP</label>
                                                        <input type="text" class="form-control" name="nomor_npwp" id="npwp_pihak_ketiga5" value="" placeholder="" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label>NTPN</label>
                                                        <input type="text" class="form-control" name="ntpn" id="ntpn" value="" placeholder="" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="akun_pajak">Akun Potongan</label>
                                                        {{-- <select class="form-select" name="akun_potongan" id="akun_potongan" value="" placeholder="" required> --}}
                                                            <select class="form-select" name="akun_potongan" id="akun_potongan" style="width: 100%" required>
                                                        <option></option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                        <div class="col">
                                                            <label>Upload Foto</label>
                                                            <input type="file" class="form-control" name="bukti_pemby" id="bukti_pemby" accept="image/*" onchange="readURL(this);">
                                                            <input type="hidden" name="hidden_image" id="hidden_image">
                                                            <small>Upload Foto Harus Format JPG,JPEG / PNS dan Max File 5MB </small>
                                                        </div>
                                                        <div class="col">
                                                            <img id="modal-preview" src="https://via/placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100">
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger m-b-xs" data-bs-dismiss="modal">
                                                <i class="fas fa-times-circle"></i> Close
                                            </button>
                                            <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary m-b-xs">
                                                <i class="fa fa-save"></i>  Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        @include('Taspen.Modal.DataTaspenedit')
        {{-- @include('Taspen.Modal.DataTaspen') --}}

        {{-- @include('Bpjs.Modal.Tambah')
        @include('Bpjs.Modal.Databpjs')
        @include('Bpjs.Modal.Terima')
        @include('Bpjs.Modal.Tolak')
        @include('Bpjs.Modal.Ubah')
        @include('Bpjs.Modal.Databpjsedit') --}}

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}
        @include('Taspen.Fungsi.Fungsitaspensipdcreate')

        {{-- @include('Bpjs.Fungsi.Fungsi') --}}
        {{-- @include('Bpjs.Fungsi.Fungsibpjssipd')
        @include('Bpjs.Fungsi.Fungsibpjssipdedit') --}}

        {{-- ############################## Batas Fungsi ################################ --}}
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>