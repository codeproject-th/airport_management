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
	$insert['Ser_charge'] = $money;
	$insert['Idair'] = $_POST['Idair'];
	$insert['Idmem'] = $_SESSION['member_id'];
	$insert['Confirm'] = '0';
	db::insert('ren_ser',$insert);
	$orderID = db::insert_id();
	$insert = array();
	$insert['order_data_type'] = '2';
	$insert['order_data_price'] = $money;
	$insert['order_data_date'] = date('Y-m-d H:i:s');
	$insert['order_id'] = $orderID;
	$insert['Idmem'] = $_SESSION['member_id'];
	db::insert('order_data',$insert);
	$order_code = str_pad(db::insert_id(),5,'0',STR_PAD_LEFT);
}

?>
<br><br><br><br>
<center>หมายเลขสั่งซื้อของคุณคือ : <?=$order_code?></center>
<br><br><br><br>