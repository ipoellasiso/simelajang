<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
    </head>
    <body>
        <!-- <div class='loader'>
            @include('Template.Loading')
        </div> -->

        <div class="page-container">
            @include('Template.Navbar')
            @include('Template.Sidebar')
            
            {{-- ######################### Isi Tampil ########################## --}}
            <div class="page-content">
                <div class="main-wrapper">
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
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="javascript:void(0)" id="createUser" data-toggle="tooltip" data-placement="top" title="klik"> Tambah </a>
                                                    <a class="dropdown-item" href="javascript:void(0)" id="uploaduser" data-toggle="tooltip" data-placement="top" title="klik"> Upload </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="zero-conf" class="tabeluseradmin display table table-hover" style="width:100%">
                                    <thead>
                                            <tr>
                                            <th class="text-center">No</th>
                                            <th>Opd</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center" width="100px">Status</th>
                                            <th class="text-center" width="100px">Action</th>
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
            {{-- ######################### Batas Isi ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}

        @include('UserAdmin.Modal.Tambah')
        @include('UserAdmin.Fungsi.Fungsi')

        {{-- ############################## Batas Modal ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        <script>
            $('.select2').select2();
        </script>

        <script>
            if (session('success'))
                Swal.fire({
                  position: "top-center",
                  text: "Success",
                  icon: "success",
                  title: "{{ Session::get('success') }}",
                  showConfirmButton: false,
                  timer: 3500
                });
            endif
        </script>
        
        <script>
            if (session('error'))
                Swal.fire({
                  position: "top-center",
                  text: "Upss Sorry !",
                  icon: "error",
                  title: "{{ Session::get('error') }}",
                  showConfirmButton: false,
                  timer: 5500
                });
            endif
        </script>
        
        <script>
            if (session('status'))
                Swal.fire({
                  position: "top-center",
                  text: "Success",
                  icon: "success",
                  title: "{{ Session::get('status') }}",
                  showConfirmButton: false,
                  timer: 3500
                });
            endif
        </script>

    </body>
</html>