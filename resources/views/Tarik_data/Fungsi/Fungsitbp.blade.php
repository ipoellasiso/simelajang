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
    var datatabletbp = $('.datatabletbp').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tarikpajaksipdritbp",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_tbp', name: 'nomor_tbp'},
            // {data: 'tanggal_tbp', name: 'tanggal_tbp'},
            {data: 'nilai_tbp', name: 'nilai_tbp'},
            {data: 'keterangan_tbp', name: 'keterangan_tbp'},
            // {data: 'no_npd', name: 'no_npd'},
            {data: 'nama_pajak_potongan', name: 'nama_pajak_potongan'},
            {data: 'id_billing', name: 'id_billing'},
            {data: 'nilai_tbp_pajak_potongan', name: 'nilai_tbp_pajak_potongan'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
        ]
    });

    var datatabletbptolak = $('.datatabletbptolak').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tarikpajaksipdritbptolak",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_tbp', name: 'nomor_tbp'},
            // {data: 'tanggal_tbp', name: 'tanggal_tbp'},
            {data: 'nilai_tbp', name: 'nilai_tbp'},
            {data: 'keterangan_tbp', name: 'keterangan_tbp'},
            // {data: 'no_npd', name: 'no_npd'},
            {data: 'nama_pajak_potongan', name: 'nama_pajak_potongan'},
            {data: 'id_billing', name: 'id_billing'},
            {data: 'nilai_tbp_pajak_potongan', name: 'nilai_tbp_pajak_potongan'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
        ]
    });

    var datatabletbpbelumverifikasi = $('.datatabletbpbelumverifikasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tarikpajaksipdritbpbelumverifikasi",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_tbp', name: 'nomor_tbp'},
            // {data: 'tanggal_tbp', name: 'tanggal_tbp'},
            {data: 'nilai_tbp', name: 'nilai_tbp'},
            {data: 'keterangan_tbp', name: 'keterangan_tbp'},
            // {data: 'no_npd', name: 'no_npd'},
            {data: 'nama_pajak_potongan', name: 'nama_pajak_potongan'},
            {data: 'id_billing', name: 'id_billing'},
            {data: 'nilai_tbp_pajak_potongan', name: 'nilai_tbp_pajak_potongan'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
        ]
    });

    var datatabletbplist = $('.datatabletbplist').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tarikpajaksipdritbplist",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_tbp', name: 'nomor_tbp'},
            {data: 'tanggal_tbp', name: 'tanggal_tbp'},
            {data: 'nilai_tbp', name: 'nilai_tbp'},
            {data: 'keterangan_tbp', name: 'keterangan_tbp'},
            {data: 'no_npd', name: 'no_npd'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
        ]
    });

    $('body').on('click', '.deletepengajuantbp', function () {

        var id = $(this).data("id");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/tariktbp/destroy/"+id,
                    dataType: "JSON",
                    success: function(data)
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: data.success
                        })
                        datatabletbp.draw();
                        datatabletbptolak.draw();
                        datatabletbplist.draw();
                        datatabletbpbelumverifikasi.draw();
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

    $('body').on('click', '.deletepengajuantbplist', function () {

        var id1 = $(this).data("id");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id1,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/tariktbp/destroylist/"+id1,
                    dataType: "JSON",
                    success: function(data1)
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: data1.success
                        })
                        datatabletbp.draw();
                        datatabletbptolak.draw();
                        datatabletbplist.draw();
                        datatabletbpbelumverifikasi.draw();
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

    $('body').on('click', '.tolaktbp', function()  {
        var iduser3 = $(this).data('id');
        $.get("/tariktbp/tolak/"+iduser3, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#edittolak_modal').modal('show');
            $('#id').val(data.id);
            $('#ebilling').val(data.id_billing);
        })
    });

    $('body').on('submit', '#userFormtolak', function(e){
        e.preventDefault();

        var id = $(this).data("id");
        var actionType1 = $('#saveBtntolak').val();
        $('#saveBtntolak').html('Sabar Ya Gaes.....');

        var formData3 = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/tariktbp/tolakupdate/"+id,
            data: formData3,
            cacha: false,
            contentType: false,
            processData: false,
            // processing: true,
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

                datatabletbp.draw();
                datatabletbptolak.draw();
                datatabletbplist.draw();
                datatabletbpbelumverifikasi.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtntolak').html('Tolak');
            }
        });
    });

    $('body').on('click', '.terimatbp', function()  {
        var iduser2 = $(this).data('id');
        $.get("/tariktbp/terima/"+iduser2, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#editterima_modal').modal('show');
            $('#id1').val(data.id);
            $('#ebilling1').val(data.id_billing);
        })
    });

    $('body').on('submit', '#userFormterima', function(e){
        e.preventDefault();

        var id = $(this).data("id");
        var actionType = $('#saveBtnterima').val();
        $('#saveBtnterima').html('Sabar Ya.....');

        var formData2 = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/tariktbp/terimaupdate/"+id,
            data: formData2,
            cacha: false,
            contentType: false,
            processData: true,
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

                datatabletbp.draw();
                datatabletbptolak.draw();
                datatabletbplist.draw();
                datatabletbpbelumverifikasi.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtnterima').html('Terima');
            }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '/tariktbp/akun_pajak',
            method: 'GET',
            success: function(data) {
                $.each(data, function(index, akunpajak) {
                    $('#akun_pajak').append(new Option(akunpajak.akun_pajak, akunpajak.akun_pajak)); // Ganti 'nama' dengan kolom yang sesuai
                });
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

    $('body').on('click', '.Ubahstatuspajakgu', function()  {
        var iduser1 = $(this).data('id');
        $.get("/tariktbp/ubahstatus/"+iduser1, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#ubahstatus_modal').modal('show');
            $('#id6').val(data.id);
            $('#ebilling6').val(data.id_billing);
        })
    });

    $('body').on('submit', '#userFormubahstatus', function(e){
        e.preventDefault();

        var id = $(this).data("id");
        var actionType = $('#saveBtnUbahstatus').val();
        $('#saveBtnUbahstatus').html('Sabar Ya Gaes.....');

        var formData1 = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/tariktbp/ubahstatusupdate/"+id,
            data: formData1,
            cacha: false,
            contentType: false,
            processData: false,
            // processing: true,
            success: (data) => {

                $('#userFormubahstatus').trigger("reset");
                $('#ubahstatus_modal').modal('hide');
                $('#saveBtnUbahstatus').html('Ubah_Status');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil Dirubah"
                })

                datatabletbp.draw();
                datatabletbptolak.draw();
                datatabletbplist.draw();
                datatabletbpbelumverifikasi.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtnUbahstatus').html('Ubah_Status');
            }
        });
    });

    // $('body').on('click', '.Ubahstatuspajakgubackup', function () {

    //     var id6 = $(this).data("id");
    //     // var ebilling6 = $(this).data("ebilling");

    //     Swal.fire({
    //     title: 'Warning ?',
    //     text: "Ubah Status Pajak Ini ?"+id6,
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes, Ubah!'
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         $.ajax({
    //             type: "POST",
    //             url: "/tariktbp/ubahstatusupdate/"+id6,
    //             dataType: "JSON",
    //             success: function(data)
    //             {
    //                 Swal.fire({
    //                     icon: "success",
    //                     title: "Success",
    //                     text: data.success
    //                 })
    //                 datatabletbp.draw();
    //             },
    //         });
    //     }else {
    //         Swal.fire({
    //             icon: "error",
    //             title: "Error",
    //             text: "Data Gagal Diterima"
    //         })
    //     }
    //     })
    // });

    $('body').on('click', '.editperbaikitbp', function () {

        var id = $(this).data("id");

        Swal.fire({
            title: 'Warning ?',
            text: "Ubah Data Ini ?"+id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Ubah Status!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/tariktbp/status4/"+id,
                    dataType: "JSON",
                    success: function(data)
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: data.success
                        })
                        datatabletbp.draw();
                        datatabletbptolak.draw();
                        datatabletbplist.draw();
                        datatabletbpbelumverifikasi.draw();
                    },
                });
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Data Gagal Diubah"
                })
            }
        })
    });

});

function readURL(input, id) {
    id = id || '#modal-preview';
    if (input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $('#modal-preview').removeClass('hidden');
        $('#start').hide();
    }
}


</script>