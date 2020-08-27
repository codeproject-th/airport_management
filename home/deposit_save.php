<?
if($_SESSION['member_id']==''){
	exit;
}

if($_POST){
	//$dateEnd = add_date(DateDB($_POST['Dateda']),($_POST['month']*30));
	$money = $_POST['month']*2500;
	$insert['Dateda'] = DateDB($_POST['Dateda']);
	$insert['Dateda_end'] = DateDB($_POST['Dateda_end']);
	$insert['Ser_charge'] = $money;
	$insert['Idair'] = $_POST['Idair'];
	$insert['Idmem'] = $_SESSION['member_id'];
	$insert['Confirm'] = '0';
	$query = db::insert('dep_air',$insert);
	$orderID = db::insert_id();
	$insert = array();
	$insert['order_data_type'] = '3';
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