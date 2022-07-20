  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
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
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php if(!empty($_GET['e'])) { echo 'Edit '; } ?>Identitas Supplier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Supplier <code>*</code></label>
                    <input autofocus autocomplete="off" value="<?= ucwords($d[1]) ?>" name="nm" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Supplier" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat Supplier</label>
                    <textarea type="text" autocomplete="off" name="alamat" class="form-control" id="exampleInputPassword1" placeholder="Alamat Supplier"><?= ucwords($d[2]) ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No. Telepon</label>
                    <input type="text" maxlength="14" value="<?= $d[3] ?>" autocomplete="off" name="hp" class="form-control" id="exampleInputPassword1" placeholder="Telepon / Handphone">
                  </div>                                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <?php if(!empty($_GET['e'])){ ?><button name="update" type="submit" class="btn btn-primary">Update</button><?php }else{ ?><button name="save" type="submit" class="btn btn-primary">Simpan</button><?php } ?>
                  <a href="?p="><button class="btn btn-default float-right">Cancel</button></a>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Supplier</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>                    
                    <th>No. Telepon</th>       
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
                    <td><?= ucwords($isi[2]) ?></td>
                    <td><?= $isi[3] ?></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tindakan
                        </button>
                        <div class="dropdown-menu">                      
                          <a class="dropdown-item" href="?p=sp&e=<?= $isi[0] ?>">Edit</a>
                          <a class="dropdown-item" href="?p=sp&d=<?= $isi[0].'" onclick="return confirm(\'Yakin dihapus?\')' ?> " >Hapus</a>
                        </div>
                      </div>      
                    </td>  
                  </tr>                                    
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