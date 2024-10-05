 <div class="breadcrumbs">
     <div class="col-sm-4">
         <div class="page-header float-left">
             <div class="page-title">
                 <h1>Poin</h1>
             </div>
         </div>
     </div>
     <div class="col-sm-8">
         <div class="page-header float-right">
             <div class="page-title">
                 <ol class="breadcrumb text-right">
                     <li><a href="dashboard">Dashboard</a></li>
                     <li class="active">Poin</li>
                 </ol>
             </div>
         </div>
     </div>
 </div>

 <div class="content mt-3">
     <div class="animated fadeIn">
         <div class="row">
             <div class="col-lg-12">
                 <!-- begin:: form -->
                 <div class="card">
                     <div class="card-header">
                         <strong>Form</strong>
                     </div>
                     <form class="form-horizontal" action="aksi/?aksi=poin_save" id="form-add-upd">
                         <!-- begin:: id -->
                         <input type="hidden" id="id_poin">
                         <!-- end:: id -->

                         <div class="card-body card-block">
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label for="nama" class=" form-control-label">Aspek&nbsp;*</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <select name="id_aspek" id="id_aspek" class="form-control form-control-sm">
                                         <option value="">- Pilih -</option>
                                         <?php
                                            $query = $pdo->GetAll('tb_aspek', 'id_aspek');
                                            while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                             <option value="<?= $row->id_aspek ?>"><?= $row->nama ?></option>
                                         <?php } ?>
                                     </select>
                                     <small class="help-block form-text error"></small>
                                 </div>
                             </div>
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label for="nama" class=" form-control-label">Nama&nbsp;*</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <input type="text" id="nama" name="nama" class="form-control form-control-sm" placeholder="Masukkan Nama" />
                                     <small class="help-block form-text error"></small>
                                 </div>
                             </div>
                         </div>
                         <div class="card-footer">
                             <button type="submit" name="add" id="add" class="btn btn-success btn-sm">
                                 <i class="fa fa-plus"></i> Tambah
                             </button>
                         </div>
                     </form>
                 </div>
                 <!-- end:: form -->
                 <!-- begin:: tabel -->
                 <div class="card">
                     <div class="card-header">
                         <h5>Tabel</h5>
                     </div>
                     <div class="card-body">
                         <table id="data-table" class="table table-striped table-bordered">
                             <thead align="center">
                                 <tr>
                                     <th>No</th>
                                     <th>Aspek</th>
                                     <th>Nama</th>
                                     <th>Aksi</th>
                                 </tr>
                             </thead>
                             <tbody align="center">
                                 <?php
                                    $sql    = "SELECT tb_poin.id_poin, tb_aspek.id_aspek, tb_aspek.nama as aspek, tb_poin.nama FROM tb_poin LEFT JOIN tb_aspek ON tb_aspek.id_aspek = tb_poin.id_aspek ORDER BY tb_poin.id_poin ASC";
                                    $query  = $pdo->Query($sql);
                                    $jumlah = $query->rowCount();
                                    $no = 1;
                                    if ($jumlah > 0) {
                                        while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                         <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $row->aspek; ?></td>
                                             <td><?= $row->nama; ?></td>
                                             <td>
                                                 <button class="btn btn-primary btn-sm btn-action" id="upd" data-id="<?= $row->id_poin ?>"><i class="fa fa-edit"></i> Ubah</button>&nbsp;
                                                 <button class="btn btn-danger btn-sm btn-action" id="del" data-id="<?= $row->id_poin ?>"><i class="fa fa-trash"></i> Hapus</button>
                                             </td>
                                         </tr>
                                     <?php } ?>
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