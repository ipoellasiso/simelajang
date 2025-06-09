
<div class="modal fade bd-example-modal-sm" id="editterima_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-centre">Anda Yakin Terima Pajak ini !!</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>

            <div class="modal-body">
                <form id="userFormterima" name="userFormterima" enctype="multipart/form-data">
                    {{-- @method('get') --}}
                    @csrf

                          <div class="input-area">
                              <label class="form-label">id</label>
                              <input name="id_potonganls" type="text" class="form-control" id="id_potonganls1" readonly>
                              <input name="id" type="text" class="form-control" id="id1" readonly>
                          </div>
    
                          <div class="input-area">
                              <label class="form-label">E-Billing</label>
                              <input name="ebilling" type="text" class="form-control" id="ebilling1" readonly>
                          </div>
    
                          <div class="input-area">
                              <label class="form-label">NTPN</label>
                              <input name="ntpn" type="text" class="form-control" id="ntpn1" readonly>
                          </div>
                  
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" id="saveBtnterima" value="create" class="btn btn-outline-primary m-b-xs">
                    <i class="fas fa-thumbs-up"></i>  Terima
                </button>
              </div>
            </form>

            </div>
        </div>
    </div>
</div>
