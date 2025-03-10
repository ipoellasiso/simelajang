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
                                    <div class="d-flex flex-row">
                                        <h4 class="card-title">{{ $title }}</h4>
                                    </div>
                                    <div class="m-t-25">
                            
                                    <form method="POST" action="{{ url('simpanjsongu') }}">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body flex flex-col p-6">
                                            <div class="card-text h-full space-y-4">
                                                <div class="input-area">
                                                    <label for="url" class="form-label">Isi Data Json </label>
                                                    <!-- <textarea name="textarea" rows="5" cols="40">Write something here</textarea> -->
                                                    <textarea id="jsontextareagu" name="jsontextareagu" type="text" class="form-control" rows="10"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary m-b-xs">
                                                        <i class="fa fa-save"></i>  Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                            
                                    <div class="table-responsive">
                                        <table id="zero-conf" class="datatablegu display table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Nomor Sp2d</th>
                                                    <th>Tanggal Sp2d</th>
                                                    <th>Nama OPD</th>
                                                    <th class="text-center">Keterangan</th>
                                                    <th class="text-center" width="100px">nilai_sp2d</th>
                                                    <th class="text-center" >nomor_spm</th>
                                                    <th class="text-center" >Jenis</th>
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
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        
        

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Tarik_data.Fungsi.Fungsigu')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>