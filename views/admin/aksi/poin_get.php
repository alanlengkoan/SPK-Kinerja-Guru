<?php
$id  = $_GET['id'];
$qry = $pdo->GetWhere('tb_poin', 'id_poin', $id);
$row = $qry->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_poin"  => $row->id_poin,
    "id_aspek" => $row->id_aspek,
    "nama"     => $row->nama,
];

echo json_encode($result);
