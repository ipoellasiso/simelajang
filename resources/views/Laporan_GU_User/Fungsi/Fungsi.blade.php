<script>
    $(document).ready(function(){
        $(document).ready(function () {
            var tampilawaluser = '1';
            $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampilawaluser',
                type: "GET",
                data: 'tampilawaluser=' + tampilawaluser,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    });

    $(document).ready(function(){
        $(document).ready(function () {
            var tampilawaluser = '1';
            $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampilawaluser',
                type: "GET",
                data: 'tampilawaluser=' + tampilawaluser,
                success: function (data) {
                    $('.tampillaporangu1rekap').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    });

    $('body').on('click', '.caribaru', function (e) {
        e.preventDefault();
        var periode = $('#periode').val();
        var akun_pajak = $("#akun_pajak").val();
        var status2 = $("#status2").val();
        var nama_skpd = $("#nama_skpd").val();
        var tampilawaluser = '1';
        $.ajax({
            url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampiluser',
            type: "GET",
            data: 'periode=' + periode + '&akun_pajak=' + akun_pajak + '&status2=' + status2,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
            });
    });

    $('body').on('click', '.caribarurekapsemuaopd', function (e) {
        e.preventDefault();
        var periode2 = $('#periode2').val();
        var status22 = $("#status22").val();
        // var nama_skpd24 = $("#nama_skpd24").val();
        var tampilawalrekapsemuaopduser = '3';
        $.ajax({
            url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawalrekapsemuaopduser +'/tampilrekapsemuaopduser',
            type: "GET",
            data: 'periode2=' + periode2 + '&status22=' + status22,
                success: function (data) {
                    $('.tampillaporangu1rekapsemuaopd').html(data);//menampilkan data ke dalam modal
                }
            });
    });

    $(document).ready(function(){
        $("#cetakpdfls").click(function(e){
            alert('a');
        });
    });

    $('body').on('click', '.resetbaru', function () {
        $('#forminput1a').show();
        $('#forminput1b').show(); 
        $('#forminput1c').show(); 
        $('#forminput1d').hide();
        $('#forminput1e').show();
        $('#forminput2a').hide(); 
        $('#forminput2b').hide(); 
        $('#forminput2c').hide(); 
        $('#forminput2d').hide(); 
        $('#forminput2e').hide();
        $('#forminput3b').hide();
        $('#forminput3e').hide();
        $('#tcari1').show(); 
        $('#treset1').show(); 
        $('#tcari2').hide(); 
        $('#treset2').hide(); 
        $('#treset3').hide(); 
        $('#tcari3').hide();
        $('#periode').val('').trigger('change');
        $('#akun_pajak').val('').trigger('change');
        $('#periode2').val('').trigger('change');
        $('#akun_pajak2').val('').trigger('change');
        $('#nama_skpd').val('').trigger('change');
        $('#status2').val('').trigger('change');
        $('#nama_skpd2').val('').trigger('change');
        $('#status22').val('').trigger('change');
        $('#status23').val('').trigger('change');
        $('#periode3').val('').trigger('change');
        $('#nama_skpd24').val('').trigger('change');
        var tampilawaluser = '1';
        $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampilawaluser',
                type: "GET",
                data: 'tampilawaluser=' + tampilawaluser,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
        });
    });

    $('body').on('click', '.resetbaru2', function () {
        $('#forminput1a').hide();
        $('#forminput1b').hide(); 
        $('#forminput1c').hide(); 
        $('#forminput1d').hide();
        $('#forminput1e').hide();
        $('#forminput2a').show(); 
        $('#forminput2b').show(); 
        $('#forminput2c').hide(); 
        $('#forminput2d').hide(); 
        $('#forminput2e').show();
        $('#forminput3b').hide();
        $('#forminput3e').hide();
        $('#tcari1').hide(); 
        $('#treset1').hide(); 
        $('#tcari2').show(); 
        $('#treset2').show(); 
        $('#treset3').hide(); 
        $('#tcari3').hide();
        $('#periode').val('').trigger('change');
        $('#akun_pajak').val('').trigger('change');
        $('#periode2').val('').trigger('change');
        $('#akun_pajak2').val('').trigger('change');
        $('#nama_skpd').val('').trigger('change');
        $('#status2').val('').trigger('change');
        $('#nama_skpd2').val('').trigger('change');
        $('#status22').val('').trigger('change');
        $('#status23').val('').trigger('change');
        $('#periode3').val('').trigger('change');
        $('#nama_skpd24').val('').trigger('change');
        var tampilawaluser = '1';
        $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampilawaluser',
                type: "GET",
                data: 'tampilawaluser=' + tampilawaluser,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
        });
    });

    $('#forminput1a').hide();
    $('#forminput1b').hide(); 
    $('#forminput1c').hide(); 
    $('#forminput1d').hide();
    $('#forminput1e').hide();
    $('#forminput2a').hide(); 
    $('#forminput2b').hide(); 
    $('#forminput3b').hide();
    $('#forminput2c').hide(); 
    $('#forminput2d').hide(); 
    $('#forminput2e').hide();
    $('#forminput3e').hide();
    $('#tcari1').hide(); 
    $('#treset1').hide(); 
    $('#tcari2').hide(); 
    $('#treset2').hide();
    $('#pilihrekap').hide();
    $('#tcari3').hide(); 
    $('#treset3').hide();



    function text1(x){
        if (x == 0){
            $('#forminput1a').show();
            $('#forminput1b').show(); 
            $('#forminput1c').show();
            $('#forminput1d').show();
            $('#forminput1e').show();
            $('#tcari1').show(); 
            $('#treset1').show();
            $('#forminput2a').hide();
            $('#forminput2b').hide(); 
            $('#forminput2c').hide();
            $('#forminput2d').hide();
            $('#forminput2e').hide();
            $('#tcari2').hide(); 
            $('#treset2').hide();
            // $('#pilihrekap').hide();
            // $('#tcari3').hide(); 
            // $('#treset3').hide();
            $('#forminput3e').hide();
            $('#forminput3b').hide();
                                
        } 
        if (x == 1){
            $('#forminput2a').show();
            $('#forminput2b').show(); 
            $('#forminput2c').hide();
            $('#forminput2d').hide();
            $('#forminput2e').show();
            $('#tcari2').show(); 
            $('#treset2').show();
            $('#forminput1a').hide();
            $('#forminput1b').hide(); 
            $('#forminput1c').hide();
            $('#forminput1d').hide();
            $('#forminput1e').hide();
            $('#tcari1').hide(); 
            $('#treset1').hide();
            // $('#pilihrekap').show();
            // $('#tcari3').hide(); 
            // $('#treset3').hide();
            $('#forminput3e').hide();
            $('#forminput3b').hide();
        }
    }

</script>