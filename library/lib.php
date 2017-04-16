<?php
	class oop{
	
		function simpan($table,array $data, $redirect){
			$sql = "INSERT INTO $table SET";
			foreach($data as $key => $value){
				$sql .=" $key = '$value' ,";
			}
			$sql = rtrim($sql,',');
			$jalan = mysql_query($sql);
			if($jalan){
				echo "<script>alert('Data berhasil disimpan.');document.location.href='$redirect'</script>";
			}else{
				echo mysql_error();
			}	
		}
		
		function update($table,array $data,$where, $redirect){
			$sql = "UPDATE $table SET";
			foreach($data as $key => $value){
				$sql .=" $key = '$value' ,";
			}
			$sql = rtrim($sql,',');
			$sql .= "where $where";
			$jalan = mysql_query($sql);
			if($jalan){
				echo "<script>alert('Data berhasil diupdate.');document.location.href='$redirect'</script>";
			}else{
				echo mysql_error();
			}	
		}
		
		function tampil($table){
			$sql = "SELECT * FROM $table";
			$tampil = mysql_query($sql);
			while($data = mysql_fetch_array($tampil))
				$isi[] = $data;
			return @$isi;
		}
		
		function edit($table,$where){
			$sql = "SELECT * FROM $table where $where";
			$edit = mysql_fetch_array(mysql_query($sql));
			return $edit;
		}
		
		function hapus($table,$where, $redirect){
			$sql = "DELETE FROM $table where $where";
			$jalan = mysql_query($sql);
			if($jalan){
				echo "<script>alert('Data berhasil dihapus..');document.location.href='$redirect'</script>";
			}else{
				echo mysql_error();
			}	
		}
		
		function login($table,$username,$password,$type,$nama_form){
			@session_start();
			$sql = "SELECT * FROM $table WHERE username = '$username' and password = '$password' and type_user = '$type'";
			$query = mysql_query($sql);
			$cek = mysql_num_rows($query);
			if($cek > 0){
				$_SESSION['username'] = $username;
				$_SESSION['type'] = $type;
				echo "<script>alert('Login berhasil');document.location.href='$nama_form'</script>"; 
			}else{
				echo "<script>alert('Maaf Username atau Password Anda salah !');document.location.href='index.php'</script>";	
			}
				
		}
		
		function upload($foto,$tempat){
			$alamat = $foto['tmp_name'];
			$nama_file = $foto['name'];
			move_uploaded_file($alamat,"$tempat/$nama_file");
			return $nama_file;
		}
				
	}
?>