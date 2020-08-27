<?php

if($_POST){
	$insert['Dateda'] = DateDB($_POST['Dateda']);
	$insert['Dateda_end'] = DateDB($_POST['Dateda_end']);
	$insert['Ser_charge'] = $_POST['Ser_charge'];
	$insert['Idair'] = $_POST['Idair'];
	$insert['Idmem'] = $_POST['Idmem'];
	$insert['Confirm'] = '1';
	$insert['Idhang'] = $_POST['Idhang'];
	$query = db::insert('dep_air',$insert);
	if($query){
		echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

$hangar = db::select('hangar',array(),'*','ORDER BY CONVERT( Name_hang USING tis620 ) ASC');
$member = db::select('member',array(),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');
?>
<script>
$(function(){
	$("#Dateda").datepicker({dateFormat: "dd/mm/yy" });
	$("#Dateda_end").datepicker({dateFormat: "dd/mm/yy" });
	$("#Idmem").change(function(){
		$('#Idair').empty();
		html = '<option value="">-----เลือก-----</option>';
		$.ajax({
			type: "POST",
			url: "./ajax/airlist.php",
			cache: false,
			dataType: "json",
			data: "Idmem="+$(this).val(),
			success: function(data){
					
					if (data === undefined || data === null) {
						
					}else{
						$.each(data, function(i, item) {
    						//alert(item.Idair);
    						html += '<option value="'+item.Idair+'">'+item.Des_air+'</option>';
						});
					}
					
					$('#Idair').append(html);
			}
		});
	});
});
</script>
<h3>เพิ่มข้อมูลรับฝากเครื่องบิน</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Dateda" id="Dateda" required/> - <input type="text" name="Dateda_end" id="Dateda_end" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">ค่าบริการ :</td>
		<td><input type="text" name="Ser_charge" style="width: 50px;" required /> </td>
	</tr>
	<tr>
		<td width="20%" align="right">สมาชิก :</td>
		<td>
			<select name="Idmem" id="Idmem" required>
				<option value="">-----เลือก-----</option>
				<?
				if(count($member)>0){
					foreach($member as $val){
				?>
					<option value="<?=$val['Idmem']?>"><?=$val['Nameuser']?> <?=$val['Surname']?></option>
				<? 
					}
				} ?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">เครื่องบิน :</td>
		<td>
			<select name="Idair" id="Idair" required>
				<option value="">-----เลือก-----</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">โรงเก็บ :</td>
		<td>
			<select name="Idhang" id="Idhang" required>
				<option value="">-----เลือก-----</option>
				<?
				if(count($hangar)>0){
					foreach($hangar as $val){
				?>
					<option value="<?=$val['Idhang']?>"><?=$val['Name_hang']?></option>
				<? 
					}
				} ?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
</form>