<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$bno = $_GET['bno'];
?>
<script language="javascript">
 function closepay(bno){
 	var page = 'slip_drugpay.php?bno='+bno;
		
		
     window.open(page, 'SLIP', 'width=400, height=500,resizable=yes, scrollbars=yes');
 }

</script>


<body  onUnload="closepay('<?=$bno?>')" style="margin:0px;">
<?
$sql = "select * from tb_clinicinformation  ";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($clinic_result); 

$sql = "select tb_payment.*,tb_patient.pname,tb_patient.fname,tb_patient.lname,tb_patient.cradno   ";
$sql .= "from tb_payment,tb_patient where tb_patient.hn = tb_payment.hn and tb_payment.billno ='$bno' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);
$vn = $rs['vn'];
$total = $rs['total'];
$recive = $rs['recive'];
$discount = $rs['discount'];


?>
<div style="width:265px; height:auto; font-size:11px; text-align:center; margin-left:0px;">
<div style="width:100%; height:20px; font-size:12px;  line-height:20px;"><?=$row['clinicname']?></div>
<div style="width:100%; height:20px;  line-height:20px;"><?=$row['address']?></div>
<div style="width:100%; height:20px;  line-height:20px;"><?=$row['province'].'  '.$row['post']?></div>
<div style="width:100%; height:20px;  line-height:20px; "><?='โทร. '.$row['telephone'].'   โทรสาร. '.$row['fax']?></div>
<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:12px ">INVOICE/RECEIPT</div>
<div style="width:45%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;"><?=date('d/m/Y H:i',time());?></div>
<div style="width:55%; height:20px; float:left; line-height:20px; font-size:11px; text-align:right; "><?='No : '.$rs['billno']?></div>

<div style="width:50%; height:20px; line-height:20px; text-align:left; float:left; "><?='HN : '.$rs['hn']?></div>
<div style="width:50%; height:20px; line-height:20px; text-align:right; float:left; "><?='Card no : '.$rs['cradno']?></div>
<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left; border-bottom:#CCCCCC 1px dotted;">
<?='Name : '.$rs['pname'].$rs['fname'].'   '.$rs['lname']?>
</div>
<div style="width:70%; height:20px; font-size:11px;  line-height:20px; border-top:#CCCCCC 1px dotted; float:left;">รายการ</div>

<div style="width:30%; height:20px; font-size:11px;  line-height:20px; border-top:#CCCCCC 1px dotted; float:left;">ราคา</div>
<div style="width:70%; height:20px; font-size:11px;  line-height:20px;  float:left; border-bottom:#CCCCCC 1px dotted;">Description</div>
<div style="width:30%; height:20px; font-size:11px;  line-height:20px;  float:left; border-bottom:#CCCCCC 1px dotted;">Amount</div>
<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; ">
<? 
$sql1 = "select * from tb_drugerec where vn = '$vn'"; 
$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
while($rs1=mysql_fetch_array($str1)){ 
if($rs1['pid']=='-'){ $dp = $rs1['qty'] * $rs1['price'];  } else { $dp=0; }
?>
<div style="width:80%; height:20px; text-align:left; line-height:20px;  float:left;">
&nbsp;<?=$rs1['dname'].' '.$rs1['qty'].' '.$rs1['unit']?>
</div>
<div style="width:20%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($dp,'0','.',',')?>&nbsp;
</div>
<?
 } 
$sql1 = "select * from tb_pctrec where vn = '$vn'"; 
$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
while($rs1=mysql_fetch_array($str1)){ 

?>
<div style="width:80%; height:20px; text-align:left; line-height:20px;  float:left;">
&nbsp;<?=$rs1['tname'].' '.$rs1['qty'].' '.$rs1['unit']?>
</div>
<div style="width:20%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs1['totalprice'],'0','.',',')?>&nbsp;
</div>
<? 
} 

$sql1 = "select * from tb_pctuse where uvn = '$vn'"; 
$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
while($rs1=mysql_fetch_array($str1)){ 

?>
<div style="width:80%; height:20px; text-align:left; line-height:20px;  float:left;">
&nbsp;<?=$rs1['tname'].' '.$rs1['qty'].' '.$rs1['unit']?>
</div>
<div style="width:20%; height:20px; text-align:right; line-height:20px;  float:left;">
<?='USE'?>&nbsp;
</div>
<? } ?>




</div>
<div style="width:60%; height:20px; text-align:right; line-height:20px;  float:left;">
รวมเงิน / Amount
</div>
<div style="width:40%; height:20px; text-align:right; line-height:20px;  float:left; border-top:#CCCCCC 2px dotted; ">
<?=number_format($rs['total'],'0','.',',')?>&nbsp;
</div>
<div style="width:60%; height:20px; text-align:right; line-height:20px;  float:left;">
ส่วนลด / Discount
</div>
<div style="width:40%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs['discount'],'0','.',',')?>&nbsp;
</div>
<div style="width:60%; height:20px; text-align:right; line-height:20px;  float:left;">
จำนวนเงินสุทธิ / Total
</div>
<div style="width:40%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs['total']-$rs['discount'],'0','.',',')?>&nbsp;
</div>

<? if($rs['cash']>0){ ?>
<div style="width:60%; height:20px; text-align:right; line-height:20px;  float:left;">
รับเงินสด / Cash
</div>
<div style="width:40%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs['cash'],'0','.',',')?>&nbsp;
</div>
<? } ?>
<? if($rs['credit']>0){ ?>
<div style="width:60%; height:20px; text-align:right; line-height:20px;  float:left;">
บัตรเครดิต / Credit Card
</div>
<div style="width:40%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs['credit'],'0','.',',')?>&nbsp;
</div>
<? } ?>
<? if($rs['ku']>0){ ?>
<div style="width:60%; height:20px; text-align:right; line-height:20px;  float:left;">
คูปอง  / Kupong
</div>
<div style="width:40%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs['ku'],'0','.',',')?>&nbsp;
</div>
<? } ?>

<? if( $rs['recive'] >= ($rs['total']-$rs['discount'])) { ?>
<div style="width:60%; height:20px; text-align:right; line-height:20px;  float:left;">
ทอนเงิน / Change
</div>
<div style="width:40%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs['recive'] - ($rs['total']-$rs['discount']),'0','.',',')?>&nbsp;
</div>
<? } else { ?>
<div style="width:60%; height:20px; text-align:right; line-height:20px;  float:left;">
ค้างชำระ / AR
</div>
<div style="width:40%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format(($rs['total']-$rs['discount'])-$rs['recive'],'0','.',',')?>&nbsp;
</div>
<? } ?>
<div style="width:100%; height:40px; font-size:11px;  line-height:20px; float:left;"></div>
<div style="width:100%; height:20px; font-size:11px; text-align:center; line-height:20px; float:left;">
<div style="width:200px; margin:auto; border-bottom:#CCCCCC 2px dotted;">&nbsp;</div>
</div>
<div style="width:100%; height:20px; font-size:11px;  line-height:20px; float:left;">ผู้รับเงิน / Casher</div>

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
