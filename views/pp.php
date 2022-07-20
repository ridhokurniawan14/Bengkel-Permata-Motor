  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil Perusahaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profil Perusahaan</li>
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
            <?php 
              if(empty($data[0]) || !empty($_GET['e']))
              {              
            ?>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php if(!empty($_GET['e'])) { echo 'Edit '; } ?>Identitas Perusahaan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Perusahaan <code>*</code></label>
                    <input autofocus autocomplete="off" name="np" type="text" value="<?= strtoupper($d[1]) ?>" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Perusahaan" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat <code>*</code></label>
                    <textarea type="text" name="alamat" class="form-control" id="exampleInputPassword1" placeholder="Alamat Perusahaan" required><?= ucwords($d[2]) ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No. Handphone <code>*</code></label>
                    <input type="text" autocomplete="off" value="<?= $d[3] ?>" name="hp" class="form-control" id="exampleInputPassword1" placeholder="No. HP" required>
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputFile">Logo <code>*</code></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="logo" class="custom-file-input" id="exampleInputFile" required>
                        <label class="custom-file-label" for="exampleInputFile"><?php if(!empty($_GET['e'])) { echo 'Pilih logo kembali'; } else { echo 'Pilih File'; } ?></label>
                      </div>                      
                    </div>
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
            <?php } else { ?>

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" style="object-fit:cover;width:230px;height:230px;"
                       src="./assets/images/logo/<?= $data[4] ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= strtoupper($data[1]) ?></h3>

                <p class="text-muted text-center"><?= ucwords($data[2]) ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Nomor HP</b> <a class="float-right"><h5><?= $data[3] ?></h5></a>
                  </li>
                  <li class="list-group-item">
                    <b>Cabang</b> <a class="float-right"><h5>1</h5></a>
                  </li>                  
                </ul>

                <a href="?p=pp&e=<?= $data[0] ?>" class="btn btn-primary btn-block"><b>Edit</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->     
            <?php } ?>            
          </div>
          <!--/.col (left) -->          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div> 