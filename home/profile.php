<?php
if($_SESSION['member_id']==''){
	exit;
}

if($_POST){
	$insert['Nameuser'] = $_POST['Nameuser'];
	$insert['Surname'] = $_POST['Surname'];
	$insert['Address'] = $_POST['Address'];
	$insert['Age'] = $_POST['Age'];
	$insert['Gender'] = $_POST['Gender'];
	$insert['Telephone'] = $_POST['Telephone'];
	$insert['Vocation'] = $_POST['Vocation'];
	//$insert['Mem_payment'] = 0;
	//$insert['Username'] = $_POST['Username'];
	$insert['Password'] = $_POST['Password'];
	//$insert['Member_type'] = $_POST['Member_type'];
	$insert['ID_card'] = $_POST['ID_card'];
	$query = db::update('member',$insert,array('Idmem'=>$_SESSION['member_id']));
	if($query){
		echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('รหัสบัตรประชาชนมีอยู่ในระบบแล้วไม่สามารถสมัครได้'); </script>";
	}
}

$data = db::select('member',array('Idmem'=>$_SESSION['member_id']));

?>
<script>
$(function() {
	$("#Expires").datepicker({ dateFormat: "dd/mm/yy" });
});
</script>
<h3>แก้ไขข้อมูลส่วนตัว</h3>
<? if($order_code!=''){ ?>
<center>รหัสสมาชิกของคุณคือ : <?=$order_code?></center>
<? } ?>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">ชื่อ-นามสกุล :</td>
		<td><input type="text" name="Nameuser" value="<?=$data[0]['Nameuser']?>" required/> <input type="text" value="<?=$data[0]['Surname']?>" name="Surname" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">หมายเลขบัตรประชาชน :</td>
		<td>
			<input type="text" name="ID_card" value="<?=$data[0]['ID_card']?>" readonly />
		</td>
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
			<input type="radio" <? if($data[0]['Gender']=='M'){ ?> checked <? } ?> name="Gender" value="M" /> ชาย &nbsp;&nbsp;&nbsp;
			<input type="radio" <? if($data[0]['Gender']=='F'){ ?> checked <? } ?> name="Gender" value="F"/> หญิง
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">เบอร์โทรศัพท์ :</td>
		<td><input type="text" name="Telephone" value="<?=$data[0]['Telephone']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">อาชีพ :</td>
		<td><input type="text" name="Vocation" value="<?=$data[0]['Vocation']?>"/></td>
	</tr>
	<tr>
		<td width="20%" align="right">ชื่อผู้ใช้งาน :</td>
		<td><input type="text" name="Username" value="<?=$data[0]['Username']?>" readonly /></td>
	</tr>
	<tr>
		<td width="20%" align="right">รหัสผ่าน :</td>
		<td><input type="password" name="Password" value="<?=$data[0]['Password']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="แก้ไขข้อมูล"/></td>
	</tr>
</table>
</form>