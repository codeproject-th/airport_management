<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('dep_air',array('Idda'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Dateda'] = DateDB($_GET['Dateda']);

if($search['Dateda']!=''){
	$where .= ' AND Dateda="'.$search['Dateda'].'" ';
}

//$sql = db::search('ren_ser',$search);
$sql = "SELECT d.* ,m.* ,a.* , h.* FROM dep_air d 
		INNER JOIN member m ON d.Idmem = m.Idmem 
		INNER JOIN hangar h ON d.Idhang = h.Idhang 
		INNER JOIN aircraft a ON d.Idair=a.Idair WHERE Confirm='1' ".$where." ORDER BY Dateda DESC";
$rows = db::pagination($sql,$_GET['page']);
?>
<script>
$(function(){
	$("#Dateda").datepicker({dateFormat: "dd/mm/yy" });
});
</script>
<h3>รายงานข้อมูลการฝากเครื่องบิน</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table>
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Dateda" id="Dateda" value="<?=$_GET['Dateda']?>"></td>
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
		<th>ค่าบริการ</th>
		<th>ชื่อ-นามสกุล</th>
		<th>เครื่องบิน</th>
		<th>โรงเก็บ</th>
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
		<td align="center"><?=DateTH($val['Dateda'])?> - <?=DateTH($val['Dateda_end'])?></td>
		<td align="right"><?=$val['Ser_charge']?></td>
		<td><?=$val['Nameuser']?> <?=$val['Surname']?></td>
		<td><?=$val['Des_air']?></td>
		<td><?=$val['Name_hang']?></td>
		<td align="center"><a href="index.php?mod=deposit&f=edit&id=<?=$val['Idda']?>"><img src="images/edit.png"></a> <a href="index.php?mod=deposit&f=search&delete_id=<?=$val['Idda']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
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