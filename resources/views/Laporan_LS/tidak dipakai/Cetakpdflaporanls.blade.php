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
            <div class="">
                <div class="">

                    <div class="row">
                        
                        <div class="col">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <table id="" class="display table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama OPD</th>
                                                <th>Nomor SPM</th>
                                                <th>Tanggal SP2D</th>
                                                <th>Nomor SP2D</th>
                                                <th>Nilai SP2D</th>
                                                <th>Akun Pajak</th>
                                                <th>Jenis Pajak</th>
                                                <th>Nilai Pajak</th>
                                                <th>E-Biling</th>
                                                <th>NTPN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($datapajakls as $d )
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $d->nama_skpd }}</td>
                                                    <td>{{ $d->nomor_spm }}</td>
                                                    <td>{{ $d->tanggal_sp2d }}</td>
                                                    <td>{{ $d->nomor_sp2d }}</td>
                                                    <td>{{ number_format($d->nilai_sp2d) }}</td>
                                                    <td>{{ $d->akun_pajak }}</td>
                                                    <td>{{ $d->jenis_pajak }}</td>
                                                    <td>{{ number_format($d->nilai_pajak) }}</td>
                                                    <td>{{ $d->ebilling }}</td>
                                                    <td>{{ $d->ntpn }}</td>
                                                </tr>
                                                
                                            @endforeach
                                        </tbody>
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

        {{-- ################################# Fungsi ################################### --}}

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>
