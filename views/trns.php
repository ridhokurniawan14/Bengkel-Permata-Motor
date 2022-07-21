  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Transaksi Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="row">                                                                          
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nama Barang <code>*</code></label>
                        <select id="kode" name="kode" class="form-control select2bs4" style="width: 100%;" required></select>                                   
                      </div>                      
                    </div>            
                    <div class="col-md-2">                      
                      <div class="form-group">
                        <label for="exampleInputPassword1">Stok Barang</label>                        
                        <input type="text" name="stok" id="stok" readonly class="form-control"  placeholder="Stok Barang">
                      </div>                      
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Harga </label>
                        <input readonly type="text" name="hrg" onkeyup="sum();" id="jual" class="form-control" id="hrg" placeholder="Harga Per Item">                                                
                      </div> 
                    </div> 
                    <div class="col-md-2">                      
                      <div class="form-group">
                        <label for="exampleInputPassword1">Qty <code>*</code></label>
                        <input type="text" onkeyup="sum();" name="qty" id="qty" class="form-control" required placeholder="Banyak barang">
                      </div>                      
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Sub Total</label>                        
                        <input readonly name="subtotal" type="text" class="form-control" id="subtotal"  placeholder="Subtotal">
                      </div> 
                    </div> 
                  </div>                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="tambah" id="tambah" class="btn btn-success float-right">Tambah Keranjang</button>                  
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->          
        </div>   
        <div class="card">
              <div class="card-header">
                <h1 class="card-title"><span class="badge bg-warning"><i class="fa fa-shopping-cart nav-icon"></i> KERANJANG</span></h1><div class="float-right"><?= $tgl_transaksi ?></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Barang</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th  style="width: 150px">Sub Total</th>
                      <th style="width: 10px">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no           = 1;
                      foreach($data as $isi)                      
                      {                      
                        // $tanggal    = $isi[4];
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= ucwords($isi[8]).' ('.ucwords($isi[7]).')' ?></td>
                      <td><span class="badge bg-secondary">Rp. <?= number_format($isi[3])?>,-</span></td>
                      <td><span class="badge bg-primary"><?= number_format($isi[2])?></span></td>
                      <td><span class="badge bg-success">Rp. <?= number_format($isi[4])?>,-</span></td>
                      <td><a class="dropdown-item" href="?p=trns&d=<?= $isi[0].'" onclick="return confirm(\'Yakin dihapus?\')' ?> " ><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
                    </tr>
                    <?php } ?>
                    <?php if($cek_data_transaksi_sementara[0] != 0) { ?>
                    <form method="POST">
                    <tr>
                      <td colspan="2"></td>
                      <td><b><i>DISKON</i></b></td>
                      <td colspan="3"><input type="text" name="diskon" id="diskon"  onkeyup="pembayaran();" class="form-control" placeholder="Diskon"><input type="text" hidden readonly id="tot_sementara" onkeyup="pembayaran();" value="<?= $total_pembayaran[0] ?>" class="form-control" placeholder="Diskon"></td>
                      
                    </tr> 
                    <tr>
                      <td colspan="2"></td>
                      <td><b><i>TOTAL</i></b></td>
                      <td colspan="3"><input readonly name="total_bayar" type="text" id="total_bayar" class="form-control" placeholder="Total Bayar"></td>
                    </tr>                                        
                    <tr>
                      <td colspan="2"></td>
                      <td><b><i>BAYAR</i></b></td>
                      <td colspan="3"><input type="text" onkeyup="pembayaran();" name="uang_bayar" id="uang_bayar" class="uang_bayar form-control" placeholder="Bayar" required></td>                      
                    </tr>                                        
                    <tr>
                      <td colspan="2"></td>
                      <td><b><i>KEMBALI</i></b></td>
                      <td colspan="3"><input readonly type="text" name="kembali_uang" id="kembali_uang" class="form-control" placeholder="Kembalian"></td>
                    </tr>                                        
                    <?php } else { ?>
                      <tr>
                        <td colspan="6" align="center"><h2><span class="badge bg-warning">KERANJANG KOSONG GAN</span></h2></td>                        
                      </tr> 
                    <?php } ?>
                  </tbody>
                </table>
                <?php if($cek_data_transaksi_sementara[0] != 0) { ?>
                <div class="card-footer" >                                    
                  <a href="?p=print_transaksi" target="_blank"><button type="submit"  id="proses_bayar" name="proses_bayar" class="btn btn-success float-right">PROSES PEMBAYARAN</button></a>
                </div>
                <?php } ?>
                    </form>
                    
              </div>
              <!-- /.card-body -->
            </div>        
        <!-- /.row -->
      </div><!-- /.container-fluid -->      
    </section>    
    
    <!-- /.content -->
  </div>  

        
