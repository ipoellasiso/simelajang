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
    var table = $('.registersp2d').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilregsp2d",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nama_skpd', name: 'nama_skpd'},
            {data: 'nama_pihak_ketiga', name: 'nama_pihak_ketiga'},
            {data: 'keterangan_sp2d', name: 'keterangan_sp2d'},
            {data: 'jenis', name: 'jenis'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
        ]
    });

    
});

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
}

</script>