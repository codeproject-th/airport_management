<?php

if($_SESSION['member_id']==''){
	exit;
}

if($_POST){
	
	$DateDiff = DateDiff(DateDB($_POST['Daters']),DateDB($_POST['Daters_end']));
	$money = ($DateDiff*100);
	if($_SESSION['member_year']==true){
		$money = 0;
	}
	//echo $DateDiff;
	$insert['Daters'] = DateDB($_POST['Daters']);
	$insert['Daters_end'] = DateDB($_POST['Daters_end']);
	$insert['Timers'] = $_POST['Timers'];
	$insert['Ser_charge'] = $_POST['Ser_charge'];
	$insert['Idair'] = $_POST['Idair'];
	$insert['Idmem'] = $_SESSION['member_id'];
	$insert['Confirm'] = '0';
	
	$air = db::select('aircraft',array('Idair'=>$insert['Idair']));
	$html = "
		<center>
		<form method='post' action='index.php?mod=home&f=rent_save'>
		<table border='1' cellpadding='0' cellspacing='0'>
			<tr>
				<td width='100' align='right'>วันที่เช่า :</td>
				<td width='200'>".$_POST['Daters']." - ".$_POST['Daters_end']."</td>
			<tr>
			<tr>
				<td align='right'>จำนวนวัน :</td>
				<td>".$DateDiff."</td>
			<tr>
			<tr>
				<td align='right'>จำนวณเงิน :</td>
				<td>".$money." บาท</td>
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
		<input type='hidden' name='Daters' value='".$_POST['Daters']."'>
		<input type='hidden' name='Daters_end' value='".$_POST['Daters_end']."'>
		<input type='hidden' name='Idair' value='".$_POST['Idair']."'>
		</form>
		</center>
		<br><br>
	";
	
	//$query = db::insert('ren_ser',$insert);
	if($query){
		//echo "<script> alert('เพิ่มข้อมูลเรียบร้อย'); </script>";
	}else{
		//echo "<script> alert('error'); </script>";
	}
}

//$Idair = db::insert('aircraft',array(),'*','ORDER BY Des_air');
$member = db::select('member',array('Idmem'=>$_SESSION['member_id']),'*','ORDER BY CONVERT( Nameuser USING tis620 ) ASC');
?>
<script>
$(function(){
	$("#Daters").datepicker({dateFormat: "dd/mm/yy" });
	$("#Daters_end").datepicker({dateFormat: "dd/mm/yy" });
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
<h3>เพิ่มข้อมูลการเช่าสนามบิน</h3>
<?=$html?>
<form method="post">
<table width="100%">
	<tr>
		<td width="20%" align="right">วันที่ :</td>
		<td><input type="text" name="Daters" id="Daters" required/> - <input type="text" name="Daters_end" id="Daters_end" required/></td>
	</tr>
	<tr>
		<td width="20%" align="right">ค่าบริการ :</td>
		<td>
		<? if($_SESSION['member_year']!=true){ ?>
			วันละ 100 บาท
		<? } ?> 
		</td>
	</tr>
	<tr style="display: none;">
		<td width="20%" align="right">สมาชิก :</td>
		<td>
			<select name="Idmem" id="Idmem" >
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