<script src="./assets/js/js/jquery.js"></script>
    <script>
        //mengidentifikasikan variabel yang kita gunakan
        // var kode;
        // var nama;
        // var beli;        
        // var stok;
        var nota;
        var tanggal;
        var kode;
        var nama;
        var harga;
        var jumlah;
        var jual;
        var stok;
        $(function(){
            $("#kode").load("./views/proses.php","op=kode");
            // $("#barang").load("proses.php","op=barang");
            
            //jika ada perubahan di kode barang
            $("#kode").change(function(){
                kode=$("#kode").val();
                
                //tampilkan status loading dan animasinya
                $("#status").html("loading. . .");
                $("#loading").show();
                
                //lakukan pengiriman data
                $.ajax({
                    url:"./views/proses.php",
                    data:"op=ambildata&kode="+kode,
                    cache:false,
                    success:function(msg){
                        data=msg.split("|");
                        
                        //masukan isi data ke masing - masing field
                        $("#nama").val(data[0]);
                        $("#beli").val(data[1]);
                        $("#jual").val(data[2]);
                        $("#stok").val(data[3]);
                        
                        
                        //hilangkan status animasi dan loading
                        $("#status").html("");
                        $("#loading").hide();
                    }
                });
            });
            //ketika tombol tambah di klik
            // $("#tambah").click(function(){
            //     kode=$("#kode").val();
            //     stok=$("#stok").val();
            //     jumlah=$("#qty").val();
            //     if(kode=="Kode Barang"){
            //         alert("Nama Barang harus diisi!");
            //         exit();
            //     }else if(jumlah > stok){
            //         alert("Stok tidak terpenuhi");
            //         $("#qty").focus();
            //         exit();
            //     }else if(jumlah < 1){
            //         alert("Qty tidak boleh 0!");
            //         $("#qty").focus();
            //         exit();
            //     }                
            //     nama=$("#nama").val();
            //     jual=$("#jual").val();                
                
                                        
            //     $("#status").html("sedang diproses. . .");
            //     $("#loading").show();
                
            //     $.ajax({
            //         url:"./views/proses.php",
            //         data:"op=tambah&kode="+kode+"&jumlah="+jumlah+"&jual="+jual,
            //         cache:false,
            //         success:function(msg){
            //             if(msg=="sukses"){
            //                 $("#status").html("Berhasil disimpan. . .");
            //             }else{
            //                 $("#status").html("ERROR. . .");
            //             }
            //             $("#loading").hide();

            //             $("#nama").val("");
            //             $("#jual").val("");
            //             $("#jumlah").val("");
            //             // $("#stok").val("");

            //             $("#kode").load("./views/proses.php","op=ambilbarang");
            //             $("#barang").load("./views/proses.php","op=barang");
            //         }
            //     });
            // });                    
            //ketika tombol update di klik
            $("#update").click(function(){
                //cek apakah kode barang kosong atau tidak
                kode=$("#kode").val();
                if(kode=="Kode Barang"){
                    alert("Pilih Kode barang dulu");
                    exit();
                }
                nama=$("#nama").val();
                beli=$("#beli").val();
                jual=$("#jual").val();
                stok=$("#stok").val();
                
                //tampilkan status update
                $("#status").html('sedang diupdate. . .');
                $("#loading").show();
                
                $.ajax({
                    url:"proses.php",
                    data:"op=update&kode="+kode+"&nama="+nama+"&beli="+beli+"&jual="+jual+"&stok="+stok,
                    cache:false,
                    success:function(msg){
                        if(msg=='Sukses'){
                            $("#status").html('Update Berhasil. . .');
                        }else{
                            $("#status").html('ERROR. . .')
                        }
                        $("#loading").hide();
                        $("#nama").val("");
                        $("#jual").val("");
                        $("#beli").val("");
                        $("#stok").val("");
                        $("#barang").load("proses.php","op=barang");
                        $("#kode").load("proses.php","op=kode");
                    }
                });
            });
            
            //ketika tombol hapus diklik
            $("#hapus").click(function(){
                kode=$("#kode").val();
                if(kode=="Kode Barang"){
                    alert("Kode barang belim dipilih");
                    exit();
                }
                $("#status").html('Sedang Dihapus. . .');
                $("#loading").show();
                
                $.ajax({
                    url:"proses.php",
                    data:"op=delete&kode="+kode,
                    cache:false,
                    success:function(msg){
                        if(msg=="sukses"){
                            $("#status").html('Berhasil Dihapus. . .');
                        }else{
                            $("#status").html('ERROR. . .');
                        }
                        $("#nama").val("");
                        $("#jual").val("");
                        $("#beli").val("");
                        $("#stok").val("");
                        $("#barang").load("proses.php","op=barang");
                        $("#kode").load("proses.php","op=kode");
                        
                    }
                });
            });
            
            //ketika tombol simpan diklik
            $("#simpan").click(function(){
                kode=$("#kode2").val();
                if(kode==""){
                    alert("Kode Barang Harus diisi");
                    exit();
                }
                nama=$("#nama").val();
                beli=$("#beli").val();
                jual=$("#jual").val();
                stok=$("#stok").val();
                
                $("#status").html("sedang diproses. . .");
                $("#loading").show();
                
                $.ajax({
                    url:"proses.php",
                    data:"op=simpan&kode="+kode+"&nama="+nama+"&beli="+beli+"&jual="+jual+"&stok="+stok,
                    cache:false,
                    success:function(msg){
                        if(msg=="sukses"){
                            $("#status").html("Berhasil disimpan. . .");
                        }else{
                            $("#status").html("ERROR. . .");
                        }
                        $("#loading").hide();
                        $("#nama").val("");
                        $("#jual").val("");
                        $("#beli").val("");
                        $("#stok").val("");
                        $("#kode2").val("");
                    }
                });
            });
        });
    </script>     
    <script>
    function sum() {
            var txtFirstNumberValue = document.getElementById('qty').value;
            var txtSecondNumberValue = document.getElementById('jual').value;        
            var result = parseInt(txtSecondNumberValue) * parseInt(txtFirstNumberValue);        
            if (!isNaN(result)) {
            document.getElementById('subtotal').value = result;          
            }
    }
    function pembayaran() {
            var txtSecondNumberValue = document.getElementById('tot_sementara').value;
            var txtFirstNumberValue = document.getElementById('diskon').value ;
            var tiga = document.getElementById('uang_bayar').value;        
            var result = parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);        
            var result2 =  tiga - result;
            
            if (!isNaN(result)) {
              document.getElementById('total_bayar').value = result;          
            }
            if (!isNaN(result2)) {
            document.getElementById('kembali_uang').value = result2;          
            }            
    }
    function open(url){
      var win = window.open("?p=print_transaksi", "Print Nota", "height=700, width=500, scrollbars=yes");
    }
    </script>      