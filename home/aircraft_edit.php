<?php

if($_POST){
	$insert['Des_air'] = $_POST['Des_air'];
	$insert['Model'] = $_POST['Model'];
	$insert['Owner'] = $_POST['Owner'];
	$insert['Iden_doc'] = $_POST['Iden_doc'];
	//$insert['Idmem'] = $_POST['Idmem'];
	$insert['doc1'] = $_POST['doc1'];
	$insert['doc2'] = $_POST['doc2'];
	$insert['doc3'] = $_POST['doc3'];
	$insert['doc4'] = $_POST['doc4'];
	$query = db::update('aircraft',$insert,array('Idair'=>$_POST['id']));
	if($query){
		echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$data = db::select('aircraft',array('Idair'=>$_GET['id']));
$member = db::select('member',array(),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');
?>
<h3>แก้ไขข้อมูลเครื่องบิน</h3>
<form method="post" id="Form">
<table width="100%">
	<tr>
		<td width="20%" align="right">รายละเอียดเครื่องบิน :</td>
		<td><input type="text" name="Des_air" value="<?=$data[0]['Des_air']?>" style="width: 400px;" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">แบบของเครื่องบิน :</td>
		<td>
			<input type="radio" name="Model" value="ultralight" <? if($data[0]['Model']=='ultralight'){?> checked <?}?> /> Ultralight
			&nbsp;&nbsp;
			<input type="radio" name="Model" value="HS2" <? if($data[0]['Model']=='HS2'){?> checked <?}?> /> HS2 
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">ชื่อเจ้าของ :</td>
		<td><input type="text" name="Owner" value="<?=$data[0]['Owner']?>" required/></td>
	</tr>
	<tr valign="top">
		<td width="20%" align="right">เอกสารประจาเครื่อง :</td>
		<td>
			<input type="checkbox" value="1" name="doc1" id="doc1" <? if($data[0]['doc1']=='1'){?>checked<?}?>/> ใบสาคัญการจดทะเบียน <br>
			<input type="checkbox" value="1" name="doc2" id="doc2" <? if($data[0]['doc2']=='1'){?>checked<?}?>/> ใบสาคัญสมควรเดินอากาศ <br>
			<input type="checkbox" value="1" name="doc3" id="doc3" <? if($data[0]['doc3']=='1'){?>checked<?}?>/> ใบอนุญาตใช้อากาศยานส่วนบุคคล <br>
			<input type="checkbox" value="1" name="doc4" id="doc4" <? if($data[0]['doc4']=='1'){?>checked<?}?>/> ประกันภัยอากาศยาน <br>
		</td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
	<input type="hidden" name="id" value="<?=$data[0]['Idair']?>"/>
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