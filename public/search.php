<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('public',array('Intpub'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Datepub'] = DateDB($_GET['Datepub']);
$sql = db::search('public',$search);
$rows = db::pagination($sql,$_GET['page']);
?>
<script>
$(function(){
	$("#Datepub").datepicker({dateFormat: "dd/mm/yy" });
});
</script>
<h3>รายงานข้อมูลสาธารณูปโภค</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table>
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Datepub" id="Datepub" value="<?=$_GET['Datepub']?>"></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="ค้นหา"/></td>
	</tr>
</table>
</form>
</fieldset>
<br><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
	<tr>
		<th>No.</th>
		<th>วันที่</th>
		<th>สาธารณูปโภค</th>
		<th>จำนวนเงิน</th>
		<th>แก้ไข/ลบ</th>
	</tr>
<?
if(count($rows['data'])>0){
	$no = $rows['no'];
	foreach($rows['data'] as $val){
		$no++;
?>
	<tr>
		<td align="center"><?=$no?></td>
		<td align="center"><?=DateTH($val['Datepub'])?></td>
		<td align="left"><?=$val['Public_name']?></td>
		<td align="right"><?=$val['Money']?></td>
		<td align="center"><a href="index.php?mod=public&f=edit&id=<?=$val['Intpub']?>"><img src="images/edit.png"></a> <a href="index.php?mod=public&f=search&delete_id=<?=$val['Intpub']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
	</tr>
<?
	}
}else{
?>
	<tr>
		<td colspan="6" align="center">ไม่พบข้อมูล</td>
	</tr>
<? } ?>
</table>
<?=pagination::pages($rows['pages']);?>