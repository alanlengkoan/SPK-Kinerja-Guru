 <?php
    $query  = $pdo->GetAll('tb_aspek', 'id_aspek');
    $jumlah = $query->rowCount();
    $aspek  = [];
    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
        $aspek[$row->id_aspek] = $row->nama;
    }
    ?>

 <div class="breadcrumbs">
     <div class="col-sm-4">
         <div class="page-header float-left">
             <div class="page-title">
                 <h1>Konsultasi</h1>
             </div>
         </div>
     </div>
     <div class="col-sm-8">
         <div class="page-header float-right">
             <div class="page-title">
                 <ol class="breadcrumb text-right">
                     <li><a href="dashboard">Dashboard</a></li>
                     <li class="active">Konsultasi</li>
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
                     <form class="form-horizontal" action="aksi/?aksi=konsultasi_save" id="form-add-upd">
                         <!-- begin:: id -->
                         <input type="hidden" name="action" id="action" value="add" />
                         <!-- end:: id -->

                         <div class="card-body">
                             <!-- begin:: name menu tab -->
                             <ul class="nav nav-tabs" role="tablist">
                                 <li class="nav-item">
                                     <a class="nav-link active" href="#guru" data-toggle="tab">GURU</a>
                                 </li>
                                 <?php foreach ($aspek as $key => $value) { ?>
                                     <li class="nav-item">
                                         <a class="nav-link" href="#<?= strtolower($value) ?>" data-toggle="tab"><?= $value ?></a>
                                     </li>
                                 <?php } ?>
                             </ul>
                             <!-- end:: name menu tab -->
                             <!-- begin:: content menu tab -->
                             <div class="tab-content">
                                 <div id="guru" class="tab-pane active">
                                     <br>
                                     <div class="row form-group">
                                         <div class="col-12 col-md-12">
                                             <label for="nama" class=" form-control-label">Guru&nbsp;*</label>
                                         </div>
                                         <div class="col-12 col-md-12">
                                             <select name="id_alternatif" id="id_alternatif" class="form-control form-control-sm">
                                                 <option value="">- Pilih -</option>
                                                 <?php
                                                    $query = $pdo->GetAll('tb_alternatif', 'id_alternatif');
                                                    while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                                     <option value="<?= $row->id_alternatif ?>"><?= $row->nama ?></option>
                                                 <?php } ?>
                                             </select>
                                             <small class="help-block form-text error"></small>
                                         </div>
                                     </div>
                                 </div>
                                 <?php
                                    $num_row = 0;
                                    foreach ($aspek as $key => $value) { ?>
                                     <div id="<?= strtolower($value) ?>" class="tab-pane">
                                         <br>
                                         <?php
                                            $query2  = $pdo->GetWhere('tb_poin', 'id_aspek', $key);
                                            $jumlah2 = $query2->rowCount();
                                            if ($jumlah2 > 0) {
                                                while ($row2 = $query2->fetch(PDO::FETCH_OBJ)) { ?>
                                                 <p><?= $row2->nama; ?></p>

                                                 <?php
                                                    $query3   = $pdo->GetWhere('tb_kriteria', 'id_poin', $row2->id_poin);
                                                    $jumlah3  = $query3->rowCount();
                                                    if ($jumlah3 > 0) {
                                                        while ($row_k = $query3->fetch(PDO::FETCH_OBJ)) { ?>

                                                         <div class="row form-group">
                                                             <div class="col-12 col-md-12">
                                                                 <label for="bobot" class=" form-control-label"><?= $row_k->nama ?>&nbsp;*</label>
                                                             </div>
                                                             <div class="col-12 col-md-12">
                                                                 <input type="hidden" name="id_kriteria[]" value="<?= $row_k->id_kriteria ?>" />
                                                                 <select name="nilai[]" id="nilai_<?= $num_row++ ?>" class="form-control form-control-sm">
                                                                     <option value="">- Pilih -</option>
                                                                     <?php
                                                                        $query4 = $pdo->GetWhere('tb_kriteria_sub', 'id_kriteria', $row_k->id_kriteria);
                                                                        while ($row_s = $query4->fetch(PDO::FETCH_OBJ)) { ?>
                                                                         <option value="<?= $row_s->nilai ?>"><?= $row_s->nama ?></option>
                                                                     <?php } ?>
                                                                 </select>
                                                                 <small class="help-block form-text error"></small>
                                                             </div>
                                                         </div>

                                                     <?php } ?>
                                                 <?php } ?>

                                             <?php } ?>
                                         <?php } ?>
                                     </div>
                                 <?php } ?>
                             </div>
                             <!-- end:: content menu tab -->
                         </div>
                         <div class="card-footer">
                             <button type="submit" name="add" id="add" class="btn btn-success btn-sm">
                                 <i class="fa fa-plus"></i>&nbsp;Submit
                             </button>
                             &nbsp;
                             <a href="konsultasi_hasil" class="btn btn-primary btn-sm">
                                 <i class="fa fa-refresh"></i>&nbsp;Hasil
                             </a>
                         </div>
                     </form>

                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>