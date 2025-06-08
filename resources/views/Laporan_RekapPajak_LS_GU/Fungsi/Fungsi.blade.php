<script>
    $(document).ready(function(){
        $(document).ready(function () {
            var tampilawal = '1';
            $.ajax({
                url: "{{ route('laporan.Rekap.index') }}" +'/' + tampilawal +'/tampilawal',
                type: "GET",
                data: 'tampilawal=' + tampilawal,
                success: function (data) {
                    $('.tampillaporanrekappajak').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    });

    $('body').on('click', '.caribaru', function (e) {
        e.preventDefault();
        var tgl_awal = $('#tgl_awal').val();
        var tgl_akhir = $("#tgl_akhir").val();
        var nama_skpd = $("#nama_skpd").val();
        var akun_pajak = $("#akun_pajak").val();
        var tampilawal = '1';
        $.ajax({
            url: "{{ route('laporan.Rekap.index') }}" +'/' + tampilawal +'/tampil',
            type: "GET",
            data: '&tgl_awal=' + tgl_awal + '&tgl_akhir=' + tgl_akhir + 'nama_skpd=' + nama_skpd + '&akun_pajak=' + akun_pajak,
                success: function (data) {
                    $('.tampillaporanrekappajak').html(data);//menampilkan data ke dalam modal
                }
            });
    });

    $(document).ready(function(){
        $("#cetakpdfls").click(function(e){
            alert('a');
        });
    });

    $('body').on('click', '.resetbaru', function () {
        $('#forminput1a').hide();
        $('#forminput1b').hide(); 
        $('#forminput1c').hide(); 
        $('#forminput1d').hide();
        $('#forminput1e').hide();
        $('#forminput2a').hide(); 
        $('#forminput2b').hide(); 
        $('#forminput2c').hide(); 
        $('#forminput2d').hide(); 
        $('#forminput2e').hide();
        $('#forminput3b').hide();
        $('#forminput3e').hide();
        $('#tcari1').hide(); 
        $('#treset1').hide(); 
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
        $('#tgl_awal').val('').trigger('change');
        $('#tgl_akhir').val('').trigger('change');
        $('#status23').val('').trigger('change');
        $('#periode3').val('').trigger('change');
        $('#nama_skpd24').val('').trigger('change');
        var tampilawal = '1';
        $.ajax({
                url: "{{ route('laporan.Rekap.index') }}" +'/' + tampilawal +'/tampilawal',
                type: "GET",
                data: 'tampilawal=' + tampilawal,
                success: function (data) {
                    $('.tampillaporanls1').html(data);//menampilkan data ke dalam modal
                }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '/laporanrekappajak/opd',
            method: 'GET',
            success: function(data) {
                $.each(data, function(index, opd) {
                    $('#nama_skpd').append(new Option(opd.nama_opd, opd.nama_opd)); // Ganti 'nama' dengan kolom yang sesuai
                });
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '/laporanrekappajak/opd',
            method: 'GET',
            success: function(data) {
                $.each(data, function(index, opd) {
                    $('#nama_skpd24').append(new Option(opd.nama_opd, opd.nama_opd)); // Ganti 'nama' dengan kolom yang sesuai
                });
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

    // var getLastMonths = function(n) {
    // var arr = new Array();

    // arr.push(moment().format('DD-MM-YYYY'));

    // for(var i=1; i< 2; i++){
    //     arr.push(moment().add(1, 'M').format('DD-MM-YYYY'));
    // }

    // return arr;
    // }
    // var appendOptions = function(arr) {
    // var html = '';
    // for(var i=0; i<arr.length; i++) {
    //     html += '<option value="' + arr[i] + '">' + arr[i] + '</option>'
    // }

    // document.getElementById('periode').innerHTML = html;

    // }
    // var months = getLastMonths(4);
    // appendOptions(months);

    // window.onload = function() {
    // var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];;
    // var date = new Date();

    // document.getElementById('periode').innerHTML = months[date.getMonth()] + ' ' + date.getFullYear();
    // };

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
            $('#forminput2d').show();
            $('#forminput2e').hide();
            $('#tcari2').hide(); 
            $('#treset2').hide();
            $('#pilihrekap').hide();
            $('#tcari3').hide(); 
            $('#treset3').hide();
            $('#forminput3e').hide();
            $('#forminput3b').hide();
                                
        } 
        if (x == 1){
            $('#forminput2a').hide();
            $('#forminput2b').hide(); 
            $('#forminput2c').hide();
            $('#forminput2d').hide();
            $('#forminput2e').hide();
            $('#tcari2').hide(); 
            $('#treset2').hide();
            $('#forminput1a').hide();
            $('#forminput1b').hide(); 
            $('#forminput1c').hide();
            $('#forminput1d').hide();
            $('#forminput1e').hide();
            $('#tcari1').hide(); 
            $('#treset1').hide();
            $('#pilihrekap').show();
            $('#tcari3').hide(); 
            $('#treset3').hide();
            $('#forminput3e').hide();
            $('#forminput3b').hide();
        }
    }

    function pilih(x){
        if (x == 0){
            $('#forminput1a').hide();
            $('#forminput1b').hide(); 
            $('#forminput1c').hide();
            $('#forminput1d').hide();
            $('#forminput1e').hide();
            $('#tcari1').hide(); 
            $('#treset1').hide();
            $('#forminput2a').hide();
            $('#forminput2b').show(); 
            $('#forminput2c').show();
            $('#forminput2d').hide();
            $('#forminput2e').show();
            $('#tcari2').show(); 
            $('#treset2').show();
            $('#pilihrekap').show();
            $('#tcari3').hide(); 
            $('#treset3').hide();
            $('#forminput3e').hide();
            $('#forminput3b').hide();
                                
        } 
        if (x == 1){
            $('#forminput2a').hide();
            $('#forminput2b').hide(); 
            $('#forminput2c').hide();
            $('#forminput2d').show();
            $('#forminput2e').hide();
            $('#tcari2').hide(); 
            $('#treset2').hide();
            $('#forminput1a').hide();
            $('#forminput1b').hide(); 
            $('#forminput1c').hide();
            $('#forminput1d').hide();
            $('#forminput1e').hide();
            $('#tcari1').hide(); 
            $('#treset1').hide();
            $('#pilihrekap').show();
            $('#tcari3').show(); 
            $('#treset3').show();
            $('#forminput3e').show();
            $('#forminput3b').show();
        }
    }

</script>

<script>
      // Export excel
      var tablesToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , tmplWorkbookXML = '<xml version="1.0"><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
          + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"><Author>Axel Richter</Author><Created>{created}</Created></DocumentProperties>'
          + '<Styles>'
          + '<Style ss:ID="Currency"><NumberFormat ss:Format="Currency"></NumberFormat></Style>'
          + '<Style ss:ID="Date"><NumberFormat ss:Format="Medium Date"></NumberFormat></Style>'
          + '</Styles>' 
          + '{worksheets}</Workbook>'
        , tmplWorksheetXML = '<Worksheet ss:Name="{nameWS}"><Table>{rows}</Table></Worksheet>'
        , tmplCellXML = '<Cell{attributeStyleID}{attributeFormula}><Data ss:Type="{nameType}">{data}</Data></Cell>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(tables, wsnames, wbname, appname) {
          var ctx = "";
          var workbookXML = "";
          var worksheetsXML = "";
          var rowsXML = "";

          for (var i = 0; i < tables.length; i++) {
            if (!tables[i].nodeType) tables[i] = document.getElementById(tables[i]);
            for (var j = 0; j < tables[i].rows.length; j++) {
              rowsXML += '<Row>'
              for (var k = 0; k < tables[i].rows[j].cells.length; k++) {
                var dataType = tables[i].rows[j].cells[k].getAttribute("data-type");
                var dataStyle = tables[i].rows[j].cells[k].getAttribute("data-style");
                var dataValue = tables[i].rows[j].cells[k].getAttribute("data-value");
                dataValue = (dataValue)?dataValue:tables[i].rows[j].cells[k].innerHTML;
                var dataFormula = tables[i].rows[j].cells[k].getAttribute("data-formula");
                dataFormula = (dataFormula)?dataFormula:(appname=='Calc' && dataType=='DateTime')?dataValue:null;
                ctx = {  attributeStyleID: (dataStyle=='Currency' || dataStyle=='Date')?' ss:StyleID="'+dataStyle+'"':''
                      , nameType: (dataType=='Number' || dataType=='DateTime' || dataType=='Boolean' || dataType=='Error')?dataType:'String'
                      , data: (dataFormula)?'':dataValue
                      , attributeFormula: (dataFormula)?' ss:Formula="'+dataFormula+'"':''
                      };
                rowsXML += format(tmplCellXML, ctx);
              }
              rowsXML += '</Row>'
            }
            ctx = {rows: rowsXML, nameWS: wsnames[i] || 'Sheet' + i};
            worksheetsXML += format(tmplWorksheetXML, ctx);
            rowsXML = "";
          }

          ctx = {created: (new Date()).getTime(), worksheets: worksheetsXML};
          workbookXML = format(tmplWorkbookXML, ctx);

    console.log(workbookXML);

          var link = document.createElement("A");
          link.href = uri + base64(workbookXML);
          link.download = wbname || 'Workbook.xls';
          link.target = '_blank';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }
      })();
</script>