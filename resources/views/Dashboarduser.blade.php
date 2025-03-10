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
            
            {{-- ######################### Isi Tampil ########################## --}}
            <div class="page-content">
              <div class="main-wrapper">
                {{-- <div class="row"> --}}
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ $page_title }}</a>
                        <a class="breadcrumb-item" href="#">{{ $breadcumd1 }}</a>
                        <span class="breadcrumb-item active">{{ $breadcumd2 }}</span>
                    </nav>
                    
                      <div class="row">
                        <div class="col-md-6 col-xl-6">
                          <div class="card stat-widget">
                              <div class="card-body">
                                <h5 class="card-title">Total Pajak LS</h5>
                                <h2>{{ number_format($total_pajakls) }}</h2>
                                <p>Rp.</p>
                                    <div class="progress">
                                      <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                          <div class="card stat-widget">
                              <div class="card-body">
                                <h5 class="card-title">Total Pajak GU</h5>
                                <h2>{{ number_format($total_pajakgu) }}</h2>
                                <p>Rp.</p>
                                    <div class="progress">
                                      <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                          <div class="card stat-widget">
                              <div class="card-body">
                                <h5 class="card-title">Pajak Pertambahan Nilai</h5>
                                    <h2>{{ number_format($total_ppngu) }}</h2>
                                    <p>Rp.</p>
                                    <div class="progress">
                                      <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 col-xl-3">
                          <div class="card stat-widget">
                              <div class="card-body">
                                <h5 class="card-title">PPh 21</h5>
                                <h2>{{ number_format($total_pph21gu) }}</h2>
                                <p>Rp.</p>
                                    <div class="progress">
                                      <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                          <div class="card stat-widget">
                              <div class="card-body">
                                <h5 class="card-title">Pajak Penghasilan Ps 22</h5>
                                <h2>{{ number_format($total_pph22gu) }}</h2>
                                <p>Rp.</p>
                                    <div class="progress">
                                      <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                          <div class="card stat-widget">
                              <div class="card-body">
                                <h5 class="card-title">Pajak Penghasilan Ps 23</h5>
                                <h2>{{ number_format($total_pph23gu) }}</h2>
                                    <p>Rp.</p>
                                    <div class="progress">
                                      <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                          <div class="card stat-widget">
                              <div class="card-body">
                                <h5 class="card-title">Pajak Penghasilan Ps 24</h5>
                                <h2>{{ number_format($total_pph24gu) }}</h2>
                                <p>Rp.</p>
                                    <div class="progress">
                                      <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                              </div>
                          </div>
                        </div>
                      </div>

                </div>

              </div>
            </div>
          </div>
            {{-- ######################### Batas Isi ########################## --}}

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