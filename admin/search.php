<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('user',array('User_id'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Username'] = $_GET['Username'];
$sql = db::search('user',$search);
$rows = db::pagination($sql,$_GET['page']);
?>
<h3>รายงานผู้ใช้งาน</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table>
	<tr>
		<td width="20%" align="right">Username :</td>
		<td><input type="text" name="Username" value="<?=$_GET['Username']?>" placeholder="Username"/></td>
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
		<th>Username</th>
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
		<td><?=$val['Username']?></td>
		<td align="center"><a href="index.php?mod=admin&f=edit&id=<?=$val['User_id']?>"><img src="images/edit.png"></a> <a href="index.php?mod=admin&f=search&delete_id=<?=$val['User_id']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
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