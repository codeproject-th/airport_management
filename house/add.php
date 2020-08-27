<?php

if($_POST){
	$insert['Name_hang'] = $_POST['Name_hang'];
	$insert['Model'] = $_POST['Model'];
	$insert['quantity'] = $_POST['quantity'];
	$query = db::insert('hangar',$insert);
	if($query){
		echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

?>
<h3>เพิ่มข้อมูลโรงเก็บ</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">ชื่อโรงเก็บเครื่องบิน :</td>
		<td><input type="text" name="Name_hang" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">แบบของโรงเก็บเครื่องบิน :</td>
		<td><input type="text" name="Model" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">จำนวนที่จอด :</td>
		<td><input type="text" style="width: 30px;" name="quantity" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
</form>