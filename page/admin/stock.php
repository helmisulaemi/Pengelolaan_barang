<?php
	$b = date("Y-m-d");
	if(isset($_POST['caribarang'])){
		@$sql = mysql_query("select * from barang where kd_barang like '%$_POST[kd_barang]%'");
		@$data = mysql_fetch_array($sql);
	}
	if(isset($_POST['simpan'])){
		if($_POST['inputstock']==''){
			echo"<script>alert('masukan jumlah stock')</script>";
		}else{
			$data = array(
					'kd_barang'=>$_POST['kd_barang'],
					'nama'=>$_POST['nama_barang'],
					'jumlah_masuk'=>$_POST['inputstock'],
					'tgl_masuk'=>$b,
					);
			$perintah->simpan("barang_masuk",$data,"?menu=stock&datastock=data");
		}
	}
?>
<h4>Form Stock  Barang</h4>
<form method="post" >
	<table width="100%">
    	<tr>
        	<td>Kode Barang</td>
            <td>:</td>
            <td colspan="2"><input type="text" name="kd_barang" value="<?php echo @$data[0] ?>" class="form pendek" placeholder="Masukan Kode Barang "
             required />
            <input type="submit" name="caribarang" value="CARI BARANG" class="btnn pendek" />	
            </td>
        </tr>
        <tr>
        	<td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="nama_barang" value="<?php echo @$data[1] ?>" class="form" readonly required="required" /></td>
        </tr>
        <tr>
        	<td>Stock Tersedia</td>
            <td>:</td>
            <td><input type="number" value="<?php echo @$data[4] ?>" class="form" readonly required ></td>
        </tr>
        <tr>
        	<td>Input Stock</td>
            <td>:</td>
            <td><input type="number" name="inputstock" <?php if(isset($_POST['caribarang'])){echo"enable";}else{echo "disabled";} ?> class="form" ></td>
        </tr>
        <tr>
        	<td></td>
            <td></td>
            <td>
          
            	<input type="submit" name="simpan" value="SIMPAN" class="btnn" />
                <input type="reset" value="RESET" class="btnn" />
          
            </td>
        </tr>
    </table>
    <table>
        <tr>
        	<td>
            <?php if(@$_GET['datastock']=='data'){?>
            <a href="?menu=stock" class="tampilkan">Sembunyikan Data Barang Masuk</a>
            <?php }else{ ?>
            <a href="?menu=stock&datastock=data" class="tampilkan">Lihat Data Barang Masuk</a>
            <?php } ?>
            </td>
            <td></td>
            <td></td>
    </table>
</form>
<?php if(@$_GET['datastock']=='data'){?>
<hr style="border:thin solid #81CFE0" />
	<table class="table" border="1" width="100%">
    	<tr class="beri-warna">
        	<td>No</td>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>Tanggal Masuk</td>
            <td>Jumlah Masuk</td>
        </tr>
        <?php 
			$no = 0;
			@$a  = $perintah->tampil("barang_masuk order by kd_barang DESC");
			if($a == ""){
				echo "<tr><td colspan='5' aling='ceter'><strong>No Record</strong></td></tr>";
			}else{
				foreach($a as $b){
					$no++;
		?>
        <tr>
        	<td><?php echo $no ?></td>
            <td><?php echo $b[0] ?></td>
            <td><?php echo $b[1] ?></td>
            <td><?php echo $b[3] ?></td>
            <td><?php echo $b[2] ?></td>
        </tr>
        <?php 	} 
			} ?>
    </table>
    <br>
    
<?php } ?>	