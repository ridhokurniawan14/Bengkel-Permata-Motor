  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pembelian Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Beli Barang</li>
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
                <h3 class="card-title">Detail Beli Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="exampleInputPassword1">No. Referensi Nota <code>*</code></label>
                        <input autofocus type="text" name="nota" value="<?= $d[1] ?>"  class="form-control" id="exampleInputPassword1" placeholder="Nomor Referensi Kwitansi" required>
                      </div>    
                    </div> 
                    <div class="col-md-7">
                      <div class="form-group">
                        <label>Nama Barang <code>*</code></label>
                        <select name="kd_barang" class="form-control select2bs4" style="width: 100%;" required>
                          <?php
                            if($_GET['e'] == NULL) 
                            {
                                echo "<option>Pilih Barang</option>";
                            }
                            foreach ($barang as $data)
                            {
                                $nmbrg = ucwords($data[3]);
                                $mrbrg = ucwords($data[2]);
                                if ($data[0]==$_GET['e']){
                                echo "<option value=$data[0] selected> $nmbrg ($mrbrg)</option>";}
                                else
                                echo "<option value=$data[0]> $nmbrg ($mrbrg)</option>";
                            }
                          ?>
                        </select>                            
                      </div>
                    </div>                                     
                  </div>
                  <div class="row">    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Supplier <code>*</code></label>
                        <select name="kd_sup" class="form-control select2bs4" style="width: 100%;" required>
                          <?php
                            if($_GET['e'] == NULL) 
                            {
                                echo "<option>Pilih Supplier</option>";
                            }
                            foreach ($supplier as $data)
                            {
                                $nmsup = ucwords($data[1]);
                                if ($data[0]==$_GET['e']){
                                echo "<option value=$data[0] selected> $nmsup</option>";}
                                else
                                echo "<option value=$data[0]> $nmsup </option>";
                            }
                          ?>
                        </select>           
                      </div>                      
                    </div>                                             
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tgl. Beli <code>*</code></label>
                        <input name="tgl_beli" value="<?= $d[4] ?>" type="date" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Qty <code>*</code></label>
                        <input name="qty" type="number" value="<?= $d[5] ?>" onkeyup="sum();" class="form-control" id="txt1" placeholder="Tambah Stok" required>
                      </div>    
                    </div> 
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Total Bayar <code>*</code></label>
                        <input name="tot_bay" type="text" value="<?= $d[6] ?>" onkeyup="sum();" class="form-control" id="txt2" placeholder="Total Bayar" required>
                      </div>    
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Harga Per Item</label>
                        <input readonly name="per_item" value="<?= $d[7] ?>" type="text" class="form-control" id="txt3" placeholder="Otomatis">
                      </div>    
                    </div>
                    <div class="col-md-8">
                    <label for="exampleInputFile">Bukti Foto Nota</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="logo" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile"><?php if(!empty($_GET['e'])) { echo $d[8]; } else { echo 'Pilih File'; } ?></label>
                      </div>                      
                    </div>
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <?php if(!empty($_GET['e'])){ ?><button name="update" type="submit" class="btn btn-primary">Update</button><?php }else{ ?><button name="save" type="submit" class="btn btn-primary">Simpan</button><?php } ?>
                  <a href="?p=bb"><button class="btn btn-default float-right">Cancel</button></a>
                </div>
              </form>
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
                <h3 class="card-title">Data Pembelian Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No. Nota</th>
                    <th>Barang</th>                    
                    <th>Tgl. Beli</th>      
                    <th>Qty</th>                                                     
                    <th></th>             
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no   = 1;
                      foreach($databb as $isi)                      
                      {                      
                        $tanggal      = $isi[4];
                    ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $isi[1] ?></td>
                    <td><?= ucwords($isi[12]) ?></td>
                    <td><?php echo $database -> tgl_indo($tanggal); ?></td>
                    <td><?= $isi[5] ?></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tindakan
                        </button>
                        <div class="dropdown-menu">                      
                          <a class="dropdown-item" href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-xl<?php echo $isi[0]; ?>">Detail Beli</a>                          
                          <a class="dropdown-item" href="?p=bb&e=<?= $isi[0] ?>">Edit</a>
                          <a class="dropdown-item" href="?p=bb&d=<?= $isi[0].'" onclick="return confirm(\'Yakin dihapus?\')' ?> " >Hapus</a>
                        </div>
                      </div>      
                    </td>  
                  </tr>  
                  <form role="form" action="" method="get">
                    <div class="modal modal fade" id="modal-xl<?php echo $isi[0]; ?>">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">                          
                            <?php
                                $id = $isi[0]; 
                                $query_edit = $database -> tampil_detbb($con,$id);
                                while ($row = mysqli_fetch_array($query_edit)) 
                                {  
                                  $tgl      = $isi[4];
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
                                      1. Nomor Nota</label>                                      
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
                                      2. Jenis Barang
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <?= ucwords($row[10]).' ('.strtoupper($row[11]).') ' ?></label>
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
                                    <label for="exampleInputPassword1"> <?= ucwords($row[12]); ?></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      4. Supplier
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <?= ucwords($row[18]); ?></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      5. Tgl. Beli
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <?php echo $database -> tgl_indo($tanggal); ?></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      6. Qty
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <h3><span class="badge bg-warning"><?= $row[5]; ?></span></h3></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      7. Total Bayar
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
                                      8. Harga Per item
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1"> <h3><span class="badge bg-success">Rp. <?= number_format($row[7]); ?></span></h3></label>
                                    </div>    
                                  </div>                                      
                                </div>
                                <div class="row">                                               
                                  <div class="col-6">
                                    <div class="form-group">
                                      9. Bukti Beli
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <div class="filter-container p-0 row">
                                        <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                          <a target="_blank" 
                                          <?php if(!empty($row[8])) { echo "href='./assets/images/bb/$row[8].'"; } ?> data-toggle="lightbox" data-title="sample 1 - white">
                                            <img <?php if(!empty($row[8])) { echo "src='./assets/images/bb/$row[8].'"; } else { echo "src='https://via.placeholder.com/300/FFFFFF?text=empty'"; } ?> class="img-fluid mb-2" alt="white sample"/>                                            
                                          </a>
                                        </div>
                                      </div>                                    
                                    </div>    
                                  </div>                                      
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">                            
                            <a href="?p=bb&e=<?= $isi[0] ?>"> <button type="submit" class="btn btn-primary">Edit</button></a>                            
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
  <script>
  function sum() {
        var txtFirstNumberValue = document.getElementById('txt1').value;
        var txtSecondNumberValue = document.getElementById('txt2').value;        
        var result = parseFloat(txtSecondNumberValue) / parseFloat(txtFirstNumberValue);        
        if (!isNaN(result)) {
          document.getElementById('txt3').value = result;          
        }
  }
  </script>  
