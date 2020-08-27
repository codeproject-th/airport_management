<?php
if($_SESSION['member_id']==''){
	exit;
}

$search['Daters'] = DateDB($_GET['Daters']);

if($search['Daters']!=''){
	$where .= ' AND Daters="'.$search['Daters'].'" ';
}

//$sql = db::search('ren_ser',$search);
$sql = "SELECT r.* ,m.* ,a.* FROM ren_ser r 
		INNER JOIN member m ON r.Idmem=m.Idmem 
		INNER JOIN aircraft a ON r.Idair=a.Idair WHERE m.Idmem='".$_SESSION['member_id']."' ".$where." ORDER BY Daters DESC";
$rows = db::pagination($sql,$_GET['page']);
?>
<script>
$(function(){
	$("#Daters").datepicker({dateFormat: "dd/mm/yy" });
});
</script>
<h3>ข้อมูลการเช่าสนามบิน</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table>
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Daters" id="Daters" value="<?=$_GET['Daters']?>"></td>
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
		<th>สถานะ</th>
	</tr>
<?
if(count($rows['data'])>0){
	$no = $rows['no'];
	foreach($rows['data'] as $val){
		$no++;
		$status = '<font color="#ff0000">รอยืนยัน</font>';
		if($val['Confirm']=='1'){
			$status = '<font color="#469810">ยืนยันแล้ว</font>';
		}
?>
	<tr>
		<td align="center"><?=$no?></td>
		<td align="center"><?=DateTH($val['Daters'])?> - <?=DateTH($val['Daters_end'])?></td>
		<td align="right"><?=$val['Ser_charge']?></td>
		<td><?=$val['Nameuser']?> <?=$val['Surname']?></td>
		<td><?=$val['Des_air']?></td>
		<td align="center"><b><?=$status?></b></td>
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