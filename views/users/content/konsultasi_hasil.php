   <?php
    // untuk alternatif
    $sql_alternatif = "SELECT id_alternatif, nip, nama, kelamin, tmp_lahir, tgl_lahir FROM tb_alternatif";
    $res_alternatif = $pdo->Query($sql_alternatif);
    $alternatif     = [];
    $guru           = [];
    while ($row_a = $res_alternatif->fetch(PDO::FETCH_OBJ)) {
        $alternatif[$row_a->id_alternatif] = $row_a->nama;
        $guru[$row_a->id_alternatif]       = $row_a;
    }

    // untuk kriteria
    $sql_kriteria = "SELECT id_kriteria, nama, bobot, tipe FROM tb_kriteria";
    $res_kriteria = $pdo->Query($sql_kriteria);
    $kriteria     = [];
    while ($row_k = $res_kriteria->fetch(PDO::FETCH_OBJ)) {
        $kriteria[$row_k->id_kriteria] = [
            'nama'  => $row_k->nama,
            'bobot' => $row_k->bobot,
            'tipe'  => $row_k->tipe
        ];
    }

    // untuk evaluasi
    $sql_evaluasi = "SELECT * FROM tb_evaluasi ORDER BY id_alternatif, id_kriteria";
    $res_evaluasi = $pdo->Query($sql_evaluasi);
    $evaluasi     = [];
    while ($row_e = $res_evaluasi->fetch(PDO::FETCH_OBJ)) {
        if (!isset($evaluasi[$row_e->id_alternatif])) {
            $evaluasi[$row_e->id_alternatif] = [];
        }
        $evaluasi[$row_e->id_alternatif][$row_e->id_kriteria] = $row_e->nilai;
    }

    $jumlah_kriteria = count($kriteria);

    $pembobotan = [];
    foreach ($evaluasi as $key => $value) {
        foreach ($value as $k => $v) {
            $pembobotan[$k][$key] = $v;
        }
    }

    $alternatif_nol = [];
    foreach ($pembobotan as $key => $value) {
        foreach ($value as $k => $v) {
            if ($kriteria[$key]['tipe'] == 'benefit') {
                $alternatif_nol[0][$key] = max($value);
            } else {
                $alternatif_nol[0][$key] = min($value);
            }
        }
    }

    $matriks_keputusan = array_merge($alternatif_nol, $evaluasi);

    $matriks_normalisasi = [];
    foreach ($matriks_keputusan as $key => $value) {
        foreach ($value as $k => $v) {
            $matriks_normalisasi[$k][$key] = $v;
        }
    }

    $normalisasi = [];
    foreach ($matriks_normalisasi as $key => $value) {
        $cost = [];
        foreach ($value as $k_c => $v_c) {
            if ($kriteria[$key]['tipe'] == 'cost') {
                $cost[$key][] = (1 / $v_c);
            }
        }

        foreach ($value as $k => $v) {
            if ($kriteria[$key]['tipe'] == 'benefit') {
                $normalisasi[$k][$key] = ($v / array_sum($matriks_normalisasi[$key]));
            } else {
                $normalisasi[$k][$key] = (1 / $v) / array_sum($cost[$key]);
            }
        }
    }

    $normalisasi_terbobot = [];
    foreach ($kriteria as $key => $value) {
        foreach ($normalisasi as $k => $v) {
            $normalisasi_terbobot[$k][$key] = $v[$key] * $value['bobot'];
        }
    }

    $si = [];
    foreach ($normalisasi_terbobot as $key => $value) {
        $si[$key] = array_sum($value);
    }

    $hasil_akhir = [];
    foreach ($normalisasi_terbobot as $key => $value) {
        foreach ($value as $k => $v) {
            if ($key != 0) {
                $hasil_akhir[$key][$k] = $v;
            }
        }
    }

    $perangkingan = [];
    foreach ($si as $key => $value) {
        if ($key != 0) {
            $perangkingan[$key] = $value / $si[0];
        }
    }

    if (count($evaluasi) == 0) {
        echo "<script>alert('Belum ada data yang ingin di proses!');window.location.href='konsultasi';</script>";
    }
    ?>

   <div class="breadcrumbs">
       <div class="col-sm-4">
           <div class="page-header float-left">
               <div class="page-title">
                   <h1>Hasil Konsultasi</h1>
               </div>
           </div>
       </div>
       <div class="col-sm-8">
           <div class="page-header float-right">
               <div class="page-title">
                   <ol class="breadcrumb text-right">
                       <li><a href="dashboard">Dashboard</a></li>
                       <li class="active">Hasil Konsultasi</li>
                   </ol>
               </div>
           </div>
       </div>
   </div>

   <div class="content mt-3">
       <div class="animated fadeIn">
           <div class="row">
               <div class="col-lg-12">
                   <div class="card">
                       <div class="card-header">
                           <h5>Inisialisasi Bobot</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Alternatif</th>
                                       <?php foreach ($kriteria as $key => $value) : ?>
                                           <th><?= $value['nama'] ?></th>
                                       <?php endforeach; ?>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($evaluasi as $key => $value) : ?>
                                       <tr>
                                           <td><?= $alternatif[$key] ?></td>
                                           <?php foreach ($value as $k => $v) : ?>
                                               <td><?= $v ?></td>
                                           <?php endforeach; ?>
                                       </tr>
                                   <?php endforeach; ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h5>Matriks Keputusan</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Alternatif</th>
                                       <?php foreach ($kriteria as $key => $value) : ?>
                                           <th><?= $value['nama'] ?></th>
                                       <?php endforeach; ?>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($matriks_keputusan as $key => $value) : ?>
                                       <tr>
                                           <td><?= (empty($key) ? '<b>A0</b>' : $alternatif[$key]) ?></td>
                                           <?php foreach ($value as $k => $v) : ?>
                                               <td><?= ($key === 0 ? '<b>' . $v . '</b>' : $v) ?></td>
                                           <?php endforeach; ?>
                                       </tr>
                                   <?php endforeach; ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h5>Normalisasi</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Alternatif</th>
                                       <?php foreach ($kriteria as $key => $value) : ?>
                                           <th><?= $value['nama'] ?></th>
                                       <?php endforeach; ?>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($normalisasi as $key => $value) : ?>
                                       <tr>
                                           <td><?= (empty($key) ? '<b>A0</b>' : $alternatif[$key]) ?></td>
                                           <?php foreach ($value as $k => $v) : ?>
                                               <td><?= ($key === 0 ? '<b>' . $v . '</b>' : $v) ?></td>
                                           <?php endforeach; ?>
                                       </tr>
                                   <?php endforeach; ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h5>Normalisasi Terbobot</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Alternatif</th>
                                       <?php foreach ($kriteria as $key => $value) : ?>
                                           <th><?= $value['nama'] ?></th>
                                       <?php endforeach; ?>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($normalisasi_terbobot as $key => $value) : ?>
                                       <tr>
                                           <td><?= (empty($key) ? '<b>A0</b>' : $alternatif[$key]) ?></td>
                                           <?php foreach ($value as $k => $v) : ?>
                                               <td><?= ($key === 0 ? '<b>' . $v . '</b>' : $v) ?></td>
                                           <?php endforeach; ?>
                                       </tr>
                                   <?php endforeach; ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h5>Nilai Utility</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Alternatif</th>
                                       <?php foreach ($kriteria as $key => $value) : ?>
                                           <th><?= $value['nama'] ?></th>
                                       <?php endforeach; ?>
                                       <th>Si</th>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($normalisasi_terbobot as $key => $value) : ?>
                                       <tr>
                                           <td><?= (empty($key) ? '<b>A0</b>' : $alternatif[$key]) ?></td>
                                           <?php foreach ($value as $k => $v) : ?>
                                               <td><?= ($key === 0 ? '<b>' . $v . '</b>' : $v) ?></td>
                                           <?php endforeach; ?>
                                           <td><?= $si[$key] ?></td>
                                       </tr>
                                   <?php endforeach; ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h5>Hasil Akhir</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Alternatif</th>
                                       <?php foreach ($kriteria as $key => $value) : ?>
                                           <th><?= $value['nama'] ?></th>
                                       <?php endforeach; ?>
                                       <th>Ki</th>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($hasil_akhir as $key => $value) : ?>
                                       <tr>
                                           <td><?= $alternatif[$key] ?></td>
                                           <?php foreach ($value as $k => $v) : ?>
                                               <td><?= ($key === 0 ? '<b>' . $v . '</b>' : $v) ?></td>
                                           <?php endforeach; ?>
                                           <td><?= $perangkingan[$key] ?></td>
                                       </tr>
                                   <?php endforeach; ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h5>Perangkingan</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Rangking</th>
                                       <th>ID</th>
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
                                    arsort($perangkingan);
                                    $index = key($perangkingan);
                                    $riwayat = [];

                                    $rangking = 1;
                                    foreach ($perangkingan as $key => $value) :
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

                                        $riwayat[] = [
                                            'id_alternatif' => $key,
                                            'date'          => date('Y-m-d'),
                                            'nilai'         => $value,
                                            'grade'         => $grade,
                                            'predikat'      => $predikat,
                                            'status'        => $status
                                        ];
                                    ?>
                                       <tr>
                                           <td><?= $rangking++ ?></td>
                                           <td><?= $guru[$key]->nip ?></td>
                                           <td><?= $guru[$key]->nama ?></td>
                                           <td><?= $guru[$key]->kelamin ?></td>
                                           <td><?= $guru[$key]->tgl_lahir ?></td>
                                           <td><?= $guru[$key]->tmp_lahir ?></td>
                                           <td><?= $nilai ?></td>
                                           <td><?= $grade ?></td>
                                           <td><?= $predikat ?></td>
                                           <td><?= $status ?></td>
                                       </tr>
                                   <?php endforeach; ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h5>Hasil</h5>
                       </div>
                       <div class="card-body">
                           Berdasarkan Hasil perhitungan Metode Aras, Alternatif <b><?= $alternatif[$index] ?></b> dengan nilai akhir <b><?= $perangkingan[$index] ?></b> adalah Peringkat 1.
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   </div>

   <?php
    $hasil_metode = json_encode($perangkingan);

    // insert hasil
    $pdo->Insert("tb_evaluasi_hasil", ["hasil", "tgl"], [$hasil_metode, date('Y-m-d')]);
    // insert riwayat
    foreach ($riwayat as $key => $value) {
        $pdo->Insert(
            "tb_riwayat",
            [
                "id_alternatif",
                "date",
                "nilai",
                "grade",
                "predikat",
                "status"
            ],
            [
                $value['id_alternatif'],
                $value['date'],
                $value['nilai'],
                $value['grade'],
                $value['predikat'],
                $value['status']
            ]
        );
    }
    // truncate evaluasi
    $pdo->Truncate("tb_evaluasi");
    ?>