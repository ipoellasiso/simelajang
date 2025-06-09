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
    var table = $('.tabelpajakgu').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilpajakgu",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id_opd', name: 'id_opd'},
            {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'jenis_pajak', name: 'jenis_pajak'},
            {data: 'nilai_pajak', name: 'nilai_pajak'},
            {data: 'ebilling', name: 'ebilling'},
            {data: 'ntpn', name: 'ntpn'},
            {data: 'status2', name: 'status2'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'periode', name: 'periode'},

        ]
    });

    // tambah data
    $('#createPajakgu').click(function (){
        $('#saveBtn').val("create-pajakgu");
        $('#id').val('');
        $('#userForm').trigger("reset");
        $('#editpajakgusipdajukantbp').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // simpan data
    $('body').on('submit', '#userForm', function(e){
        e.preventDefault();

        var actionType = $('#saveBtn').val();
        $('#saveBtn').html('Menunggu Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/pajakgu/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahpajakgu').modal('hide');
                    $('#saveBtn').html('Simpan');
                    $('.bd-example-modal-xl').modal('hide');

                    Swal.fire({
                        icon: "success",
                        title: "success",
                        text: data.success
                    })

                    table.draw();
                }
                else
                {
                    $('#userForm').trigger("reset");
                    $('#tambahpajakgu').modal('hide');
                    $('#saveBtn').html('Simpan');
                    $('.bd-example-modal-xl').modal('hide');

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data.error
                    })

                    table.draw();
                }
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtn').html('Simpan');
            }
        });
    });

    // hapus data
    $('body').on('click', '.deletePajakgu', function () {

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
                    url: "/pajakgu/destroy/"+id,
                    dataType: "JSON",
                    success: function(data)
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: data.success
                        })
                        table.draw();
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

    $('body').on('click', '.tolakPajakgua', function () {

        var id = $(this).data("id");
        var ebilling = $(this).data("ebilling");

        Swal.fire({
            title: 'Warning ?',
            text: "Tolak Data Ini ?"+id+ebilling,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Tolak!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/pajakgu/tolakgu/"+id,
                    dataType: "JSON",
                    success: function(data)
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: data.success
                        })
                        table.draw();
                    },
                });
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Data Gagal Ditolak"
                })
            }
        })
        });

        $('body').on('click', '.aktifPajakgua', function () {

        var id = $(this).data("id");
        // var ebilling = $(this).data("ebilling");

        Swal.fire({
        title: 'Warning ?',
        text: "Terima Data Ini ?"+id,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Terima!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "/pajakgu/terimagu/"+id,
                dataType: "JSON",
                success: function(data)
                {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: data.success
                    })
                    table.draw();
                },
            });
        }else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Data Gagal Diterima"
            })
        }
        })
    });

    $(document).ready(function() {
        $('.amount').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), ' '));
        });
    });

    $(document).ready(function() {
            $.ajax({
                url: '/pajakgu/akunpajak',
                method: 'GET',
                success: function(data) {
                    $.each(data, function(index, akunpajak) {
                        $('#akun_pajak6').append(new Option(akunpajak.akun_pajak, akunpajak.akun_pajak)); // Ganti 'nama' dengan kolom yang sesuai
                    });
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });

    $(document).ready(function() {
        $.ajax({
            url: '/pajakgu/jenispajak',
            method: 'GET',
            success: function(data) {
                $.each(data, function(index, jenispajak) {
                    $('#nama_pajak_potongan5').append(new Option(jenispajak.jenis_pajak, jenispajak.jenis_pajak)); // Ganti 'nama' dengan kolom yang sesuai
                });
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

    $('body').on('click', '.tolakPajakgu', function()  {
        var iduser = $(this).data('id');
        $.get("/pajakgu/tolakgu/"+iduser, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#edittolak_modal').modal('show');
            $('#id').val(data.id);
            $('#id_potonganls').val(data.id_potonganls);
            $('#ntpn').val(data.ntpn);
            $('#ebilling').val(data.ebilling);
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
            url: "/pajakgu/tolakguupdate/"+id,
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

    $('body').on('click', '.terimaPajakgu', function()  {
        var iduser = $(this).data('id');
        $.get("/pajakgu/terimagu/"+iduser, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#editterima_modal').modal('show');
            $('#id1').val(data.id);
            $('#ntpn1').val(data.ntpn);
            $('#ebilling1').val(data.ebilling);
            $('#id_potonganls1').val(data.id_potonganls);
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
            url: "/pajakgu/terimaguupdate/"+id,
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

    // $.ajax({ url: '/pajakgu/totalnilai', 
    //     type: 'GET', 
    //     success: function(response) { 
    //         $('#total_pajak').text(response.total); 
    //     }
    // });
});

function readURL(input, id) {
    id = id || '#modal-preview5';
    if (input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $('#modal-preview5').removeClass('hidden');
        $('#start').hide();
    }
}

function readURL(input, id) {
    id = id || '#modal-preview6';
    if (input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $('#modal-preview6').removeClass('hidden');
        $('#start').hide();
    }
}

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