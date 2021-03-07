<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px; overflow:auto; text-align:center; height:290px; ">
  <?
include('../class/config.php');


if(!empty($_POST['did'])){
  $did = $_POST['did'];
} else {
  $did = '';
}


$cl = '';
$dat = date('Y-m-d');


?>
  <div style="width:2500px; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?= $tabcolor ?>;">
    <div style="width:4%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
    <div style="width:4%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
    <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ค่ายา</div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ค่่าหัตถการ/แล็บ</div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ทรีทเมนท์/เลเซอร์</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คอร์ส</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพ็คเกจ</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รวมเงิน</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ส่วนลด</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ทั้งหมด</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รับเงิน</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ค้างชำระ</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เงินสด</div>
    <div style="width:6%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;บัตรเคดิต</div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คูปอง</div>
  </div>


  <? 
$cl = $color1;



if(empty($did)){
  $sql = "select a.*,b.cradno,b.pname,b.fname,b.lname from tb_payment a,tb_patient b,tb_vst c  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate like '%$dat%') and (c.status='COM')   ";
} else {
  $sql = "select a.*,b.cradno,b.pname,b.fname,b.lname  from tb_payment a,tb_patient b,tb_vst c  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate like '%$dat%') and (c.empid like '%$did%')  and (c.status='COM') ";
}
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 




$sql .=" order by a.billno asc ";
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

  <div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="width:2500px;;background:<?= $cl ?>; ">
    <div style="width:4%; float:left;"><?= $n ?></div>
    <div style="width:4%; float:left;">&nbsp;<?= $rs['cradno'] ?></div>
    <div style="width:10%; float:left;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['dp'], '0', '.', ',') ?></div>
    <div style="width:7%; float:left;"><?= number_format($rs['lp'], '0', '.', ',') ?></div>
    <div style="width:7%; float:left;"><?= number_format($rs['tp'], '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['cp'], '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['pp'], '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['total'], '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['discount'], '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['total'] -  $rs['discount'], '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($recive, '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($ar, '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['cash'], '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['credit'], '0', '.', ',') ?></div>
    <div style="width:7%; float:left;"><?= number_format($rs['ku'], '0', '.', ',') ?></div>



  </div>






  <? $n++; } ?>


  <? } 

if(empty($did)){

$cl = $color1;
$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname from tb_payment a,tb_patient  b where (a.hn = b.hn) and   (a.vn like 'AR%') and   (a.pdate like '%$dat%') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 
$sql .=" order by a.billno asc";
$result  = mysql_query($sql);

while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
  $cl = $color1;
} else {
  $cl = $color2;
}

//$t1 = $t1 + $rs['cash'];
//$t2 = $t2 + $rs['credit'];
$recive = $rs['cash'] + $rs['credit'];
$re = $re + $rs['total'];
?>

  <div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="width:2500px;;background:<?= $cl ?>; ">
    <div style="width:4%; float:left;"><?= $n ?></div>
    <div style="width:4%; float:left;">&nbsp;<?= $rs['cradno'] ?></div>
    <div style="width:10%; float:left;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
    <div style="width:6%; float:left;">-</div>
    <div style="width:7%; float:left;">-</div>
    <div style="width:7%; float:left;">-</div>
    <div style="width:6%; float:left;">-</div>
    <div style="width:6%; float:left;">-</div>
    <div style="width:6%; float:left;">-</div>
    <div style="width:6%; float:left;">-</div>
    <div style="width:6%; float:left;">-</div>
    <div style="width:6%; float:left;"><?= number_format($recive, '0', '.', ',') ?></div>
    <div style="width:6%; float:left;">-</div>
    <div style="width:6%; float:left;"><?= number_format($rs['cash'], '0', '.', ',') ?></div>
    <div style="width:6%; float:left;"><?= number_format($rs['credit'], '0', '.', ',') ?></div>
    <div style="width:7%; float:left;">-</div>
  </div>
  <?
$n++;
}
}
?>
</div>




<div id="d_list2" style=" width: 99%; margin-top:5px; margin-top:5px; overflow:auto; text-align:center; height:102px; background-color:#FFCC99;  ">

  <?



?>

  <div class="line" style="margin-top: 2px;">
    <div style="width:14.5%; float:left; text-align:right;">รวมค่ายา :&nbsp;</div>
    <div style="width:12%; float:left;">
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
    <div style="width:14.5%; float:left; text-align:right;">รวมค่าคอร์ส :&nbsp;</div>
    <div style="width:12%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($cp, '0', '.', ',') ?>" />
    </div>
    <div style="width:20%; float:left; text-align:right;">รวมค่่าแพ็คเกจ :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($pp, '0', '.', ',') ?>" />
    </div>
    <div style="width:25%; float:left; text-align:right;">รวมส่วนลด :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($ds, '0', '.', ',') ?>" />
    </div>
  </div>





  <div class="line" style="font-weight:bold;">
    <div style="width:14.5%; float:left; text-align:right;">รวมเงินทั้งหมด :&nbsp;</div>
    <div style="width:12%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($tt, '0', '.', ',') ?>" />
    </div>
    <div style="width:20%; float:left; text-align:right;">รวมรับเงิน :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($re, '0', '.', ',') ?>" />
    </div>
    <div style="width:25%; float:left; text-align:right;">รวมค้างชำระ :&nbsp;</div>
    <div style="width:10%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($aa, '0', '.', ',') ?>" />
    </div>
  </div>

  <!-- เพิ่มราคาทำ KOY -->

  <?
  if(empty($did)){
$sql1 = "select sum((b.totalprice/b.qty)*a.qty) one from tb_pctuse a,tb_pctrec b,tb_vst c where a.vn = b.vn and a.uvn = c.vn and a.pid = b.tid and (a.dat like '%$dat%')   and a.uvn <> b.vn and (c.status='COM') group by a.dat  ";
} else {
$sql1 = "select sum((b.totalprice/b.qty)*a.qty) one from tb_pctuse a,tb_pctrec b,tb_vst c where a.vn = b.vn and a.uvn = c.vn and a.pid = b.tid and (a.dat like '%$dat%') and a.uvn <> b.vn and (c.status='COM') t and (c.empid like '%$did%') group by a.dat  ";
}



$str = mysql_query($sql1) or die ("Error Query ".$sql1); 
$row = mysql_fetch_array($str);
$usetotal = $row['one'];

?>

  <div class="line" style="font-weight:bold;">
    <div style="width:14.5%; float:left; text-align:right;">รวมค่าทำ :&nbsp;</div>
    <div style="width:12%; float:left;">
      <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($usetotal, '2', '.', ',') ?>" />
    </div>

  </div>


  <!--	<div class="line">
      <div style="width:15%; float:left; text-align:right;">รวมเงินสด :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?= number_format($row['s_cash'], '0', '.', ',') ?>" />
      </div>
      <div style="width:20%; float:left; text-align:right;">รวมรับบัตรเคดิต :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?= number_format($row['s_credit'], '0', '.', ',') ?>" />
      </div>
	  <div style="width:25%; float:left; text-align:right;">รวมเงินคูปอง:&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?= number_format($row['s_ku'], '0', '.', ',') ?>" />
      </div>
    </div>-->


</div>