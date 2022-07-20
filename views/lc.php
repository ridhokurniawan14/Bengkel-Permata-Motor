<style>
.table-row:hover{background-color:#99ccff;}
.heading{
    font-weight:bold;
    display:table-row;
    background-color:blanchedalmond;
    text-align:center;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    line-height:35px;
    color:black;
    /* width: 100%; */
}
.table-row{  
    display:table-row;
    text-align:center;
}
.strip{  
    display:table-row;
    text-align:center;
    background-color:#f0f0f0;
}
.col{ 
    display:table-cell;
    border:1px solid black;
    width: auto;
}
.col-barang{ 
    display:table-cell;
    border:1px solid black;
    width: auto;
    text-align: left;        
}
.col-harga{ 
    display:table-cell;
    border:1px solid black;
    width: auto;
    text-align: right;        
}
.col-bawah{
  display:table-cell;
  border:1px solid black;
  width: auto;
  text-align: right;  
  font-weight: bold;
  font-style: italic;
}
.col-bawah-hilang{
  display:table-cell;
  border:0px solid black;
  width: auto;
  text-align: right;  
  font-weight: bold;
  font-style: italic;
}
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Custom</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Custom</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">     
        <?php if($dari != NULL) { ?> 
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-info"></i> Informasi</h5>
          Hasil pencarian transaksi berdasarkan tanggal <b style="color:yellow;"><?= $tgldari.'-'.$blndari.'-'.$thndari ?></b> sampai dengan <b style="color:yellow;"><?= $tglke.'-'.$blnke.'-'.$thnke ?></b> mendapat <b style="color:yellow;"><?= $count ?> Data </b> Transaksi
        </div>  
        <?php } ?>
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">                  
                  <div class="row">
                    <div class="col-md-12">
                      <h1 class="card-title"><b>DATA TRANSAKSI</b></h1>
                    </div>    
                  </div>
                  <form action="" method="post">
                  <div class="row">
                      <div class="col-md-5">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Tanggal</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" name="dari" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">sampai</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" name="ke" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group row">
                          <div class="col-sm-12">                            
                            <button type="submit" name="filter" class="btn btn-info col-sm-12">FILTER</button>
                          </div>
                        </div>
                      </div>
                  </div>          
                  </form>    
                  <?php if($ke != NULL) { ?> 
                  <div class="row">
                    <div class="form-group col-md-6">
                      <a href="?p=lc"><button class="btn btn-secondary col-sm-12">RESET</button></a>
                    </div>    
                    <div class="form-group btn-group col-sm-6">
                      <button type="button" class="btn btn-success col-sm-12 dropdown-toggle" data-toggle="dropdown">
                        Download
                      </button>
                      <div class="dropdown-menu col-sm-12" role="menu">
                        <a class="dropdown-item" target="_blank" href="?p=dac&dari=<?= $dari ?>&ke=<?= $ke ?>">Excel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" target="_blank" href="?p=lpdf&dari=<?= $dari ?>&ke=<?= $ke ?>">PDF</a>                            
                      </div>
                    </div>
                  </div>                  
                  <?php } ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No. Nota</th>
                    <th>Tgl. Transaksi</th>
                    <th>Total</th>                    
                    <th>Diskon</th>       
                    <th>Bayar</th>                           
                    <th>Kembali</th>                           
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
                    <td><?= ucwords($isi[0]) ?></td>
                    <td><?= ucwords($isi[1]) ?></td>
                    <td>Rp. <?= number_format($isi[2]) ?></td>
                    <td><?php if($isi[3] == 0) { echo '-'; } else echo 'Rp. '.number_format($isi[3]) ?></td>
                    <td>Rp. <?= number_format($isi[4]) ?></td>
                    <td>Rp. <?= number_format($isi[5]) ?></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tindakan
                        </button>
                        <div class="dropdown-menu">                      
                          <a class="dropdown-item" href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-info<?php echo $isi[0]; ?>">Detail Barang</a>                          
                          <a target="_blank" class="dropdown-item" href="?p=print_transaksi&nota=<?= $isi[0] ?>">Cetak</a>
                          <a class="dropdown-item" href="?p=lh&d=<?= $isi[0].'" onclick="return confirm(\'Yakin dihapus?\')' ?> " >Hapus</a>
                        </div>
                      </div>      
                    </td>  
                  </tr>                  
                  
                    <div class="modal modal fade" id="modal-info<?php echo $isi[0]; ?>">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">                                                      
                            <h4 class="modal-title">Detail Transaksi </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body" id="detail_user">   
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="container">
                                    <div class="heading">
                                      <div class="col" style="width: 5%">#</div>
                                      <div class="col" style="width: 40%">Nama Barang</div>
                                      <div class="col" style="width: 20%">Harga</div>
                                      <div class="col" style="width: 15%">Qty</div>
                                      <div class="col" style="width: 20%">Sub Total</div>                                  
                                    </div>

                                    <?php
                                      $no   = 1;
                                      $id   = $isi[0];
                                      $dt   = $database -> tampil_data_transaksi($con,$id);
                                      foreach ($dt as $row)
                                      {   
                                    ?>
                                    <div class="table-row">
                                        <div class="col"><?= $no++ ?></div>
                                        <div class="col-barang"><?= ucwords($row[15]) ?></div>
                                        <div class="col-harga">Rp. <?= number_format($row[10]) ?></div>
                                        <div class="col"><?= $row[9] ?></div>
                                        <div class="col-harga">Rp. <?= number_format($row[11]) ?></div>
                                    </div>    
                                    <?php } ?>                            
                                    <div class="table-row">
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang">Diskon</div>                                    
                                        <div class="col-bawah"><?php if($row[3] == 0) { echo '-'; } else echo 'Rp. '.number_format($row[3]) ?></div>                                    
                                    </div>  
                                    <div class="table-row">
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang">Total</div>                                    
                                        <div class="col-bawah"><?= 'Rp. '.number_format($row[2]) ?></div>                                    
                                    </div>  
                                    <div class="table-row">
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang">Bayar</div>                                    
                                        <div class="col-bawah"><?= 'Rp. '.number_format($row[4]) ?></div>                                    
                                    </div>    
                                    <div class="table-row">
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang"></div>                                    
                                        <div class="col-bawah-hilang">Kembali</div>                                    
                                        <div class="col-bawah"><?= 'Rp. '.number_format($row[5]) ?></div>
                                    </div>  
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">                            
                            <a target="_blank" href="?p=print_transaksi&nota=<?= $row[0] ?>"> <button type="submit" class="btn btn-primary">Cetak</button></a>                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>                          
                          <?php } ?>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>                                                   
                                               
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
  // Basic example
  // $(document).ready(function () {
  // $('#example1').DataTable({
  // "ordering": true // false to disable sorting (or any other option)
  // });
  // $('.dataTables_length').addClass('bs-select');
  // });
  </script>  
  
