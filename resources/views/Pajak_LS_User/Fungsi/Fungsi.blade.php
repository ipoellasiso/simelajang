<script type="text/javascript">
    $(function () {

      /*------------------------------------------
       --------------------------------------------
       Pass Header Token
       --------------------------------------------
       --------------------------------------------*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      /*------------------------------------------
      --------------------------------------------
      Render DataTable
      --------------------------------------------
      --------------------------------------------*/
    var table = $('.tabelpajaklsuser').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilpajaklsuser",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_skpd', name: 'nama_skpd'},
            {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'akun_pajak', name: 'akun_pajak'},
            {data: 'jenis_pajak', name: 'jenis_pajak'},
            {data: 'nilai_pajak', name: 'nilai_pajak'},
            {data: 'ebilling', name: 'ebilling'},
            {data: 'ntpn', name: 'ntpn'},
            // {data: 'status2', name: 'status2'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'keterangan', name: 'keterangan'},

        ]
    });
});

</script>