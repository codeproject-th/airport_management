<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('personnel',array('Idper'=>$_GET['delete_id']));
	db::delete('user',array('Idper'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Name'] = $_GET['Name'];
$search['Surname'] = $_GET['Surname'];
$search['Position'] = $_GET['Position'];
$sql = db::search('personnel',$search);
$rows = db::pagination($sql,$_GET['page']);
?>
<h3>รายงานข้อมูลพนักงาน</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table>
	<tr>
		<td width="20%" align="right">ชื่อ-นามสกุล :</td>
		<td><input type="text" name="Name" value="<?=$_GET['Name']?>" placeholder="ชื่อ"/> <input type="text" name="Surname" value="<?=$_GET['Surname']?>" placeholder="นามสกุล" /></td>
	</tr>
	<tr>
		<td width="20%" align="right">ตำแหน่ง :</td>
		<td><input type="text" name="Position" value="<?=$_GET['Position']?>"  style="width: 400px;"/></td>
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
		<th>ชื่อ-นามสกุล</th>
		<th>ตำแหน่ง</th>
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
		<td><?=$val['Name']?> <?=$val['Surname']?></td>
		<td align="center"><?=$val['Position']?></td>
		<td align="center"><a href="index.php?mod=emp&f=edit&id=<?=$val['Idper']?>"><img src="images/edit.png"></a> <a href="index.php?mod=emp&f=search&delete_id=<?=$val['Idper']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
	</tr>
<?
	}
}else{
?>
	<tr>
		<td colspan="4" align="center">ไม่พบข้อมูล</td>
	</tr>
<? } ?>
</table>
<?=pagination::pages($rows['pages']);?>