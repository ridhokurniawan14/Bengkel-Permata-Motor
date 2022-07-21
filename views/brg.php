  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Barang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php if(!empty($_GET['e'])) { echo 'Edit Detail Barang'; } elseif(!empty($_GET['stok'])) { echo 'Edit Stok Barang'; } else { echo 'Detail Barang'; } ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <?php if(!empty($_GET['stok'])) { ?>
                <form method="post">
                  <div class="card-body">
                    <div class="row">                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Merk <code>*</code></label>
                          <input readonly name="merk" type="text" value="<?= ucwords($d[2]) ?>" class="form-control" id="exampleInputPassword1" placeholder="Merk Barang" required>
                        </div>                      
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama Barang <code>*</code></label>
                          <input readonly name="nm" type="text" value="<?= ucwords($d[3]) ?>" class="form-control" id="exampleInputPassword1" placeholder="Tulis Nama Barang Lengkap" required>
                        </div>    
                      </div>  
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputPassword1">STOK <code>*</code></label>
                          <input name="stok" id="txt1" value="<?= $d[4] ?>" type="number" class="form-control " placeholder="Harga Beli" required>                                                
                        </div>
                      </div>
                    </div>                    
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button name="upstok" type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="?p=brg"><button class="btn btn-default float-right">Cancel</button></a>
                  </div>
                </form>
                <?php } else {?>
                <form method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Jenis Barang <code>*</code></label>
                          <select name="jenis" autofocus class="form-control select2" style="width: 100%;" required>
                            <?php if($d[2] == !NULL)  { ?> <option value="<?= $d[1] ?>" selected="selected"><?= ucwords($d[1]) ?></option>  <?php } else { ?>
                            <option selected="selected">Pilih Jenis Barang</option><?php } ?>
                            <option value="accu">Accu</option>
                            <option value="ban">Ban</option>
                            <option value="oli">Oli</option>             
                          </select>                        
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Merk <code>*</code></label>
                          <input name="merk" type="text" value="<?= ucwords($d[2]) ?>" class="form-control" id="exampleInputPassword1" placeholder="Merk Barang" required>
                        </div>                      
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama Barang <code>*</code></label>
                          <input name="nm" type="text" value="<?= ucwords($d[3]) ?>" class="form-control" id="exampleInputPassword1" placeholder="Tulis Nama Barang Lengkap" required>
                        </div>    
                      </div>  
                    </div>
                    <div class="row">                                               
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Harga Beli (per item) <code>*</code></label>
                          <input name="hb" id="txt1" value="<?= $d[5] ?>" onkeyup="sum();"  type="text" class="form-control " placeholder="Harga Beli" required>                                                
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Harga Jual (per item) <code>*</code></label>
                          <input name="hj" id="txt2" value="<?= $d[6] ?>" onkeyup="sum();" type="text" class="form-control" placeholder="Harga Jual" required>                        
                        </div>    
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Untung (per item)</label>
                          <input name="untung" readonly type="number" class="form-control" id="txt3" placeholder="otomatis" value="<?= $d[7] ?>">                        
                        </div>
                      </div>                    
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <?php if(!empty($_GET['e'])){ ?><button name="update" type="submit" class="btn btn-primary">Update</button><?php }else{ ?><button name="save" type="submit" class="btn btn-primary">Simpan</button><?php } ?>
                    <a href="?p=brg"><button type="button" class="btn btn-default float-right">Cancel</button></a>
                  </div>
                </form>
                <?php } ?>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->          
        </div>
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-header">                                    
                  <form action="" method="post">
                  <div class="row">
                      <div class="col-md-5">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Jenis Barang</label>
                          <div class="col-sm-10">
                            <select name="jenis" autofocus class="form-control select2" style="width: 100%;" required>
                              <option value="all" selected="selected">Semua Barang</option>
                              <option value="accu">Accu</option>
                              <option value="ban">Ban</option>
                              <option value="oli">Oli</option>             
                            </select> 
                          </div>
                        </div>
                      </div>                      
                      <div class="col-md-2">
                        <div class="form-group row">
                          <div class="col-sm-12">                            
                            <button type="submit" name="filter" class="btn btn-primary col-sm-12">FILTER</button>
                          </div>
                        </div>
                      </div>
                      <?php if(isset($_POST['filter'])) { ?>
                      <div class="form-group col-sm-5">
                        <a target="_blank" href="?p=lpdf-brg&jenis=<?= $jenis ?>">
                          <button type="button" name="filter" class="btn btn-success col-sm-12">Download</button>
                        </a>
                      </div>                        
                      <?php } ?>
                  </div>    
                  </form>    
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">                  
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Jenis Barang</th>
                    <th>Nama Barang</th>                    
                    <th>Stok</th>       
                    <th>Harga Beli</th>                           
                    <th>Harga Jual</th>                           
                    <th>Total Harga Beli</th>                           
                    <th>Total Harga Jual</th>
                    <th></th>             
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $no   = 1;
                    foreach($data as $isi)
                    {
                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= ucwords($isi[1]) ?></td>
                    <td><?= ucwords($isi[3]).' ('.ucwords($isi[2]).')' ?></td>
                    <td><?= $isi[4] ?></td>
                    <td>Rp. <?= number_format($isi[5]) ?></td>
                    <td>Rp. <?= number_format($isi[6]) ?></td>
                    <td>Rp. <?= number_format($isi[8]) ?></td>
                    <td>Rp. <?= number_format($isi[9]) ?></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tindakan
                        </button>
                        <div class="dropdown-menu">                      
                          <a class="dropdown-item" href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-info<?php echo $isi[0]; ?>">Detail Barang</a>                          
                          <a class="dropdown-item" href="?p=brg&e=<?= $isi[0] ?>">Edit Barang</a>
                          <a class="dropdown-item" href="?p=brg&stok=<?= $isi[0] ?>">Edit Stok</a>
                          <a class="dropdown-item" href="?p=brg&d=<?= $isi[0].'" onclick="return confirm(\'Yakin dihapus?\')' ?> " >Hapus</a>
                        </div>
                      </div>      
                    </td>  
                  </tr>                  
                  <form role="form" action="" method="get">
                    <div class="modal modal fade" id="modal-info<?php echo $isi[0]; ?>">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">                          
                            <?php
                                $id = $isi[0]; 
                                $query_edit = $database -> tampil_detbrg($con,$id);
                                while ($row = mysqli_fetch_array($query_edit)) {  
                            ?>
                            <h4 class="modal-title">Detail Barang </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      1. Jenis Barang</label>                                      
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"><?= strtoupper($row[1]); ?></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      2. Merk
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <?= strtoupper($row[2]); ?></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      3. Nama Barang
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <?= strtoupper($row[3]); ?></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      4. Stok
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <?= strtoupper($row[4]); ?></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      5. Harga Beli
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <h3><span class="badge bg-warning">Rp. <?= number_format($row[5]); ?></span></h3></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      6. Harga Jual
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <h3><span class="badge bg-primary">Rp. <?= number_format($row[6]); ?></span></h3></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      7. Untung (per item)
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <h3><span class="badge bg-success">Rp. <?= number_format($row[7]); ?></span></h3></label>
                                    </div>    
                                  </div>                                      
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">                            
                            <a href="?p=brg&e=<?= $isi[0] ?>"> <button type="submit" class="btn btn-primary">Edit</button></a>                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>                          
                          <?php } ?>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </form>   
                  <?php } ?>                 
                                               
                  </tfoot>
                </table>                     
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->         
    </section>
    <!-- /.content -->
  </div>  
  <!-- <script type="text/javascript" src="./assets/dist/js/jquery.js"></script> -->
  <script type="text/javascript" src="./assets/dist/js/rupiah.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="./assets/dist/js/jquery.mask.min.js"></script>  
  <script>
  function sum() {
        var txtFirstNumberValue = document.getElementById('txt1').value;
        var txtSecondNumberValue = document.getElementById('txt2').value;        
        var result = parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);        
        if (!isNaN(result)) {
          document.getElementById('txt3').value = result;          
          ;
        }
  }
  </script>  
