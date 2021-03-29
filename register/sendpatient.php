<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');
$hn = $_POST['hn'];
$bid = $_POST['bid'];
$branch_id = "";
if(empty($bid)) {
    if($_SESSION['branch_id'] != "") {
        $branch_id = $_SESSION['branch_id'];
    }
}
else {
    $branch_id = $bid;
}

$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];
$where_user =  set_where_user_data('',$_SESSION['branch_id'], $company_code, $company_data);

$sd = 'Yes';
$sql = "select * from tb_vst where hn='$hn' and status not IN('COM','CANCEL') " . $where_user['where_company_code'];
// echo $sql;exit();
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$num = mysql_num_rows($str);
if($num > 0 ){
	$sd = 'No';
	// echo $sd;
	$rs = mysql_fetch_array($str);
	switch ($rs['status']) {
	case 'SD'  : $txt = 'ไม่สามารถส่งคนไข้เข้าระบบได้ เนื่องจากคนไข้อยู่ระหว่างการซื้อยาหน้าร้าน';
				 break;
	case 'DOC' : $txt = 'ไม่สามารถส่งคนไข้เข้าระบบได้ เนื่องจากคนไข้อยู่ระหว่างการตรวจ ';
				 break;
	}
}

$sql = "select * from tb_patient where hn='$hn'" . $where_user['where_company_code'];
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]");
$row = mysql_fetch_array($patient_result);
if($sd == 'Yes'){
	if($row['vn'] != '-'){
		$sd = 'No'; 
		$txt = 'ไม่สามารถส่งคนไข้เข้าระบบได้ เนื่องจากคนไข้กำลังซื้อยาหน้าร้าน';
	}
}

?>

<div style="width:100%; height:50px; line-height:50px; font-size:18px; background:#f5fffa; border-bottom:#CCCCCC 1px dotted;">
	<div style="width:40%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ : <?=$hn; ?></div>
	<div style="width:50%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left; "><?=$row['pname'].$row['fname'].'    '.$row['lname']; ?></div>
</div>
<? if($sd == 'Yes'){ ?>
<div style="width:100%; height:100px;">
	<div class="line" style="margin-top:10px; height:50px; font-size:16px;">
		<div style="width:25%; float:left; text-align:right; line-height:50px; height:50px;">แพทย์ผู้ตรวจ&nbsp;</div>
		<div style="width:75%; float:left; line-height:50px; height:50px; padding-top:15px;">
		<select id="sempid" style="width:330px; font-size:16px;">
		<option value="00">ไม่ระบุแพทย์</option>
		<?php
		$branch_id_staff = $_SESSION['branch_id'];
		if($_SESSION['company_code'] == 1) {
			$sql = "select * from tb_staff where typ = 'D' and eshow='Y' and (branchid is NULL or branchid = '' or branchid = '$branch_id_staff')" . $where_user['where_company_code'] . " order by typ, fname ";
		}
		else {
			$sql = "select * from tb_staff where typ = 'D' and eshow='Y' and branchid = '$branch_id_staff' " . $where_user['where_company_code'] . " order by typ, fname ";
		}
		// echo $sql;exit();
		$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		while($rs = mysql_fetch_array($result)){
			?>
			<option value="<?=$rs['staffid']?>"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></option>
		<? } ?>		
		</select>
		</div>
    </div>
</div>
<div style="width:100%; height:49px; text-align:right;">
	<input type="button" value="  ส่งเข้าระบบ  " style="font-size:14px; font-weight:bold; height:35px;" onclick="sendadd('register/sendpatientadd.php','<?=$hn?>','<?php echo $_SESSION['branch_id']; ?>','')" />&nbsp;
	<input type="button" value="  ยกเลิก  "  style="font-size:14px; font-weight:bold; height:35px;" onclick="cancelsend()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
<? } else { ?>
<div style="width:100%; height:100px;">
	<div class="line" style="margin-top:10px; height:50px; font-size:16px;">
		
		<div style="width:100%; float:left; line-height:50px; height:50px; padding-top:15px; text-align:center;">
			<span style="color:#FF0000; font-size:16px; font-weight:bold;"><?=$txt?></span>
		</div>
    </div>
</div>
<div style="width:100%; height:49px; text-align:right;">
	<input type="button" value="  ยกเลิก  "  style="font-size:14px; font-weight:bold; height:35px;" onclick="cancelsend()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<? } ?>