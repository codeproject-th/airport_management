<?php

if($_POST){
	$insert['Username'] = $_POST['Username'];
	$insert['Password'] = $_POST['Password'];
	$query = db::insert('user',$insert);
	if($query){
		echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

?>
<h3>เพิ่มข้อมูลพนักงาน</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">Username :</td>
		<td><input type="text" name="Username" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">Password :</td>
		<td><input type="password" name="Password" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
</form>