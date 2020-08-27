<?php
include_once('./../config.php');
include_once('./../libs/db.php');
include_once('./../libs/pagination.php');
include_once('./../libs/date.php');
db::open();
$Idair = db::select('aircraft',array('Idmem'=>$_POST['Idmem']),'*','ORDER BY Des_air');
echo json_encode($Idair);
?>