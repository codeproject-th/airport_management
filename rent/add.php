<?php

if($_POST){
	$insert['Daters'] = DateDB($_POST['Daters']);
	$insert['Daters_end'] = DateDB($_POST['Daters_end']);
	$insert['Timers'] = $_POST['Timers'];
	$insert['Ser_charge'] = $_POST['Ser_charge'];
	$insert['Idair'] = $_POST['Idair'];
	$insert['Idmem'] = $_POST['Idmem'];
	$insert['Confirm'] = '1';
	$query = db::insert('ren_ser',$insert);
	if($query){
		echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

//$Idair = db::insert('aircraft',array(),'*','ORDER BY Des_air');
$member = db::select('member',array(),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');
?>
<script>
$(function(){
	$("#Daters").datepicker({dateFormat: "dd/mm/yy" });
	$("#Daters_end").datepicker({dateFormat: "dd/mm/yy" });
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
<h3>เพิ่มข้อมูลการเช่าสนามบิน</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Daters" id="Daters" required/> - <input type="text" name="Daters_end" id="Daters_end" required/></td>
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
		<td width="20%" align="right"></td>
		<td><input type="submit" value="บันทึก"/></td>
	</tr>
</table>
</form>