<?php

if($_POST){
	$insert['Datesa'] = DateDB($_POST['Datesa']);
	$insert['Money'] = $_POST['Money'];
	$insert['Idper'] = $_POST['Idper'];
	$query = db::insert('salary',$insert);
	if($query){
		echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$emp= db::select('personnel',array(),'*','ORDER BY CONVERT( Name USING tis620 ) ASC');
?>
<script>
$(function(){
	$("#Datesa").datepicker({dateFormat: "dd/mm/yy" });
});
</script>
<h3>จ่ายเงินเดือน</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Datesa" id="Datesa" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">เงินเดือน :</td>
		<td><input type="text" name="Money" style="width: 100px;" required /> บาท</td>
	</tr>
	<tr>
		<td width="20%" align="right">พนักงาน :</td>
		<td>
			<select name="Idper" id="Idper" required>
				<option value="">-----เลือก-----</option>
				<?
				if(count($emp)>0){
					foreach($emp as $val){
				?>
					<option value="<?=$val['Idper']?>"><?=$val['Name']?> <?=$val['Surname']?></option>
				<? 
					}
				} ?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
</form>