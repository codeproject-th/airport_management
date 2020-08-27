<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<script src="./jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
	<script src="./jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<link rel='stylesheet' href='./jquery-ui-1.11.4.custom/jquery-ui.css' type='text/css' media='all' />
	<link rel='stylesheet' href='./css/style.css' type='text/css' media='all' />
	<title>Admin</title> 
</head>
<body>
	<div class="container">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr valign="bottom">
				<td colspan="2" align="right">
				<div class="header">
					
				</div>
				<div style="padding: 5px;">
				<? if($_SESSION['login_id']!=''){ ?>
					<img src="images/change_password.png"> <a href="index.php?mod=admin&f=edit_pass">แก้ไขรหรัสผ่าน</a>
					&nbsp;&nbsp;
					<img src="images/logout.png"> <a href="logout.php">ออกจากระบบ</a>
				<? } ?>
				</div>
				</td>
			</tr>
			<tr valign="top" valign="top">
				<td width="25%" style="padding-bottom: 20px;">
					<? include('menu.php') ?>
				</td>
				<td style="padding: 5px; padding-top: 0px;">
					<div class="content"><? include($file_page); ?></div>
				</td>
			</tr>
			<tr>
				<td colspan="2" height="100" align="center" bgcolor="#0d4bf2">
					<font color="#FFFFFF">สนามบินทานตะวัน 7 ม.2 ต.นายาว อ.พระพุทธบาท จ.สระบุรี 18120
					<br>
					เบอร์โทร 083-8988245</font>
				</td>
			</tr>
		</table>
	</div>
</body>
</html> 		