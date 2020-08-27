<?php

//ลบข้อมูล
if($_GET['delete_id']){
	db::delete('order_data',array('order_data_id'=>$_GET['delete_id']));
	echo '<script> alert("ลบข้อมูลเรียบร้อย"); </script>';
}

$search['Datesa'] = DateDB($_GET['Datesa']);

if($search['Datesa']!=''){
	$where .= ' AND DATE(r.order_data_date)="'.$search['Datesa'].'" ';
}


$sql = "SELECT r.* , m.* FROM order_data r 
		INNER JOIN member m ON r.Idmem = m.Idmem 
		WHERE 1=1 ".$where." ORDER BY r.order_data_date DESC";
$rows = db::pagination($sql,$_GET['page']);
?>
<script>
$(function(){
	$("#Datesa").datepicker({dateFormat: "dd/mm/yy" });
});

function confirm_dialog(id){
	$.ajax({
			type: "POST",
			url: "./ajax/order_data.php",
			cache: false,
			data: "id="+id,
			success: function(data){
					$("#output_data").html(data);
			}
	});
	$("#dialog").dialog({
		width: 700
  	});
}

function confirm_dialog_close(){
	window.location.reload();
}

</script>
<div id="dialog" title="ยื่นยันข้อมูล" style="display: none;">
	<div id="output_data"></div>
</div>
<h3>ค้นหารายการสั่งซื้อ</h3>

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
		<th>รหัสสการสั่งซื้อ</th>
		<th>รายการสั่งซื้อ</th>
		<th>จำนวนเงิน</th>
		<th>สมาชิก</th>
		<th>สถานะ</th>
		<th>ยื่นยัน/ลบ</th>
	</tr>
<?
if(count($rows['data'])>0){
	$no = $rows['no'];
	foreach($rows['data'] as $val){
		$no++;
		switch($val['order_data_type']){
			case '1' : $type = 'สมัครสมาชิก'; break;
			case '2' : $type = 'เช่าสนามบิน'; break;
			case '3' : $type = 'ฝากเครื่องบิน'; break;
		}
		
		$status = "<font color='#ff0000'>ยังไม่ยืนยัน</font>";
		if($val['order_data_status']=='1'){
			$status = "<font color='#2c7317'>ยืนยันแล้ว</font>";
		}
?>
	<tr>
		<td align="center"><?=$no?></td>
		<td align="center"><?=DateTimeTH($val['order_data_date']);?></td>
		<td align="center"><?=str_pad($val['order_data_id'],5,'0',STR_PAD_LEFT)?></td>
		<td align="center"><?=$type?></td>
		<td align="right"><?=number_format($val['order_data_price']);?></td>
		<td><?=$val['Nameuser']?>&nbsp;&nbsp;<?=$val['Surname']?></td>
		<td align="center"><?=$status?></td>
		<td align="center"><a href="#" onclick="confirm_dialog('<?=$val['order_data_id']?>')"><img src="images/true.png"></a> <a href="index.php?mod=order&f=search&delete_id=<?=$val['order_data_id']?>" onclick="return confirm('ลบข้อมูล');"><img src="images/delete.gif"></a></td>
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