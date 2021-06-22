<?php
if (isset($_GET['pesan'])) {
  if ($_GET['pesan'] == "login") {
  }
} else {
  // echo "<script>window.alert('Maaf Salah')</script>";
  header("location:login.php");
}
?>
<?php include "template/header.php" ?>
<?php require "database.php" ?>
<!-- Start content -->
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <h4 class="page-title float-left">Example Pak Irwan</h4>

          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <!-- end row -->

    <div class="row">
      <div class="col-12">
        <div class="card-box">
          <div class="m-t-30" id="contoh"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card-box" style="height: 500px;">
          <iframe name="mondrian" src="http://localhost:8080/mondrian/index.html" style="height:100%; width:100%; border:none; align-content:center"> </iframe>
        </div>
      </div>
    </div>


  </div> <!-- container -->

</div> <!-- content -->

<script type="text/javascript">
  // Create the chart
  Highcharts.chart('contoh', {
    chart: {
      type: 'pie'
    },
    title: {
      text: 'Persentase Nilai Penjualan (WH Sakila) - Semua Kategori'
    },
    subtitle: {
      text: 'Klik di potongan kue untuk melihat detil nilai penjualan kategori berdasarkan bulan'
    },

    accessibility: {
      announceNewData: {
        enabled: true
      },
      point: {
        valueSuffix: '%'
      }
    },

    plotOptions: {
      series: {
        dataLabels: {
          enabled: true,
          format: '{point.name}: {point.y:.1f}%'
        }
      }
    },

    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total</br>'
    },

    series: [{
      name: "Pendapatan By Kategori",
      colorByPoint: true,
      data: <?php
            //TEKNIK GA JELAS

            $datanya = $json_all_kat;
            $data1 = str_replace('["', '{"', $datanya);
            $data2 = str_replace('"]', '"}', $data1);
            $data3 = str_replace('[[', '[', $data2);
            $data4 = str_replace(']]', ']', $data3);
            $data5 = str_replace(':', '" : "', $data4);
            $data6 = str_replace('"name"', 'name', $data5);
            $data7 = str_replace('"drilldown"', 'drilldown', $data6);
            $data8 = str_replace('"y"', 'y', $data7);
            $data9 = str_replace('",', ',', $data8);
            $data10 = str_replace(',y', '",y', $data9);
            $data11 = str_replace(',y : "', ',y : ', $data10);
            echo $data11;
            ?>

    }],
    drilldown: {
      series: [

        <?php
        //TEKNIK CLEAN
        echo $string_data;

        ?>



      ]
    }
  });
</script>

<?php include "template/footer.php" ?>