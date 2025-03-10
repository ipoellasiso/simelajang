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
    var table = $('.tabelakunpajak').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilakunpajak",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'akun_pajak', name: 'akun_pajak'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
    $('#createAkunpajak').click(function (){
        $('#saveBtn').val("create-akunpajak");
        $('#id').val('');
        $('#userForm').trigger("reset");
        $('#tambahakunpajak').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editAkunpajak', function()  {
        var iduser = $(this).data('id');
        $.get("/akunpajak/edit/"+iduser, function (data) {
            $('#saveBtn').val("edit-akunpajak");
            $('#tambahakunpajak').modal('show');
            $('#id').val(data.id);
            $('#akun_pajak').val(data.akun_pajak);
        })
    });

    // simpan data
    $('body').on('submit', '#userForm', function(e){
        e.preventDefault();

        var actionType = $('#saveBtn').val();
        $('#saveBtn').html('Tunggu..');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/akunpajak/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {

                $('#userForm').trigger("reset");
                $('#tambahakunpajak').modal('hide');
                $('#saveBtn').html('Simpan');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil Disimpan"
                })

                table.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtn').html('Simpan');
            }
        });
    });

    // hapus data
    $('body').on('click', '.deleteAkunpajak', function () {

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
                    url: "/akunpajak/destroy/"+id,
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

});

</script>

<script>
    function deleteData(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        );
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting your data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>   