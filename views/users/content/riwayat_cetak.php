<?php
ob_start();
// untuk router
include_once '../../../configs/library/my_root.php';
// autoload class
spl_autoload_register('autoLoadClass');
// untuk memanggil class sql
$pdo = new sql;
// untuk class my_login
$mylog = new my_login;
// untuk class my_function
$myfun = new my_function;

$id_alternatif = $_GET['id_alternatif'];

$qry = $pdo->GetWhere('tb_alternatif', 'id_alternatif', $id_alternatif);
$row = $qry->fetch(PDO::FETCH_OBJ);

$qryLaporan = $pdo->GetWhere('tb_riwayat', 'id_alternatif', $id_alternatif);
$rowCount = $qryLaporan->rowCount();
?>

<!-- CSS -->
<style media="screen">
    .judul {
        padding: 4mm;
        text-align: center;
    }

    .nama {
        text-decoration: underline;
        font-weight: bold;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    h3 {
        font-family: times;
    }

    p {
        margin: 0;
    }
</style>
<!-- CSS -->

<div class="judul">
    <table align="center" border="0">
        <tr>
            <td align="center">
                <img src="./../../../assets/admin/images/logo.png" alt="" width="100">
            </td>
            <td width="" align="center">
                <h4>LAPORAN HASIL KEPUTUSAN PENILAIAN KINERJA GURU</h4>
                <h4>SMA FRATER MAKASSAR</h4>
            </td>
        </tr>
    </table>

    <hr>

    <br /><br />

    <h2>Riwayat Hasil Konsultasi</h2>

    <br /><br />

    <h3>Guru</h3>

    <table border="1" align="center">
        <tr>
            <td>ID Guru</td>
            <td>:</td>
            <td><?= $row->nip ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $row->nama ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?= $row->kelamin ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><?= $myfun->tanggal_indo($row->tgl_lahir) ?></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><?= $row->tmp_lahir ?></td>
        </tr>
    </table>

    <br /><br />

    <h3>Detail</h3>

    <?php if ($rowCount == 0) { ?>
        <p style="text-align: center;">Belum ada rekam data</p>
    <?php } else { ?>
        <table border="1" align="center">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nilai</th>
                    <th>Grade</th>
                    <th>Predikat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php while ($row = $qryLaporan->fetch(PDO::FETCH_OBJ)) { ?>
                    <tr>
                        <td><?= $row->date; ?></td>
                        <td><?= $row->nilai; ?></td>
                        <td><?= $row->grade; ?></td>
                        <td><?= $row->predikat; ?></td>
                        <td><?= $row->status; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php
// proses untuk menampilkan file pdf
$content = ob_get_clean();
include_once "./../../../vendors/html2pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Cetak Riwayat.pdf');
?>