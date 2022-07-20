  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ganti Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ganti Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Gunakan kata sandi yang tidak mudah ditebak</p>
      
            <form action="#" method="post">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <input name="pas_lama" autofocus type="password" class="form-control" placeholder="Password Lama" required>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <input name="pas_baru" type="password" class="form-control" placeholder="Password Baru" required>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <input name="pas_ver" type="password" class="form-control" placeholder="Confirm Password" required>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-12">
                        <button name="update" type="submit" class="btn btn-primary btn-block">Ganti Password</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </div>
                </div>
              </div>
            </form>           
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
    </section>
  </div>