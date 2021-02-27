<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Slip PCT</title>
</head>
<?
include('../class/config.php');
$vn = $_GET['vn'];
$hn = $_GET['hn'];

$sql = "select * from tb_clinicinformation  ";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($clinic_result); 


$sql = "select * from tb_autonumber where typ='PCT'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = explode('-',$rs['number']);
$n = strlen($x[1]);
$bno = $x[0].'-' ;
$txt = explode('-',$rs['last']);
$num = intval($txt[1]) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$bno .= $t;  




$sql = "select tb_patient.pname,tb_patient.fname,tb_patient.lname,tb_patient.cradno,tb_patient.hn   ";
$sql .= "from tb_patient where tb_patient.hn = '$hn' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);





?>
<body  style="margin:0px;">

<div style="width:265px; height:auto; font-size:11px; text-align:center; margin-left:0px;">

<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:12px ">เพิ่มคอร์สเก่า</div>
<div style="width:45%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;"><?=date('d/m/Y H:i',time());?></div>
<div style="width:55%; height:20px; float:left; line-height:20px; font-size:11px; text-align:right; "><?='No : '.$bno?></div>

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

 
$sql1 = "select * from tb_pctrec where vn = '$vn'"; 
$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
while($rs1=mysql_fetch_array($str1)){ 

?>
<div style="width:80%; height:20px; text-align:left; line-height:20px;  float:left;">
&nbsp;<?=$rs1['tname'].' '.$rs1['qty']?>
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
&nbsp;<?=$rs1['tname'].' '.$rs1['qty']?>
</div>
<div style="width:20%; height:20px; text-align:right; line-height:20px;  float:left;">
<?='USE'?>&nbsp;
</div>
<? } ?>




</div>








</body>
</html>
