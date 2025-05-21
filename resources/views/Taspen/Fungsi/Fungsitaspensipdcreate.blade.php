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
    var table = $('#tblTaspen').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/datataspen/create",
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

      /*------------------------------------------
      --------------------------------------------
      Click to Edit Button
      --------------------------------------------
      --------------------------------------------*/
    
    // $('#id_siswa').select2({
	//     allowClear: true,
	//     ajax: { 
    //         url: "/siswakelas/siswa",
    //         type: "POST",
    //         dataType: 'json',
    //         delay: 250,
    //         data: function (params) {
    //             return {
    //                 searchSiswa: params.term // search term
    //             };
    //         },
    //         processResults: function (response) {
    //             return {
    //                 results: response
    //             };
    //         },
    //             cache: true
    //         }
    // });

        /*------------------------------------------
      --------------------------------------------
      Render Datatable Siswa
      --------------------------------------------
      --------------------------------------------*/

    // var tblTampil = $('#tblTampil').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "/datataspen/load_cart",
    //     columns: [
    //         {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    //         {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
    //         {data: 'nomor_sp2d', name: 'nomor_sp2d'},
    //         {data: 'nilai_sp2d1', name: 'nilai_sp2d1'},
    //         {data: 'jenis_pajak', name: 'jenis_pajak'},
    //         {data: 'nilai_pajak1', name: 'nilai_pajak1'},
    //         {data: 'action', name: 'action', orderable: false, searchable: false},
    //     ],
    // });

    $('#detail_cart').load("/datataspen/show_cart")

    // $('#detail_cart').load("/datataspen/show_cart")

    /*------------------------------------------
      --------------------------------------------
      Click Button to Add 
      --------------------------------------------
      --------------------------------------------*/

    $('body').on('click', '#add_cart', function () {
        var id    	        = $(this).data("id");
        var tanggal_sp2d    = $(this).data("tanggal_sp2d");
        var nomor_sp2d      = $(this).data("nomor_sp2d");
        var nilai_sp2d      = $(this).data("nilai_sp2d");
        var jenis_pajak     = $(this).data("jenis_pajak");
        var nilai_pajak     = $(this).data("nilai_pajak");

        $.ajax({
            url : "/datataspen/addToCart",
            method : "POST",
            data : {id: id, tanggal_sp2d: tanggal_sp2d, nomor_sp2d: nomor_sp2d, nilai_sp2d: nilai_sp2d, jenis_pajak: jenis_pajak, nilai_pajak: nilai_pajak},
            success: function(data){
                // tblTampil.draw();
                $('#detail_cart').html(data);
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
                    url : "/datataspen/deleteCart/"+id,
                    method : "POST",
                    data : {id : id},
                    success :function(data){
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Data Berhasil Dihapus"
                        })
                        // tblTampil.draw();
                        $('#detail_cart').html(data);
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