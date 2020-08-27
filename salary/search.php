<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('salary',array('Idsalary'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Datesa'] = DateDB($_GET['Datesa']);

if($search['Datesa']!=''){
	$where .= ' AND Datesa="'.$search['Datesa'].'" ';
}

//$sql = db::search('ren_ser',$search);
$sql = "SELECT s.* , p.* FROM salary s 
		INNER JOIN personnel p ON s.Idper = p.Idper 
		WHERE 1=1 ".$where." ORDER BY Datesa DESC";
$rows = db::pagination($sql,$_GET['page']);
?>
<script>
$(function(){
	$("#Datesa").datepicker({dateFormat: "dd/mm/yy" });
});
</script>
<h3>รายงานข้อมูลการจ่ายเงินเดือน</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table>
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Datesa" id="Datesa" value="<?=$_GET['Datesa']?>"></td>
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
		<th>เงินเดือน</th>
		<th>ชื่อ-นามสกุล</th>
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
		<td align="center"><?=DateTH($val['Datesa'])?></td>
		<td align="right"><?=number_format($val['Money'])?></td>
		<td><?=$val['Name']?> <?=$val['Surname']?></td>
		<td align="center"><a href="#" onclick="printTable('emp<?=$val['Idper']?>')"><img src="images/print.png"></a> <a href="index.php?mod=salary&f=edit&id=<?=$val['Idsalary']?>"><img src="images/edit.png"></a> <a href="index.php?mod=salary&f=search&delete_id=<?=$val['Idsalary']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
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

<?if(count($rows['data'])>0){
	foreach($rows['data'] as $val){
?>		
<div style="display:none;" id="emp<?=$val['Idper']?>">
	<table width="700" border="1" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
		<tr valign="top">
			<td align="center">
			
	<center><h3>สลิปเงินเดือน</h3></center>
	<table width="700" border="0">
		<tr>
			<td width="200" align="right"><b>รหัสพนักงาน :</b></td>
			<td><?=str_pad($val['Idper'],5,'0',STR_PAD_LEFT)?></td>
		</tr>
		<tr>
			<td align="right"><b>ชื่อ-นามสกุล :</b></td>
			<td>คุณ<?=$val['Name']?>&nbsp;<?=$val['Surname']?></td>
		</tr>
		<tr>
			<td align="right"><b>ตำแหน่ง :</b></td>
			<td><?=$val['Position']?></td>
		</tr>
		<tr>
			<td align="right"><b>เงินเดือน :</b></td>
			<td><?=number_format($val['Money'],2)?></td>
		</tr>
		<tr>
			<td align="right"><b>วันที่จ่าย :</b></td>
			<td><?=DateTH($val['Datesa'])?></td>
		</tr>
		<tr>
			<td align="right"></td>
			<td>&nbsp;</td>
		</tr>
	</table>
	
			</td>
		</tr>
	</table>
</div>
<?
	}
}
?>

<script type="text/javascript"> 
function printTable(tableprint) { 
 	var printContents = document.getElementById(tableprint).innerHTML; 
    var originalContents = document.body.innerHTML; 
    document.body.innerHTML = printContents; 
    window.print(); 
    document.body.innerHTML = originalContents; 
} 
</script>