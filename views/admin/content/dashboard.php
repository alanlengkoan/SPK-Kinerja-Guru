    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                Selamat datang <b>Wakil Kepala Sekolah</b> di sistem pendukung keputusan Metode Aras.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        Sistem Pendukung Keputusan Penilaian Kinerja Guru SMA Frater Makassar
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Guru</div>
                            <div class="stat-digit">
                                <?php
                                $qry_alternatif = $pdo->GetAll('tb_alternatif', 'id_alternatif');
                                $sum_alternatif = $qry_alternatif->rowCount();
                                echo $sum_alternatif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Aspek</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria = $pdo->GetAll('tb_aspek', 'id_aspek');
                                $sum_kriteria = $qry_kriteria->rowCount();
                                echo $sum_kriteria;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Poin</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria_sub = $pdo->GetAll('tb_poin', 'id_poin');
                                $sum_kriteria_sub = $qry_kriteria_sub->rowCount();
                                echo $sum_kriteria_sub;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Pertanyaan</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria = $pdo->GetAll('tb_kriteria', 'id_kriteria');
                                $sum_kriteria = $qry_kriteria->rowCount();
                                echo $sum_kriteria;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Skala</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria_sub = $pdo->GetAll('tb_kriteria_sub', 'id_kriteria_sub');
                                $sum_kriteria_sub = $qry_kriteria_sub->rowCount();
                                echo $sum_kriteria_sub;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Kompetensi</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria_sub = $pdo->GetAll('tb_kriteria_sub', 'id_kriteria_sub');
                                $sum_kriteria_sub = $qry_kriteria_sub->rowCount();
                                echo $sum_kriteria_sub;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Penilaian</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria_sub = $pdo->GetAll('tb_kriteria_sub', 'id_kriteria_sub');
                                $sum_kriteria_sub = $qry_kriteria_sub->rowCount();
                                echo $sum_kriteria_sub;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Kepala Sekolah</div>
                            <div class="stat-digit">
                                <?php
                                $qry_users = $pdo->GetWhere('tb_users', 'level', 'kepsek');
                                $sum_users = $qry_users->rowCount();
                                echo $sum_users;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>