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
                                        <label>Pilih OPD</label>
                                        <select class="form-select" name="id_opd" id="opd" value="">
                                            <option value=""></option>
                                            <!-- <option value="1">Dinas Pendidikan dan Kebudayaan</option>
                                            <option value="2">Dinas Kesehatan</option>
                                            <option value="3">Dinas Pekerjaan Umum</option> -->
                                        </select>
                                    </div>
                                    <div class="col mb-4">
                                        <label>Konfirmasi OPD</label>
                                        <select class="form-select" name="nama_opd1" id="namaopd2" value="">
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
                                    <div class="col mb-4">
                                        <label>NIP</label>
                                        <input type="text" class="form-control" name="nip" id="nip" value="" placeholder="nip ...." required>
                                    </div>
                                    <div class="col mb-4">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat" value="" placeholder="alamat ...." required>
                                    </div>
                                    <div class="col mb-4">
                                        <label>Nomor Hp</label>
                                        <input type="text" class="form-control" name="no_hp" id="no_hp" value="" placeholder="no_hp ...." required>
                                    </div>
                                    <div class="col mb-4">
                                        <label>Hobi</label>
                                        <input type="text" class="form-control" name="hobi" id="hobi" value="" placeholder="hobi ...." required>
                                    </div>
                                    <div class="col mb-4">
                                        <label>Nama PA / KPA</label>
                                        <input type="text" class="form-control" name="nama_pa_kpa" id="nama_pa_kpa" value="" placeholder="nama_pa_kpa ...." required>
                                    </div>
                                    <div class="col mb-4">
                                        <label>Nip PA / KPA</label>
                                        <input type="text" class="form-control" name="nip_pa_kpa" id="nip_pa_kpa" value="" placeholder="nip_pa_kpa ...." required>
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
                            <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary m-b-xs">
                                <i class="fa fa-save"></i>  Simpan
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>


