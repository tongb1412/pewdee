<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$hn = $_GET['hn'];
$vn = $_GET['vn'];
$tid = $_GET['tid'];
$type = $_GET['type'];


$sql = "select *  from tb_patient where hn ='$hn' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);
$pname = $rs['pname'].$rs['fname'].'   '.$rs['lname'];
$cn = $rs['cradno'];

if($type=='C'){
$sql = "select *  from tb_pctrec where vn ='$vn' and tid='$tid' and typ='C' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);
$tname = $rs['tname'];
$tprice = number_format($rs['totalprice'],'2','.',',');
$ename =  $rs['empname'];
$qty = $rs['qty'];
$sql = "select qty  from tb_course_detail where  cid='$tid' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);
$tqty = $rs['qty'] * $qty;

} else {
$cid = $_GET['cid'];
$sql = "select *  from tb_pctrec where vn ='$vn' and tid='$tid' and typ='P' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);
$ename =  $rs['empname'];
$qty = $rs['qty'];

$sql = "select *  from tb_package_detail where  pid='$tid' and id='$cid' and typ='C' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 

$rs=mysql_fetch_array($str);
$tname = $rs['name'];
$tprice = number_format($rs['price'],'2','.',',');
$qty = $rs['qty'] * $qty;

$sql = "select qty  from tb_course_detail where  cid='$cid' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);
$tqty = $rs['qty'] * $qty;
}
$sql = "select * from tb_clinicinformation  ";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($clinic_result); 

?>
<body  style="margin:0px; margin-left:5px;">

<div style="width:100%; height:1000px;  font-family: 'Angsana New'; text-align:center; margin-left:0px;">

	<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:16px ">รายการรับบริการคอร์ส</div>
	<div style="width:50%; height:20px; line-height:20px; text-align:left; float:left; ">
		<div style="width:100%; height:20px;   line-height:20px;"><?=$row['clinicname']?></div>	
	</div>
	<div style="width:50%; height:20px; line-height:20px; text-align:right; float:left; ">วันที่ :&nbsp; <?=date('d/m/Y H:i',time());?></div>
	
	<div style="width:50%; height:20px; line-height:20px; text-align:left; float:left; ">ที่อยู่ :&nbsp;<?=$row['address'].'   '.$row['province'].'  '.$row['post']?></div>
	<div style="width:50%; height:20px; line-height:20px; text-align:right; float:left; ">พนักงานคลีนิค : <?=$ename?></div>
	
	<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left; "><?='เบอร์โทรศัพท์ '.$row['telephone'].'   โทรสาร '.$row['fax']?></div>
	
	<div style="width:100%; height:15px;   line-height:10px; float:left;"></div>
	
	<div style="width:60%; height:20px; line-height:20px; text-align:left; float:left; ">ชื่อ-สกุล : <?=$pname?></div>
	<div style="width:40%; height:20px; line-height:20px; text-align:right; float:left; "><?='Card no : '.$cn?></div>

	<div style="width:100%; height:10px;   line-height:10px; float:left;"></div>

	<div style="width:15%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  float:left;">ลำดับ</div>
	<div style="width:53%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  border-left:none;float:left;">รายการ</div>
	<div style="width:29%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid; border-left:none;float:left;">ราคา</div>

	<div style="width:15%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">1</div>
	<div style="width:53%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid; text-align:left">
	&nbsp;<?=$tname?>
	</div>
	<div style="width:29%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid; ">
	<?=$tprice?>&nbsp;
	</div>
	
<!--ตาราง-->
<? $n = 0 ;
while ($n < 3) { ?>
	<div style="width:15%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:53%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:29%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
<? 
$n++;
} ?>

<!--รวม-->
<div style="width:15%; height:20px;   line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
<div style="width:53%; height:20px;  text-align:right;  line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">รวม&nbsp;&nbsp;&nbsp;
</div>
<div style="width:29%; height:20px;   line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;"><?=$tprice?>&nbsp;</div>

