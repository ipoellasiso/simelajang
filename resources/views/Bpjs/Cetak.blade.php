<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body style="background-color: white;">

    <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }

    .table-borderless td,
    .table-borderless th {
        border: 0;
    }
  </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table border="2" cellpadding="10" align="center" cellspacing="20" style="width: 100%">
                            <tr>
                                <td colspan="" style="width: 5%;"><center><img src="/theme/assets/images/13.png" width="100" height="100"></center></td>
                                <td colspan="6" style="width: 55%;">
                                    <font style="font-size: 20pt;font-weight: bold;"><center>PEMERINTAH KOTA PALU</center></font>
                                    <font style="font-size: 13pt;font-weight: bold;"><center>BADAN PENGELOLA KEUANGAN DAN ASET DAERAH KOTA PALU</center></font>
                                    {{-- <font style="font-size: 13pt;font-weight: bold;"><center>KOTA PALU</center></font> --}}
                                    <font style="font-size: 11pt;font-weight:13"><center>Alamat : Jl. Baruga No. 2 No.Tlp : 0451-9384 Kode Pos : 94362</center></font>
                                </td>
                                {{-- <td colspan="1" style="border: 0px;width: 25%;"> --}}
                                    {{-- <font style="font-size: 12pt;font-weight: bold;">No Barang Masuk :  </font> <br/>
                                    <font style="font-size: 12pt;font-weight: bold;">Tanggal Masuk  </font> --}}
                                {{-- </td> --}}
                            </tr>

                            <!-- DATA SUPPLIER -->
                            <tr style="border: 0;">
                                <td colspan="6"></td>
                            </tr>
                            {{-- <tr style="border: 1;" align="center">
                                <td colspan="6"><b>DATA POTONGAN</b></td>
                            </tr> --}}
                            <tr>
                                <td style="border: 0;width: 10%;" colspan="2">E-Billing</td>
                                <td style="border: 0;">: {{ $dtrincianbpjs->ebilling }} </td>

                                 <td style="border-top: 0;border-right: 0;border-bottom: 0;" colspan="2">NTPN</td>
                                 <td style="border: 0;">: {{ $dtrincianbpjs->ntpn }} </td>
                            </tr>
                            <tr>
                                <td style="border: 0;" colspan="2">Akun Potongan</td>
                                <td style="border: 0;">: {{ $dtrincianbpjs->akun_potongan }} </td>

                                 <td style="border-top: 0;border-right: 0;border-bottom: 0;" colspan="2">Nilai Potongan</td>
                                 <td style="border: 0;">: Rp. {{ number_format($dtrincianbpjs->nilai_potongan) }} </td>
                            </tr>

                            <!-- DATA BARANG -->

                            <tr style="border: 0;">
                                <td colspan="6"></td>
                            </tr>

                            <tr>
                                <th>No</th>
                                <th>Nomor SP2D</th>
                                <th>Nilai SP2D</th>
                                <th>Jenis Potongan</th>
                                <th>Akun Potongan</th>
                                <th>Nilai Potongan</th>
                            </tr>
                            @php $no=1; @endphp
                            @foreach ($dtbpjs as $row)
                            <tr>
                                <td style="width: 2%">{{ $no++ }}</td>
                                <td style="width: 25%">{{ $row->nomor_sp2d }}</td>
                                <td style="width: 20%">Rp. {{ number_format($row->nilai_sp2d) }}</td>
                                <td style="width: 20%">{{ $row->jenis_pajak }}</td>
                                <td style="width: 10%">{{ $row->akun_potongan }}</td>
                                <td style="width: 25%">Rp. {{ number_format($row->nilai_potongan) }}</td>
                            </tr>
                            @endforeach
                            <tr style="border: 1;" align="left">
                                <td colspan="5" align="right"><b>TOTAL</b></td>
                                <td><b>Rp. {{ number_format($dtrincianbpjs->nilai_potongan) }}</b></td>
                            </tr>

                            <tr>
                                <td colspan="6" style="border-bottom: 0;"></td>
                            </tr>
                            
                            <tr style="border: 0;">
                                <td style="border: 0;" colspan="3"><center><b></b></center></td>
                                <td style="border: 0;" colspan="3"><center><b>{{ $row->jabatan_bud_kbud }}</b></center></td>
                            </tr>
                            
                            <tr style="border: 0;">
                                <td style="border: 0;" colspan="3" align="center">
                                    <br/><br/><br/>
                                </td>
                                <td style="border: 0;" colspan="3" align="center">
                                    <br/><br/><br/>
                                </td>
                            </tr>

                            <tr>
                                <td style="border: 0;" colspan="3"><center><u><b></b></u></center></td>
                                <td style="border: 0;" colspan="3">
                                <center>
                                    <u><b>{{ $row->nama_bud_kbud }}</b></u><br>
                                    <b>NIP. {{ $row->nip_bud_kbud }}</b>
                                </center></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        window.print();

        setTimeout(() => {
            window.close();
            window.location.href = '/tampilbpjs';
        }, 1000);
    </script>

</body>

</html>