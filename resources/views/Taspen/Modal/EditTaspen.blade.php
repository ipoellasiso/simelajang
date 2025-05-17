<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
    </head>
    <body>
        <div class='loader'>
            @include('Template.Loading')
        </div>

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
                                <div class="card-body table-responsive">
                                    <div class="row mb-5">
                                        <div class="col-8">
                                            <h5 class="card-title">{{ $title }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <div class="float-end">
                                                <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#Taspensipd" data-bs-dismiss="modal">
                                                    <i data-feather="search"></i> Tambah Potongan TASPEN
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                        <font style="font-size: 11pt;font-weight: ;"><center>Rincian Potongan</center></font>
                                    <hr/>
                            <form id="userFormtaspen" name="userFormtaspen" method="POST" action="/datataspen/update/{{ $dtrinciantaspen->id }}" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-body">
                                    <table class="display table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Nomor SPM</th>
                                                <th>Tanggal SP2D</th>
                                                <th>Nomor SP2d</th>
                                                <th>Nilai SP2D</th>
                                                <th>Jenis Potongan</th>
                                                <th>Akun Potongan</th>
                                                <th>Nilai Potongan</th>
                                            </tr>
                                        
                                            <tbody>
                                                @php $no = 1; $total=0; @endphp
                                                @foreach ($dttaspen as $d)
                                                @php $total += $d->nilai_potongan @endphp
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $d->nomor_spm }}</td>
                                                        <td>{{ $d->tanggal_sp2d }}</td>
                                                        <td>{{ $d->nomor_sp2d }}</td>
                                                        <td>{{ number_format($d->nilai_sp2d) }}</td>
                                                        <td>{{ $d->jenis_pajak }}</td>
                                                        <td>{{ $d->akun_potongan }}</td>
                                                        <td>{{ number_format($d->nilai_potongan) }}</td>
                                                        <td>
                                                            {{-- <center> --}}
                                                                 <a type="button" href="/dtbpjs/destroyDetail/{{ $d->id }}" onclick="return confirm('Hapus Data Ini ?')" class="btn btn-outline-danger m-b-xs">
                                                                 <i class="fa fa-trash"></i> Hapus
                                                                 </a>
                                                             {{-- </center> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="7" align="right"><strong>Total Potongan</strong></td>
                                                    <td colspan="2"><strong>{{ number_format($total) }} </strong></td>
                                                </tr>
                                            </tbody>
                                            
                                        </thead>
                                    </table>
                                    <br>
                                    <br>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label>E-Billing</label>
                                            <input type="text" class="form-control" name="ebilling" id="ebilling" value="{{ $dtrinciantaspen->ebilling }}" placeholder="">
                                        </div>
                                        <div class="col">
                                            <label>NTPN</label>
                                            <input type="text" class="form-control" name="ntpn" id="ntpn" value="{{ $dtrinciantaspen->ntpn }}" placeholder="">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col">
                                            <label>Akun Potongan</label>
                                            <input type="text" class="form-control" name="akun_potongan" id="akun_potongan" value="{{ $dtrinciantaspen->akun_potongan }}" placeholder="">
                                        </div>
                                        <div class="col">
                                            <label>Upload Foto</label>
                                            <input type="file" class="form-control" name="bukti_pemby" id="bukti_pemby" accept="image/*" onchange="readURL(this);">
                                            <input type="hidden" name="hidden_image" id="hidden_image">
                                            <small>Upload Foto Harus Format JPG,JPEG / PNS dan Max File 5MB </small>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <img id="modal-preview" src="https://via/placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="id_rincianbpjs" id="id_rincianbpjs" value="{{ $dtrinciantaspen->id_rinciantaspen }}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="/tampiltaspen" type="button" class="btn btn-outline-danger m-b-xs" data-bs-dismiss="modal">
                                        <i class="fas fa-times-circle"></i> Kembali
                                    </a>
                                    <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary m-b-xs">
                                        <i class="fa fa-save"></i>  Simpan
                                    </button>
                                </div>
                            </form>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        
        @include('Taspen.Modal.DataTaspen')
        {{-- @include('Bpjs.Modal.Tambah')
        @include('Bpjs.Modal.Databpjsedit')
        @include('Bpjs.Modal.Terima')
        @include('Bpjs.Modal.Tolak') --}}

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}
        @include('Taspen.Fungsi.Fungsitaspensipd')
        {{-- @include('Bpjs.Fungsi.Fungsi')
        @include('Bpjs.Fungsi.Fungsibpjssipd')
        @include('Bpjs.Fungsi.Fungsibpjssipdedit') --}}

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>