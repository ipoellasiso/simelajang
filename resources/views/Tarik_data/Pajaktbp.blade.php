<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
    </head>
    <body>
        {{-- <div class='loader'> --}}
            {{-- @include('Template.Loading') --}}
        {{-- </div> --}}

        <div class="page-container">
            @include('Template.Navbar')
            @include('Template.Sidebar')
            
            {{-- ######################### Isi Tampil Pajak LS ########################## --}}
            <div class="page-content">
                <div class="main-wrapper">

                    <div class="row">
                        <nav class="breadcrumb breadcrumb-dash">
                            <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ $page_title }}</a>
                            <a class="breadcrumb-item" href="#">{{ $breadcumd1 }}</a>
                            <span class="breadcrumb-item active">{{ $breadcumd2 }}</span>
                        </nav>
                        
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-text h-full">
                                        <div>
                                          <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                              <a href="#tabs-pengajuan_tbp-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent active dark:text-slate-300" id="tabs-home-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-pengajuan_tbp-withIcon" role="tab" aria-controls="tabs-pengajuan_tbp-withIcon" aria-selected="true">
                                                <iconify-icon class="mr-1" icon="heroicons-outline:home"></iconify-icon>
                                                Pengajuan Pajak TBP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabs-tbp_belumverifikasi-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300" id="tabs-profile-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-tbp_belumverifikasi-withIcon" role="tab" aria-controls="tabs-tbp_belumverifikasi-withIcon" aria-selected="false">
                                                  <iconify-icon class="mr-1" icon="heroicons-outline:user"></iconify-icon>
                                                  Belum Verifikasi</a>
                                              </li>
                                            <li class="nav-item" role="presentation">
                                              <a href="#tabs-tbp_diterima-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300" id="tabs-profile-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-tbp_diterima-withIcon" role="tab" aria-controls="tabs-tbp_diterima-withIcon" aria-selected="false">
                                                <iconify-icon class="mr-1" icon="heroicons-outline:user"></iconify-icon>
                                                Terima</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <a href="#tabs-tbp_ditolak-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300" id="tabs-messages-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-tbp_ditolak-withIcon" role="tab" aria-controls="tabs-tbp_ditolak-withIcon" aria-selected="false">
                                                <iconify-icon class="mr-1" icon="heroicons-outline:chat-alt-2"></iconify-icon>
                                                Tolak</a>
                                            </li>
                                          </ul>
                                          
                                          <div class="tab-content" id="tabs-tabContent">
                                            <div class="tab-pane fade show active" id="tabs-pengajuan_tbp-withIcon" role="tabpanel" aria-labelledby="tabs-pengajuan_tbp-withIcon">

                                                <form method="POST" action="{{ url('simpanjsontbp') }}" enctype=multipart/form-data>
                                                    @csrf
                                                    <div class="card">
                                                        <div class="card-body flex flex-col p-6">

                                                            <div class="row mb-4">
                                                                <div class="col">
                                                                    <label for="no_spm" class="form-label">NOMOR SPM </label>
                                                                    <input id="no_spm" name="no_spm" type="text" class="form-control"></input>
                                                                </div>
                                                            </div>
                
                                                            <div class="row mb-4">
                                                                <div class="col">
                                                                    <label for="url" class="form-label">Isi Data Json </label>
                                                                    <!-- <textarea name="textarea" rows="5" cols="40">Write something here</textarea> -->
                                                                    <textarea id="jsontextareatbp" name="jsontextareatbp" type="text" class="form-control" rows="10"></textarea>
                                                                </div>
                                                            </div>
                
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary m-b-xs">
                                                                    <i data-feather="check-square"></i>  Ajukan Pajak TBP
                                                                    </button>
                                                                </div>
                                                            
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <div class="card">
                                                        <div class="card-body flex flex-col p-6">

                                                            <div class="m-t-25">
                                                                <div class="table-responsive">
                                                                    <table id="zero-conf" class="datatabletbplist display table table-hover" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Nomor TBP</th>
                                                                                <th>Tanggal TBP</th>
                                                                                <th>Nilai TBP</th>
                                                                                <th>Keterangan TBP</th>
                                                                                <th>Nomor NPD</th>
                                                                                <th>Aksi</th>
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

                                            </div>

                                            <div class="tab-pane fade" id="tabs-tbp_diterima-withIcon" role="tabpanel" aria-labelledby="tabs-profile-withIcon-tab">

                                                <div class="m-t-25">
                                                    <div class="table-responsive">
                                                        <table id="zero-conf" class="datatabletbp display table table-hover" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nomor TBP</th>
                                                                    {{-- <th>Tanggal TBP</th> --}}
                                                                    <th>Nilai TBP</th>
                                                                    <th>Keterangan TBP</th>
                                                                    {{-- <th>Nomor NPD</th> --}}
                                                                    <th>Jenis Pajak</th>
                                                                    <th>E-Billing</th>
                                                                    <th>Nilai Pajak</th>
                                                                    {{-- <th>Nomor SPM</th> --}}
                                                                    {{-- <th>Tanggal SPM</th> --}}
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {{-- datatable ajax --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="tabs-tbp_ditolak-withIcon" role="tabpanel" aria-labelledby="tabs-settings-withIcon-tab">

                                                <div class="m-t-25">
                                                    <div class="table-responsive">
                                                        <table id="zero-confa" class="datatabletbptolak display table table-hover" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nomor TBP</th>
                                                                    {{-- <th>Tanggal TBP</th> --}}
                                                                    <th>Nilai TBP</th>
                                                                    <th>Keterangan TBP</th>
                                                                    {{-- <th>Nomor NPD</th> --}}
                                                                    <th>Jenis Pajak</th>
                                                                    <th>E-Billing</th>
                                                                    <th>Nilai Pajak</th>
                                                                    {{-- <th>Nomor SPM</th> --}}
                                                                    {{-- <th>Tanggal SPM</th> --}}
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {{-- datatable ajax --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                              
                                            </div>

                                            <div class="tab-pane fade" id="tabs-tbp_belumverifikasi-withIcon" role="tabpanel" aria-labelledby="tabs-settings-withIcon-tab">

                                                <div class="m-t-25">
                                                    <div class="table-responsive">
                                                        <table id="zero-confb" class="datatabletbpbelumverifikasi display table table-hover" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nomor TBP</th>
                                                                    {{-- <th>Tanggal TBP</th> --}}
                                                                    <th>Nilai TBP</th>
                                                                    <th>Keterangan TBP</th>
                                                                    {{-- <th>Nomor NPD</th> --}}
                                                                    <th>Jenis Pajak</th>
                                                                    <th>E-Billing</th>
                                                                    <th>Nilai Pajak</th>
                                                                    <th>Aksi</th>
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
                                        </div>
                                      </div>

                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        
        @include('Tarik_data.Modal.Terima')
        @include('Tarik_data.Modal.Tolak')
        @include('Tarik_data.Modal.Ubahstatus')

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Tarik_data.Fungsi.Fungsitbp')
        

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>