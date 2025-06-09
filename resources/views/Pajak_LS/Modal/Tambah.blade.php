<div class="modal fade bd-example-modal-xl" id="tambahpajakls" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-xl">
  
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
              <div class="modal-body">
                    <form id="userForm" name="userForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="text" name="id" id="id5">
                            <input type="text" name="id_potonganls" id="id_potonganls5">
                            <div class="row">
                                <div class="row mb-4">
                                    <div class="col">
                                        
                                        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editpajaklssipd" data-bs-dismiss="modal">
                                        <i data-feather="search"></i>
                                        </button>
                                        <label><<=== Pilih Pajak dari SIPD RI</label>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label>Nama NPWP</label>
                                        <input type="text" class="form-control" name="nama_npwp" id="nama_npwp" value="" placeholder="" required>
                                    </div>
                                    <div class="col">
                                        <label>Nomor NPWP</label>
                                        <input type="text" class="form-control" name="nomor_npwp" id="nomor_npwp" value="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="akun_pajak">Akun Pajak</label>
                                            <select class="form-select" id="akun_pajak" name="akun_pajak" required>
                                                    <option value=""></option> 
                                            </select>
                                    </div>
                                    <div class="col">
                                        <label>Jenis Pajak:</label>
                                        <input class="form-control" id="jenis_pajak" name="jenis_pajak" readonly>
                                            {{-- <option value="{{ $jenispajak1->jenis_pajak }}"></option> --}}
                                        </input>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label>Ebilling</label>
                                        <input type="text" class="form-control" name="ebilling" id="ebillingg" value="" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label>Rekening Belanja</label>
                                        <input type="text" class="form-control" name="rek_belanja" id="rek_belanja" value="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label>NTPN</label>
                                        <input type="text" class="form-control" name="ntpn" id="ntpn" value="" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label>Nilai Pajak</label>
                                        <input type="text" class="form-control amount" name="nilai_pajak" id="nilai_pajak" value="" placeholder="" required>
                                    </div>
                                    <div class="col">
                                        <label>Nomor Daftar Penguji</label>
                                        <input type="text" class="form-control" name="no_penguji" id="no_penguji" value="" placeholder="">
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

