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
    var tabelbpjssipdri = $('#tabelbpjssipdri').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilbpjssipd",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'status1', name: 'status1'},
            {data: 'nama_skpd', name: 'nama_skpd'},
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

    $('#detail_cart').load("/dtbpjs/load_cart")
                // tabelcartbpjs.draw();
    

    // var tabelcartbpjs = $('#tabelcartbpjs').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "/dtbpjs/load_cart",
    //     columns: [
    //         {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    //         {data: 'qty', name: 'qty'},
    //         // {data: 'nomor_spm', name: 'nomor_spm'},
    //         {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
    //         {data: 'nomor_sp2d', name: 'nomor_sp2d'},
    //         {data: 'nilai_sp2d', name: 'nilai_sp2d'},
    //         {data: 'jenis_pajak', name: 'jenis_pajak'},
    //         {data: 'nilai_pajak', name: 'nilai_pajak'},
    //         {data: 'action', name: 'action', orderable: false, searchable: false},
    //         // {data: 'ebilling', name: 'ebilling'},
            
    //     ]
    // });

    // /*------------------------------------------
    //   --------------------------------------------
    //   Click Button to Add 
    //   --------------------------------------------
    //   --------------------------------------------*/

      $('body').on('click', '#add_cart', function () {
        var id    	        = $(this).data("id");
        var tanggal_sp2d    = $(this).data("tanggal_sp2d");
        var nomor_sp2d      = $(this).data("nomor_sp2d");
        var nilai_sp2d      = $(this).data("nilai_sp2d");
        var jenis_pajak     = $(this).data("jenis_pajak");
        var nilai_pajak     = $(this).data("nilai_pajak");
        // var kode_pot        = $(this).data("kode_pot5");
        

        $.ajax({
            url : "/dtbpjs/addToCart",
            method : "POST",
            data : {id: id, tanggal_sp2d: tanggal_sp2d, nomor_sp2d: nomor_sp2d, nilai_sp2d: nilai_sp2d, jenis_pajak: jenis_pajak, nilai_pajak: nilai_pajak},
            success: function (response) {
                $('#detail_cart').html(response);
            }
        });
    });

    /*------------------------------------------
      --------------------------------------------
      Click Button to Delete 
      --------------------------------------------
      --------------------------------------------*/

    $('body').on('click', '.hapus_cart', function () {

        var id = $(this).attr("id");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : "/dtbpjs/deleteCart/"+id,
                    method : "POST",
                    data : {id : id},
                    success :function(response){
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Data Berhasil Dihapus"
                        })
                        // tabelcartbpjs.draw();
                        $('#detail_cart').html(response);
                    },
                });
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Data Gagal Dihapus"
                })
            }
        })
    });

});

</script>

