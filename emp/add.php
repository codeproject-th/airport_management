<?php

if($_POST){
	$insert['Name'] = $_POST['Name'];
	$insert['Surname'] = $_POST['Surname'];
	$insert['Address'] = $_POST['Address'];
	$insert['Age'] = $_POST['Age'];
	$insert['Gender'] = $_POST['Gender'];
	$insert['Telephone'] = $_POST['Telephone'];
	$insert['Position'] = $_POST['Position'];
	$query = db::insert('personnel',$insert);
	if($query){
		$id = db::insert_id();
		if($_POST['Username']!='' AND $_POST['Password']!=''){
			db::insert('user',array('Username'=>$_POST['Username'],'Password'=>$_POST['Password'],'Idper'=>$id));
		}
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
		<td width="20%" align="right">ชื่อ-นามสกุล :</td>
		<td><input type="text" name="Name" required/> <input type="text" name="Surname" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">ที่อยู่ :</td>
		<td><input type="text" name="Address" style="width: 400px;" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">อายุ :</td>
		<td><input type="text" name="Age" style="width: 50px;" required /> ปี</td>
	</tr>
	<tr>
		<td width="20%" align="right">เพศ :</td>
		<td>
			<input type="radio" name="Gender" value="M" /> ชาย &nbsp;&nbsp;&nbsp;
			<input type="radio" name="Gender" value="F"/> หญิง
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">เบอร์โทรศัพท์ :</td>
		<td><input type="text" name="Telephone" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">ตำแหน่ง :</td>
		<td><input type="text" name="Position" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">Username :</td>
		<td><input type="text" name="Username"/></td>
	</tr>
	<tr>
		<td width="20%" align="right">Password :</td>
		<td><input type="password" name="Password"/></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
</form>