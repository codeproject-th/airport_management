<?php
if($_SESSION['member_id']==''){
	exit;
}

$search['Des_air'] = $_GET['Des_air'];
$search['Model'] = $_GET['Model'];
$search['Owner'] = $_GET['Owner'];
$search['Iden_doc'] = $_GET['Iden_doc'];
$sql = db::search('aircraft',$search);
$sql = $sql.' AND Idmem="'.$_SESSION['member_id'].'"';
$rows = db::pagination($sql,$_GET['page']);

$member = db::select('member',array(),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');
?>
<h3>ข้อมูลเครื่องบิน</h3>


<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
	<tr>
		<th>No.</th>
		<th>ชื่อเครื่องบิน</th>
		<th>แบบของเครื่องบิน</th>
		<th>ชื่อเจ้าของ</th>
		<th>เอกสารประจำเครื่อง</th>
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
		<td><?=$val['Des_air']?></td>
		<td align="center"><?=$val['Model']?></td>
		<td><?=$val['Owner']?></td>
		<td align="center">
			<?
			if($val['doc1']=='1'){
				echo "ใบสาคัญการจดทะเบียน,";
			}
			if($val['doc2']=='1'){
				echo "ใบสาคัญสมควรเดินอากาศ,";
			}
			if($val['doc3']=='1'){
				echo "ใบอนุญาตใช้อากาศยานส่วนบุคคล,";
			}
			if($val['doc4']=='1'){
				echo "ประกันภัยอากาศยาน ";
			}
			?>
		</td>
		<td align="center"><a href="index.php?mod=home&f=aircraft_edit&id=<?=$val['Idair']?>"><img src="images/edit.png"></a> <a href="index.php?mod=aircraft_edit&f=search&delete_id=<?=$val['Idair']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
	</tr>
<?
	}
}else{
?>
	<tr>
		<td colspan="7" align="center">ไม่พบข้อมูล</td>
	</tr>
<? } ?>
</table>
<?=pagination::pages($rows['pages']);?>