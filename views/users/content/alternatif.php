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