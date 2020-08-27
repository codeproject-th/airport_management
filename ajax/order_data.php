<?php
include_once('./../config.php');
include_once('./../libs/db.php');
include_once('./../libs/pagination.php');
include_once('./../libs/date.php');
db::open();

$data = db::select('order_data',array('order_data_id'=>$_POST['id']));

if($data[0]['order_data_type']=='3'){
	$dep_air = db::select('dep_air',array('Idda'=>$data[0]['order_id']));
	$hangar = db::select('hangar');
	$td = '';
	if(count($hangar)>0){
		foreach($hangar as $val){
			$sql = 'SELECT * FROM dep_air WHERE 
			Idhang="'.$val['Idhang'].'" 
			AND Confirm="1" AND Dateda BETWEEN "'.$dep_air[0]['Dateda'].'" AND "'.$dep_air[0]['Dateda_end'].'"
			';
			//echo $sql;
			$t = db::fetch($sql);
			
			if(count($t)>0){
				foreach($t as $val2){
					$chk_qty = $chk_qty+1;
				}
			}
			
			
			$qty = $val['quantity']-$chk_qty;
			$td .= '<tr>
						<td align="center"><input type="radio" class="radio1" name="select_hang" value="'.$val['Idhang'].'"></td>
						<td>'.$val['Name_hang'].'</td>
						<td align="center">'.$val['quantity'].'</td>
						<td align="center">'.$qty.'</td>
					</tr>
				';
		}
	}
	$html = '
			เลือกโรงเก็บ วันที่ '.DateTH($dep_air[0]['Dateda']).' - '.DateTH($dep_air[0]['Dateda_end']).'
			
			<table border="1" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center">เลือก</td>
					<td align="center">โรงเก็บ</td>
					<td align="center">จำนวน</td>
					<td align="center">เหลือ</td>
				</tr>
				'.$td.'
			</table>
			<input type="button" value="ยืนยัน" onclick="save_select_hang(\''.$_POST['id'].'\')">
			';
	echo $html;
}else if($data[0]['order_data_type']=='2'){
	db::update('ren_ser',array('Confirm'=>'1'),array('Idrs'=>$data[0]['order_id']));
	db::update('order_data',array('order_data_status'=>'1'),array('order_data_id'=>$_POST['id']));
	echo '<script> confirm_dialog_close(); </script>';
}else if($data[0]['order_data_type']=='1'){
	$Expires = add_date(date('Y-m-d'),'365');
	db::update('member',array('Mem_payment'=>'2500','Expires'=>$Expires,'Reg_date'=>date('Y-m-d')),array('Idmem'=>$data[0]['order_id']));
	db::update('order_data',array('order_data_status'=>'1'),array('order_data_id'=>$_POST['id']));
	echo '<script> confirm_dialog_close(); </script>';
}
?>
<script>
function save_select_hang(id){
	//alert('cc');
	
	h = $('.radio1:checked').val();
	//alert(h);
	$.ajax({
			type: "POST",
			url: "./ajax/save_select_hang.php",
			cache: false,
			data: "id="+id+"&h="+h,
			success: function(data){
				$("#output_data").html(data);
			}
	});
}
</script>