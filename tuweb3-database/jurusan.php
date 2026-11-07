<?php

header("Content-Type: application/json");

include "koneksi.php";

$data = [];
$query = mysqli_query(
    $conn,
    "SELECT * FROM tabel_jurusan"
);

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}
echo json_encode($data);