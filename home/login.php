<?php
if($_POST){
	$rows = db::select('member',array('Username'=>$_POST['Username'],'Password'=>$_POST['Password']));
	if(count($rows)>0){
		$_SESSION['member_id'] = $rows[0]['Idmem'];
		if($rows[0]['Member_type']=='2' and $rows[0]['AND Mem_payment']>0){
			$_SESSION['member_year'] = true;
		}
		
		$error = "<script> window.location = 'index.php'; </script>";
		
	}else{
		$error = "Username หรือ Password ไม่ถูกต้อง";
	}
}
?>
<h3>เข้าสู่ระบบ</h3>
<form method="post">
		<table width="500" border="0" cellpadding="0" cellspacing="0" style="">
			<tr>
				<td width="200" align="right" height="30">
					Username : &nbsp;
				</td>
				<td>
					<input type="text" name="Username"/>
				</td>
			</tr>
			<tr>
				<td width="200" align="right" height="30">
					Password :  &nbsp;
				</td>
				<td>
					<input type="password" name="Password"/>
				</td>
			</tr>
			<tr>
				<td width="200" align="right" height="30">
				</td>
				<td>
					<input type="submit" value="เข้าสู่ระบบ"/>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<div style="color:#ff0000"><?=$error?></div>
				</td>
			</tr>
		</table>
</form>