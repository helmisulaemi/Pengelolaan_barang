<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Laporan Penjualan</title>
</head>
<?php 
	include "../../config/koneksi.php";
	include "../../library/lib.php";
	$perintah = new oop();
?>
<link rel="stylesheet" href="../../asset/css/laporan.css">
<body>

	<div id="print">
    	<h4><a href="#" onClick="document.getElementById('print').style.display='none';window.print();" class="print">Print</a></h4>
    </div>
    <br>
    <div class="utama">
    <center><h2>Laporan Keuangan</h2></center>
    <hr style="border:thin solid #CCC;">
    <table width="100%" class="table" align="center" border="1">
    	<tr class="beri-warna">
        	<td>No</td>
            <td>Kode Transaksi</td>
            <td>Tanggal</td>
            <td>Total</td>
        </tr>
        <?php
			$no =0;
        	$a = $perintah->tampil("qtransaksi where tgl_transaksi between '$_GET[dari]' and '$_GET[sampai]' ");
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
            <td><?php echo "Rp. ".number_format($b[2])?></td>
        </tr>
        <?php
		 } }
		 $total = mysql_fetch_array(mysql_query("select sum(total)as jumlah from qtransaksi where tgl_transaksi between '$_GET[dari]' and '$_GET[sampai]'"));
		 ?>
        <tr>
        	<td colspan="3" align="center">Total Keuangan</td>
            <td><?php echo "Rp. ".number_format($total['jumlah'])?></td>
        </tr>
    </table>
    </div>
</body>
</html>