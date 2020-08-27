<?php
include_once('./../config.php');
include_once('./../libs/db.php');
include_once('./../libs/pagination.php');
include_once('./../libs/date.php');
db::open();

$data = db::select('order_data',array('order_data_id'=>$_POST['id']));
$dep_air = db::select('dep_air',array('Idda'=>$data[0]['order_id']));

db::update('order_data',array('order_data_status'=>'1'),array('order_data_id'=>$_POST['id']));
db::update('dep_air',array('Confirm'=>'1','Idhang'=>$_POST['h']),array('Idda'=>$data[0]['order_id']));
?>
<script>
confirm_dialog_close();
</script>