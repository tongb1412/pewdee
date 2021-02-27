<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$hn = $_POST['hn'];


$sql = "select * from tb_patient where hn='$hn'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);


?>
<div style="width:100%; height:50px; line-height:50px; font-size:18px; background:#f5fffa; border-bottom:#CCCCCC 1px dotted;">
	<div style="width:40%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ : <?=$hn; ?></div>
	<div style="width:50%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left; "><?=$row['pname'].$row['fname'].'    '.$row['lname']; ?></div>
</div>

<div style="width:100%; height:100px;">
	<div class="line" style="margin-top:10px; height:50px; font-size:16px;">
		<div style="width:25%; float:left; text-align:right; line-height:50px; height:50px;">หมายเหตุ&nbsp;</div>
		<div style="width:75%; float:left; line-height:50px; height:50px; padding-top:15px;">
		<textarea id="cmem" rows="2" cols="48"></textarea>

		</div>
    </div>
</div>
<div style="width:100%; height:49px; text-align:right;">
	<input type="button" value="  ส่งกลับเวชระเบียน  " style="font-size:14px; font-weight:bold; height:35px;" onclick="canceladd('doctor/sendpatientadd.php','<?=$hn?>','<?=$vn?>','wlist')" />&nbsp;
	<input type="button" value="  ยกเลิก  "  style="font-size:14px; font-weight:bold; height:35px;" onclick="cancelsend()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>