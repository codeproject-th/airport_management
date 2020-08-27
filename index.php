<?php
session_start();
ini_set('error_reporting', E_STRICT);
error_reporting(E_ALL ^ E_NOTICE);
include_once('config.php');
include_once('./libs/db.php');
include_once('./libs/pagination.php');
include_once('./libs/date.php');


$mod = $_GET['mod'];
$f = $_GET['f'];

$path = '';
switch($mod){
	case "salary" :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "salary"; //เงินเดือน
	break;
	case "rent" :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "rent"; //เช่า
	break;
	case "member" :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "member"; //สมาชิก
	break;
	case "house" :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "house"; //โรงเก็บ
	break;
	case "emp" :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "emp"; //พนักงาน
	break;
	case "airplane" :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "airplane"; //เครื่องบิน
	break;
	case "deposit"  :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "deposit"; //รับฝากเครื่องบิน
	break;
	case "public"  :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "public"; //ข้อมูลสาธารณูปโภค
	break;
	case "order"  :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "order"; //รายการสั่งซื้อ
	break;
	case "report"  :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "report"; //รายการสั่งซื้อ
	break;
	case "admin"  :
		if($_SESSION['login_id']==''){
			header("Location: login.php");
			exit;
		}
		$path = "admin"; //รายการสั่งซื้อ
	break;
	case "home"  :
		$path = "home"; //ข้อมูลสาธารณูปโภค
	break;
	default : 
		$path = "home";
	break;
}

if($f==''){
	$f = "home";
}

db::open();
$file_page = "./".$path."/".$f.".php";
if($_SESSION['login_id']!=''){
	include_once('layout-admin.php');
}else{
	include_once('layout-web.php');
}
db::close();
?>