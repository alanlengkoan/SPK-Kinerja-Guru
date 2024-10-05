    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Kompetensi</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li class="active">Kompetensi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul style="padding-left: 40px !important;">
                            <?php
                            $query  = $pdo->GetAll('tb_aspek', 'id_aspek');
                            $jumlah = $query->rowCount();
                            if ($jumlah > 0) {
                                while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                    <li>
                                        <b><?= $row->nama; ?></b>
                                    </li>

                                    <ol style="padding-left: 40px !important;">
                                        <?php
                                        $query2  = $pdo->GetWhere('tb_poin', 'id_aspek', $row->id_aspek);
                                        $jumlah2  = $query2->rowCount();
                                        if ($jumlah2 > 0) {
                                            while ($row2 = $query2->fetch(PDO::FETCH_OBJ)) { ?>
                                                <li><?= $row2->nama; ?></li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ol>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>