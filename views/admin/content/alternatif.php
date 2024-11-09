 <div class="breadcrumbs">
     <div class="col-sm-4">
         <div class="page-header float-left">
             <div class="page-title">
                 <h1>Guru</h1>
             </div>
         </div>
     </div>
     <div class="col-sm-8">
         <div class="page-header float-right">
             <div class="page-title">
                 <ol class="breadcrumb text-right">
                     <li><a href="dashboard">Dashboard</a></li>
                     <li class="active">Guru</li>
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
                     <form class="form-horizontal" action="aksi/?aksi=alternatif_save" id="form-add-upd">
                         <!-- begin:: id -->
                         <input type="hidden" id="id_alternatif">
                         <!-- end:: id -->

                         <div class="card-body card-block">
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label for="nama" class=" form-control-label">Nama&nbsp;*</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <input type="text" id="nama" name="nama" class="form-control form-control-sm" placeholder="Masukkan Nama Guru" />
                                     <small class="help-block form-text error"></small>
                                 </div>
                             </div>
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label for="kelamin" class=" form-control-label">Kelamin&nbsp;*</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <select name="kelamin" id="kelamin" class="form-control form-control-sm">
                                         <option value="">- Pilih -</option>
                                         <option value="L">Laki-laki</option>
                                         <option value="P">Perempuan</option>
                                     </select>
                                     <small class="help-block form-text error"></small>
                                 </div>
                             </div>
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label for="tgl_lahir" class=" form-control-label">Tanggal Lahir&nbsp;*</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control form-control-sm" />
                                     <small class="help-block form-text error"></small>
                                 </div>
                             </div>
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label for="tmp_lahir" class=" form-control-label">Tempat Lahir&nbsp;*</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control form-control-sm" placeholder="Masukkan Tempat Lahir" />
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
                                     <th>ID</th>
                                     <th>Nama</th>
                                     <th>Kelamin</th>
                                     <th>Tanggal Lahir</th>
                                     <th>Tempat Lahir</th>
                                     <th>Aksi</th>
                                 </tr>
                             </thead>
                             <tbody align="center">
                                 <?php
                                    $sql    = "SELECT tb_alternatif.id_alternatif, tb_alternatif.nip, tb_alternatif.nama,  tb_alternatif.kelamin, tb_alternatif.tgl_lahir, tb_alternatif.tmp_lahir FROM tb_alternatif ORDER BY tb_alternatif.id_alternatif ASC";
                                    $query  = $pdo->Query($sql);
                                    $jumlah = $query->rowCount();
                                    $no = 1;
                                    if ($jumlah > 0) {
                                        while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                         <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $row->nip; ?></td>
                                             <td><?= $row->nama; ?></td>
                                             <td><?= $row->kelamin; ?></td>
                                             <td><?= $myfun->tanggal_indo($row->tgl_lahir); ?></td>
                                             <td><?= $row->tmp_lahir; ?></td>
                                             <td>
                                                 <button class="btn btn-primary btn-sm btn-action" id="upd" data-id="<?= $row->id_alternatif ?>"><i class="fa fa-edit"></i> Ubah</button>&nbsp;
                                                 <button class="btn btn-danger btn-sm btn-action" id="del" data-id="<?= $row->id_alternatif ?>"><i class="fa fa-trash"></i> Hapus</button>
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