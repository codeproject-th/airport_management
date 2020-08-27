<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('hangar',array('Idhang'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Name_hang'] = $_GET['Name_hang'];
$search['Model'] = $_GET['Model'];
$sql = db::search('hangar',$search);
$rows = db::pagination($sql,$_GET['page']);
?>
<h3>รายงานข้อมูลโรงเก็บ</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table width="100%">
	<tr>
		<td width="20%" align="right">ชื่อโรงเก็บเครื่องบิน :</td>
		<td><input type="text" name="Name_hang" value="<?=$_GET['Name_hang']?>"/></td>
	</tr>
	<tr>
		<td width="20%" align="right">แบบของโรงเก็บเครื่องบิน :</td>
		<td><input type="text" name="Model" value="<?=$_GET['Model']?>"/></td>
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
		<th>ชื่อโรงเก็บเครื่องบิน</th>
		<th>แบบของโรงเก็บเครื่องบิน</th>
		<th>จำนวนที่จอด</th>
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
		<td><?=$val['Name_hang']?></td>
		<td><?=$val['Model']?></td>
		<td align="center"><?=$val['quantity']?></td>
		<td align="center"><a href="index.php?mod=house&f=edit&id=<?=$val['Idhang']?>"><img src="images/edit.png"></a> <a href="index.php?mod=house&f=search&delete_id=<?=$val['Idhang']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
	</tr>
<?
	}
}else{
?>
	<tr>
		<td colspan="5" align="center">ไม่พบข้อมูล</td>
	</tr>
<? } ?>
</table>
<?=pagination::pages($rows['pages']);?>