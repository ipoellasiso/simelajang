<div class="modal fade" id="tambahjenispajak" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jenis Pajak</label>
                                        <input type="text" class="form-control" name="jenis_pajak" id="jenis_pajak" value="" placeholder="Jenis Pajak ...." required>
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
                    </form>
            </div>
        </div>
    </div>
</div>


