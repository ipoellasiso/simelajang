<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
    </head>
    <body>
        {{-- <div class='loader'>
            @include('Template.Loading')
        </div> --}}

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
                        
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Zero Configuration</h5>
                                    <p>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.</p>
                                    <table id="zero-conf" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        <script>
            @if (session('success'))
                Swal.fire({
                  position: "top-center",
                  text: "Success",
                  icon: "success",
                  title: "{{ Session::get('success') }}",
                  showConfirmButton: false,
                  timer: 3500
                });
            @endif
        </script>
        
        <script>
            @if (session('error'))
                Swal.fire({
                  position: "top-center",
                  text: "Upss Sorry !",
                  icon: "error",
                  title: "{{ Session::get('error') }}",
                  showConfirmButton: false,
                  timer: 5500
                });
            @endif
        </script>
        
        <script>
            @if (session('status'))
                Swal.fire({
                  position: "top-center",
                  text: "Success",
                  icon: "success",
                  title: "{{ Session::get('status') }}",
                  showConfirmButton: false,
                  timer: 3500
                });
            @endif
        </script>

    </body>
</html>