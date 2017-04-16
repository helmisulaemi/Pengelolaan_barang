<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Laporan Penjualan</title>
</head>
<link rel="stylesheet" href="../../asset/css/laporan.css" />
<?php 
	include "../../config/koneksi.php";
	include "../../library/lib.php";
	$perintah = new oop();
?>

<body>
	<div id="print">
    	<h4><a href="#" onclick="document.getElementById('print').style.display='none';window.print();" class="print">print</a></h4>
    </div>
    <br />
    <div class="utama">
    	<center><h2>Laporan Penjualan</h2></center>
    <hr style="border:thin solid #CCC;">
    <table width="100%" class="table" align="center" border="1">
    	<tr class="beri-warna">
        	<td>No</td>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>Terjual</td>
        </tr>
        <?php
			$no =0;
        	$a = $perintah->tampil("barang_keluar");
			if($a == ""){
				echo "<tr><td colspan='4' align='center'><strong>No Record</strong></td></tr>";
			}else{
				foreach($a as $b){
					$no++
		?>
        <tr>
        	<td><?php echo $no?></td>
            <td><?php echo $b[0]?></td>
            <td><?php echo $b[1]?></td>
            <td><?php echo $b[3]?></td>
        </tr>
        <?php } }?>
    </table>
    </div>
</body>
</html>