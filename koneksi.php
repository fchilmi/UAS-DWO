<?php

$dbHost = "localhost";
$dbDatabase = "whsakila2021";
$dbUser = "root";
$dbPassword = "";

$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);

$sql1 = mysqli_query($conn, "SELECT sum(amount) as total FROM fakta_pendapatan");

$customer = mysqli_query($conn, "SELECT count(customer_id) as tot_cust FROM customer");

$film = mysqli_query($conn, "SELECT count(judul) as tot_film FROM film");

$total = mysqli_fetch_row($sql1);
$tot_cust = mysqli_fetch_row($customer);
$tot_film = mysqli_fetch_row($film);

$sql = "SELECT concat('name:', s.nama_kota) as name, concat('y:',SUM(fp.amount)*100/'" . $total[0] . "') as y, concat('drilldown:', s.nama_kota) as drilldown
FROM fakta_pendapatan fp JOIN store s ON fp.store_id=s.store_id
GROUP BY s.nama_kota";

$sum_toko = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_all($sum_toko)) {
  $data[] = $row;
}
$json_sum_toko = json_encode($data);
// print_r($json_sum_toko);


//DRILLDOWN
$drill = "SELECT s.nama_kota, sum(fp.amount)
FROM fakta_pendapatan fp JOIN store s ON fp.store_id=s.store_id
GROUP BY s.nama_kota";

$hasil_perbulan = mysqli_query($conn, $drill);

while ($row = mysqli_fetch_all($hasil_perbulan)) {
  $hasil_toko[] = $row;
}

function cari_tot_toko($toko_dicari, $hasil_toko)
{
  $counter = 0;
  // echo $tot_all_kat[0];
  while ($counter < count($hasil_toko[0])) {
    if ($toko_dicari == $hasil_toko[0][$counter][0]) {
      $tot_kat = $hasil_toko[0][$counter][1];
      return $tot_kat;
    }
    $counter++;
  }
}

//query untuk ambil penjualan di kategori berdasarkan bulan (clean)
$toko_perbulan = "SELECT s.nama_kota, sum(fp.amount),t.bulan,t.tahun
FROM fakta_pendapatan fp JOIN store s ON fp.store_id=s.store_id
JOIN time t on fp.time_id=t.time_id
GROUP BY s.nama_kota, t.bulan";
$det_toko = mysqli_query($conn, $toko_perbulan);
$i = 0;
while ($row = mysqli_fetch_all($det_toko)) {
  //echo $row;
  $data_toko[] = $row;
}
$i = 0;

//inisiasi string DATA
$string_data = "";
$string_data .= '{name:"' . $data_toko[0][$i][0] . '", id:"' . $data_toko[0][$i][0] . '", data: [';


foreach ($data_toko[0] as $a) {

  if ($i < count($data_toko[0]) - 1) {
    if ($a[0] != $data_toko[0][$i + 1][0]) {
      $string_data .= '["' . $a[2] . '", ' .
        $a[1] . ']]},';
      $string_data .= '{name:"' . $data_toko[0][$i + 1][0] . '", id:"' . $data_toko[0][$i + 1][0] . '", data: [';
    } else {
      $string_data .= '["' . $a[2] . '", ' .
        $a[1] . '], ';
    }
  } else {

    $string_data .= '["' . $a[2] . '", ' .
      $a[1] . ']]}';
  }


  $i = $i + 1;
}
