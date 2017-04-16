<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
	</head>
	<link rel="stylesheet" href="asset/css/style.css">
    <?php
    	include "config/koneksi.php";
		include "library/lib.php";
		
		$perintah = new oop();
		@$table = "user";
		@$username = $_POST['username'];
		@$password = $_POST['password'];
		@$type = $_POST['type'];
		if(isset($_POST['masuk'])){
			$perintah->login($table,$username,$password,$type,"page/index.php?menu=utama");	
		}
	?>
	<body>
    	<br><br></br>
    	<div class="wrap">
        <form method="post">
    		<table width="100%">
            	<tr>
                	<td><center><h3 class="judul">Silahkan Login</h3></center></td>
                </tr>
                <tr>
                	<td><hr style="border:thin solid #81CFE0"></td>
                </tr>
                <tr>
                	<td><input type="text" name="username" placeholder="Username"  class="form" required ></td>
                </tr>
                <tr>
                	<td><input type="password" name="password" placeholder="Password" class="form" required ></td>
                </tr>
                <tr>
                	<td>
                    	<select name="type" class="form-select" style="width:100%" required>
                        	<option></option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                        </select>
                    </td>
                </tr>
                 <tr>
                	<td><input type="submit" name="masuk" class="btn" value="MASUK"></td>
                </tr>
            </table>
        </div>
        </form>
	</body>
</html>