<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body  style="margin:0px; margin-left:5px;">
<?
include('../class/config.php');
$hn = $_GET['hn'];


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

if($rs['stayin']=='DOC'){
	$sql5 = "select *  from tb_vst where hn ='$hn' and status='DOC' ";
	$str5 = mysql_query($sql5) or die ("Error Query [".$sql5."]"); 
	$rs5=mysql_fetch_array($str5);
	if($rs5['empname']!='-'){ 
		$dname = $rs5['empname'];
		$eid = $rs5['empid'];
		$dat = date('Y-m-d');
		$sql5 = "select empid  from tb_vst where empid ='$eid'  and vdate like '%$dat%' ";
		$str5 = mysql_query($sql5) or die ("Error Query [".$sql5."]"); 		
		$dnum = mysql_num_rows($str5);
		
	} else { $dname=''; }
}

?>

<div style="width:265px; height:auto; font-size:11px; text-align:center; margin-left:0px;">
	<?php /*?><div style="width:100%; height:20px; float:left;  line-height:20px; font-weight:bold; font-size:12px ">ใบสั่งยา</div><?php */?>
	<div style="width:45%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;"><?=date('d/m/Y H:i',time());?></div>
	<div style="width:55%; height:20px; float:left; line-height:20px; font-size:11px; text-align:right; "><?='No : '.$no?></div>
	
	<div style="width:100%; height:20px;  line-height:20px; text-align:left; float:left; ">
		<?='Card no : '.$rs['cradno'].'    '.$rs['pname'].$rs['fname'].'   '.$rs['lname']?>
    </div>

	<div style="width:100%; height:20px; line-height:20px; text-align:left; float:left;">
		<div style="width:70%; float:left;"><?='แพทย์ : '.$dname?></div>
        <div style="width:30%; float:left; text-align:right"><?='ลำดับที่ : '.$dnum?></div>
	</div>	

	<div style="width:100%; border:#999999 1px solid; border-left:none; border-right:none; float:left; height:25px;; line-height:20px; text-align:center; margin-top:5px;">
		<div style="width:60%; height:20px; float:left;">
			<div>รายการ</div>
		</div>
		<div style="width:38%; height:25px; float:left;  border-left:#999999 1px solid;">
			<div>จำนวน</div>
			
		</div>
	</div>


<? for($i=1; $i < 16; $i++){ ?>
	<div style="width:100%; border-bottom:#999999 1px solid;  float:left; height:25px;; line-height:20px; text-align:center;">
	&nbsp;
	</div>
<? } ?>

<div style="width:100%; height:20px; font-size:11px; text-align:center; line-height:10px; float:left;">&nbsp;</div>
<div style="width:100%; height:20px; font-size:11px;  line-height:10px; float:left;">
	<div style="width:10%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;">DF :&nbsp;</div>
	<div style="width:30%; height:20px; border-bottom:#CCCCCC 2px dotted; float:left;">&nbsp;</div>
	<div style="width:20%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;">แพทย์ :&nbsp;</div>
	<div style="width:40%; height:20px; border-bottom:#CCCCCC 2px dotted; float:left;">&nbsp;</div>

</div>
<?php /*?><div style="width:100%; height:20px; font-size:11px; text-align:center; line-height:10px; float:left;">&nbsp;</div>
<div style="width:100%; height:20px; font-size:11px;  line-height:10px; float:left;">
	<div style="width:20%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;">แพทย์ :&nbsp;</div>
	<div style="width:80%; height:20px; border-bottom:#CCCCCC 2px dotted; float:left;">&nbsp;</div>

</div><?php */?>
<div style="width:100%; height:20px; font-size:11px; text-align:center; line-height:10px; float:left;">&nbsp;</div>
<div style="width:100%; height:20px; font-size:11px;  line-height:10px; float:left;">
	<div style="width:20%; height:20px; float:left; font-size:11px;  line-height:20px; text-align:left;">วันนัด :&nbsp;</div>
	<div style="width:80%; height:20px; border-bottom:#CCCCCC 2px dotted; float:left;">&nbsp;</div>

</div>	
	
	


</div>
</body>