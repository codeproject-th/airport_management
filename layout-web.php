<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<script src="./jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
	<script src="./jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<link rel='stylesheet' href='./jquery-ui-1.11.4.custom/jquery-ui.css' type='text/css' media='all' />
	<link rel='stylesheet' href='./css/style-web.css' type='text/css' media='all' />
	<title></title> 
</head>
<body>
	<div class="container">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td  align="right" class="header">
				
				</td>
			</tr>
			<tr>
				<td bgcolor="#2f53d0" colspan="2" height="30" class="menu">
				<? if($_SESSION['member_id']==''){ ?> 
					<a href="index.php?mod=home&f=register">สมัครสมาชิก</a>
					<a href="index.php?mod=home&f=login">เข้าสู่ระบบ</a>
					<a href="login.php">ผู้ดูแลระบบ</a>
				<? } ?>
				<? if($_SESSION['member_id']!=''){ ?> 
					<a href="index.php?mod=home&f=profile">แก้ไขข้อมูลส่วนตัว</a>
					<a href="index.php?mod=home&f=aircraft">เพิ่มเครื่องบิน</a>
					<a href="index.php?mod=home&f=aircraft_list">ข้อมูลเครื่องบิน</a>
					<a href="index.php?mod=home&f=rent">เพิ่มการเช่าสนามบิน</a>
					<a href="index.php?mod=home&f=rent_list">ข้อมูลการเช่าสนามบิน</a>
					<a href="index.php?mod=home&f=deposit">เพิ่มการรับฝากเครื่องบิน</a>
					<a href="index.php?mod=home&f=deposit_list">ข้อมูลฝากเครื่องบิน</a>
					<a href="index.php?mod=home&f=logout">ออกจากระบบ</a>
				<? } ?>
				</td>
			</tr>
			<tr valign="top" valign="top">
				<td style="padding-bottom: 20px;">
					<? include($file_page); ?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#2f53d0" align="center" height="100">
					<font color="#FFFFFF">สนามบินทานตะวัน 7 ม.2 ต.นายาว อ.พระพุทธบาท จ.สระบุรี 18120
					<br>
					เบอร์โทร 083-8988245</font>
				</td>
			</tr>
		</table>
	</div>
</body>
</html> 		