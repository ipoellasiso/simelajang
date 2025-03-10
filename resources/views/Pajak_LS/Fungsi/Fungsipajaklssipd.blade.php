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
    var table = $('.tabelpajaklssipdri').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilpajaklssipd1",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'status2', name: 'status2'},
            // {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'jenis_pajak', name: 'jenis_pajak'},
            {data: 'nilai_pajak', name: 'nilai_pajak'},
            {data: 'ebilling', name: 'ebilling'},
            
        ]
    });

    var table = $('.tabelpajaklssipdribeluminput1').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilpajaklsadminbeluminput",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'status2', name: 'status2'},
            // {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'keterangan_sp2d', name: 'keterangan_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'jenis_pajak', name: 'jenis_pajak'},
            {data: 'nilai_pajak', name: 'nilai_pajak'},
            {data: 'ebilling', name: 'ebilling'},
            
        ]
    });

    // edit data
    $('body').on('click', '.editPajaklssipd', function()  {
        var iduser = $(this).data('id');
        $.get("/pajaklssipd1/edit/"+iduser, function (data) {
            $('#saveBtn').val("edit-pajakls");
            $('#tambahpajakls').modal('show');
            $('#id5').val(data.id);
            $('#id_potonganls5').val(data.id_potonganls);
            $('#ebillingg').val(data.ebilling);
            $('#jenis_pajak').val(data.jenis_pajak);
            $('#nilai_pajak').val(data.nilai_pajak);
            $('#periode').val(data.periode);
            $('.bd-example-modal-xl').modal('hide');
        })
    });
});

</script>

