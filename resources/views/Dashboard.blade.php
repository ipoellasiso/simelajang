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
                                    <h5 class="card-title">Hai.. Selamat Datang</h5>
                                  <div class="transactions-list">
                                    <div class="tr-item">
                                      <div class="tr-company-name">
                                          <div>
                                            <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="app\assets\images\foto_user\{{ $userx->gambar }}" alt="" width="100px"></a>
                                          </div>
                                          <div class="tr-text">
                                            <h4>{{ $userx->fullname }}</h4>
                                            <p>{{ $userx->role }}</p>
                                          </div>
                                      </div>
                                          <div class="progress">
                                            {{-- <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div> --}}
                                          </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-xl-3">
                            <div class="card stat-widget">
                                <div class="card-body">
                                  <h5 class="card-title">Total Pajak LS</h5>
                                  <h2>{{ number_format($total_pajakls) }}</h2>
                                  <p>Rp.</p>
                                      <div class="progress">
                                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 col-xl-6">
                            <div class="card stat-widget">
                                <div class="card-body">
                                    <h5 class="card-title">Total PerJenis Pajak LS</h5>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-primary text-primary">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Pertambahan Nilai</h4>
                                            <p>50 %</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_ppn,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-success text-success">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 21</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph21,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-danger text-danger">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 22</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph22,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-warning text-warning">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 23</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph23,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-info text-info">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 24</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph24,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-xl-6">
                            <div class="card stat-widget">
                                <div class="card-body">
                                    <h5 class="card-title">Total PerJenis Pajak GU</h5>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-primary text-primary">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Pertambahan Nilai</h4>
                                            <p>50 %</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_ppngu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-success text-success">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 21</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph21gu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-danger text-danger">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 22</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph22gu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-warning text-warning">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 23</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph23gu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-info text-info">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 24</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph24gu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 col-xl-6">
                            <div class="card stat-widget">
                                <div class="card-body">
                                    <table id="" class="display table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Jumlah SP2D</th>
                                                <th>Nilai SP2D</th>
                                            </tr>
                                        </thead>
                                        <?php $i=1; ?>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Januari</td>
                                                <td>{{ ($total11) }}</td>
                                                <td>{{ number_format($total1,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Februari</td>
                                                <td>{{ ($total21) }}</td>
                                                <td>{{ number_format($total2,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Maret</td>
                                                <td>{{ ($total31) }}</td>
                                                <td>{{ number_format($total3,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>April</td>
                                                <td>{{ ($total41) }}</td>
                                                <td>{{ number_format($total4,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Mei</td>
                                                <td>{{ ($total51) }}</td>
                                                <td>{{ number_format($total5,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Juni</td>
                                                <td>{{ ($total61) }}</td>
                                                <td>{{ number_format($total6,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Juli</td>
                                                <td>{{ ($total71) }}</td>
                                                <td>{{ number_format($total7,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Agustus</td>
                                                <td>{{ ($total81) }}</td>
                                                <td>{{ number_format($total8,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>September</td>
                                                <td>{{ ($total91) }}</td>
                                                <td>{{ number_format($total9,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Oktober</td>
                                                <td>{{ ($total101) }}</td>
                                                <td>{{ number_format($total10,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>November</td>
                                                <td>{{ ($total111) }}</td>
                                                <td>{{ number_format($totall11,2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-td"> {{ $i++ }}</td>
                                                <td>Desember</td>
                                                <td>{{ ($total121) }}</td>
                                                <td>{{ number_format($total12,2) }}</td>
                                            </tr>
                                            
                                        <tbody>
                                            {{-- datatable ajax --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-xl-6">
                            <div class="card stat-widget">
                                <div class="card-body">
                                    <h5 class="card-title">Total PerJenis Pajak GU</h5>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-primary text-primary">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Pertambahan Nilai</h4>
                                            <p>50 %</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_ppngu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-success text-success">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 21</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph21gu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-danger text-danger">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 22</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph22gu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-warning text-warning">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 23</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph23gu,2) }}</span></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="transactions-list">
                                      <div class="tr-item">
                                        <div class="tr-company-name">
                                          <div class="tr-icon tr-card-icon tr-card-bg-info text-info">
                                            <i data-feather="credit-card"></i>
                                          </div>
                                          <div class="tr-text">
                                            <h4>Pajak Penghasilan Ps 24</h4>
                                            <p>50%</p>
                                          </div>
                                        </div>
                                        <div class="tr-rate">
                                          <p><span class="text-dark"><h9>Rp. </h9>{{ number_format($total_pph24gu,2) }}</span></p>
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