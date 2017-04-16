<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db   = "pd_hasan";
	
	mysql_connect($host,$user,$pass) or die ("Koneksi ke server gagal");
	mysql_select_db($db);
?>