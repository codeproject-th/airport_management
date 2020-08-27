<?php

if($_POST){
	$insert['Des_air'] = $_POST['Des_air'];
	$insert['Model'] = $_POST['Model'];
	$insert['Owner'] = $_POST['Owner'];
	$insert['Iden_doc'] = $_POST['Iden_doc'];
	$insert['Idmem'] = $_SESSION['member_id'];
	$insert['doc1'] = $_POST['doc1'];
	$insert['doc2'] = $_POST['doc2'];
	$insert['doc3'] = $_POST['doc3'];
	$insert['doc4'] = $_POST['doc4'];
	$query = db::insert('aircraft',$insert);
	if($query){
		echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$member = db::select('member',array(),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');

?>
<h3>เพิ่มข้อมูลเครื่องบิน</h3>
<form method="post" id="Form">
<table width="100%">
	<tr>
		<td width="20%" align="right">ชื่อเครื่องบิน :</td>
		<td><input type="text" name="Des_air"  required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">แบบของเครื่องบิน :</td>
		<td>
			<input type="radio" checked name="Model" value="ultralight"/> Ultralight
			&nbsp;&nbsp;
			<input type="radio" name="Model" value="HS2"/> HS2 
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">ชื่อเจ้าของ :</td>
		<td><input type="text" name="Owner" required/></td>
	</tr>
	<tr valign="top">
		<td width="20%" align="right">เอกสารประจำเครื่อง :</td>
		<td>
			<input type="checkbox" value="1" name="doc1" id="doc1"/> ใบสาคัญการจดทะเบียน <br>
			<input type="checkbox" value="1" name="doc2" id="doc2"/> ใบสาคัญสมควรเดินอากาศ <br>
			<input type="checkbox" value="1" name="doc3" id="doc3"/> ใบอนุญาตใช้อากาศยานส่วนบุคคล <br>
			<input type="checkbox" value="1" name="doc4" id="doc4"/> ประกันภัยอากาศยาน<br>
		</td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
</form>
<script>
$( document ).ready(function() {
	$("#Form").submit(function(){
		var txt = "";
		if($("#doc1").prop("checked")==false){
			txt += "ไม่มี ใบสาคัญการจดทะเบียน\n";
		}
		if($("#doc2").prop("checked")==false){
			txt += "ไม่มี ใบสาคัญสมควรเดินอากาศ\n";
		}
		if($("#doc3").prop("checked")==false){
			txt += "ใบอนุญาตใช้อากาศยานส่วนบุคคล\n";
		}
		if($("#doc4").prop("checked")==false){
			txt += "ประกันภัยอากาศยาน\n";
		}
		
		if(txt!=""){
			alert(txt);
		}
		
	});
});
</script>