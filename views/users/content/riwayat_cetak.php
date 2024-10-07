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

// untuk alternatif
$sql_alternatif = "SELECT * FROM tb_alternatif";
$res_alternatif = $pdo->Query($sql_alternatif);
$alternatif = [];
while ($row_a = $res_alternatif->fetch(PDO::FETCH_OBJ)) {
    $alternatif[$row_a->id_alternatif] = $row_a;
}

// ambil data laporan
$id_riwayat   = $_GET['id_riwayat'];
$qryLaporan   = $pdo->GetWhere('tb_riwayat', 'id_riwayat', $id_riwayat);
$rowLaporan   = $qryLaporan->fetch(PDO::FETCH_OBJ);
$hasil_metode = json_decode($rowLaporan->hasil, true);
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

    <h3>Hasil Konsultasi</h3>

    <br /><br />

    <table align="center" border="1">
        <thead>
            <tr>
                <th>Ranking</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Lahir</th>
                <th>Nilai</th>
                <th>Grade</th>
                <th>Predikat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php
            arsort($hasil_metode);
            $index = key($hasil_metode);

            $ranking = 1;
            foreach ($hasil_metode as $key => $value) {
                $nilai = round(($value * 100), 0);

                if ($nilai > 80) {
                    $grade    = 'A';
                    $predikat = 'Sangat Baik';
                    $status   = 'Reward';
                } elseif ($nilai > 75) {
                    $grade    = 'B';
                    $predikat = 'Baik';
                    $status   = 'Reward';
                } elseif ($nilai > 70) {
                    $grade    = 'C';
                    $predikat = 'Kurang Baik';
                    $status   = 'Evaluasi';
                } elseif ($nilai > 55) {
                    $grade    = 'D';
                    $predikat = 'Tidak Baik';
                    $status   = 'Evaluasi & Konsekuensi';
                } else {
                    $grade    = 'E';
                    $predikat = 'Sangat Tidak Baik';
                    $status   = 'Evaluasi & Konsekuensi';
                }
            ?>
                <tr>
                    <td><?= $ranking++ ?></td>
                    <td><?= $alternatif[$key]->nip ?></td>
                    <td><?= $alternatif[$key]->nama ?></td>
                    <td><?= $alternatif[$key]->kelamin ?></td>
                    <td><?= $alternatif[$key]->tgl_lahir ?></td>
                    <td><?= $alternatif[$key]->tmp_lahir ?></td>
                    <td><?= $nilai ?></td>
                    <td><?= $grade ?></td>
                    <td><?= $predikat ?></td>
                    <td><?= $status ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br /><br />

    <p>
        Berdasarkan Hasil Keputusan perhitungan Metode Aras, Guru atas nama <b><?= $alternatif[$index]->nama ?></b> dengan nilai akhir <b><?= $hasil_metode[$index] ?></b> adalah Peringkat 1.
    </p>

    <br /><br />

    <h3>Keterangan</h3>

    <br /><br />

    <table align="center" border="1">
        <thead>
            <tr>
                <th>Nilai</th>
                <th>Grade</th>
                <th>Predikat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>80 - 100</td>
                <td>A</td>
                <td>Sangat Baik</td>
                <td>Reward</td>
            </tr>
            <tr>
                <td>75 - 79</td>
                <td>B</td>
                <td>Baik</td>
                <td>Reward</td>
            </tr>
            <tr>
                <td>70 - 74</td>
                <td>C</td>
                <td>Kurang Baik</td>
                <td>Evaluasi</td>
            </tr>
            <tr>
                <td>55 - 69</td>
                <td>D</td>
                <td>Tidak Baik</td>
                <td>Evaluasi & Konsekuensi</td>
            </tr>
            <tr>
                <td>0 - 54</td>
                <td>E</td>
                <td>Sangat Tidak Baik</td>
                <td>Evaluasi & Konsekuensi</td>
            </tr>
        </tbody>
    </table>

    <br /><br /><br /><br /><br /><br /><br /><br />

    <table>
        <tr>
            <td width="500"></td>
            <td>
                <p>Mengetahui,</p>
                <p>Kepala SMA Frater Makassar</p>
                <br />
                <br />
                <br />
                <br />
                <p class="nama">Fr. Silvianus Gole HHK, M.Pd</p>
                <p>NIP. 19810311 200903 1 001</p>
            </td>
        </tr>
    </table>
</div>

<?php
// proses untuk menampilkan file pdf
$content = ob_get_clean();
include_once "./../../../vendors/html2pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Cetak Riwayat.pdf');
?>