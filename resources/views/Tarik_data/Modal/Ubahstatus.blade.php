
<div class="modal fade bd-example-modal-sm" id="ubahstatus_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-centre">Anda Yakin Tolak TBP ini !!</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>

            <div class="modal-body">
                <form id="userFormubahstatus" name="userFormubahstatus" enctype="multipart/form-data">
                    {{-- @method('get') --}}
                    @csrf
                          <div class="input-area">
                              <label class="form-label">id</label>
                              <input name="id" type="text" class="form-control" id="id6" readonly>
                          </div>
    
                          <div class="input-area">
                              <label class="form-label">E-Billing</label>
                              <input name="ebilling" type="text" class="form-control" id="ebilling6" readonly>
                          </div>
                  
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" id="saveBtnUbahstatus" value="create" class="btn btn-outline-danger m-b-xs">
                    <i class="fas fa-thumbs-down"></i>  Tolak
                </button>
              </div>
            </form>

            </div>
        </div>
    </div>
</div>
