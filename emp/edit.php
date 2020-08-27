<?php

if($_POST){
	$insert['Name'] = $_POST['Name'];
	$insert['Surname'] = $_POST['Surname'];
	$insert['Address'] = $_POST['Address'];
	$insert['Age'] = $_POST['Age'];
	$insert['Gender'] = $_POST['Gender'];
	$insert['Telephone'] = $_POST['Telephone'];
	$insert['Position'] = $_POST['Position'];
	$query = db::update('personnel',$insert,array('Idper'=>$_POST['id']));
	if($query){
		if($_POST['Username']!='' AND $_POST['Password']!=''){
			$user_insert = db::select('user',array('Idper'=>$_POST['id']));
			if(count($user_inser)==0){
				db::insert('user',array('Username'=>$_POST['Username'],'Password'=>$_POST['Password'],'Idper'=>$_POST['id']));
			}else{
				db::update('user',array('Username'=>$_POST['Username'],'Password'=>$_POST['Password']),array('Idper'=>$_POST['id']));
			}
		}else{
			db::delete('user',array('Idper'=>$_POST['id']));
		}
		echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$data = db::select('personnel',array('Idper'=>$_GET['id']));
$user = db::select('user',array('Idper'=>$_GET['id']));
?>
<h3>แก้ไขข้อมูลพนักงาน</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">ชื่อ-นามสกุล :</td>
		<td><input type="text" name="Name" value="<?=$data[0]['Name']?>" required/> <input type="text" name="Surname" value="<?=$data[0]['Surname']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">ที่อยู่ :</td>
		<td><input type="text" name="Address" value="<?=$data[0]['Address']?>" style="width: 400px;" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">อายุ :</td>
		<td><input type="text" name="Age" value="<?=$data[0]['Age']?>" style="width: 50px;" required /> ปี</td>
	</tr>
	<tr>
		<td width="20%" align="right">เพศ :</td>
		<td>
			<input type="radio" name="Gender" value="M" <? if($data[0]['Gender']=="M"){ ?> checked <? } ?> /> ชาย &nbsp;&nbsp;&nbsp;
			<input type="radio" name="Gender" value="F" <? if($data[0]['Gender']=="F"){ ?> checked <? } ?>/> หญิง
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">เบอร์โทรศัพท์ :</td>
		<td><input type="text" name="Telephone" value="<?=$data[0]['Telephone']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">ตำแหน่ง :</td>
		<td><input type="text" name="Position" value="<?=$data[0]['Position']?>" required style="width: 400px;"/></td>
	</tr>
	<tr>
		<td width="20%" align="right">Username :</td>
		<td><input type="text" name="Username" value="<?=$user[0]['Username']?>"/></td>
	</tr>
	<tr>
		<td width="20%" align="right">Password :</td>
		<td><input type="password" name="Password" value="<?=$user[0]['Password']?>"/></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
	<input type="hidden" name="id" value="<?=$data[0]['Idper']?>"/>
</form>