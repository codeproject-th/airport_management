<?php

if($_POST){
	$insert['Nameuser'] = $_POST['Nameuser'];
	$insert['Surname'] = $_POST['Surname'];
	$insert['Address'] = $_POST['Address'];
	$insert['Age'] = $_POST['Age'];
	$insert['Gender'] = $_POST['Gender'];
	$insert['Telephone'] = $_POST['Telephone'];
	$insert['Vocation'] = $_POST['Vocation'];
	$insert['Mem_payment'] = $_POST['Mem_payment'];
	$insert['Username'] = $_POST['Username'];
	$insert['Password'] = $_POST['Password'];
	$insert['Member_type'] = $_POST['Member_type'];
	$insert['Expires'] = DateDB($_POST['Expires']);
	$insert['ID_card'] = $_POST['ID_card'];
	$query = db::update('member',$insert,array('Idmem'=>$_POST['id']));
	if($query){
		echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$data = db::select('member',array('Idmem'=>$_GET['id']));
?>
<script>
$(function(){
	$("#Expires").datepicker({dateFormat: "dd/mm/yy" });
});
</script>
<h3>แก้ไขข้อมูลสมาชิก</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">ประเภทสมาชิก :</td>
		<td>
			<input type="radio" <? if($data[0]['Member_type']=="1"){ ?> checked <? } ?> name="Member_type" value="1"/> ปกติ &nbsp;&nbsp;&nbsp;
			<input type="radio" <? if($data[0]['Member_type']=="2"){ ?> checked <? } ?> name="Member_type" value="2"/> รายปี
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">วันที่หมดอายุ :</td>
		<td><input type="text" name="Expires" id="Expires" value="<?=DateTH($data[0]['Expires'])?>" /></td>
	</tr>
	<tr>
		<td width="20%" align="right">ชื่อ-นามสกุล :</td>
		<td><input type="text" name="Nameuser" value="<?=$data[0]['Nameuser']?>" required/> <input type="text" name="Surname" value="<?=$data[0]['Surname']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">หมายเลขบัตรประชาชน :</td>
		<td>
			<input type="text" name="ID_card" value="<?=$data[0]['ID_card']?>" required/>
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
			<input type="radio" name="Gender" value="M" <? if($data[0]['Gender']=="M"){ ?> checked <? } ?> /> ชาย &nbsp;&nbsp;&nbsp;
			<input type="radio" name="Gender" value="F" <? if($data[0]['Gender']=="F"){ ?> checked <? } ?>/> หญิง
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">เบอร์โทรศัพท์ :</td>
		<td><input type="text" name="Telephone" value="<?=$data[0]['Telephone']?>" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">อาชีพ :</td>
		<td><input type="text" name="Vocation" value="<?=$data[0]['Vocation']?>" /></td>
	</tr>
	<tr>
		<td width="20%" align="right">ค่าสมาชิก :</td>
		<td><input type="text" name="Mem_payment" value="<?=$data[0]['Mem_payment']?>" /></td>
	</tr>
	<tr>
		<td width="20%" align="right">ชื่อผู้ใช้งาน :</td>
		<td><input type="text" name="Username" value="<?=$data[0]['Username']?>"  required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">รหัสผ่าน :</td>
		<td><input type="password" name="Password" value="<?=$data[0]['Password']?>"  required /></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
	<input type="hidden" name="id" value="<?=$data[0]['Idmem']?>"/>
</form>