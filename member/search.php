<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('member',array('Idmem'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Nameuser'] = $_GET['Name'];
$search['Surname'] = $_GET['Surname'];
$sql = db::search('member',$search);
$rows = db::pagination($sql,$_GET['page']);
?>
<h3>รายงานข้อมูลสมาชิก</h3>

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
		<th>ประเภท</th>
		<th>แก้ไข/ลบ</th>
	</tr>
<?
if(count($rows['data'])>0){
	$no = $rows['no'];
	foreach($rows['data'] as $val){
		$no++;
		$type = "";
		if($val['Member_type']=='1'){
			$type = "ปกติ";
		}else if($val['Member_type']=='2'){
			$type = "รายปี";
		}
?>
	<tr>
		<td align="center"><?=$no?></td>
		<td><?=$val['Nameuser']?> <?=$val['Surname']?></td>
		<td align="center"><?=$type?></td>
		<td align="center"><a href="#" onclick="printTable('member<?=$val['Idmem']?>')"><img src="images/print.png"></a> <a href="index.php?mod=member&f=edit&id=<?=$val['Idmem']?>"><img src="images/edit.png"></a> <a href="index.php?mod=emp&f=search&delete_id=<?=$val['Idmem']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
	</tr>
<?
	}
}else{
?>
	<tr>
		<td colspan="3" align="center">ไม่พบข้อมูล</td>
	</tr>
<? } ?>
</table>
<?=pagination::pages($rows['pages']);?>

<?if(count($rows['data'])>0){
	foreach($rows['data'] as $val){
?>		
<div style="display:none;" id="member<?=$val['Idmem']?>">
	<table width="400" border="1" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
		<tr valign="top">
			<td align="center">
			
	<center><h3>บัตรสมาชิกสนามบินทานตะวัน</h3></center>
	<table width="400" border="0">
		<tr>
			<td width="100" align="right"><b>รหัสสมาชิก :</b></td>
			<td><?=str_pad($val['Idmem'],7,'0',STR_PAD_LEFT)?></td>
		</tr>
		<tr>
			<td align="right"><b>ชื่อ-นามสกุล :</b></td>
			<td>คุณ<?=$val['Nameuser']?>&nbsp;<?=$val['Surname']?></td>
		</tr>
		<tr>
			<td align="right"><b>วันที่หมดอายุ :</b></td>
			<td><?=DateTH($val['Expires'])?></td>
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