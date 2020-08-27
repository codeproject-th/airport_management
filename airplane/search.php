<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('aircraft',array('Idair'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Des_air'] = $_GET['Des_air'];
$search['Model'] = $_GET['Model'];
$search['Owner'] = $_GET['Owner'];
$search['Iden_doc'] = $_GET['Iden_doc'];
$sql = db::search('aircraft',$search);
if($_GET['Idmem']!=''){
	$sql = $sql.' AND Idmem="'.$_GET['Idmem'].'"';
}
$rows = db::pagination($sql,$_GET['page']);

$member = db::select('member',array(),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');
?>
<h3>รายงานเครื่องบิน</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table width="100%">
	<tr>
		<td width="20%" align="right">ชื่อเครื่องบิน :</td>
		<td><input type="text" name="Des_air" value="<?=$_GET['Des_air']?>" /></td>
	</tr>
	<tr>
		<td width="20%" align="right">แบบของเครื่องบิน :</td>
		<td><input type="text" name="Model" value="<?=$_GET['Model']?>"/></td>
	</tr>
	<tr>
		<td width="20%" align="right">ชื่อเจ้าของ :</td>
		<td><input type="text" name="Owner" value="<?=$_GET['Owner']?>"/></td>
	</tr>
	<tr style="display: none;">
		<td width="20%" align="right">เอกสารประจำเครื่อง :</td>
		<td><input type="text" name="Iden_doc" value="<?=$_GET['Iden_doc']?>"/></td>
	</tr>
	<tr>
		<td width="20%" align="right">สมาชิก :</td>
		<td>
			<select name="Idmem">
				<option value="">-----เลือก-----</option>
				<?
				if(count($member)>0){
					foreach($member as $val){
						$member_id[$val['Idmem']] = $val['Nameuser'].' '.$val['Surname'];
				?>
					<option <? if($_GET['Idmem']==$val['Idmem']){ ?> selected <? } ?> value="<?=$val['Idmem']?>"><?=$val['Nameuser']?> <?=$val['Surname']?></option>
				<? 
					}
				} ?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="คันหา"/></td>
	</tr>
</table>
</form>
</fieldset>
<br><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
	<tr>
		<th>No.</th>
		<th>ชื่อเครื่องบิน</th>
		<th>แบบของเครื่องบิน</th>
		<th>ชื่อเจ้าของ</th>
		<th>เอกสารประจำเครื่อง</th>
		<th>สมาชิก</th>
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
		<td align="center"><?
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
			?></td>
		<td><?=$member_id[$val['Idmem']]?></td>
		<td align="center"><a href="index.php?mod=airplane&f=edit&id=<?=$val['Idair']?>"><img src="images/edit.png"></a> <a href="index.php?mod=airplane&f=search&delete_id=<?=$val['Idair']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
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