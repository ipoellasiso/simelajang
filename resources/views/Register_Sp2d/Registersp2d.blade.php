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

                        <div class="row">
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Januari ditess<p></p>{{ $totalcount1 }} </h5>
                                        <h2></h2>
                                        <p>Rp. {{ number_format($total_1,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Februari <p></p>{{ $totalcount2 }}</h5>
                                        <h2></h2>
                                        <p>Rp. {{ number_format($total_2,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Maret <p></p>{{ $totalcount3 }}</h5>
                                            <h2></h2>
                                            <p>Rp. {{ number_format($total_3,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak April123456 <p></p>{{ $totalcount4 }}</h5>
                                            <h2></h2>
                                            <p>Rp. {{ number_format($total_4,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Mei <p></p>{{ $totalcount5 }}</h5>
                                            <h2></h2>
                                            <p>Rp. {{ number_format($total_5,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Juni <p></p>{{ $totalcount6 }}</h5>
                                            <h2></h2>
                                            <p>Rp. {{ number_format($total_6,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Juli <p></p>{{ $totalcount7 }}</h5>
                                        <h2></h2>
                                        <p>Rp. {{ number_format($total_7,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Agustus <p></p>{{ $totalcount8 }}</h5>
                                        <h2></h2>
                                        <p>Rp. {{ number_format($total_8,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak September <p></p>{{ $totalcount9 }}</h5>
                                            <h2></h2>
                                            <p>Rp. {{ number_format($total_9,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Oktober <p></p>{{ $totalcount10 }}</h5>
                                            <h2></h2>
                                            <p>Rp. {{ number_format($total_10,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak November <p></p>{{ $totalcount11 }}</h5>
                                            <h2></h2>
                                            <p>Rp. {{ number_format($total_11,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-2">
                                    <div class="card stat-widget">
                                        <div class="card-body">
                                        <h5 class="card-title">Total Pajak Desember <p></p>{{ $totalcount12 }}</h5>
                                            <h2></h2>
                                            <p>Rp. {{ number_format($total_12,2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="col">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <div class="row mb-5">
                                        <div class="col-8">
                                            <h5 class="card-title">{{ $title }}</h5>
                                        </div>
                                    </div>

                                    <table id="zero-conf" class="registersp2d display table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor SPM</th>
                                                <th>Tanggal SP2D</th>
                                                <th>Nomor SP2D</th>
                                                <th>Unit SKPD</th>
                                                <th>Nama Penerima</th>
                                                <th>Keterangan</th>
                                                <th>Jenis SP2D</th>
                                                <th>Nilai SP2D</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                            <div class="row invoice-last">
                                <div class="col-9">
                                  <!-- {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut ante id elit molestie<br>dapibus id sollicitudin vel, luctus sit amet justo</p> --}} -->
                                </div>
                                <div class="col-3">
                                    <div class="invoice-info">
                                        {{-- @foreach ($total as $d) --}}
                                            <!-- <p>Total SP2D Januari ( {{ $totalcount1 }} ) <span>Rp.  {{ number_format($total_1,2) }}</span></p>
                                            <p>Total SP2D Februari ( {{ $totalcount2 }} ) <span>Rp. {{ number_format($total_2,2) }}</span></p>
                                            <p>Total SP2D Maret ( {{ $totalcount3 }} ) <span>Rp.  {{ number_format($total_3,2) }}</span></p>
                                            <p>Total SP2D April ( {{ $totalcount4 }} ) <span>Rp.  {{ number_format($total_4,2) }}</span></p>
                                            <p>Total SP2D Mei ( {{ $totalcount5 }} ) <span>Rp.  {{ number_format($total_5,2) }}</span></p>
                                            <p>Total SP2D Juni ( {{ $totalcount6 }} ) <span>Rp.  {{ number_format($total_6,2) }}</span></p>
                                            <p>Total SP2D Juli ( {{ $totalcount7 }} ) <span>Rp.  {{ number_format($total_7,2) }}</span></p>
                                            <p>Total SP2D Agustus ( {{ $totalcount8 }} ) <span>Rp.  {{ number_format($total_8,2) }}</span></p>
                                            <p>Total SP2D September ( {{ $totalcount9 }} ) <span>Rp.  {{ number_format($total_9,2) }}</span></p>
                                            <p>Total SP2D Oktober ( {{ $totalcount10 }} ) <span>Rp.  {{ number_format($total_10,2) }}</span></p>
                                            <p>Total SP2D November ( {{ $totalcount11 }} ) <span>Rp.  {{ number_format($total_11,2) }}</span></p>
                                            <p>Total SP2D Desember ( {{ $totalcount12 }} ) <span>Rp.  {{ number_format($total_12,2) }}</span></p>
                                            <p class="bold">TOTAL SP2D ( {{ $totalcount13 }} ) <span>Rp.  {{ number_format($totalsp2d,2) }}</span></p> -->
                                        {{-- @endforeach --}}
                                        <div class="d-grid gap-2">
                                          {{-- <button class="btn btn-danger m-t-xs" type="button">Print Invoice</button> --}}
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

            @include('Register_Sp2d.Fungsi.Fungsi')

            {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>