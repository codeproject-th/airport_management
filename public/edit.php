<?php

if($_POST){
	$insert['Datepub'] = DateDB($_POST['Datepub']);
	$insert['Public_name'] = $_POST['Public_name'];
	$insert['Money'] = $_POST['Money'];
	
	$query = db::update('public',$insert,array('Intpub'=>$_POST['id']));
	if($query){
		echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$data = db::select('public',array('Intpub'=>$_GET['id']));
?>
<script>
$(function(){
	$("#Datepub").datepicker({dateFormat: "dd/mm/yy" });
});
</script>
<h3>แก้ไขข้อมูลสาธารณูปโภค</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Datepub" id="Datepub" value="<?=DateTH($data[0]['Datepub'])?>" style="" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">สาธารณูปโภค :</td>
		<td><input type="text" name="Public_name" value="<?=$data[0]['Public_name']?>" style="width: 300px;" required /> </td>
	</tr>
	<tr>
		<td width="20%" align="right">จำนวนเงิน :</td>
		<td><input type="text" name="Money" value="<?=$data[0]['Money']?>"  style="" required /> </td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
<input type="hidden" name="id" value="<?=$data[0]['Intpub']?>"/>
</form>