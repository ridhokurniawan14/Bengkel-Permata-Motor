  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?= $tot[0] ?></h4>

                <p>Penjualan Hari ini</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?= 'Rp. '.number_format($tot[1]) ?></h4>

                <p>Pengeluaran Hari ini</p>
              </div>
              <div class="icon">
                <i class="fa fa-briefcase"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-success">
              <div class="inner">
                  <h4>Rp. <?= number_format($tot[2]) ?></h4>

                  <p>Pendapatan Hari ini</p>
              </div>
              <div class="icon">
                  <i class="ion ion-cash"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-success">
              <div class="inner">
                  <h4>Rp. <?= number_format($tot[3]) ?></h4>

                  <p>Laba Hari ini</p>
              </div>
              <div class="icon">
                  <i class="ion ion-cash"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>          
          <!-- ./col -->
          <!-- ./col -->
        </div>       
        <div class="row">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $tot[4] ?></h3>

                <p>Stok Accu</p>
              </div>
              <div class="icon">
                <i class="ion ion-flash"></i>
              </div>
              <a href="?p=brg" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $tot[5] ?></h3>

                <p>Stok Ban</p>
              </div>
              <div class="icon">
                <i class="fa fa-motorcycle"></i>
              </div>
              <a href="?p=brg" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $tot[6] ?></h3>

                <p>Stok Oli</p>
              </div>
              <div class="icon">
                <i class="ion ion-paintbucket"></i>
              </div>
              <a href="?p=brg" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Grafik Penjualan Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <canvas id="myChart" ></canvas>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Grafik Laba Perbulan</h3>
                <h3 class="card-title float-right">Tahun <b><?= $thn ?></b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <canvas id="myChart2" height=""></canvas>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        
        <!-- /.row -->
        <!-- Main row -->        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>

  <script src="./assets/js/Chart.js"></script>
  <script>
	const ctx = document.getElementById("myChart").getContext('2d');
	const myChart = new Chart(ctx, {
		type: 'bar',    
		data: {			
      labels: ['Accu','Ban','Oli'],
			datasets: [{
				label: 'Penjualan',
				data: [<?= $tot[7] ?>,<?= $tot[8] ?>,<?= $tot[9] ?>],
				backgroundColor: [
        'rgba(0, 255, 38, 0.5)',
				'rgba(255, 255, 0, 0.5)',
				'rgba(255, 26, 0, 0.5)'			
				],
        borderColor: [
        'rgba(0, 0, 0, 0.5)',
				'rgba(0, 0, 0, 0.5)',
				'rgba(0, 0, 0, 0.5)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}          
				}]
			}
		}
	});    
</script>
<script>
		var ctxx = document.getElementById("myChart2").getContext('2d');
		var myChart2 = new Chart(ctxx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($label); ?>,
				datasets: [{
					label: 'Grafik Laba Penjualan',
					data: <?php echo json_encode($jumlah_produk); ?>,
                    backgroundColor: 'green',
                    borderColor: ['rgba(0, 0, 0, 0.5)'],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>