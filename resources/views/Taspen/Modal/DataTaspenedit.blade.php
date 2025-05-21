<div class="modal fade bd-example-modal-xl" id="editTaspensipd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            {{-- <h4 class="card-title">{{ $title }}</h4> --}}
                            {{-- <a class="btn btn-secondary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createPajakls" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                                <i data-feather="search"></i>
                            </a> --}}
                        </div>
                        {{-- class="m-t-25" --}}
                        <div class="table-responsive">
                            <table id="tblTaspen" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">No</th> -->
                                        <th></th>
                                        {{-- <th>Nomor SPM</th> --}}
                                        <th>Tanggal SP2D</th>
                                        <th>Nomor SP2D</th>
                                        <th>Nilai SP2D</th>
                                        <th>Jenis Potongan</th>
                                        <th>Nilai Potongan</th>
                                        {{-- <th>E-Biling</th> --}}
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- datatable ajax --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger m-b-xs" data-bs-dismiss="modal">
                    <i class="fas fa-times-circle"></i> Close
                </button>
                {{-- <button type="submit" id="saveBtn" value="create" class="btn btn-secondary">
                    <i class="fa fa-save"></i>  Simpan
                </button> --}}

            </div>
        </div>
    </div>
</div>