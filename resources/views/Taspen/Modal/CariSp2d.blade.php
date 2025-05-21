<div class="modal fade bd-example-modal-xl" id="carisp2d" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-xl">
  
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
              <div class="modal-body">
                    <form id="userFormcarisp2d" name="userFormcarisp2d" method="POST" action="/dttaspen/store" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id5">
                            <input type="hidden" name="kode_pot" id="kode_pot5">
                            {{-- <input type="text" class="amount" id="detail_cart"> --}}
                            <div class="row">
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="akun_pajak">Akun Potongan</label>
                                            <select class="form-select" name="akun_potongan" id="akun_potongan" style="width: 100%" required>
                                        <option></option>
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

