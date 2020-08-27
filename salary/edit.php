<?php

if($_POST){
	$insert['Datesa'] = DateDB($_POST['Datesa']);
	$insert['Money'] = $_POST['Money'];
	$insert['Idper'] = $_POST['Idper'];
	$query = db::update('salary',$insert,array('Idsalary'=>$_POST['id']));
	if($query){
		echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$emp= db::select('personnel',array(),'*','ORDER BY CONVERT( Name USING tis620 ) ASC');
$data = db::select('salary',array('Idsalary'=>$_GET['id']));
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
		<td><input type="text" name="Datesa" id="Datesa" value="<?=DateTH($data[0]['Datesa'])?>" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">เงินเดือน :</td>
		<td><input type="text" name="Money" value="<?=$data[0]['Money']?>" style="width: 100px;" required /> บาท</td>
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
					<option <? if($data[0]['Idper']==$val['Idper']){ ?> selected <? } ?> value="<?=$val['Idper']?>"><?=$val['Name']?> <?=$val['Surname']?></option>
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
<input type="hidden" name="id" value="<?=$data[0]['Idsalary']?>"/>
</form>