<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <?
include('../class/config.php');
include('../class/permission_user.php');


if(!empty($_POST['did'])){
$did = $_POST['did'];
} else {
$did = '';
}


$cl = '';
if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {

//$nd = substr($_POST['edate'],0,2) + 1;
//if(strlen($nd)==1){ $nd = '0'.$nd; }
//$sdate = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2)  ;
//$edate = substr($_POST['edate'],6,4).'-'.substr($_POST['edate'],3,2).'-'.$nd ;

$t0 = strtotime($_POST['sdate']);
$t1 = strtotime($_POST['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 
}

if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}

$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

?>
<div style=" width: 98%; margin-top:5px; overflow:auto; text-align:center; height:290px; ">
  <div style="width:1700px; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?= $tabcolor ?>;">
    <div style="width:4%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
    <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
    <div style="width:14%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
    <div style="width:9%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ค่ายา</div>
    <div style="width:9%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ค่่าหัตถการ/แล็บ</div>
    <div style="width:9%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ทรีทเมนท์/เลเซอร์</div>
    <div style="width:9%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คอร์ส</div>
    <div style="width:9%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพ็คเกจ</div>
    <div style="width:9%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รวมเงิน</div>


  </div>


  <? 
$cl = $color1;


if(empty($did)){
	if($sdate == $edate){
		$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname from tb_payment a,tb_patient b,tb_vst c  where (a.hn = b.hn) and (a.vn=c.vn)  and ( a.pdate like '%$sdate%' ) and (c.status='COM') and a.total = a.discount and a.total>0 $where_branch_id ";	
	} else {	
		$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname from tb_payment a,tb_patient b,tb_vst c  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate between '$sdate%' and '$edate%') and (c.status='COM') and a.total = a.discount and a.total>0 $where_branch_id";
	}
} else {
	if($sdate == $edate){
		$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname  from tb_payment a,tb_patient b,tb_vst c  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate like '%$sdate%') and (c.empid like '%$did%') and (c.status='COM') and a.total = a.discount and a.total>0 $where_branch_id";
	} else {	
		$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname  from tb_payment a,tb_patient b,tb_vst c  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate between '$sdate%' and '$edate%') and (c.empid like '%$did%') and (c.status='COM') and a.total = a.discount and a.total>0 $where_branch_id";
	
	}
}

$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 

$sql .=" order by a.pdate asc ";
$result  = mysql_query($sql);
if($result){
$n=1;
$dp =0; $lp=0; $tp=0; $cp=0; $pp=0; $ds=0; $tt=0; $re=0; $aa=0;
while($rs=mysql_fetch_array($result)){  
  if($cl != $color1){
    $cl = $color1;
  } else {
    $cl = $color2;
  }

  
  $dp = $dp + $rs['dp'];
  $lp = $lp + $rs['lp'];
  $tp = $tp + $rs['tp'];
  $cp = $cp + $rs['cp'];
  $pp = $pp + $rs['pp'];
  $ds = $ds + $rs['discount'];
  $tt = $tt + $rs['total'];

  if($rs['recive'] < $rs['total']){	
    $recive = $rs['cash'] + $rs['credit'] + $rs['ku'];
    $re = $re + $recive;
    $aa = $aa + (($rs['total'] - $rs['discount']) - $recive);
    $ar = ($rs['total'] - $rs['discount']) - $recive;
  } else {
    $re = $re + ($rs['total'] -  $rs['discount']);
    $recive = $rs['total'] - $rs['discount'];
    $ar = 0;
  }





  ?>

    <div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="width:1700px;;background:<?= $cl ?>; ">
      <div style="width:4%; float:left;"><?= $n ?></div>
      <div style="width:10%; float:left;">&nbsp;<?= $rs['cradno'] ?></div>
      <div style="width:14%; float:left;"><?= $rs['fname'] . '    ' . $rs['lname']  ?></div>
      <div style="width:9%; float:left;"><?= number_format($rs['dp'], '0', '.', ',') ?></div>
      <div style="width:9%; float:left;"><?= number_format($rs['lp'], '0', '.', ',') ?></div>
      <div style="width:9%; float:left;"><?= number_format($rs['tp'], '0', '.', ',') ?></div>
      <div style="width:9%; float:left;"><?= number_format($rs['cp'], '0', '.', ',') ?></div>
      <div style="width:9%; float:left;"><?= number_format($rs['pp'], '0', '.', ',') ?></div>
      <div style="width:9%; float:left;"><?= number_format($rs['total'], '0', '.', ',') ?></div>
    </div>

  <? $n++; } ?>


  <? } ?>
</div>




<div id="d_list2" style=" width: 99%; margin-top:5px; margin-top:5px; overflow:auto; text-align:center; height:102px; background-color:#FFCC99;  ">

  <?



?>

  <div class="line" style="margin-top: 2px;">
    <div style="width:15%; float:left; text-align:right;">รวมค่ายา :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($dp, '0', '.', ',') ?>" />
    </div>
    <div style="width:20%; float:left; text-align:right;">รวมค่่าหัตถการ/แล็บ :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($lp, '0', '.', ',') ?>" />
    </div>
    <div style="width:25%; float:left; text-align:right;">รวมค่่าทรีทเมนท์/เลเซอร์ :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($tp, '0', '.', ',') ?>" />
    </div>
  </div>

  <div class="line">
    <div style="width:15%; float:left; text-align:right;">รวมค่าคอร์ส :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($cp, '0', '.', ',') ?>" />
    </div>
    <div style="width:20%; float:left; text-align:right;">รวมค่่าแพ็คเกจ :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($pp, '0', '.', ',') ?>" />
    </div>


  </div>

  <!--	<div class="line">
      <div style="width:15%; float:left; text-align:right;">รวมเงินสด :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?= number_format($row['s_cash'], '2', '.', ',') ?>" />
      </div>
      <div style="width:20%; float:left; text-align:right;">รวมรับบัตรเคดิต :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?= number_format($row['s_credit'], '2', '.', ',') ?>" />
      </div>
	  <div style="width:25%; float:left; text-align:right;">รวมเงินคูปอง:&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?= number_format($row['s_ku'], '2', '.', ',') ?>" />
      </div>
    </div>-->


</div>