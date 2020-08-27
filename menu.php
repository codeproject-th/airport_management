<? if($_SESSION['login_id']!=''){ ?>
<div class="box_menu">
<h3>พนักงาน</h3>
<ul>
	<li><a href="index.php?mod=emp&f=add">เพิ่มข้อมูลพนักงาน</a></li>
	<li><a href="index.php?mod=emp&f=search">รายงานข้อมูลพนักงาน</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>สมาชิก</h3>
<ul>
	<li><a href="index.php?mod=member&f=add">เพิ่มข้อมูลสมาชิก</a></li>
	<li><a href="index.php?mod=member&f=search">รายงานข้อมูลสมาชิก</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>โรงเก็บ</h3>
<ul>
	<li><a href="index.php?mod=house&f=add">เพิ่มข้อมูลโรงเก็บ</a></li>
	<li><a href="index.php?mod=house&f=search">รายงานข้อมูลโรงเก็บ</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>เครื่องบิน</h3>
<ul>
	<li><a href="index.php?mod=airplane&f=add">เพิ่มข้อมูลเครื่องบิน</a></li>
	<li><a href="index.php?mod=airplane&f=search">รายงานข้อมูลเครื่องบิน</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>การเช่าสนามบิน</h3>
<ul>
	<li><a href="index.php?mod=rent&f=add">เพิ่มข้อมูลเช่าสนามบิน</a></li>
	<li><a href="index.php?mod=rent&f=search">รายงานข้อมูลเช่าสนามบิน</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>รับฝากเครื่องบิน</h3>
<ul>
	<li><a href="index.php?mod=deposit&f=add">เพิ่มข้อมูลฝากเครื่องบิน</a></li>
	<li><a href="index.php?mod=deposit&f=search">รายงานข้อมูลการฝากเครื่องบิน</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>ข้อมูลสาธารณูปโภค</h3>
<ul>
	<li><a href="index.php?mod=public&f=add">เพิ่มข้อมูลสาธารณูปโภค</a></li>
	<li><a href="index.php?mod=public&f=search">รายงานข้อมูลสาธารณูปโภค</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>เงินเดือน</h3>
<ul>
	<li><a href="index.php?mod=salary&f=add">จ่ายเงินเดือน</a></li>
	<li><a href="index.php?mod=salary&f=search">รายงานข้อมูลเงินเดือน</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>รายการสั่งซื้อ</h3>
<ul>
	<li><a href="index.php?mod=order&f=search">ค้นหารายการสั่งซื้อ</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>รายงานรายรับ-รายจ่าย</h3>
<ul>
	<li><a href="index.php?mod=report&f=report_month">รายเดือน</a></li>
	<li><a href="index.php?mod=report&f=report_year">รายปี</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>รายงานการใช้เครื่องบิน</h3>
<ul>
	<li><a href="index.php?mod=report&f=report_airplane_month">รายเดือน</a></li>
	<li><a href="index.php?mod=report&f=report_airplane_year">รายปี</a></li>
</ul>
</div>
<br>
<div class="box_menu">
<h3>ผู้ใช้งาน</h3>
<ul>
	<li><a href="index.php?mod=admin&f=add">เพิ่มผู้ใช้งาน</a></li>
	<li><a href="index.php?mod=admin&f=search">ค้นหาผู้ใช้งาน</a></li>
</ul>
</div>
<? } ?>