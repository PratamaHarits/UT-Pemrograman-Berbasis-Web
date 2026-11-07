<?php
header("Content-Type: application/json");

include "koneksi.php";

$aksi = $_GET['aksi'] ?? '';

if($aksi == 'lihat'){
    $data = [];
    $query = mysqli_query(
        $conn,
        "SELECT * FROM tabel_mhs"
    );
    while($row = mysqli_fetch_assoc($query)){
        $data[] = $row;
    }
    echo json_encode($data);
}

elseif($aksi == 'tambah'){
    $data = json_decode(
        file_get_contents("php://input"),
        true
    );
    mysqli_query(
        $conn,
        "INSERT INTO tabel_mhs
        (nim,nama,jurusan,fakultas)
        VALUES
        (
            '{$data['nim']}',
            '{$data['nama']}',
            '{$data['jurusan']}',
            '{$data['fakultas']}'
        )"
    );
    echo json_encode([
        "status"=>"sukses"
    ]);
}

elseif($aksi == 'edit'){
    $data = json_decode(
        file_get_contents("php://input"),
        true
    );
    mysqli_query(
        $conn,
        "UPDATE tabel_mhs SET
            nim='{$data['nim']}',
            nama='{$data['nama']}',
            jurusan='{$data['jurusan']}',
            fakultas='{$data['fakultas']}'
        WHERE id='{$data['id']}'"
    );
    echo json_encode([
        "status"=>"sukses"
    ]);
}

elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    mysqli_query(
        $conn,
        "DELETE FROM tabel_mhs
        WHERE id='$id'"
    );
    echo json_encode([
        "status"=>"sukses"
    ]);
}