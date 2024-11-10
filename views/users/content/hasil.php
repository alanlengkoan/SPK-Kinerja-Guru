    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Hasil</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li class="active">Hasil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <!-- begin:: tabel -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Tabel</h5>
                        </div>
                        <div class="card-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead align="center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    $sql = "SELECT r.id_evaluasi_hasil, r.tgl AS tgl_konsul FROM tb_evaluasi_hasil AS r ORDER BY r.id_evaluasi_hasil";
                                    $qry = $pdo->Query($sql);
                                    $sum = $qry->rowCount();
                                    $no  = 1;

                                    while ($row = $qry->fetch(PDO::FETCH_OBJ)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->tgl_konsul ?></td>
                                            <td>
                                                <a href="content/hasil_cetak.php?id_evaluasi_hasil=<?= $row->id_evaluasi_hasil ?>" class="btn btn-info btn-sm btn-action" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end:: tabel -->
                </div>
            </div>
        </div>
    </div>
    </div>