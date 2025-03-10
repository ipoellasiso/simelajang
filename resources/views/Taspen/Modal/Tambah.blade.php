<div class="modal fade bd-example-modal-xl" id="tambahbpjs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-xl">
  
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
              <div class="modal-body">
                    <form id="userFormbpjs" name="userFormbpjs" method="POST" action="/dtbpjs/store" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id5">
                            <input type="hidden" name="kode_pot" id="kode_pot5">
                            {{-- <input type="text" class="amount" id="detail_cart"> --}}
                            <div class="row">
                                <div class="row mb-4">
                                    <div class="col">
                                        
                                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editBpjssipd" data-bs-dismiss="modal">
                                        <i data-feather="search"></i>Tambah Potongan Dari SIPD RI
                                        </button>
                                        {{-- <label><= Tambah Potongan Dari SIPD RI</label> --}}
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <table id="tabelcartbpjs" class="display table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal SP2D</th>
                                                    <th>Nomor SP2D</th>
                                                    <th>Nilai SP2D</th>
                                                    <th>Jenis Potongan</th>
                                                    <th>Nilai Potongan</th>
                                                    {{-- <th>qty</th>
                                                    <th>Jumlah</th> --}}
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            {{-- <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Total Potongan</th>
                                                    <th id="detail_cart"></th>
                                                </tr>
                                            </tfoot> --}}
                                            <tbody id="detail_cart">
                                                
                                            </tbody>

                                        </table>
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
                                        <input type="text" class="form-control" name="akun_potongan" id="akun_potongan" value="" placeholder="" required>
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

