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
    var table = $('.tabelspmsp2dgusipdri').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilspmsp2dgusipd",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'status2', name: 'status2'},
            {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'nama_pajak_potongan', name: 'nama_pajak_potongan'},
            {data: 'id_billing', name: 'id_billing'},
            {data: 'nilai_tbp_pajak_potongan', name: 'nilai_tbp_pajak_potongan'},
            // {data: 'keterangan_sp2d', name: 'keterangan_sp2d'},
            {data: 'nama_skpd', name: 'nama_skpd'},
        ]
    });

    var table = $('.tabelpajakgubeluminput').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilpajakgubeluminput",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'status2', name: 'status2'},
            {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'keterangan_sp2d', name: 'keterangan_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'nama_pajak_potongan', name: 'nama_pajak_potongan'},
            {data: 'id_billing', name: 'id_billing'},
            {data: 'nilai_tbp_pajak_potongan', name: 'nilai_tbp_pajak_potongan'},
            
        ]
    });

    // edit data
    $('body').on('click', '.editPajakgusipd', function()  {
        var iduser = $(this).data('id');
        $.get("/pajakgusipd/edit/"+iduser, function (data) {
            $('#saveBtn').val("edit-pajakgu");
            $('#editpajakgusipdajukantbp').modal('show');
            $('#id5').val(data.id);
            $('#nomor_spm5').val(data.nomor_spm);
            $('#nomor_sp2d5').val(data.nomor_sp2d);
            $('#akun_pajak5').val(data.akun_pajak);
            $('#nama_pajak_potongan5').val(data.nama_pajak_potongan);
            $('#id_billing5').val(data.id_billing);
            $('#nilai_tbp_pajak_potongan5').val(data.nilai_tbp_pajak_potongan);
            $('#npwp5').val(data.npwp);
            $('#nama_npwp5').val(data.nama_npwp);
            $('#nomor_rekening5').val(data.nomor_rekening);
            $('#ntpn5').val(data.ntpn);
            $('.bd-example-modal-xl').modal('hide');
        })
    });
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

</script>

