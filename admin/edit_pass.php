<?php

if($_POST){
	db::update('user',array('Password'=>$_POST['new_password']),array('User_id'=>$_SESSION['login_id']));
	echo '<script> alert("แก้ไขรหัสผ่านเรียบร้อย"); </script>';
}

?>
<h3>แก้ไขรหัสผ่าน</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">รหัสผ่านใหม่ :</td>
		<td><input type="password" name="new_password" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="แก้ไขรหัสผ่าน"/></td>
	</tr>
</table>
</form>