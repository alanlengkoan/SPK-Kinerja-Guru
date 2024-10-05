<?php
$id  = $_GET['id'];
$qry = $pdo->GetWhere('tb_aspek', 'id_aspek', $id);
$row = $qry->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_aspek" => $row->id_aspek,
    "nama"     => $row->nama,
];

echo json_encode($result);
