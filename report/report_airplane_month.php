<?php
$strMonth = Array(
								"01" => "มกราคม",
								"02" => "กุมภาพันธ์",
								"03" => "มีนาคม",
								"04" => "เมษายน",
								"05" => "พฤษภาคม",
								"06" => "มิถุนายน",
								"07" => "กรกฎาคม",
								"08" => "สิงหาคม",
								"09" => "กันยายน",
								"10" => "ตุลาคม",
								"11" => "พฤศจิกายน",
								"12" => "ธันวาคม"
							);
							
if($_GET['year']){
	$set_date_start = $_GET['year'].'-'.$_GET['month'].'-01';
	$set_date_end = $_GET['year'].'-'.$_GET['month'].'-31';
	$sql = "SELECT COUNT(*) AS c FROM ren_ser 
			INNER JOIN aircraft ON ren_ser.Idair = aircraft.Idair
			WHERE ren_ser.Confirm='1' AND ren_ser.Daters BETWEEN '".$set_date_start."' AND '".$set_date_end."' 
			AND  aircraft.Model='ultralight'
			";
	$ultralight[0] = db::fetch($sql);	
	
	$sql = "SELECT COUNT(*) AS c FROM ren_ser 
			INNER JOIN aircraft ON ren_ser.Idair = aircraft.Idair
			WHERE ren_ser.Confirm='1' AND ren_ser.Daters BETWEEN '".$set_date_start."' AND '".$set_date_end."' 
			AND  aircraft.Model='HS2'
			";
	$HS2[0] = db::fetch($sql);	
	//////////////////////
	
	$sql = "SELECT COUNT(*) AS c FROM dep_air 
			INNER JOIN aircraft ON dep_air.Idair = aircraft.Idair
			WHERE dep_air.Confirm='1' AND dep_air.Dateda BETWEEN '".$set_date_start."' AND '".$set_date_end."' 
			AND aircraft.Model='ultralight'
			";
	$ultralight[1] = db::fetch($sql);	
	
	$sql = "SELECT COUNT(*) AS c FROM dep_air 
			INNER JOIN aircraft ON dep_air.Idair = aircraft.Idair
			WHERE dep_air.Confirm='1' AND dep_air.Dateda BETWEEN '".$set_date_start."' AND '".$set_date_end."' 
			AND aircraft.Model='HS2'
			";
	$HS2[1] = db::fetch($sql);
	//echo $ultralight[0]['c'];
}
?>
<h3>รายงานการใช้เครื่องบิน(รายเดือน)</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table>
	<tr>
		<td width="20%" align="right">เดือน :</td>
		<td>
			<select name="month" required>
				<option value="">-----เลือก-----</option>
				<?
				foreach($strMonth as $key => $val){
				?>
					<option value="<?=$key?>"><?=$val?></option>
				<? } ?>
			</select>
			&nbsp;&nbsp;
			ปี : 
			<select name="year" required>
				<option value="">-----เลือก-----</option>
				<?
				$year = date('Y')-4;
				for($i=$year;$i<=date('Y');$i++){
				?>
					<option value="<?=$i?>"><?=$i?></option>
				<?
				}
				?>
			</select>
			</td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td><input type="submit" value="ค้นหา"/></td>
	</tr>
</table>
</form>
</fieldset>
<br><br>
<? if($_GET['year']!=''){ ?>
<div id="tableprint">
<center>เดื่อน <?=$strMonth[$_GET['month']]?> <?=$_GET['year']?></center>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
	<tr>
		<td width="50%" align="center">
			Ultralight
		</td>
		<td align="center">
			HS2
		</td>
	</tr>
	<tr valign="top">
		<td align="right">
			<?=number_format($ultralight[0][0]['c']+$ultralight[1][0]['c'])?> ครั้ง
		</td>
		<td align="right">
			<?=number_format($HS2[0][0]['c']+$HS2[1][0]['c'])?> ครั้ง
		</td>
		<tr>
			<td align="right">รวมทั้งหมด</td>
			<td align="right"><?=number_format($ultralight[0][0]['c']+$ultralight[1][0]['c']+$HS2[0][0]['c']+$HS2[1][0]['c'])?></td>
		</tr>
	</tr>
</table>
</div>
<br>
<center>
	<input type="button" value="Print" onclick="printTable('tableprint')">
</center>
<? } ?>
<script type="text/javascript"> 
function printTable(tableprint) { 
 	var printContents = document.getElementById(tableprint).innerHTML; 
    var originalContents = document.body.innerHTML; 
    document.body.innerHTML = printContents; 
    window.print(); 
    document.body.innerHTML = originalContents; 
} 
</script>