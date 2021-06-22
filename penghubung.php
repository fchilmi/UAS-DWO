<?php

$dbHost = "localhost";
$dbDatabase = "whsakila2021";
$dbUser = "root";
$dbPassword = "";

$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);

$sql1 = mysqli_query($conn, "SELECT sum(amount) as total FROM fakta_pendapatan");

$total = mysqli_fetch_row($sql1);

$thn05 = "SELECT t.tahun as name, t.bulan as bulan, SUM(fp.amount) as penghasilan FROM fakta_pendapatan fp JOIN store s ON fp.store_id = s.store_id JOIN time t ON fp.time_id = t.time_id WHERE t.tahun = 2005 GROUP BY t.bulan";

$thn06 = "SELECT t.tahun as name, t.bulan bulan, SUM(fp.amount) as penghasilan FROM fakta_pendapatan fp JOIN store s ON fp.store_id = s.store_id JOIN time t ON fp.time_id = t.time_id WHERE t.tahun = 2006 GROUP BY t.bulan";

$sql = "SELECT concat('name:', t.tahun) as name, concat('y:',SUM(fp.amount)) as y, concat('drilldown:', t.tahun) as drilldown FROM fakta_pendapatan fp 
JOIN store s ON fp.store_id = s.store_id JOIN 
time t ON fp.time_id = t.time_id GROUP BY t.tahun";

$sum_tahun = mysqli_query($conn, $sql);
$tahun2005 = mysqli_query($conn, $thn05);
$tahun2006 = mysqli_query($conn, $thn06);

while ($row = mysqli_fetch_all($sum_tahun)) {
    $data[] = $row;
}
while ($row = mysqli_fetch_all($tahun2005)) {
    $data05[] = $row;
}
while ($row = mysqli_fetch_all($tahun2006)) {
    $data06[] = $row;
}

$json_sum_tahun = json_encode($data);
$json_tahun_2005 = json_encode($data05);
$json_tahun_2006 = json_encode($data06);
// print_r($data05[0]);
// print_r($json_tahun_2006);

// print_r($bulan);
