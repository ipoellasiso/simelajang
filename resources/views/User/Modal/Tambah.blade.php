<div class="modal fade" id="tambahuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
  
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
            <form id="userForm" name="userForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <!-- <div class="row"> -->
                                <!-- <div class="row"> -->
                                    <div class="col mb-4">
                                        <label>OPD</label>
                                        <select class="form-select" name="id_opd" id="opd" value="">
                                            <option value=""></option>
                                            <!-- <option value="1">Dinas Pendidikan dan Kebudayaan</option>
                                            <option value="2">Dinas Kesehatan</option>
                                            <option value="3">Dinas Pekerjaan Umum</option> -->
                                        </select>
                                    </div>
                                    <div class="col mb-4">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname" value="" placeholder="Nama Lengkap ...." required>
                                    </div>
                                {{-- </div> --}}
                                {{-- <div class="col-12"> --}}
                                    <div class="col mb-4">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" id="email" value="" placeholder="Email ...." required>
                                    </div>
                                {{-- </div> --}}
                                {{-- <div class="col-12"> --}}
                                    <div class="col mb-4">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" id="password" value="" placeholder="Password ....">
                                    </div>
                                {{-- </div> --}}
                                {{-- <div class="col-12"> --}}
                                    <div class="col mb-4">
                                        <label>Role</label>
                                        <select class="form-control" name="role" id="role" value="" required>
                                            <option value="" hidden>-- Pilih role --</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                            <option value="Verifikasi">Verifikasi</option>
                                            <option value="Pegawai">Pegawai</option>
                                        </select>
                                    </div>
                                {{-- </div> --}}
                                {{-- <div class="col-12"> --}}
                                    <div class="col mb-4">
                                        <label>Upload Foto</label>
                                        <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" onchange="readURL(this);">
                                        <input type="hidden" name="hidden_image" id="hidden_image">
                                        <small>Upload Foto Harus Format JPG,JPEG / PNS dan Max File 5MB </small>
                                    </div>
                                    <div class="col mb-4">
                                        <img id="modal-preview" src="https://via/placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100">
                                    </div>
                                <!-- </div> -->
                            <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger m-b-xs" data-bs-dismiss="modal">
                                <i class="fas fa-times-circle"></i> Close
                            </button>
                            <button type="submit" id="saveBtn" value="create" class="btn btn-outline-danger m-b-xs">
                                <i class="fa fa-save"></i>  Simpan
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>


