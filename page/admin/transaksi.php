<?php
	$tgl = date("Y-m-d");
	@$carikode = mysql_fetch_array(mysql_query("select * from transaksi order by kd_transaksi DESC"));
	@$kode = substr($carikode['kd_transaksi'],2,4)+1;
	@$nextkode = sprintf("TR"."%04s",$kode);
	
	if(isset($_POST['nama'])){
				$sql = mysql_query("select * from barang where nama_barang = '$_POST[nama]'");
				$data = mysql_fetch_array($sql);
	}
	if(isset($_POST['tambah'])){
			$data = array(
						'kd_barang'=>$data['kd_barang'],
						'nama_barang'=>$_POST['nama'],
						'harga'=>$_POST['harga'],
						'jumlah_keluar'=>$_POST['jumlah_beli'],
						'status'=>1
					);
			$perintah->simpan("barang_keluar",$data,"?menu=transaksi&chart=data");
	}
	if(isset($_GET['hapus'])){
		$perintah->hapus("barang_keluar","kd_barang = '$_GET[id]'","?menu=transaksi&chart=data");
	}
	if(isset($_POST['batal'])){
		$perintah->hapus("barang_keluar","status = 1","?menu=transaksi&chart=data");
	}
?>
<h4>Form Transaksi Penjualan Barang</h4>
<form method="post" >
	<table width="100%">
        <tr>
        	<td>Nama Barang</td>
            <td>:</td>
            <td>
           
            	<select name="nama" class="form-select pendek" onchange="submit()">
                	<option value="<?php echo @$data['nama_barang'] ?>"><?php echo @$_POST['nama'] ?></option>
                    <option value=""></option>
                    <?php
                    	@$a = $perintah->tampil("barang where stock !=''");
						foreach($a as $b){
					?>
                    <option value="<?php echo $b[1]?>" ><?php echo @$b[1]?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Harga</td>
            <td>:</td>
            <td><input type="number" name="harga" value="<?php echo $data['harga'] ?>" class="form" readonly required ></td>
        </tr>
       
        <tr>
        	<td>Jumlah Beli</td>
            <td>:</td>
            <td><input type="number" name="jumlah_beli"  class="form" >
            </td>
        </tr>
        <tr>
        	<td></td>
            <td></td>
            <td>
            <input type="submit" name="tambah" value="TAMBAHKAN" class="btnn" />
            <a href="<?php if(@$_GET['chart']=='data'){echo "?menu=transaksi&chart=data";}else{echo "?menu=transaksi";}?>" 
            class="btnn kecil" >RESET</a>
          	<a href="?menu=transaksi&chart=data" class="btnn kecil" >Lihat Barang Jualan</a>
            </td>
        </tr>
    </table>
    <?php if(@$_GET['chart']=='data'){?>
    <table width="100%" class="table">
    	<tr>
        	<td colspan="8">Kode Transaksi : <?php echo $nextkode?></td>
        </tr>
        <tr>
        	<td>No</td>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>Harga</td>
            <td>Qty</td>
            <td>Subtotal</td>
            <td colspan="2"></td>
        </tr>
        <?php
			$no = 0;
        	$a = $perintah->tampil("barang_keluar where status = 1");
			if($a == ""){
				echo "<tr><td colspan = '8' align='center'><strong>No Record</strong></td></tr>";
			}else{
				foreach($a as $b){
					$no++;
		?>
        <tr>
        	<td><?php echo $no?></td>
            <td><?php echo $b[0]?></td>
            <td><?php echo $b[1]?></td>
            <td><?php echo "Rp. ".number_format($b[2])?></td>
            <td><?php echo $b[3]?></td>
            <td><?php $sub = "Rp. ".number_format($b[2]*$b[3]); echo $sub?></td>
            <td colspan="2"><a href="?menu=transaksi&chart=data&hapus&id=<?php echo $b[0]?>" class="tampilkan">Hapus Barang</a></td>
        </tr>
        <?php
			if(isset($_POST['selesai'])){
				$data = array(
							'kd_transaksi'=>$nextkode,
							'kd_barang'=>$b[0],
							'tgl_transaksi'=>$tgl,
							'qty'=>$b[3],
							'subtotal'=>$b[2]*$b[3],
						);
				$perintah->simpan("transaksi",$data,"?menu=transaksi");
				mysql_query("update barang_keluar set status = '0' where kd_barang = '$b[0]'");
			} 
		} } 
		$total = mysql_fetch_array(mysql_query("select sum($b[2]*$b[3])as total from barang_keluar where status = 1"));
		?>
        <tr>
        	<td colspan="4"></td>
        	<td>Total : </td>
            <td><?php echo "Rp. ".number_format($total['total'])?></td>
            <td><input type="submit" name="selesai" value="SELESAI TRANSAKSI" class="btn" /></td>
            <td><input type="submit" name="batal" value="BATAL TRANSAKSI" class="btn" /></td>
        </tr>
    </table>
    <?php } ?>
    <br />
    <table>
        <tr>
        	<td>
            <?php if(@$_GET['datatransaksi']=='data'){?>
            <a href="?menu=transaksi" class="tampilkan">Sembunyikan Data Transaksi</a>
            <?php }else{ ?>
            <a href="?menu=transaksi&datatransaksi=data" class="tampilkan">Lihat Data Transaksi</a>
            <?php } ?>
            </td>
            <td></td>
            <td></td>
    </table>
</form>
<?php if(@$_GET['datatransaksi']=='data'){?>
<hr style="border:thin solid #81CFE0" />
	<table class="table" border="1" width="100%">
    	<tr class="beri-warna">
        	<td>No</td>
            <td>Kode Transaksi</td>
            <td>Tanggal Transaksi</td>
            <td>Total</td>
        </tr>
        <?php 
			$no = 0;
			$a  = $perintah->tampil("qtransaksi order by kd_transaksi DESC");
			if($a == ""){
				echo "<tr><td colspan='4' aling='ceter'><strong>No Record</strong></td></tr>";
			}else{
				foreach($a as $b){
					$no++;
		?>
        <tr>
        	<td><?php echo $no ?></td>
            <td><?php echo $b[0] ?></td>
            <td><?php echo $b[1] ?></td>
            <td><?php echo "Rp. ".number_format($b[2]) ?></td>
        </tr>
        <?php 	} 
			} ?>
    </table>
    <br>
    
<?php } ?>	