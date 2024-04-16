<?php
$id  = $_GET['id'];
$qry = $pdo->GetWhere('tb_alternatif', 'id_alternatif', $id);
$row = $qry->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_alternatif" => $row->id_alternatif,
    "nip"           => $row->nip,
    "nama"          => $row->nama,
    "kelamin"       => $row->kelamin,
    "tgl_lahir"     => $row->tgl_lahir,
    "tmp_lahir"     => $row->tmp_lahir
];

echo json_encode($result);
