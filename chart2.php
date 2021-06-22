<?php include "template/header.php" ?>
<?php require "penghubung.php" ?>

<!-- Start content -->
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <h4 class="page-title float-left">Penghasilan per Tahun</h4>

          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <!-- end row -->

    <?php
    foreach ($tahun2005 as $tahun) {
      $bulan[] = (float)$tahun['bulan'];
      $penghasilan[] = (float)$tahun['penghasilan'];
    }
    foreach ($tahun2006 as $tahun6) {
      $bulan6[] = (float)$tahun6['bulan'];
      $penghasilan6[] = (float)$tahun6['penghasilan'];
    }
    ?>

    <div class="col-12">
      <div class="row">
        <div class="col-lg-6">
          <div class="card-box">
            <div class="m-t-10">
              <div id="2005" class="ct-chart ct-golden-section"></div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card-box">
            <div class="m-t-10">
              <div id="2006" class="ct-chart ct-golden-section"></div>
            </div>
          </div>
        </div>
      </div>
      <!--end row-->
    </div>
  </div> <!-- container -->
</div> <!-- content -->

<script type="text/javascript">
  // Create the chart

  Highcharts.chart('2005', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Tahun 2005'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      categories: <?= json_encode($bulan); ?>,
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Penghasilan per tahun'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{
      name: 'Hasil',
      data: <?= json_encode($penghasilan); ?>

    }]
  });
  Highcharts.chart('2006', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Tahun 2006'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      categories: <?= json_encode($bulan6); ?>,
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Penghasilan per tahun'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{
      name: 'Hasil',
      data: <?= json_encode($penghasilan6); ?>

    }]
  });
</script>

<?php include "template/footer.php" ?>