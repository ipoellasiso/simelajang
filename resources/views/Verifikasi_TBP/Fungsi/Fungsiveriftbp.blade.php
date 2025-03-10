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
    var table = $('.datatableveriftbp').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilveriftbp",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_skpd', name: 'nama_skpd'},
            {data: 'nomor_tbp', name: 'nomor_tbp'},
            {data: 'tanggal_tbp', name: 'tanggal_tbp'},
            {data: 'nilai_tbp', name: 'nilai_tbp'},
            {data: 'no_npd', name: 'no_npd'},
            // {data: 'no_spm', name: 'no_spm'},
            // {data: 'tgl_spm', name: 'tgl_spm'},
            // {data: 'id_billing', name: 'id_billing'},
            // {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            // {data: 'keterangan_tbp', name: 'keterangan_tbp'},
            {data: 'statustolak', name: 'statustolak', orderable: false, searchable: false},
            {data: 'status', name: 'status', orderable: false, searchable: false},
        ]
    });

    $('body').on('click', '.verifikasitolaktbp', function()  {
        var iduser = $(this).data('id');
        $.get("/verifikasitbp/tolak/"+iduser, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#edittolak_modal').modal('show');
            $('#id').val(data.id);
            $('#ebilling').val(data.nomor_tbp);
        })
    });

    $('body').on('submit', '#userFormtolak', function(e){
        e.preventDefault();

        var id = $(this).data("id");
        var actionType = $('#saveBtntolak').val();
        $('#saveBtntolak').html('Sabar Ya Gaes.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/verifikasitbp/tolakupdate/"+id,
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {

                $('#userFormtolak').trigger("reset");
                $('#edittolak_modal').modal('hide');
                $('#saveBtntolak').html('Tolak');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil diTolak"
                })

                table.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtntolak').html('Tolak');
            }
        });
    });

    $('body').on('click', '.verifikasiterimatbp', function()  {
        var iduser = $(this).data('id');
        $.get("/verifikasitbp/terima/"+iduser, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#editterima_modal').modal('show');
            $('#id1').val(data.id);
            $('#ebilling1').val(data.nomor_tbp);
        })
    });

    $('body').on('submit', '#userFormterima', function(e){
        e.preventDefault();

        var id = $(this).data("id");
        var actionType = $('#saveBtnterima').val();
        $('#saveBtnterima').html('Sabar Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/verifikasitbp/terimaupdate/"+id,
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {

                $('#userFormterima').trigger("reset");
                $('#editterima_modal').modal('hide');
                $('#saveBtnterima').html('Terima');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil diTerima"
                })

                table.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtnterima').html('Terima');
            }
        });
    });

});

</script>