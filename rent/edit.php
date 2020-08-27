<?php

if($_POST){
	$insert['Daters'] = DateDB($_POST['Daters']);
	$insert['Daters_end'] = DateDB($_POST['Daters_end']);
	//$insert['Timers'] = $_POST['Timers'];
	$insert['Ser_charge'] = $_POST['Ser_charge'];
	$insert['Idair'] = $_POST['Idair'];
	$insert['Idmem'] = $_POST['Idmem'];
	$query = db::update('ren_ser',$insert,array('Idrs'=>$_POST['id']));
	if($query){
		echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
	}else{
		echo "<script> alert('error'); </script>";
	}
}

//$Idair = db::insert('aircraft',array(),'*','ORDER BY Des_air');
$data = db::select('ren_ser',array('Idrs'=>$_GET['id']));
$member = db::select('member',array(),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');
$Idair = db::select('aircraft',array('Idmem'=>$data[0]['Idmem']),'*','ORDER BY Des_air');
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
<h3>แก้ไขข้อมูลการเช่าสนามบิน</h3>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Daters" id="Daters" value="<?=DateTH($data[0]['Daters'])?>" required/>  - <input type="text" name="Daters_end" id="Daters_end" value="<?=DateTH($data[0]['Daters_end'])?>" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">ค่าบริการ :</td>
		<td><input type="text" name="Ser_charge" value="<?=$data[0]['Ser_charge']?>" style="width: 50px;" required /> </td>
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
					<option <? if($val['Idmem']==$data[0]['Idmem']){ ?> selected <? } ?> value="<?=$val['Idmem']?>"><?=$val['Nameuser']?> <?=$val['Surname']?></option>
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
				<? if(count($Idair)>0){ 
					foreach($Idair as $val){
				?>
					<option <? if($val['Idair']==$data[0]['Idair']){ ?>selected<? } ?> value="<?=$val['Idair']?>"><?=$val['Des_air']?></option>
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
<input type="hidden" name="id" value="<?=$data[0]['Idrs']?>"/>
</form>