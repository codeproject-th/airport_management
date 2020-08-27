<?php
session_start();
ini_set('error_reporting', E_STRICT);
include_once('config.php');
include_once('./libs/db.php');

if($_POST){
	db::open();
	$select['Username'] = $_POST['username'];
	$select['Password'] = $_POST['password'];
	$rows = db::select('user',$select);
	if(count($rows)>0){
		$_SESSION['login_id'] = $rows[0]['User_id'];
		 header("Location: index.php");
		 exit;
	}else{
		$error = "Username หรือ Password ไม่ถูกต้อง";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel='stylesheet' href='./css/style.css' type='text/css' media='all' />
	<title></title> 
</head>
<body>
	<div class="container">
		<center>
		<form method="post">
		<table width="500" border="0" cellpadding="0" cellspacing="0" style="margin-top: 150px; margin-bottom: 150px;">
			<tr>
				<td width="200" align="right" height="30">
					Username : &nbsp;
				</td>
				<td>
					<input type="text" name="username"/>
				</td>
			</tr>
			<tr>
				<td width="200" align="right" height="30">
					Password :  &nbsp;
				</td>
				<td>
					<input type="password" name="password"/>
				</td>
			</tr>
			<tr>
				<td width="200" align="right" height="30">
				</td>
				<td>
					<input type="submit" value="เข้าสู่ระบบ"/>
					<input type="button" value="หน้าหลัก" onclick="window.location='index.php';"/>
				</td>
			</tr>
            
			<tr>
				<td colspan="2" align="center">
					<div style="color:#ff0000"><?=$error?></div>
				</td>
			</tr>
		</table>
		</form>
       
		</center>
	</div>
</body>
</html> 		