<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Visin Google Charts</title>
<link rel="stylesheet" href="<?php echo base_url('vendor/uikit/css/'); ?>uikit.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
    body {
        background-image: url('assets/bg.jpg');
        background-size: cover;
    }
</style>



<script type="text/javascript">
    // Mengambil API visualisasi.
    google.charts.load('current', {'packages':['corechart']});
    //mengambil data dari variabel PHP
    var region=[];
    region['dataStr'] = '<?php echo $region;?>';        
    region['dataArray'] = JSON.parse(region['dataStr']);


    var jenis=[];
    jenis['dataStr'] = '<?php echo $jenis;?>';        
    jenis['dataArray'] = JSON.parse(jenis['dataStr']); 


    var tahun=[];
    tahun['dataStr'] = '<?php echo $tahun;?>';        
    tahun['dataArray'] = JSON.parse(tahun['dataStr']);  

    //menggambar grafik
    google.charts.setOnLoadCallback(function(){
        drawChart(region['dataArray'],'pie','region'); 
        drawChart(jenis['dataArray'],'bar','jenis'); 
        drawChart(tahun['dataArray'],'bar','tahun');   
    });



    // Menentukan data yang akan ditampilkan
    function drawChart(dataArray,type,container) {
        // Membuat data tabel yang sesuai dengan format google chart dari sumber data array javascript
        var data = new google.visualization.arrayToDataTable(dataArray,false);      
        // Tentukan pengaturan chart
        var options = {
            legend:'bottom',            
            titlePosition:'none',
            titleTextStyle:{fontSize:18},
            chartArea:{width:'80%',height:'70%'}                      
            };
        if(type == 'pie')
        {
            var chart = new google.visualization.PieChart(document.getElementById(container));
        }
        if(type == 'column')
        {
            var chart = new google.visualization.ColumnChart(document.getElementById(container));
        }
        if(type == 'bar')
        {
            var chart = new google.visualization.BarChart(document.getElementById(container));
        }
        chart.draw(data, options);
    }
</script>




<nav class="uk-navbar-container uk-margin" uk-navbar>
    <div class="uk-navbar-center">
        <a class="uk-navbar-item uk-logo" href="#" style="text-align:center">Profil Sarana Kesehatan Provinsi RIAU</a>
    </div>
</nav>
<div class="uk-container">
    <div class="uk-child-width-1-2@s" uk-grid uk-height-match="target: > div > .uk-card">    
        <div>
            <div class="uk-card uk-card-default uk-card-small uk-card-body" >
                <h3 class="uk-card-title">Jumlah Sarana Kesehatan Berdasarkan Kabupaten/Kota</h3>
                <div id="region" style="height:350px;"></div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-small uk-card-body" >
                <h3 class="uk-card-title">Jumalah Sarana Kesehatan 2019</h3>
                <div id="jenis" style="height:350px;"></div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-small uk-card-body" >
                <h3 class="uk-card-title">Peningkatan Sarana Kesehatan Tahun 2019</h3>
                <div id="tahun" style="height:350px;"></div>
            </div>
        </div>
        <div>
        </div>
    </div>
</div>

<body>
<div class="uk-flex uk-flex-column uk-flex-middle uk-flex-center" style="background-color:#; height:300px;">
<div id="diagram-pie"></div>
</div>
<script src="<?php echo base_url('vendor/uikit/js/'); ?>uikit.js"></script>
</body>

</head>
</html>
