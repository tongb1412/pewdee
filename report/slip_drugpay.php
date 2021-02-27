<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body  style="margin:0px; margin-left:5px;">
<?
include('../class/config.php');

$bno = $_GET['bno'];
$sql = "select hn  from tb_payment where billno ='$bno' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);
$hn = $rs['hn'];

$sql = "select * from tb_autonumber where typ='DD'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = substr($rs['last'],6,4);
$y = substr($rs['last'],0,6);
if($y != date('ymd',time())){
	$num = 1;
} else {
	$num = intval($x) + 1;
}
$m = strlen($num);

$i = 0; $t = ''; 
while($i < 4 - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$no = date('ymd',time()).$t; 

$sql  = "update tb_autonumber set last='$no' where typ='DD'";
mysql_query($sql) or die ("Error Query [".$sql."]");


$sql = "select *  from tb_patient where hn ='$hn' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($str);
?>

<div style="width:265px; height:auto; font-size:11px; text-align:center; margin-left:0px;">
	<div style="width:100%; height:20px; float:left;  line-height:20px; font-weight:bold; font-size:12px ">ใบสั่งยา</div>
	<div style="width:45%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;"><?=date('d/m/Y H:i',time());?></div>
	<div style="width:55%; height:20px; float:left; line-height:20px; font-size:11px; text-align:right; "><?='No : '.$no?></div>
	
	<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left; "><?='Card no : '.$rs['cradno']?></div>
	<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left;">
	<?='Name : '.$rs['pname'].$rs['fname'].'   '.$rs['lname']?>
	</div>

	<div style="width:99%; border:#999999 1px solid; float:left; height:45px;; line-height:20px; text-align:center; margin-top:5px;">
		<div style="width:60%; height:20px; float:left;">
			<div>รายการ</div>
		</div>
		<div style="width:38%; height:44px; float:left;  border-left:#999999 1px solid;">
			<div>จำนวน</div>
			<div>หน่วย</div>
		</div>
	</div>


<? for($i=1; $i < 11; $i++){ ?>
	<div style="width:99%; border:1px #999999 solid;  border-top:none; border-bottom:#999999 1px solid;  float:left; height:20px;; line-height:20px; text-align:center;">
	&nbsp;
	</div>
<? } ?>


<div style="width:100%; height:20px; font-size:11px; text-align:center; line-height:10px; float:left;">&nbsp;</div>
<div style="width:100%; height:20px; font-size:11px;  line-height:10px; float:left;">
	<div style="width:20%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;">แพทย์ :&nbsp;</div>
	<div style="width:80%; height:20px; border-bottom:#CCCCCC 2px dotted; float:left;">&nbsp;</div>

</div>

<div style="width:100%; height:20px; font-size:11px; text-align:center; line-height:10px; float:left;">&nbsp;</div>
<div style="width:100%; height:20px; font-size:11px;  line-height:10px; float:left;">
	<div style="width:20%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;">วันนัด :&nbsp;</div>
	<div style="width:80%; height:20px; border-bottom:#CCCCCC 2px dotted; float:left;">&nbsp;</div>

</div>	
	
	


</div>
</body>