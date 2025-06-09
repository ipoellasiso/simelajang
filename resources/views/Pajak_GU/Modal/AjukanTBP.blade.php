<div class="modal fade bd-example-modal-xl" id="editpajakgusipdajukantbp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">{{ $title }}</h5>
                
                {{-- <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close" data-toggle="modal" data-target=".bd-example-modal-xl"></i>
                </button> --}}
            </div>
            <div class="modal-body">
                <div class="card">
                    {{-- <div class="card-body"> --}}
                        {{-- <div class="d-flex flex-row"> --}}
                            {{-- <h4 class="card-title">{{ $title }}</h4> --}}
                            {{-- <a class="btn btn-secondary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createPajakls" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                                <i class="fas fa-pencil-alt"></i>
                            </a> --}}
                        {{-- </div> --}}
                        <!-- <div class="m-t-25"> -->
                            
                        <form method="POST" action="{{ url('pajakgu/store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            {{-- <div class="card-body flex flex-col p-6"> --}}
                                {{-- <div class="card"> --}}
                                    <div class="row mb-4">
                                        <div class="col">
                                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editpajakgusipd" data-bs-dismiss="modal">
                                            <i data-feather="search"></i> Pilih SPM dan SP2D
                                            </button>
                                            {{-- <label><= Pilih SPM dan SP2D</label> --}}
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <input id="id_potongan2" name="id" type="hidden" class="form-control" readonly></input>
                                        <div class="col">
                                            <label for="nomor_spm" class="form-label">Nomor SPM </label>
                                            <input id="nomor_spm5" name="nomor_spm" type="text" class="form-control" required readonly></input>
                                        </div>
                                        <div class="col">
                                            <label for="nomor_sp2d" class="form-label">Nomor SP2D </label>
                                            <input id="nomor_sp2d5" name="nomor_sp2d" type="text" class="form-control" required readonly></input>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label for="nomor_rekening5" class="form-label">Rekening Belanja </label>
                                            <input id="nomor_rekening5" name="nomor_rekening" type="text" class="form-control" required ></input>
                                        </div>
                                        <div class="col">
                                            <label for="npwp5" class="form-label">Nomor NPWP </label>
                                            <input id="npwp5" name="npwp" type="text" class="form-control" required></input>
                                        </div>
                                        <div class="col">
                                            <label for="nama_npwp" class="form-label">Nama NPWP </label>
                                            <input id="nama_npwp5" name="nama_npwp" type="text" class="form-control" required></input>
                                        </div>
                                        <div class="col">
                                            <label for="nilai_tbp_pajak_potongan" class="form-label">Nilai Pajak </label>
                                            <input id="nilai_tbp_pajak_potongan5" name="nilai_tbp_pajak_potongan" type="text" class="form-control amount" required></input>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label for="akun_pajak6">Akun Pajak</label>
                                                <select class="form-select mb-4" id="akun_pajak6" name="akun_pajak" required>
                                                        <option value=""></option> 
                                                </select>
                                            <label for="ntpn5" class="form-label">NTPN </label>
                                                <input id="ntpn5" name="ntpn" type="text" class="form-control mb-4" required></input>
                                            
                                            {{-- <label>Upload Foto</label>
                                                <input type="file" class="form-control" name="bukti_pemby" id="bukti_pemby" accept="image/*" onchange="readURL(this);">
                                                <input type="hidden" name="hidden_image" id="hidden_image">
                                                <small>Upload Foto Harus Format JPG,JPEG / PNS dan Max File 5MB </small> --}}
                                        </div>
                                        <div class="col">
                                            <label for="nama_pajak_potongan">Jenis Pajak</label>
                                                <select class="form-select mb-4" id="nama_pajak_potongan5" name="nama_pajak_potongan" required>
                                                        <option value="" readonly></option> 
                                                </select>
                                            <label for="id_billing" class="form-label">E-Billing </label>
                                                <input id="id_billing5" name="id_billing" type="text" class="form-control mb-4" required></input>
                                            
                                            {{-- <img id="modal-preview5" src="https://via/placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"> --}}
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <div class="col">
                                            <label>Upload Foto</label>
                                            <input type="file" class="form-control" name="bukti_pemby" id="bukti_pemby" accept="image/*" onchange="readURL(this);">
                                            <input type="hidden" name="hidden_image" id="hidden_image">
                                            <small>Upload Foto Harus Format JPG,JPEG / PNS dan Max File 5MB </small>
                                        </div>
                                        <div class="col">
                                            <img id="modal-preview5" src="https://via/placeholder.com/150" alt="Hasil Upload Bukti" class="form-group hidden" width="200" height="150">
                                        </div>
                                    </div>
                                   
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger m-b-xs" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#tambahpajakls">
                                <i class="fas fa-times-circle"></i> Close
                            </button>
                            <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary m-b-xs">
                                <i data-feather="git-pull-request"></i>  Simpan
                            </button>
                        </div>
                        </form>
                        
                
                        <!-- <div class="table-responsive">
                            <table id="zero-confa" class="datatabletbp display table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor TBP</th>
                                        <th>Tanggal TBP</th>
                                        <th>Nilai TBP</th>
                                        <th>Keterangan TBP</th>
                                        <th>Nomor NPD</th>
                                        <th>Nomor SPM</th>
                                        <th>Tanggal SPM</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- datatable ajax --}}
                                </tbody>
                            </table>
                        </div> -->
                
                        <!-- </div> -->
                    {{-- </div> --}}
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark m-b-xs" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#tambahpajakls">
                    <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                </button>
                {{-- <button type="submit" id="saveBtn" value="create" class="btn btn-secondary">
                    <i class="fa fa-save"></i>  Simpan
                </button> --}}

            </div> -->
        </div>
    </div>
</div>