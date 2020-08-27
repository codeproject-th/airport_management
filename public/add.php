<?php

if($_POST){
	$insert['Datepub'] = DateDB($_POST['Datepub']);
	$insert['Public_name'] = $_POST['Public_name'];
	$insert['Money'] = $_POST['Money'];
	
	$query = db::insert('public',$insert);
	if($query){
		echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

?>
<script>
$(function(){
	$("#Datepub").datepicker({dateFormat: "dd/mm/yy" });
});
</script>
<h3>เพิ่มข้อมูลสาธารณูปโภค</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Datepub" id="Datepub" style="" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">สาธารณูปโภค :</td>
		<td><input type="text" name="Public_name" style="width: 300px;" required /> </td>
	</tr>
	<tr>
		<td width="20%" align="right">จำนวนเงิน :</td>
		<td><input type="text" name="Money" style="" required /> </td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
</form>