<!--ข้อตกลง-->	
	<div style="width:100%; height:10px; font-size:12px;  line-height:10px; float:left;"></div>
	<div style="width:8%; height:20px;   line-height:20px; float:left;text-align:left; font-weight:bold">ข้อตกลง</div>
	<div style="width:92%; height:20px;   line-height:20px; float:left; text-align:left;">
		คอร์ส หรือแพ็กเกจ ข้างต้น ไม่สามารถเปลี่ยนแปลง ยกเลิก หรือคืนคอร์สได้ และไม่สามารถเปลี่ยนเป็นเงิน หรือขอคืนเป็นเงินได้ ยกเว้นในกรณี
	</div>
	<div style="width:100%; height:20px;   line-height:20px; float:left; text-align:left;">
		พิเศษที่ไม่สามารถรับบริการได้ เช่น เกิดการแพ้ยา หรือเกิดอาการข้างเคียง  ทางคลีนิคจะพิจารณาการเปลี่ยนแปลงเป็นบริการอื่นทดแทนโดยความเห็นชอบ
	</div>
	<div style="width:100%; height:20px;   line-height:20px; float:left; text-align:left;">
		จากแพทย์เท่านั้น ผู้รับบริการได้อ่านและเข้าใจข้อตกลงแล้ว จึงลงรายมือชื่อไว้เป็นหลักฐาน
	</div>
	
	<div style="width:100%; height:10px;   line-height:10px; float:left;"></div>
	
	<div style="width:100%; height:20px;   line-height:20px; float:left;">
		<div style="width:150px; margin:auto; border-bottom:#000000 2px dotted;">&nbsp;</div>
	</div>
	<div style="width:100%; height:10px;   line-height:10px; float:left;"></div>
	<div style="width:100%; height:20px;   line-height:20px; float:left;">(.........................................................................)</div>
	<div style="width:100%; height:10px;   line-height:10px; float:left;"></div>
	<div style="width:100%; height:20px;   line-height:20px; float:left;">ผู้รับบริการ</div>
	
	<div style="width:100%; height:20px;   line-height:20px; float:left; text-align:left;">
		*** เพื่อประโยชน์ของท่าน กรุณาเก็บเอกสารฉบับนี้ไว้เป็นหลักฐานแสดงการรับบริการเป็นคอร์สและการชำระเงิน ทางคลีนิคได้ทำการเก็บข้อมูลและ
	</div>
	<div style="width:100%; height:20px;   line-height:20px; float:left; text-align:left;">
		รายละเอียดการรับบริการของท่านไว้อย่างเป็นระบบ แต่ในกรณีที่ไม่ปรากฏข้อมูลอันเนื่องมาจากความผิดพลาดใดๆก็ตาม ท่านสามารถนำเอกสารมาเพื่อ
	</div>
	<div style="width:100%; height:20px;   line-height:20px; float:left; text-align:left;">
		ยืนยันกับทางคลีนิคได้ทางผิวดีคลีนิคไม่สามารถรับผิดชอบต่อความเสียหายใด ๆ ที่เกิดขึ้นได้หากท่านไม่สามารถแสดงหลักฐานการชำระเงินนี้
	</div>	
	<div style="width:100%; height:20px;   line-height:20px; float:left; text-align:left;">
		ต่อทางคลินิกได้  ***
	</div>
	
	<div style="width:100%; height:20px; font-size:11px; line-height:20px; text-align: right; float: left; ">
	ส่วนที่ 1 สำหรับลูกค้า
	</div>
	<div style="width:100%; height:5px; font-size:10px; line-height:20px; text-align:center; border-bottom: #000000 2px dotted; float:left; ">
	&nbsp;
	</div>
	
	
<!--ส่วนที่สอง-->
	<div style="width:100%; height:5px; font-size:12px;  line-height:10px; float:left;"></div>

	<div style="width:40%; height:20px; line-height:20px; text-align:left; float:left; ">
		<div style="width:100%; height:20px;   line-height:20px;"><?=$row['clinicname']?></div>	
	</div>
	<div style="width:30%; height:20px; line-height:20px; text-align: center; float:left; ">วันที่ :&nbsp; <?=date('d/m/Y H:i',time());?></div>
	<div style="width:30%; height:20px; line-height:20px; text-align:right; float:left; ">พนักงานคลีนิค : <?=$ename?></div>
	
	<div style="width:60%; height:20px; line-height:20px; text-align:left; float:left; ">ชื่อ-สกุล : <?=$pname?></div>
	<div style="width:40%; height:20px; line-height:20px; text-align:right; float:left; "><?='Card no : '.$cn?></div>
	

	<div style="width:40%; height:20px; line-height:20px; text-align:left; float:left; ">
		<div style="width:100%; height:20px;   line-height:20px;">คอร์ส : <?=$tname?></div>	
	</div>
	<div style="width:30%; height:20px; line-height:20px; text-align: center; float:left; ">จำนวน : <?=$tqty?> ครั้ง</div>
	<div style="width:30%; height:20px; line-height:20px; text-align:right; float:left; ">ราคา : <?=$tprice?> บาท</div>

