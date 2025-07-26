<div class="modal fade bd-example-modal-xl" id="tambahsp2dtpp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-xl">
  
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
              <div class="modal-body">
                    <form id="userForm" name="userForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            {{-- <input type="text" name="id" id="id"> --}}
                            {{-- <input type="text" name="id_sp2d" id="id_sp2d"> --}}
                            <div class="row">
                                <div class="row mb-4">
                                    <div class="col">
                                        <label>Id</label>
                                        <input type="text" class="form-control" name="id" id="id" value="" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label>Id SP2D</label>
                                        <input type="text" class="form-control" name="id_sp2d" id="id_sp2d" value="" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label>Periode</label>
                                        <select class="form-select" id="periode" name="periode" required>
                                            <option value="">Pilih Periode</option> 
                                            <option value="Januari">Januari</option> 
                                            <option value="Februari">Februari</option> 
                                            <option value="Maret">Maret</option> 
                                            <option value="April">April</option> 
                                            <option value="Mei">Mei</option> 
                                            <option value="Juni">Juni</option> 
                                            <option value="Juli">Juli</option> 
                                            <option value="Agustus">Agustus</option> 
                                            <option value="September">September</option> 
                                            <option value="Oktober">Oktober</option> 
                                            <option value="November">November</option> 
                                            <option value="Desember">Desember</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label>Status1</label>
                                        <select class="form-select" id="status1" name="status1" required>
                                            <option value="">Pilih</option> 
                                            <option value="TPP">TPP</option> 
                                        </select>
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

