<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');
$dat = date('Y-m-d');

if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = '';
}
$as = "";
// echo "x".$branchid."x";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];


if($_POST['mode']=='add'){

	if(!empty($_POST['eid'])){
		
		$sql  = "select empid from doctor where (empid='$eid') and (dat = '$dat') "; 
		$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		if (mysql_num_rows($str)) {
			$ee = trim($_POST['eid']);
			$tin = trim($_POST['tin']);
			$tout = trim($_POST['tout']);
			$mem = trim($_POST['mem']);	  
			$txt  = "update doctor set tin='$tin',tout='$tout',mem='$mem' where  empid='$eid' and dat='$dat' ";

		} else {
			$ee = trim($_POST['eid']);
			$tin = trim($_POST['tin']);
			$tout = trim($_POST['tout']);
			$mem = trim($_POST['mem']);			
			$eid = $ee;	
			$txt = "insert into doctor values('".$eid."','$dat','$tin','$tout','$mem')";
			
			
		}
		mysql_query($txt);	
		$eid = '';
		$tin = '';
		$tout = '';
		$mem = '';	
	}

}

if($_POST['mode']=='del'){
	$eid = $_POST['eid'];
	$sql2  = "delete from doctor  where  empid='$eid'";
	mysql_query($sql2) or die ("Error Query [".$sql2."]");
}


if($_POST['mode']=='show'){
	$eid = $_POST['eid'];
	$tin = $_POST['tin'];
	$tout = $_POST['tout'];
	$mem = $_POST['mem'];
}


?>
<!-- <div id="main" class="main" style="width:99%; margin:auto; height:500px; overflow:hidden;"> -->
<div id="t_main_monthly" class="tmain h-100">
	<div class="littleDD" style="font-size:18px; font-weight:bold; height:50px; " align="center" ;>
		<div style="width:30%; height:50px; line-height:50px; text-align:left; float:left;">ลงเวลาแพทย์ </div>
	</div>
	<div style="width:100%; height:180px;">
	<?
	$sql = "select staffid,pname,fname,lname from tb_staff where typ='D' $where_branch_id";
	$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	?>

		<div class="line" style="margin-top:10px; height:30px; font-size:16px;">
			<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">แพทย์ : &nbsp;</div>
			<div style="width:75%; float:left; line-height:30px; height:30px;">
				<select name="empid" id="empid" style="width:200px;">
					<option value="00">เลือกแพทย์</option>
					<? while($rs=mysql_fetch_array($result)){  ?>

					<option value="<?= $rs['staffid'] ?>" <? if($eid==$rs['staffid']){?> selected="selected"
						<? }?> > <?= $rs['fname'] . '   ' . $rs['lname'] ?>
					</option>
					<?  } ?>

				</select>&nbsp;

			</div>
		</div>

		<div class="line" style="margin-top:10px; height:30px; font-size:16px;">
			<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">เวลาเข้า : &nbsp;</div>
			<div style="width:15%; float:left; line-height:30px; height:30px;">
				<input type="text" id="tin" name="tin" size="10" value="<?= $tin ?>" />&nbsp;

			</div>
			<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">เวลาออก : &nbsp;</div>
			<div style="width:25%; float:left; line-height:30px; height:30px;">
				<input type="text" id="tout" name="tout" size="10" value="<?= $tout ?>" />&nbsp;

			</div>

		</div>
		<div class="line" style="margin-top:10px; height:60px; font-size:16px;">
			<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">หมายเหตุ : &nbsp;</div>
			<div style="width:75%; float:left; line-height:30px; height:30px;">
				<textarea id="mem" name="mem" cols="60" rows="2"><?= $mem ?></textarea>&nbsp;

			</div>
		</div>
		<div class="line" style="height:30px; font-size:16px;">
			<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">&nbsp;</div>
			<div style="width:75%; float:left; line-height:30px; height:30px;">
				<input type="button" value="  บันทึกข้อมูล " onclick="dtime()" />&nbsp;
				<input type="button" value="  ลบข้อมูล " onclick="cdtime()" />

			</div>
		</div>

	</div>
	<div style=" width:100%; margin-top:5px;  text-align:center; height:250px; ">
		<?
        $cl = $color1;     
        ?>
		<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:#EEF2F7;">
			<div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
			<div style="width:44%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพทย์</div>

			<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลาเข้า</div>
			<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลาออก</div>
		</div>
		<div style=" width:98%; margin:auto;  text-align:center; height:230px; overflow:auto;">
			<?			
			$sql  = "select a.*,b.pname,b.fname,b.lname from doctor a,tb_staff b where a.empid=b.staffid and a.dat='$dat' ";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
			$Num_Rows = mysql_num_rows($result);
			$n= 1;
			while($rs=mysql_fetch_array($result)){  
				if($cl != $color1){
					$cl = $color1;
				} else {
					$cl = $color2;
				} 
			?>
			<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="width:97%; cursor:pointer;background:<?= $cl ?>; " onclick="javascript: showdtime('<?= $rs['empid'] ?>','<?= $rs['tin'] ?>','<?= $rs['tout'] ?>','<?= $rs['mem'] ?>')">
				<div style="width:8%; float:left;"><?= $n ?></div>
				<div style="width:44%; float:left;"><?= $rs['pname'] . $rs['fname'] . '   ' . $rs['lname'] ?></div>
				<div style="width:20%; float:left;"><?= $rs['tin'] ?></div>
				<div style="width:20%; float:left;">&nbsp;<?= $rs['tout'] ?></div>
			</div>
			<? $n++; }?>
		</div>
	</div>





</div>