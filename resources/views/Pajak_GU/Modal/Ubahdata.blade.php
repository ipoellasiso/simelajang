<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
    </head>
    <body>
        <!-- <div class='loader'>
            @include('Template.Loading')
        </div> -->

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
                            {{-- ## start ## --}}
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row">
                                        <h4 class="card-title">{{ $title }}</h4>
                                        {{-- <a class="btn btn-secondary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createPajakls" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a> --}}
                                    </div>
                                    {{-- class="m-t-25" --}}
                                    <div class="modal-body">
                                    <form method="POST" action="/pajakgu/update/{{ $dtpajakgu->id }}" enctype="multipart/form-data">
                                    @csrf
                                        <div class="modal-body">
                                            <input type="text" name="id" value="{{ $dtpajakgu->id }}">
                                            <input type="text" name="id_potonganls" value="{{ $dtpajakgu->id_potonganls }}">
                                            <input type="hidden" name="id_opd" value="{{ $dtpajakgu->id_opd }}">
                                            {{-- <input type="text" name="id_potongan2" id="id_potongan2"> --}}
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col mb-5">
                                                        {{-- <label>Pilih Pajak</label>
                                                        <button class="btn btn-tone btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" data-dismiss="modal">
                                                            <i class="anticon anticon-sync"></i>
                                                        </button> --}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-5">
                                                        <label>Nama NPWP</label>
                                                        <input type="text" class="form-control" name="nama_npwp" id="nama_npwp" value="{{ $dtpajakgu->nama_npwp }}" placeholder="" required>
                                                    </div>
                                                    <div class="col mb-5">
                                                        <label>Nomor NPWP</label>
                                                        <input type="text" class="form-control" name="nomor_npwp" id="nomor_npwp" value="{{ $dtpajakgu->nomor_npwp }}" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-5">
                                                        <label for="akun_pajak">Akun Pajak</label>
                                                            <select class="form-select" id="akun_pajak6" name="akun_pajak">
                                                                <option value="{{ $dtpajakgu->akun_pajak }}">{{ $dtpajakgu->akun_pajak }}</option>
                                                            </select>
                                                        
                                                        <!-- <label for="akun_pajak">Akun Pajak:</label>
                                                        <select class="select2" id="akun_pajak" name="akun_pajak">
                                                            <option value="0">Pilih Akun Pajak</option>
                                                            <option value="1">411211</option>
                                                            <option value="2">411121</option>
                                                            <option value="3">411122</option>
                                                            <option value="4">411124</option>
                                                            <option value="5">411128</option> -->
                                                        <!-- </select> -->
                                                    </div>
                                                    <div class="col mb-5">
                                                        <label>Jenis Pajak:</label>
                                                        <select class="form-select" id="nama_pajak_potongan5" name="jenis_pajak">
                                                            <option value="{{ $dtpajakgu->jenis_pajak }}">{{ $dtpajakgu->jenis_pajak }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-5">
                                                        <label>Ebilling</label>
                                                        <input type="text" class="form-control" name="ebilling" id="ebilling" value="{{ $dtpajakgu->ebilling }}" placeholder="" required>
                                                    </div>
                                                    <div class="col mb-5">
                                                        <label>Rekening Belanja</label>
                                                        <input type="text" class="form-control" name="rek_belanja" id="rek_belanja" value="{{ $dtpajakgu->rek_belanja }}" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-5">
                                                        <label>NTPN</label>
                                                        <input type="text" class="form-control" name="ntpn" id="ntpn" value="{{ $dtpajakgu->ntpn }}" placeholder="" required>
                                                    </div>
                                                    <div class="col mb-5">
                                                        <label>Nilai Pajak</label>
                                                        <input type="text" class="form-control amount" name="nilai_pajak" id="nilai_pajak" value="{{ $dtpajakgu->nilai_pajak }}" placeholder="" required>
                                                    </div>
                                                    <div class="col">
                                                        <label>Bulan</label>
                                                        <select class="form-select" name="periode" id="periode" value="">
                                                            <option value="{{ $dtpajakgu->periode }}">{{ $dtpajakgu->periode }}</option>
                                                            <option value="Jan">Jan</option>
                                                            <option value="Feb">Feb</option>
                                                            <option value="Mar">Mar</option>
                                                            <option value="Apr">Apr</option>
                                                            <option value="Mei">Mei</option>
                                                            <option value="Jun">Jun</option>
                                                            <option value="Jul">Jul</option>
                                                            <option value="Agu">Agu</option>
                                                            <option value="Sep">Sep</option>
                                                            <option value="Okt">Okt</option>
                                                            <option value="Nov">Nov</option>
                                                            <option value="Des">Des</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <label>Upload Foto</label>
                                                        <input type="file" class="form-control" name="bukti_pemby" id="bukti_pemby" value="{{ $dtpajakgu->bukti_pemby }}" accept="image/*" onchange="readURL(this);">
                                                        <input type="hidden" name="hidden_image" id="hidden_image">
                                                        <small>Upload Foto Harus Format JPG,JPEG / PNS dan Max File 5MB </small>
                                                    </div>
                                                    <div class="col">
                                                        <img id="modal-preview5" src="https://via/placeholder.com/150" alt="Preview" class="form-group hidden" width="450" height="250">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/tampilpajakgu" type="button" class="btn btn-outline-danger m-b-xs" data-dismiss="modal">
                                                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                                            </a>
                                            <button type="submit" class="btn btn-outline-primary m-b-xs">
                                                <i class="fa fa-save"></i>  Simpan
                                            </button>
                        
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
        
        @include('Pajak_GU.Modal.Terima')
        @include('Pajak_GU.Modal.Tolak')
        @include('Pajak_GU.Modal.Tambah')
        @include('Pajak_GU.Modal.Datapajakls')

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Pajak_GU.Fungsi.Fungsi')
        @include('Pajak_GU.Fungsi.Fungsipajaklssipd')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>