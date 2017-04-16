<?php
	$carikode = mysql_fetch_array(mysql_query("select * from barang order by kd_barang DESC"));
	$kode = substr($carikode['kd_barang'],2,4)+1;
	$nextkode = sprintf("BR"."%04s",$kode);
	
	@$table = "barang";
	@$where = "kd_barang = '$_GET[id]'";
	@$redirect = "?menu=barang&databarang=data";
	@$foto = $_FILES['foto'];
	@$tempat = "../foto";
	if(isset($_POST['simpan'])){
			$upload = $perintah->upload($foto,$tempat);
			$data = array(
						'kd_barang'=>$nextkode,
						'nama_barang'=>$_POST['nama_barang'],
						'tgl_masuk'=>$_POST['tgl_masuk'],
						'harga'=>$_POST['harga'],
						'stock'=>$_POST['stock'],
						'foto'=>$upload,
					);
			$perintah->simpan($table,$data,$redirect);
			
	}
	if(isset($_GET['hapus'])){
		$perintah->hapus($table,$where,$redirect);
	}
	if(isset($_GET['edit'])){
		@$dis = "disabled";
		@$edit = $perintah->edit($table,$where);
	}
	if(isset($_POST['update'])){
		$upload = $perintah->upload($foto,$tempat);
		if(empty($_FILES['foto']['name'])){
			$data = array(
						'nama_barang'=>$_POST['nama_barang'],
						'tgl_masuk'=>$_POST['tgl_masuk'],
						'harga'=>$_POST['harga'],
					);
		}else{
			$data = array('nama_barang'=>$_POST['nama_barang'],
						'tgl_masuk'=>$_POST['tgl_masuk'],
						'harga'=>$_POST['harga'],
						'foto'=>$upload,
						);
		}
		$perintah->update($table,$data,$where,$redirect);
	}
?>
<h4>Form Barang</h4>
<form method="post" enctype="multipart/form-data">
	<table width="100%">
    	<tr>
        	<td>Kode Barang</td>
            <td>:</td>
            <td><input type="text" name="kd_barang" value="<?php if(@$_GET['id']==''){echo $nextkode;}else{echo $edit[0];}?>" class="form" 
            readonly="readonly" required="required"  /></td>
        </tr>
        <tr>
        	<td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="nama_barang" value="<?php echo @$edit[1] ?>" class="form" required="required" /></td>
        </tr>
        <tr>
        	<td>Tanggal Masuk</td>
            <td>:</td>
            <td><input type="date" name="tgl_masuk"  value="<?php echo @$edit[2] ?>" class="form" required="required" /></td>
        </tr>
        <tr>
        	<td>Harga</td>
            <td>:</td>
            <td><input type="number" name="harga" value="<?php echo @$edit[3] ?>" class="form" required="required" </td>
        </tr>
        <tr>
        	<td>Stock</td>
            <td>:</td>
            <td><input type="number" name="stock" value="<?php echo @$edit[4] ?>" <?php echo @$dis ?> class="form" required="required"</td>
        </tr>
        <tr>
        	<td>Foto</td>
            <td>:</td>
            <td><input type="file" name="foto"  class="form" /></td>
        </tr>
        <tr>
        	<td></td>
            <td></td>
            <td>
            <?php
            	if(@$_GET['id']==''){
			?>
            	<input type="submit" name="simpan" value="SIMPAN" class="btnn" />
                <input type="reset" value="RESET" class="btnn" />
            <?php }else{ ?>
            	<input type="submit" name="update" value="UPDATE" class="btnn" />
                <a href="?menu=barang&databarang=data" class="btnn kecil" onclick="return confirm('Batalkan Perubahan ?')">BATAL</a>
            <?php } ?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
        	<td>
            <?php if(@$_GET['databarang']=='data'){?>
            <a href="?menu=barang" class="tampilkan">Sembunyikan Data Barang</a>
            <?php }else{ ?>
            <a href="?menu=barang&databarang=data" class="tampilkan">Lihat Data Barang</a>
            <?php } ?>
            </td>
            <td></td>
            <td></td>
    </table>
</form>
<?php if(@$_GET['databarang']=='data'){?>
<hr style="border:thin solid #81CFE0" />
	<table class="table" border="1" width="100%">
    	<tr class="beri-warna">
        	<td>No</td>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>Tanggal Masuk</td>
            <td>Harga</td>
            <td>Stock</td>
            <td>Foto</td>
            <td></td>
        </tr>
        <?php 
			$no = 0;
			$a  = $perintah->tampil("barang order by kd_barang DESC");
			if($a == ""){
				echo "<tr><td colspan='8' aling='ceter'><strong>No Record</strong></td></tr>";
			}else{
				foreach($a as $b){
					$no++;
		?>
        <tr>
        	<td><?php echo $no ?></td>
            <td><?php echo $b[0] ?></td>
            <td><?php echo $b[1] ?></td>
            <td><?php echo $b[2] ?></td>
            <td><?php echo "Rp. ".number_format($b[3]) ?></td>
            <td><?php echo $b[4] ?></td>
            <td><?php echo $b[5] ?></td>
            <td>
            	<a href="?menu=barang&databarang=data&edit&id=<?php echo $b[0] ?>" class="tampilkan">Edit</a> |
                <a href="?menu=barang&databarang=data&hapus&id=<?php echo $b[0] ?>" onclick="return confirm('Hapus <?php echo $b[1]?> ?')" 
                class="tampilkan">Hapus</a>
            </td>
        </tr>
        <?php 	} 
			} ?>
    </table>
    <br />
    <a href="" class="tampilkan" style="text-decoration:none">Stock Kosong : <?php echo mysql_num_rows(mysql_query("select * from barang where stock = ''"))?></a>
<?php } ?>	