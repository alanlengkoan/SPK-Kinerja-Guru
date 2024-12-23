    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Riwayat</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li class="active">Riwayat</li>
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
                                        <th>ID Guru</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Tempat Lahir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    $sql = "SELECT a.id_alternatif, a.nip, a.nama, a.kelamin, a.tgl_lahir, a.tmp_lahir FROM tb_alternatif as a ORDER BY a.id_alternatif ASC";
                                    $qry = $pdo->Query($sql);
                                    $sum = $qry->rowCount();
                                    $no  = 1;

                                    while ($row = $qry->fetch(PDO::FETCH_OBJ)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->nip; ?></td>
                                            <td><?= $row->nama; ?></td>
                                            <td><?= $row->kelamin; ?></td>
                                            <td><?= $myfun->tanggal_indo($row->tgl_lahir); ?></td>
                                            <td><?= $row->tmp_lahir; ?></td>
                                            <td>
                                                <a href="content/riwayat_cetak.php?id_alternatif=<?= $row->id_alternatif ?>" class="btn btn-info btn-sm btn-action" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a>
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