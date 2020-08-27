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
	$set_date_start = $_GET['year'].'-01-01';
	$set_date_end = $_GET['year'].'-12-31';
	$sql = "SELECT SUM(Mem_payment) AS price FROM member WHERE 	Reg_date BETWEEN '".$set_date_start."' AND '".$set_date_end ."'";
	$member = db::fetch($sql);
	
	$sql = "SELECT SUM(Ser_charge) AS price FROM ren_ser WHERE Confirm='1' AND 	Daters BETWEEN '".$set_date_start."' AND '".$set_date_end."'";
	$rent = db::fetch($sql);	
	
	$sql = "SELECT SUM(Ser_charge) AS price FROM dep_air WHERE Confirm='1' AND 	Dateda BETWEEN '".$set_date_start."' AND '".$set_date_end."'";
	$dep_air = db::fetch($sql);
	
	$total = $member[0]['price']+$rent[0]['price']+$dep_air[0]['price'];
	//////////////////////////////////////////////////////////////////
	$sql = "SELECT SUM(Money) AS price FROM salary WHERE Datesa BETWEEN '".$set_date_start."' AND '".$set_date_end."'";
	$salary = db::fetch($sql);
	$sql = "SELECT SUM(Money) AS price FROM public WHERE Datepub BETWEEN '".$set_date_start."' AND '".$set_date_end."'";
	$public = db::fetch($sql);
	$total2 = $salary[0]['price']+$public[0]['price'];
}
?>
<h3>รายรับ-รายจ่าย(รายปี)</h3>

<fieldset>
<legend>ค้นหา</legend>
<form method="get">
<input type="hidden" name="mod" value="<?=$_GET['mod']?>"/>
<input type="hidden" name="f" value="<?=$_GET['f']?>"/>
<table>
	<tr>
		<td width="20%" align="right">ปี :</td>
		<td>
			<select name="year" required="">
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
<center>ปี <?=$_GET['year']?></center>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
	<tr>
		<td width="50%" align="center">
			รายรับ
		</td>
		<td align="center">
			รายจ่าย
		</td>
	</tr>
	<tr valign="top">
		<td>
			<table border="0" width="100%">
				<tr>
					<td>ค่าสมาชิก</td>
					<td align="right"><?=number_format($member[0]['price'])?></td>
				</tr>
				<tr>
					<td>ค่าเช่าสนาม</td>
					<td align="right"><?=number_format($rent[0]['price'])?></td>
				</tr>
				<tr>
					<td>ค่าฝากเครื่องบิน</td>
					<td align="right"><?=number_format($dep_air[0]['price'])?></td>
				</tr>
				<tr>
					<td>รวม</td>
					<td align="right"><?=number_format($total)?></td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" width="100%">
				<tr>
					<td>เงินเดือน</td>
					<td align="right"><?=number_format($salary[0]['price'])?></td>
				</tr>
				<tr>
					<td>ค่าสาธารณูปโภค</td>
					<td align="right"><?=number_format($public[0]['price'])?></td>
				</tr>
				<tr>
					<td>รวม</td>
					<td align="right"><?=number_format($total2)?></td>
				</tr>
			</table>
		</td>
		<tr>
			<td align="right">รายรับ-รายจ่าย</td>
			<td align="right"><?=number_format($total-$total2)?></td>
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