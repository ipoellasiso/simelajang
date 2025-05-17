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
    var tabelbpjssipdri = $('#tabeltaspensipdri').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampiltaspensipdedit",
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
    $('body').on('click', '.editpotcartsipdtaaspen', function()  {
        var id    	        = $(this).data("id");
        var tanggal_sp2d    = $(this).data("tanggal_sp2d");
        var nomor_sp2d      = $(this).data("nomor_sp2d");
        var nilai_sp2d      = $(this).data("nilai_sp2d");
        var jenis_pajak     = $(this).data("jenis_pajak");
        var nilai_pajak     = $(this).data("nilai_pajak");

        $.ajax({
            url : "/datataspen/store",
            method : "POST",
            data : {id: id, tanggal_sp2d: tanggal_sp2d, nomor_sp2d: nomor_sp2d, nilai_sp2d: nilai_sp2d, jenis_pajak: jenis_pajak, nilai_pajak: nilai_pajak},
            success: function(data){
                // tblTampil.draw();
                // $('#detail_cart').html(data);
            }
        });
    });

});

</script>

