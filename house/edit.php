<?php

if($_POST){
	$insert['Name_hang'] = $_POST['Name_hang'];
	$insert['Model'] = $_POST['Model'];
	$insert['quantity'] = $_POST['quantity'];
	$query = db::update('hangar',$insert,array('Idhang'=>$_POST['id']));
	if($query){
		echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$data = db::select('hangar',array('Idhang'=>$_GET['id']));
?>
<h3>แก้ไขข้อมูลโรงเก็บ</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">ชื่อโรงเก็บเครื่องบิน :</td>
		<td><input type="text" name="Name_hang" value="<?=$data[0]['Name_hang']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">แบบของโรงเก็บเครื่องบิน :</td>
		<td><input type="text" name="Model" value="<?=$data[0]['Model']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">จำนวนที่จอด :</td>
		<td><input type="text" style="width: 30px;" name="quantity" value="<?=$data[0]['quantity']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
	<input type="hidden" name="id" value="<?=$data[0]['Idhang']?>"/>
</form>