<!--ตาราง-->
		<div style="width:100%; height:10px;   line-height:10px; float:left;"></div>

	<div style="width:9%; height:20px;    line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  float:left;">ครั้งที่</div>
	<div style="width:15%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  border-left:none;float:left;">รายการ</div>
	<div style="width:10%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  border-left:none;float:left;">วันที่</div>
	<div style="width:15%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  border-left:none;float:left;">แพทย์/เจ้าหน้าที่</div>
	<div style="width:9%; height:20px;    line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  border-left:none;float:left;">ครั้งที่</div>
	<div style="width:15%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  border-left:none;float:left;">รายการ</div>
	<div style="width:10%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  border-left:none;float:left;">วันที่</div>
	<div style="width:15%; height:20px;   line-height:20px; border:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;  border-left:none;float:left;">แพทย์/เจ้าหน้าที่</div>
	
	

<? $n = 0 ;
while ($n < 10) { ?>
	<div style="width:9%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:15%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:10%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:15%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:9%;  height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:15%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:10%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
	<div style="width:15%; height:20px; line-height:20px;  float:left; border-bottom:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid;">&nbsp;</div>
<? 
$n++;
} ?>


	
	
	<!--ข้อตกลง-->	
	<div style="width:100%; height:10px; font-size:12px;  line-height:10px; float:left;"></div>
	<div style="width:8%; height:20px;   line-height:20px; float:left;text-align:left; font-weight:bold">ข้อตกลง</div>
	<div style="width:92%; height:20px;   line-height:20px; float:left; text-align:left;">
		คอร์ส หรือแพ็กเกจ ข้างต้น ไม่สามารถเปลี่ยนแปลง ยกเลิก หรือคืนคอร์สได้ และไม่สามารถเปลี่ยนเป็นเงิน หรือขอคืนเป็นเงินได้ ยกเว้นในกรณี
	</div>
	<div style="width:100%; height:20px;   line-height:20px; float:left; text-align:left;">
		พิเศษที่ไม่สามารถรับบริการได้ เช่น เกิดการแพ้ยา หรือเกิดอาการข้างเคียง  ทางคลีนิคจะพิจารณาการเปลี่ยนแปลงเป็นบริการอื่นทดแทนโดยความเห็นชอบ
	</div>
	<div style="width:100%; height:20px;   line-height:20px; float:left; text-align:left;">
		จากแพทย์เท่านั้น ผู้รับบริการได้อ่านและเข้าใจข้อตกลงแล้ว จึงลงรายมือชื่อไว้เป็นหลักฐาน
	</div>
	
	<div style="width:100%; height:10px;   line-height:10px; float:left;"></div>
	
	<div style="width:100%; height:20px;   line-height:20px; float:left;">
		<div style="width:150px; margin:auto; border-bottom:#000000 2px dotted;">&nbsp;</div>
	</div>
	<div style="width:100%; height:10px;   line-height:10px; float:left;"></div>
	<div style="width:100%; height:20px;   line-height:20px; float:left;">(.........................................................................)</div>
	<div style="width:100%; height:10px;   line-height:10px; float:left;"></div>
	<div style="width:100%; height:20px;   line-height:20px; float:left;">ผู้รับบริการ</div>
	
	
	
	<div style="width:100%; height:20px; font-size:11px; line-height:20px; text-align: right; float: left; ">
	ส่วนที่ 2 สำหรับคลีนิค(แนบไว้ในประวัติลูกค้า)
	</div>
	
	

</div>

<script language="javascript">
printpr();


function printpr()
{

var OLECMDID = 7;
/* OLECMDID values:
* 6 - print
* 7 - print preview
* 1 - open window
* 4 - Save As
*/
var PROMPT = 1; // 2 DONTPROMPTUSER
var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
WebBrowser1.ExecWB(OLECMDID, PROMPT);
WebBrowser1.outerHTML = "";
window.print();

}
</script>

</body>
