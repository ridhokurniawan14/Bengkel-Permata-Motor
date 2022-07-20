<?php
// error_reporting(0);
//JALUR APLIKASI 
if(!empty($_GET["p"]))
{
	$p = strtolower($_GET["p"]);
		
	if($p == "dsb") // HALAMAN DASHBOARD
	{
		$tot = $database -> tampil_jumlah($con);

		include("views/bd.php");
	}
	elseif($p == "pp") // HALAMAN PROFIL PERUSAHAAN
	{
		$data = $database -> tampil_data_pp($con);
		
		if(isset($_POST['save'])) //simpan
		{			
			$rand       = rand();                               //nomor random
			$ekstensi   = array('PNG','JPG','JPEG','gif');      //ekstensi yg diperbolehkan
			$logo       = $_FILES['logo']['name'];              //nama file
			$ukuran     = $_FILES['logo']['size'];              //ukuran file			
			$ext        = pathinfo($logo, PATHINFO_EXTENSION);  //gabungan logo dan extension untuk cek
			$limit      = 10 * 1024 * 1024;                     //			
			
			$np     = mysqli_real_escape_string($con, strtolower($_POST["np"]));
			$alamat = mysqli_real_escape_string($con, strtolower($_POST["alamat"]));
			$hp     = mysqli_real_escape_string($con, $_POST["hp"]);

			if(in_array($ext,$ekstensi)) 
			{
				echo '<script>alert("foto harus jpg/png");window.location.href="?p=pp";</script>';
			}
			else
			{
				if($ukuran < $limit) 
				{
					$filename_logo = $rand.'_'.$logo;
					move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/images/logo/'.$rand.'_'.$logo);
					$save = $database -> save_pp($con,$np,$alamat,$hp,$filename_logo);
				}		
				else
				{
					echo '<script>alert("Ukuran foto terlalu besar");window.location.href="?p=pp";</script>';
				}	
			}	
		}
		if(!empty($_GET['e'])) //edit
		{
			$id = $_GET['e'];
			$d = $database -> tampil_satu_data_pp($con,$id);						

			if(isset($_POST['update'])) //update
			{
				$id          = $_GET['e'];
				$rand        = rand();                               //nomor random
				$ekstensi    = array('PNG','JPG','JPEG','gif');      //ekstensi yg diperbolehkan
				$logo        = $_FILES['logo']['name'];              //nama file
				$ukuran      = $_FILES['logo']['size'];              //ukuran file
				$ext         = pathinfo($logo, PATHINFO_EXTENSION);  //gabungan logo dan extension untuk cek
				$limit       = 10 * 1024 * 1024;                     //
				
				$np     = mysqli_real_escape_string($con, strtolower($_POST["np"]));
				$alamat = mysqli_real_escape_string($con, strtolower($_POST["alamat"]));
				$hp     = mysqli_real_escape_string($con, $_POST["hp"]);
				unlink("assets/images/logo/$d[4]");
				
				if(in_array($ext,$ekstensi)) 
				{
					echo '<script>alert("foto harus jpg/png");window.location.href="?p=pp";</script>';
				}
				else
				{
					if($ukuran < $limit) 
					{
						$filename_logo = $rand.'_'.$logo;
						move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/images/logo/'.$rand.'_'.$logo);
						$save = $database -> update_pp($con,$np,$alamat,$hp,$filename_logo,$id);
					}		
					else
					{
						echo '<script>alert("Ukuran foto terlalu besar");window.location.href="?p=pp";</script>';
					}	
				}	
			}		
		}
		else
		{
			$d = array('','','','','');
		}
		include("views/bd.php");
	}
	elseif($p == "ad") // HALAMAN ADMIN
	{
		$data = $database -> tampil_data_ad($con);

		if(isset($_POST['save']))
		{
			$nm    = mysqli_real_escape_string($con, strtolower($_POST["nm"]));
			$user  = mysqli_real_escape_string($con, strtolower($_POST["user"]));
			$pass  = mysqli_real_escape_string($con, PassHash::hash($_POST["pass"]));
			$kat   = mysqli_real_escape_string($con, strtolower($_POST["kat"]));
			$save = $database -> save_ad($con,$nm,$user,$pass,$kat);
		}
		if(!empty($_GET["d"]))
		{
			$kd = $_GET["d"];
			$database -> hapus_ad($con,$kd);
		}
		if(!empty($_GET['e'])) //edit
		{
			$id = $_GET['e'];
			$d = $database -> tampil_satu_data_ad($con,$id);
			if(isset($_POST['update']))
			{
				$nm    = mysqli_real_escape_string($con, strtolower($_POST["nm"]));
				$user  = mysqli_real_escape_string($con, strtolower($_POST["user"]));
				$pass  = mysqli_real_escape_string($con, PassHash::hash($_POST["pass"]));			
				$save = $database -> update_ad($con,$nm,$user,$pass,$id);
			}
		}
		else
		{
			$d = array('','','','','');
		}		
		include("views/bd.php");
	}
	elseif($p == "sp") // HALAMAN SUPPLIER
	{
		$data = $database -> tampil_data_sp($con);

		if(isset($_POST['save']))
		{
			$nm        = mysqli_real_escape_string($con, strtolower($_POST["nm"]));
			$alamat    = mysqli_real_escape_string($con, strtolower($_POST["alamat"]));
			$hp        = mysqli_real_escape_string($con, $_POST["hp"]);
			$save      = $database -> save_sp($con,$nm,$alamat,$hp);
		}
		if(!empty($_GET["d"]))
		{
			$kd = $_GET["d"];
			$database -> hapus_sp($con,$kd);
		}
		if(!empty($_GET['e'])) //edit
		{
			$id = $_GET['e'];
			$d = $database -> tampil_satu_data_sp($con,$id);
			if(isset($_POST['update']))
			{
				$nm        = mysqli_real_escape_string($con, strtolower($_POST["nm"]));
				$alamat    = mysqli_real_escape_string($con, strtolower($_POST["alamat"]));
				$hp        = mysqli_real_escape_string($con, $_POST["hp"]);
				$save      = $database -> update_sp($con,$nm,$alamat,$hp,$id);
			}
		}
		else
		{
			$d = array('','','','','');
		}		
		include("views/bd.php");
	}
	elseif($p == "brg") // HALAMAN BARANG
	{
		$data = $database -> tampil_data_brg($con);

		if(isset($_POST['save']))
		{
			$jenis   = mysqli_real_escape_string($con, strtolower($_POST["jenis"]));
			$merk    = mysqli_real_escape_string($con, strtolower($_POST["merk"]));
			$nm      = mysqli_real_escape_string($con, strtolower($_POST["nm"]));
			$stok    = NULL;
			$hb      = mysqli_real_escape_string($con, $_POST["hb"]);
			$hj      = mysqli_real_escape_string($con, $_POST["hj"]);
			$untung  = mysqli_real_escape_string($con, $_POST["untung"]);
			$save    = $database -> save_brg($con,$jenis,$merk,$nm,$stok,$hb,$hj,$untung);
		}
		if(!empty($_GET["d"]))
		{
			$kd = $_GET["d"];
			$database -> hapus_brg($con,$kd);
		}
		if(!empty($_GET['e'])) //edit
		{
			$id = $_GET['e'];
			$d = $database -> tampil_satu_data_brg($con,$id);
			if(isset($_POST['update']))
			{
				$jenis    = mysqli_real_escape_string($con, strtolower($_POST["jenis"]));
				$merk     = mysqli_real_escape_string($con, strtolower($_POST["merk"]));
				$nm       = mysqli_real_escape_string($con, strtolower($_POST["nm"]));
				// $stok     = NULL;
				$hb       = mysqli_real_escape_string($con, $_POST["hb"]);
				$hj       = mysqli_real_escape_string($con, $_POST["hj"]);
				$untung   = mysqli_real_escape_string($con, $_POST["untung"]);			
				$save     = $database -> update_brg($con,$jenis,$merk,$nm,$hb,$hj,$untung,$id);
			}
		}
		elseif(!empty($_GET['stok'])) //edit
		{
			$id = $_GET['stok'];
			$d = $database -> tampil_satu_data_brg($con,$id);
			if(isset($_POST['upstok']))
			{
				$stok    = mysqli_real_escape_string($con, $_POST["stok"]);
				
				$save     = $database -> update_stok_brg($con,$stok,$id);
			}
		}
		else
		{
			$d = array('','','','','','','');
		}		
		include("views/bd.php");
	}
	elseif($p == "bb") // HALAMAN PEMBELIAN BARANG
	{
		$barang       = $database -> tampil_data_brg($con);
		$supplier     = $database -> tampil_data_sp($con);
		$databb       = $database -> tampil_data_bb($con);						

		if(isset($_POST['save']))
		{
			$rand        = rand();                               //nomor random
			$ekstensi    = array('PNG','JPG','JPEG');      //ekstensi yg diperbolehkan
			$logo        = $_FILES['logo']['name'];//nama file
			$ukuran      = $_FILES['logo']['size'];              //ukuran file
			$ext         = pathinfo($logo, PATHINFO_EXTENSION);  //gabungan logo dan extension untuk cek
			$limit       = 10 * 1024 * 1024;                     //

			$nota        = mysqli_real_escape_string($con, strtolower($_POST["nota"]));
			$kd_barang   = mysqli_real_escape_string($con, strtolower($_POST["kd_barang"]));
			$kd_sup      = mysqli_real_escape_string($con, strtolower($_POST["kd_sup"]));
			$tgl_beli    = mysqli_real_escape_string($con, $_POST["tgl_beli"]);
			$qty         = mysqli_real_escape_string($con, $_POST["qty"]);
			$tot_bay     = mysqli_real_escape_string($con, $_POST["tot_bay"]);
			$per_item    = mysqli_real_escape_string($con, $_POST["per_item"]);			
			
			
			if($kd_sup == 0)
			{
				echo '<script>alert("Supplier tidak boleh kosong");window.location.href="?p=bb";</script>';
			}
			elseif(in_array($ext,$ekstensi)) 
			{
				echo '<script>alert("foto harus jpg/png");window.location.href="?p=bb";</script>';
			}
			else
			{
				if($ukuran < $limit) 
				{
					if(empty($logo)) 
					{
						$filename_logo    = NULL;
						$save             = $database -> save_bb($con,$nota,$kd_barang,$kd_sup,$tgl_beli,$qty,$tot_bay,$per_item,$filename_logo);
					}
					else
					{
						$filename_logo   = $rand.'_'.$logo; // nama foto
						move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/images/bb/'.$rand.'_'.$logo);
						$save        = $database -> save_bb($con,$nota,$kd_barang,$kd_sup,$tgl_beli,$qty,$tot_bay,$per_item,$filename_logo);					
					}
				}		
				else
				{
					echo '<script>alert("Ukuran foto terlalu besar");window.location.href="?p=bb";</script>';
				}
			}	
		}
		if(!empty($_GET["d"]))
		{
			$kd = $_GET["d"];			
			$d = $database -> tampil_satu_data_bb($con,$kd);
			unlink("assets/images/bb/".$d[8]);
			$database -> hapus_bb($con,$kd);
			
		}
		if(!empty($_GET['e'])) //edit
		{
			$id = $_GET['e'];
			$d = $database -> tampil_satu_data_bb($con,$id);

			if(isset($_POST['update']))
			{
				$id         = $_GET['e'];
				$rand       = rand();                               //nomor random
				$ekstensi   = array('PNG','JPG','JPEG');      //ekstensi yg diperbolehkan
				// $foto         =$_FILES['gambar']['tmp_name'];
				$logo       = $_FILES['logo']['name'];//nama file
				$ukuran     = $_FILES['logo']['size'];              //ukuran file
				$ext        = pathinfo($logo, PATHINFO_EXTENSION);  //gabungan logo dan extension untuk cek
				$limit      = 10 * 1024 * 1024;                     //

				$nota       = mysqli_real_escape_string($con, strtolower($_POST["nota"]));
				$kd_barang  = mysqli_real_escape_string($con, strtolower($_POST["kd_barang"]));
				$kd_sup     = mysqli_real_escape_string($con, strtolower($_POST["kd_sup"]));
				$tgl_beli   = mysqli_real_escape_string($con, $_POST["tgl_beli"]);
				$qty        = mysqli_real_escape_string($con, $_POST["qty"]);
				$tot_bay    = mysqli_real_escape_string($con, $_POST["tot_bay"]);
				$per_item   = mysqli_real_escape_string($con, $_POST["per_item"]);
				
				if(in_array($ext,$ekstensi)) 
				{
					echo '<script>alert("foto harus jpg/png");window.location.href="?p=bb";</script>';
				}
				else
				{
					if($ukuran < $limit) 
					{
						if(empty($logo))
						{		
							$logo            = $d[8];
							$filename_logo   = $logo; // nama foto
							$save            = $database -> update_bb($con,$nota,$kd_barang,$kd_sup,$tgl_beli,$qty,$tot_bay,$per_item,$filename_logo,$id);							
						}
						else
						{
							unlink("assets/images/bb/".$d[8]);					
							$filename_logo   = $rand.'_'.$logo; // nama foto							
							move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/images/bb/'.$rand.'_'.$logo);
							$save     = $database -> update_bb($con,$nota,$kd_barang,$kd_sup,$tgl_beli,$qty,$tot_bay,$per_item,$filename_logo,$id);														
						}
					}		
					else
					{
						echo '<script>alert("Ukuran foto terlalu besar");window.location.href="?p=bb";</script>';
					}
				}	
			}			
		}
		else
		{
			$d = array('','','','','','','','','',);
		}				
		include("views/bd.php");
	}	
	elseif($p == "trns") // HALAMAN GANTI PASSWORD
	{
		$barang           = $database -> tampil_data_brg($con);
		$data             = $database -> tampil_data_transaksi_sementara($con);
		$bul              = date("m");
		$tgl1             = date("d");
		$thn              = date("Y");
		$tgl_transaksi    = $tgl1.' '.$database -> getBulan($bul).' '.$thn;
		$total_pembayaran = $database -> total_pembayaran($con);
		$tgl 	= date("Y/m/d");
		$cek_data_transaksi_sementara = $database -> cek_data_transaksi_sementara($con);

		if(isset($_POST['tambah']))
		{
			$kode        = mysqli_real_escape_string($con, $_POST["kode"]);
			$stok        = mysqli_real_escape_string($con, $_POST["stok"]);
			$hrg         = mysqli_real_escape_string($con, $_POST["hrg"]);
			$qty         = mysqli_real_escape_string($con, $_POST["qty"]);
			$subtotal    = mysqli_real_escape_string($con, $_POST["subtotal"]);			

			if($kode == 0)
			{
				echo '<script>alert("Nama Barang tidak boleh kosong");window.location.href="?p=trns";</script>';
			}
			elseif($qty > $stok)
			{
				echo '<script>alert("Stok tidak terpenuhi");window.location.href="?p=trns";</script>';
			}
			else
			{
				$sisa_stok   = $stok - $qty;
				$save    = $database -> save_transaksi_sementara($con,$kode,$qty,$hrg,$subtotal,$sisa_stok);
			}			
		}
		if(!empty($_GET["d"]))
		{
			$kd = $_GET["d"];						
			$database -> hapus_transaksi_sementara($con,$kd);			
		}
		if(isset($_POST['proses_bayar']))
		{

			$diskon        = mysqli_real_escape_string($con, $_POST["diskon"]);
			$total_bayar   = mysqli_real_escape_string($con, $_POST["total_bayar"]);
			$uang_bayar    = mysqli_real_escape_string($con, $_POST["uang_bayar"]);
			$kembali_uang  = mysqli_real_escape_string($con, $_POST["kembali_uang"]);
			$id_admin      = $_SESSION["id_admin"];

			$nota            = $database -> cari_nota_terakhir($con);
			$nota_terakhir   = $nota[0] + 1;		

			if($kembali_uang < 0)
			{
				echo '<script>alert("Uang Bayar kurang. Silahkan Ulangi kembali");window.location.href="?p=trns";</script>';				
			}			
			else
			{			
				$save    = $database -> save_transaksi($con,$tgl,$total_bayar,$diskon,$uang_bayar,$kembali_uang,$id_admin,$nota_terakhir);				
			}			
		}
		include("views/bd.php");
	}
	elseif($p == "gp") // HALAMAN GANTI PASSWORD
	{			
		if(isset($_POST['update']))
		{
			// session_start();
			$pass_lama   = mysqli_real_escape_string($con, $_POST['pas_lama']);
			$pass_bar    = mysqli_real_escape_string($con, $_POST['pas_baru']);
			$pass_ver    = mysqli_real_escape_string($con, $_POST['pas_ver']);
			$id          = $_SESSION["id_admin"];
			$d           = $database -> tampil_satu_data_ad($con,$id);
			// $cek_hash    = $database -> PassHash::check_password($d[3], $pass_lama);
			
			if(password_verify($pass_lama, $d[3]))
			{
				if($pass_bar == $pass_ver)
				{
					$pass_baru = mysqli_real_escape_string($con, PassHash::hash($_POST["pas_baru"]));
					$save = $database -> update_gp($con,$pass_baru,$id);
				}
				else
				{
					echo "<script>window.alert('Password Baru Tidak Sama!');window.location.href='?p=gp';</script>";	
				}
			}
			else
			{		
				// echo "$pass_lama == $d[3]";
				echo "<script>window.alert('Password Lama Salah!');window.location.href='?p=gp';</script>";
			}
		}
		include("views/bd.php");
	}		
	else if($p == "print_transaksi")
	{		
		if(!empty($_GET['nota']))
		{
			$d            = $database -> tampil_data_pp($con);
			$nama_toko    = strtoupper($d[1]);
			$alamat_toko  = ucwords($d[2]);
			$no_toko      = $d[3];
			
			$no_nota      = $_GET['nota'];
			$db           = $database -> tampil_data_transaksi($con,$no_nota);
			$db2           = $database -> tampil_data_transaksi_satu($con,$no_nota);	
			$db3           = $database ->tampil_data_transaksi_id_admin($con,$no_nota);
			$tgl_nota	  = $db2[0];

			$id     	= $db3[0];
			$dtadmin	  = $database -> tampil_satu_data_ad($con,$id);
			$nm_admin     = $dtadmin[1];		
		}
		else
		{
			$d            = $database -> tampil_data_pp($con);
			$nama_toko    = strtoupper($d[1]);
			$alamat_toko  = ucwords($d[2]);
			$no_toko      = $d[3];

			$dt           = $database -> cari_nota_terakhir($con);
			$no_nota      = $dt[0];
			$tgl_nota     = $dt[1];

			$db           = $database -> tampil_data_transaksi($con,$no_nota);

			// session_start();
			$id_admin     = $_SESSION["id_admin"];
			$nm_admin     = ucwords($_SESSION["nama"]);
		}

		include("views/print_transaksi.php");
	}	
	elseif ($p == "lh")
	{
		$data = $database -> tampil_data_transaksi_semua($con);		
		if(!empty($_GET["d"]))
		{
			$kd = $_GET["d"];						
			$database -> hapus_transaksi($con,$kd);			
		}
		include("views/bd.php");
	}
	elseif ($p == "lc")
	{
		if(isset($_POST['filter'])) 
		{	
			if(!empty($_POST["dari"]) && !empty($_POST["ke"]))
			{
				// echo "<script>window.location.href='?p=lc';</script>";	
	
				$dari       = $_POST["dari"];
				$ke         = $_POST["ke"];

				$tgldari    = substr($dari, 8,2);
				$blndari    = substr($dari, 5,2);
				$thndari    = substr($dari, 0,4);
				
				$tglke      = substr($ke, 8,2);
				$blnke      = substr($ke, 5,2);
				$thnke      = substr($ke, 0,4);

				$data       = $database -> cari_laporan($con,$dari,$ke);
				$count      = $database -> cari_laporan_count($con,$dari,$ke);
			}
		}		
		else 
		{
			$dari    = '';
			$ke      = '';
			$data    = $database -> tampil_data_transaksi_semua($con);
		}		
		include("views/bd.php");
	}
	elseif ($p == "dac")
	{
		if (!empty($_GET["dari"]) && !empty($_GET["ke"]))
		{	
			$dari       = $_GET["dari"];
			$ke         = $_GET["ke"];

			$tgldari    = substr($dari, 8,2);
			$blndari    = substr($dari, 5,2);
			$thndari    = substr($dari, 0,4);
			
			$tglke      = substr($ke, 8,2);
			$blnke      = substr($ke, 5,2);
			$thnke      = substr($ke, 0,4);

			$dari    = mysqli_real_escape_string($con, $_GET["dari"]);
			$ke      = mysqli_real_escape_string($con, $_GET["ke"]);
			
			$qry     = $database -> download_laporan($con,$dari,$ke);
		}
		include("views/dac.php");
	}
	elseif ($p == "lpdf")
	{
		if (!empty($_GET["dari"]) && !empty($_GET["ke"]))
		{	
			$dari       = $_GET["dari"];
			$ke         = $_GET["ke"];

			$tgldari    = substr($dari, 8,2);
			$blndari    = substr($dari, 5,2);
			$thndari    = substr($dari, 0,4);
			
			$tglke      = substr($ke, 8,2);
			$blnke      = substr($ke, 5,2);
			$thnke      = substr($ke, 0,4);

			$dari    = mysqli_real_escape_string($con, $_GET["dari"]);
			$ke      = mysqli_real_escape_string($con, $_GET["ke"]);
			
			$qry     = $database -> download_laporan($con,$dari,$ke);
		}
		include("views/lpdf.php");
	}
	//HALAMAN LOGOUT
	else if($p == "out")
	{
		// session_start();
		if (isset($_SESSION['user']))
		{
		session_destroy();

		echo "<script language='javascript'>document.location='index'</script>";
		}
	}
	else
	{
		include("views/index.php");
	}
}
//DEFAULT
else
{
	if(empty($_GET["p"]))
	{
		// session_start();
				
		if(!empty($_POST['user']) && !empty($_POST['pass']))				
		{
			$u = mysqli_real_escape_string($con, $_POST["user"]);			
			$p = mysqli_real_escape_string($con, $_POST["pass"]);
			$database -> login($con, $u, $p);
		}		
	}
	include ("views/h.php");
}
?>