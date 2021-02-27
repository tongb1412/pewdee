<?
include('../class/config.php');
$cno = $_GET['cno'];

$sql = "select * from tb_clinicinformation  ";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($clinic_result); 

$sql = "select * from tb_salepct where cno='$cno' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);

$total = $rs['price'];
$recive = ($rs['cash'] + $rs['credit']) - $total;

?>



<body  style="margin:0px;">

<div style="width:265px; height:auto; font-size:11px; text-align:center; margin-left:0px;">
<div style="width:100%; height:20px; font-size:12px;  line-height:20px;">ผิวดีคลีนิค</div>

<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:12px ">INVOICE/RECEIPT</div>
<div style="width:45%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;"><?=date('d/m/Y H:i',time());?></div>
<div style="width:55%; height:20px; float:left; line-height:20px; font-size:11px; text-align:right; "><?='No : '.$rs['cno']?></div>


<div style="width:70%; height:20px; font-size:11px;  line-height:20px; border-top:#CCCCCC 1px dotted; float:left;">รายการ</div>

<div style="width:30%; height:20px; font-size:11px;  line-height:20px; border-top:#CCCCCC 1px dotted; float:left;">ราคา</div>
<div style="width:70%; height:20px; font-size:11px;  line-height:20px;  float:left; border-bottom:#CCCCCC 1px dotted;">Description</div>
<div style="width:30%; height:20px; font-size:11px;  line-height:20px;  float:left; border-bottom:#CCCCCC 1px dotted;">Amount</div>
<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; ">

<div style="width:80%; height:20px; text-align:left; line-height:20px;  float:left;">
&nbsp;<?=$rs['tname'].'  '.$rs['qty']?>
</div>
<div style="width:20%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($total,'0','.',',')?>&nbsp;
</div>





</div>
<div style="width:50%; height:20px; text-align:right; line-height:20px;  float:left;">
รวมเงิน / Amount
</div>
<div style="width:50%; height:20px; text-align:right; line-height:20px;  float:left; border-top:#CCCCCC 2px dotted; ">
<?=number_format($total,'0','.',',')?>&nbsp;
</div>

<? if($rs['cash']>0){ ?>
<div style="width:50%; height:20px; text-align:right; line-height:20px;  float:left;">
รับเงินสด / Cash
</div>
<div style="width:50%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs['cash'],'0','.',',')?>&nbsp;
</div>
<? } ?>
<? if($rs['credit']>0){ ?>
<div style="width:50%; height:20px; text-align:right; line-height:20px;  float:left;">
บัตรเครดิต / Credit Card
</div>
<div style="width:50%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($rs['credit'],'0','.',',')?>&nbsp;
</div>
<? } ?>


<div style="width:50%; height:20px; text-align:right; line-height:20px;  float:left;">
ทอนเงิน / Change
</div>
<div style="width:50%; height:20px; text-align:right; line-height:20px;  float:left;">
<?=number_format($recive,'o','.',',')?>&nbsp;
</div>

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
