<?php

if($_POST){
	$insert['Nameuser'] = $_POST['Nameuser'];
	$insert['Surname'] = $_POST['Surname'];
	$insert['Address'] = $_POST['Address'];
	$insert['Age'] = $_POST['Age'];
	$insert['Gender'] = $_POST['Gender'];
	$insert['Telephone'] = $_POST['Telephone'];
	$insert['Vocation'] = $_POST['Vocation'];
	$insert['Mem_payment'] = 0;
	$insert['Username'] = $_POST['Username'];
	$insert['Password'] = $_POST['Password'];
	$insert['Member_type'] = $_POST['Member_type'];
	$insert['ID_card'] = $_POST['ID_card'];
	$row = db::select('member',array('ID_card'=>$insert['ID_card']));
	if(count($row)==0){
		$row = db::select('member',array('Username'=>$insert['Username']));
		if(count($row)==0){
			$query = db::insert('member',$insert);
			$orderID = db::insert_id();
			if($query){
				if($insert['Member_type']=='2'){
					$insert = array();
					$insert['order_data_type'] = '1';
					$insert['order_data_price'] = '2500';
					$insert['order_data_date'] = date('Y-m-d H:i:s');
					$insert['order_id'] = $orderID;
					$insert['Idmem'] = $orderID;
					db::insert('order_data',$insert);
					$order_code = str_pad(db::insert_id(),5,'0',STR_PAD_LEFT);
				}
				echo "<script> alert('สมัครสมาชิกเรียบร้อย'); </script>";
			}else{
				echo "<script> alert('error'); </script>";
			}
		}else{
			echo "<script> alert('Username มีอยู่ในระบบแล้วไม่สามารถสมัครได้'); </script>";
		}
	}else{
			echo "<script> alert('รหัสบัตรประชาชนมีอยู่ในระบบแล้วไม่สามารถสมัครได้'); </script>";
	}
}

?>
<script>
$(function() {
	$("#Expires").datepicker({ dateFormat: "dd/mm/yy" });
});
</script>
<h3>สมัครสมาชิก</h3>
<? if($order_code!=''){ ?>
<center>หมายเลขสั่งซื้อของคุณคือ : <?=$order_code?></center>
<? } ?>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">ประเภทสมาชิก :</td>
		<td>
			<input type="radio" checked name="Member_type" value="1"/> ปกติ ไม่มีค่าใช้จ่าย&nbsp;&nbsp;&nbsp;
			<input type="radio" name="Member_type" value="2"/> รายปี ค่าใช้จ่าย 2,500 บาท
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">ชื่อ-นามสกุล :</td>
		<td><input type="text" name="Nameuser" required/> <input type="text" name="Surname" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">หมายเลขบัตรประชาชน :</td>
		<td>
			<input type="text" name="ID_card" required/>
		</td>
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
			<input type="radio" checked name="Gender" value="M" /> ชาย &nbsp;&nbsp;&nbsp;
			<input type="radio" name="Gender" value="F"/> หญิง
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">เบอร์โทรศัพท์ :</td>
		<td><input type="text" name="Telephone" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">อาชีพ :</td>
		<td><input type="text" name="Vocation"/></td>
	</tr>
	<tr>
		<td width="20%" align="right">ชื่อผู้ใช้งาน :</td>
		<td><input type="text" name="Username" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right">รหัสผ่าน :</td>
		<td><input type="password" name="Password" required /></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="สมัครสมาชิก"/></td>
	</tr>
</table>
</form>