<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_GET['vn'];

$sql = "select * from tb_clinicinformation  ";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($clinic_result); 




$sql = "select * from cbil where vn='$vn'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);


$sql1= "select b.selfphone from tb_payment a,tb_patient b where a.hn=b.hn and  a.vn='$vn'";
$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
$rs1=mysql_fetch_array($str1);
$tel = $rs1['selfphone'];

?>



<body  style="margin:0px;">

<div style="width:265px; height:auto; font-size:11px; text-align:center; margin-left:0px; ">

<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:12px ">ยกเลิกบิล</div>

<div style="width:100%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;"><?='วันที่ยกเลิก '.date('d/m/Y H:i',time());?></div>
<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left;">
<?='สาขา : '.$row['clinicname']?>
</div>

<div style="width:60%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;"><?='เลขที่บิล : '.$rs['bno']?></div>
<div style="width:40%; height:20px; float:left; line-height:20px; font-size:11px; text-align:right; "><?='จำนวนเงิน : '.number_format($rs['total'],'0','.',',')?></div>

<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left;">
<?='ชื่อค้า : '.$rs['cname']?>
</div>
<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left;">
<?='เบอร์โทร : '.$tel?>
</div>
<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left; ">
<?='ผู้ยกเลิก : '.$rs['ename']?>
</div>
<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left; ">
<?='ผู้ตรวจสอบ : '.$rs['pname']?>
</div>

<div style="width:100%; height:40px; text-align:left; line-height:20px;  float:left;">
<?='สาเหตุที่ยกเลิก : '.$rs['mem']?>
</div>

<div style="width:30%; height:20px; text-align:left; line-height:20px;  float:left;">
ลูกค้า
</div>
<div style="width:70%; height:20px; text-align:right; line-height:20px;  float:left; border-bottom:#CCCCCC 1px dotted;">
&nbsp;
</div>
<div style="width:30%; height:20px; text-align:left; line-height:20px;  float:left;">
ผู้ยกเลิก
</div>
<div style="width:70%; height:20px; text-align:right; line-height:20px;  float:left; border-bottom:#CCCCCC 1px dotted;">
&nbsp;
</div>
<div style="width:30%; height:20px; text-align:left; line-height:20px;  float:left;">
ผู้ตรวจสอบ
</div>
<div style="width:70%; height:20px; text-align:right; line-height:20px;  float:left; border-bottom:#CCCCCC 1px dotted;">
&nbsp;
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
