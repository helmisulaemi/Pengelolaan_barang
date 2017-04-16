<?php
	@session_start();
	
	include "../config/koneksi.php";
	include "../library/lib.php";
	
	$perintah = new oop();
	if(empty($_SESSION['username']) and empty($_SESSION['type'])){
		echo "<script>document.location.href='../'</script>";
	}else{
		
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Aplikasi Penjualan PD.Hasan</title>
	</head>
	<link rel="stylesheet" href="../asset/css/style.css">
	<body>
    	<nav>
        	<ul class="dropdown">
           		<li><a href="" class="brand">PD.Hasan </a><li>
                	 <ul class="dropdown right">
                       	<li><a href="">Hallo, <?php echo $_SESSION['username']?></a></li>
            		</ul>   
            </ul>   
           
          
           
        </nav>
        <br></br>
        <div class="kotak-atas">
        	<?php
			if($_SESSION['type']=="admin"){
            	$menu = array(
							array('url'=>'utama','text'=>'Home','con'=>''),
							array('url'=>'barang','text'=>'Data Barang','con'=>''),
							array('url'=>'stock','text'=>'Barang Masuk','con'=>''),
							array('url'=>'transaksi','text'=>'Transaksi Penjualan','con'=>''),
							array('url'=>'logout','text'=>'Logout','con'=>"return confirm('Klik OK untuk Keluar !')"),
						);
			}elseif($_SESSION['type']=="manager"){
				$menu = array(
							array('url'=>'utama','text'=>'Home','con'=>''),
							array('url'=>'lapkeuangan','text'=>'Laporan Keuangan','con'=>''),
							array('url'=>'lappenjualan','text'=>'Laporan Penjualan','con'=>''),
							array('url'=>'lapbarang','text'=>'Laporan Barang','con'=>''),
							array('url'=>'lappembelian','text'=>'Laporan Pembelian','con'=>''),
							array('url'=>'kelola','text'=>'Data Pegawai','con'=>''),
							array('url'=>'logout','text'=>'Logout','con'=>"return confirm('Klik OK untuk Keluar !')"),
						);
			}
			foreach($menu as $a){
				if($_GET['menu']=="$a[url]"){
			?>
            	<a href="index.php?menu=<?php echo $a['url']?>" class="btn-menu-aktif" onClick="<?php echo $a['con']?>"><?php echo $a['text'] ?></a>
            <?php }else{ ?>
            	<a href="index.php?menu=<?php echo $a['url']?>" class="btn-menu" onClick="<?php echo $a['con']?>"><?php echo $a['text'] ?></a>
            <?php } }?>
        </div>
        <br>
        <div class="kotak-bawah">
        	<?php
            	switch($_GET['menu']){
					case "utama";
					include "main.php";
					break;
					
					case "barang";
					include "admin/barang.php";
					break;
					
					case "stock";
					include "admin/stock.php";
					break;
					
					case "transaksi";
					include "admin/transaksi.php";
					break;
					
					case "lapbarang";
					echo "<script>document.location.href='manager/laporan_barang.php'</script>";
					break;
					
					case "lappenjualan";
					echo "<script>document.location.href='manager/laporan_penjualan.php'</script>";
					break;
					
					case "lappembelian";
					include "manager/laporang_pembelian.php";
					break;
					
					case "lapkeuangan";
					include "manager/pilih_lapkeuangan.php";
					break;
					
					case "kelola";
					include "manager/kelola_pengelola.php";
					break;
					
					case "logout";
					include "logout.php";
					break;
				}
			?>
        </div>
	</body>
</html>
<?php } ?>