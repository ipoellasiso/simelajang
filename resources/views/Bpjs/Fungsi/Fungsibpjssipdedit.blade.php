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
    var tabelbpjssipdri = $('#tabelbpjssipdriedit').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilbpjssipdedit",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'status1', name: 'status1'},
            // {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nilai_sp2d1', name: 'nilai_sp2d1'},
            {data: 'jenis_pajak', name: 'jenis_pajak'},
            {data: 'nilai_pajak1', name: 'nilai_pajak1'},
            // {data: 'ebilling', name: 'ebilling'},
            
        ]
    });

    // edit data
    $('body').on('click', '.editpotcartsipd', function()  {
        var iduser = $(this).data('id');
        $.get("/dtbpjs/editpotcart/"+iduser, function (data) {
            $('#saveBtn').val("edit-potbpjscart");
            $('#tambahbpjs').modal('show');
            $('#kode_pot5').val(data.kode_pot);
            // $('#no_rek_pihak_ketiga5').val(data.no_rek_pihak_ketiga);
            // $('#jenis_pajak5').val(data.jenis_pajak);
            // $('#npwp_pihak_ketiga5').val(data.npwp_pihak_ketiga);
            $('.bd-example-modal-xl').modal('hide');
        })
    });

});

</script>

