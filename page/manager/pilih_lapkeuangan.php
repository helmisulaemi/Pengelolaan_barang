<form method="post">
	<table>
    	<tr>
        	<td>Pilih dari tanggal</td>
            <td>:</td>
            <td><input type="date" name="dt" class="form" required></td>
            <td width="10px"></td>
            <td>sampai </td>
            <td>:</td>
            <td><input type="date" name="st"  class="form" required></td>
        </tr>
        <tr>
        	<td></td>
            <td></td>
            <td colspan="4">
            <input type="submit" name="lihat" value="LIHAT LAPORAN" class="btn-menu	">
            </td>
        </tr>
    </table>
    <?php
    	if(isset($_POST['lihat'])){
			echo "<script>document.location.href='manager/laporan_keuangan.php?dari=$_POST[dt]&sampai=$_POST[st]'</script>";
		}
	?>
</form>