<?php

if($_POST){
	$insert['Username'] = $_POST['Username'];
	$insert['Password'] = $_POST['Password'];
	$query = db::update('user',$insert,array('User_id'=>$_POST['id']));
	if($query){
		echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$data = db::select('user',array('User_id'=>$_GET['id']));

?>
<h3>เพิ่มข้อมูลพนักงาน</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">Username :</td>
		<td><input type="text" name="Username" value="<?=$data[0]['Username']?>" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">Password :</td>
		<td><input type="password" name="Password" value="<?=$data[0]['Password']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
<input type="hidden" name="id" value="<?=$data[0]['User_id']?>"/>
</form>