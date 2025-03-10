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
                        
                        <div class='loader'>
                            <div class='spinner-grow text-primary' role='status'>
                            <span class='sr-only'>Loading...</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <img class="card-img-top" src="/app/assets/images/bukti_pemby_pajak/{{ $lihatpajakgu->bukti_pemby }}" width="100px" height="500px" alt="">
                                    </div>
                                </div>
                                <div class="float-right">
                                    <a href="/tampilpajakgu" type="button" class="btn btn-outline-danger m-b-xs" data-dismiss="modal">
                                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                                    </a>
                                    <a href="#" type="button" class="btn btn-outline-primary m-b-xs" data-dismiss="modal">
                                        <i class="fas fa-arrow-alt-circle-down"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">TANGGAL SPM :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->tanggal_spm }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">                                        </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">NOMOR SPM :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->nomor_spm }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">NILAI SPM :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->nilai_sp2d }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">TANGGAL SP2D :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->nomor_sp2d }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">                                        </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">NOMOR SP2D :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->nomor_sp2d }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">NILAI SP2D :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->nilai_sp2d }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">REKENING BELANJA :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->rek_belanja }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">                                        </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">AKUN PAJAK :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->akun_pajak }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">                                        </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">JENIS PAJAK :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->jenis_pajak }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">NILAI PAJAK :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->nilai_pajak }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">NAMA NPWP :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->nama_npwp }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">                                        </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">NOMOR NPWP :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->nomor_npwp }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">EBILLING :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->ebilling }}</span>
                                            </div>
                                        </div>
                                        <div class="media m-b-30">
                                            <div class="avatar avatar-image">
                                                <img src="/app/assets/images/logo/logo-fold3.png" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">NTPN :</h6>
                                                <span class="font-size-13 text-gray">{{ $lihatpajakgu->ntpn }}</span>
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
        
        @include('Pajak_GUadmin.Modal.Terima')
        @include('Pajak_GUadmin.Modal.Tolak')
        @include('Pajak_GUadmin.Modal.Tambah')
        @include('Pajak_GUadmin.Modal.Datapajakls')

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Pajak_GUadmin.Fungsi.Fungsi')
        @include('Pajak_GUadmin.Fungsi.Fungsipajaklssipd')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>