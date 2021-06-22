<?php include "template/header.php" ?>
<?php include "koneksi.php" ?>

<!-- Start content -->
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <h4 class="page-title float-left">Penghasilan per Toko</h4>

          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <!-- end row -->

    <div class="row">
      <div class="col-xl-4 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
          <i class="mdi mdi-currency-usd widget-two-icon"></i>
          <div class="wigdet-two-content">
            <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Revenue</p>
            <h2 class="font-600"><span></span> <span data-plugin="counterup"><?= $total[0]; ?></span></h2>
            <p class="m-0"><br></p>
          </div>
        </div>
      </div><!-- end col -->

      <div class="col-xl-4 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
          <i class="mdi mdi-account-multiple widget-two-icon"></i>
          <div class="wigdet-two-content">
            <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Customer</p>
            <h2 class="font-600"><span></span> <span data-plugin="counterup"><?= $tot_cust[0]; ?></span></h2>
            <p class="m-0">2005-2006</p>
          </div>
        </div>
      </div><!-- end col -->

      <div class="col-xl-4 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
          <i class="mdi mdi-crown widget-two-icon"></i>
          <div class="wigdet-two-content">
            <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Film</p>
            <h2 class="font-600"><span></span> <span data-plugin="counterup"><?= $tot_film[0]; ?></span></h2>
            <p class="m-0">2005-2006</p>
          </div>
        </div>
      </div><!-- end col -->

    </div>

    <div class="row">
      <div class="col-12">
        <div class="card-box">
          <div class="m-t-30" id="container"></div>
        </div>
      </div>
    </div>


  </div> <!-- container -->

</div> <!-- content -->

<script type="text/javascript">
  // Create the chart
  Highcharts.chart('container', {
    chart: {
      type: 'pie'
    },
    title: {
      text: 'Persentase Nilai Penjualan Tiap Toko (WH Sakila)'
    },
    subtitle: {
      text: 'Klik di potongan kue untuk melihat detail nilai '
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

            $datanya = $json_sum_toko;
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