<?php
if($_SESSION['member_id']==''){
	exit;
}

if($_POST){
	$dateEnd = add_date(DateDB($_POST['Dateda']),($_POST['month']*30));
	
	$insert['Dateda'] = DateDB($_POST['Dateda']);
	$insert['Dateda_end'] = DateDB($_POST['Dateda_end']);
	//$insert['Ser_charge'] = $_POST['Ser_charge'];
	$insert['Idair'] = $_POST['Idair'];
	$insert['Idmem'] = $_SESSION['member_id'];
	$insert['Confirm'] = '0';
	//$insert['Idhang'] = $_POST['Idhang'];
	//$query = db::insert('dep_air',$insert);
	$money = $_POST['month']*2500;
	$air = db::select('aircraft',array('Idair'=>$insert['Idair']));
	$html = "
		<center>
		<form method='post' action='index.php?mod=home&f=deposit_save'>
		<table border='1' cellpadding='0' cellspacing='0'>
			<tr>
				<td width='100' align='right'>วันที่ฝาก :</td>
				<td width='200'>".$_POST['Dateda']." - ".DateTH($dateEnd)."</td>
			<tr>
			<tr>
				<td align='right'>จำนวน:</td>
				<td>".$_POST['month']." เดื่อน</td>
			<tr>
			<tr>
				<td align='right'>จำนวณเงิน :</td>
				<td>".number_format($money)." บาท</td>
			<tr>
			<tr>
				<td align='right'>เครื่องบิน :</td>
				<td>".$air[0]['Des_air']."</td>
			<tr>
			<tr>
				<td></td>
				<td><input type='submit' value='ยืนยันการสั่งซื้อ'/></td>
			<tr>
		</table>
		<input type='hidden' name='Dateda' value='".$_POST['Dateda']."'>
		<input type='hidden' name='Dateda_end' value='".DateTH($dateEnd)."'>
		<input type='hidden' name='Idair' value='".$_POST['Idair']."'>
		<input type='hidden' name='month' value='".$_POST['month']."'>
		</form>
		</center>
		<br><br>
	";
	
	if($query){
		//echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		//echo "<script> alert('error'); </script>";
	}
}

$hangar = db::select('hangar',array(),'*','ORDER BY CONVERT( Name_hang USING tis620 ) ASC');
$member = db::select('member',array(),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');
?>
<script>
$(function(){
	$("#Dateda").datepicker({dateFormat: "dd/mm/yy" });
	$("#Dateda_end").datepicker({dateFormat: "dd/mm/yy" });
	//$("#Idmem").change(function(){
		$('#Idair').empty();
		html = '<option value="">-----เลือก-----</option>';
		$.ajax({
			type: "POST",
			url: "./ajax/airlist.php",
			cache: false,
			dataType: "json",
			data: "Idmem=<?=$_SESSION['member_id']?>",
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
	//});
});
</script>
<h3>เพิ่มข้อมูลรับฝากเครื่องบิน</h3>
<?=$html?>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Dateda" id="Dateda" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">ระยะเวลาการใช้งาน :</td>
		<td><input type="text" name="month" style="width: 50px;"/> เดือน &nbsp;&nbsp;&nbsp;ค่าเช่าเดือนละ 2,500 บาท</td>
	</tr>	
	<tr style="display: none;">
		<td width="20%" align="right">สมาชิก :</td>
		<td>
			<select name="Idmem" id="Idmem">
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
	<tr style="display:none;">
		<td width="20%" align="right">โรงเก็บ :</td>
		<td>
			<select name="Idhang" id="Idhang">
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