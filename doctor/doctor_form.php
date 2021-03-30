<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('../class/config.php');
$vn = $_REQUEST['mode'];
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];
$where_branch = "and branchid = '$branch_id' ";
$where_company = "and company_code = '$company_code' ";

$sql = "select * from tb_patient,tb_vst where tb_patient.hn = tb_vst.hn and  tb_vst.vn = '$vn' and tb_vst.branchid = '$branch_id' and tb_vst.company_code = '$company_code' ";
$str = mysql_query($sql) or die("Error Querycc " . $sql);
$row = mysql_fetch_array($str);
$hn = $row['hn'];
$did = $row['empid'];
$dname = $row['empname'];
if (!empty($row['birthday'])) {
    $y = date('Y', time());
    $age = intval($y) - intval(substr($row['birthday'], 6, 4));
    if ($age < 0) {
        $age = (intval($y) + 543) - intval(substr($row['birthday'], 6, 4));
    }
} else {
    $age = '-';
}


?>
<div style="width:98%; height:100px; margin:auto;">
    <input type="hidden" id="hn" value="<?= $row['hn'] ?>" />
    <input type="hidden" id="vn" value="<?= $vn ?>" />
    <input type="hidden" id="typ" value="00" />
    <input type="hidden" id="fis" value="Y" />
    <div style="width:45%; height:470px; margin-right:10px; margin-left:5px; float:left; border:1px <?= $tabcolor ?> solid;">
        <div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
            <div style="width:65%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
            <div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
            <div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคารวม</div>
        </div>
        <div id="sdlist" style="width:100%; height:auto; text-align:left;">
            <div style="width:100%; height:420px; text-align:left; overflow:auto ">
                <?
$n=1; $total = 0;
$sql = "select * from tb_drugerec where vn='$vn' and pid='-' and branchid = '$branch_id' and company_code = '$company_code' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
                    <div style="width:100%;float:left; font-weight:bold; color:#0033FF;">ยา</div>

                </div>
                <?
}
$cl = $color1;
while($rs = mysql_fetch_array($result)){
    $total = $total + ( $rs['price'] *$rs['qty'] );
    if($cl != $color1){
        $cl = $color2;
    } else {
        $cl = $color2;
    }

    ?>

                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
                    <div style="width:5%;float:left; "><?= $n . '.' ?></div>
                    <div style="width:65%;float:left; cursor:pointer;" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= $rs['dname'] ?>&nbsp;</div>
                    <div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= number_format($rs['price'] * $rs['qty'], '2', '.', ',') ?>&nbsp;</div>

                </div>
                <?
    $n++;
}

$sql = "select * from tb_labrec where vn='$vn' and branchid = '$branch_id' and company_code = '$company_code' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
                    <div style="width:100%;float:left; font-weight:bold;color:#0033FF;">หัตถการ / แล็บ</div>

                </div>
                <?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){
$total = $total + ( $rs['price'] *$rs['qty'] );
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

$price = $rs['price'];
?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
                    <div style="width:5%;float:left; "><?= $n . '.' ?></div>
                    <div style="width:65%;float:left; cursor:pointer;" onClick="movelabEdit('<?= $rs['lid'] ?>','<?= $rs['lname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['eid'] ?>','<?= $rs['ename'] ?>','<?= $rs['mem'] ?>')">
                        <?= $rs['lname'] ?>&nbsp;</div>
                    <div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movelabEdit('<?= $rs['lid'] ?>','<?= $rs['lname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['eid'] ?>','<?= $rs['ename'] ?>','<?= $rs['mem'] ?>')">
                        <?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movelabEdit('<?= $rs['lid'] ?>','<?= $rs['lname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['eid'] ?>','<?= $rs['ename'] ?>','<?= $rs['mem'] ?>')">
                        <?= number_format($rs['price'] * $rs['qty'], '2', '.', ',') ?>&nbsp;</div>

                </div>
                <?
$n++;
}
$sql = "select * from tb_pctrec where vn='$vn' and typ IN ('T','L') and branchid = '$branch_id' and company_code = '$company_code' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
                    <div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">ทรีทเม้นท์ / เลเซอร์</div>
                </div>
                <?
}
$cl = $color1;
while($rs = mysql_fetch_array($result)){
$total = $total +  $rs['totalprice'] ;
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

$price = $rs['price'];
$pid = $rs['tid'];
$cid = $rs['cid'];
$cname = $rs['cname'];

$sqlu = "select empid,ename from tb_pctuse where vn='$vn' and pid='$pid' and ftyp='T' and branchid = '$branch_id' and company_code = '$company_code'";
$ustr = mysql_query($sqlu) or die ("Error Query [".$sqlu."]");
$ru = mysql_fetch_array($ustr);
$eid = $ru['empid'];
$ename = $ru['ename'];
?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; cursor:pointer; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" onclick="movelaserEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>','<?= $rs['unit'] ?>','<?= $eid ?>','<?= $ename ?>','<?= $cid ?>','<?= $cname ?>')">
                    <div style="width:5%;float:left; "><?= $n . '.' ?></div>
                    <div style="width:65%;float:left; ">
                        <?= $rs['tname'] ?>&nbsp;</div>
                    <div style="width:15%;float:left;  text-align:right">
                        <?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="width:15%;float:left; text-align:right;">
                        <?= number_format($rs['totalprice'], '2', '.', ',') ?>&nbsp;</div>

                </div>
                <?
$n++;
}
$sql = "select * from tb_pctrec where vn='$vn' and typ IN ('P','C') and branchid = '$branch_id' and company_code = '$company_code'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
                    <div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">คอร์ส / แพ็คเกจ</div>

                </div>
                <?
}
$cl = $color1;
while($rs = mysql_fetch_array($result)){
    $total = $total +  $rs['totalprice'] ;
    if($cl != $color1){
        $cl = $color2;
    } else {
        $cl = $color2;
    }

    $price = $rs['price'];
    $sid = $rs['empid'];
    $sname = $rs['empname'];
    $cid = $rs['cid'];
    $cname = $rs['cname'];

    ?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
                    <div style="width:5%;float:left; "><?= $n . '.' ?></div>
                    <div style="width:65%;float:left; cursor:pointer;" onClick="movepctEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>','<?= $sid ?>','<?= $sname ?>','<?= $cid ?>','<?= $cname ?>')">
                        <?= $rs['tname'] ?>&nbsp;</div>
                    <div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movepctEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>,'<?= $sid ?>','<?= $sname ?>','<?= $cid ?>','<?= $cname ?>')">
                        <?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movepctEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>,'<?= $sid ?>','<?= $sname ?>','<?= $cid ?>','<?= $cname ?>')">
                        <?= number_format($rs['totalprice'], '2', '.', ',') ?>&nbsp;</div>
                </div>
                <?
    $n++;
}

$sql = "select * from tb_drugerec where vn='$vn' and pid <> '-' and branchid = '$branch_id' and company_code = '$company_code'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
                    <div style="width:100%;float:left; font-weight:bold; color:#0033FF;"> ( <span style="color:#FF0000"></span> ) </div>

                </div>
                <?
}
$cl = $color1;
while($rs = mysql_fetch_array($result)){

if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

?>

                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
                    <div style="width:5%;float:left; "><?= $n . '.' ?></div>
                    <div style="width:65%;float:left; cursor:pointer;" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= $rs['dname'] ?>&nbsp;</div>
                    <div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= number_format($rs['price'] * $rs['qty'], '2', '.', ',') ?>&nbsp;</div>

                </div>
                <?
$n++;
}
$sql = "select * from tb_pctuse where uvn='$vn'  and branchid = '$branch_id' and company_code = '$company_code'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
                    <div style="width:100%;float:left; font-weight:bold; color:#0033FF;"> </div>

                </div>
                <?
}
$cl = $color1;
while($rs = mysql_fetch_array($result)){

    if($cl != $color1){
        $cl = $color2;
    } else {
        $cl = $color2;
    }

    ?>

                <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
                    <div style="width:5%;float:left; "><?= $n . '.' ?></div>
                    <div style="width:65%;float:left; "><?= $rs['tname'] ?>&nbsp;</div>
                    <div style="width:15%;float:left;  text-align:right"><?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="width:15%;float:left; text-align:right; "><input type="button" value="  " class="btn_del" onclick="pctUseDelete('doctor/pctuse_del.php','content','<?= $rs['uvn'] ?>','<?= $rs['tid'] ?>','<?= $rs['empid'] ?>','<?= $rs['ftyp'] ?>',<?= $rs['qty'] ?>,'<?= $rs['pid'] ?>','<?= $rs['vn'] ?>')" title="ลบ" alt="ลบ" /> </div>

                </div>
                <?
    $n++;
}
?>




            </div>
            <div style="width:100%; height:25px; float:left; font-size:16px; font-weight:bold; color:#FF0000;  border:#CCCCCC 1px dotted;">
                <div class="line">
                    <div style="width:70%; float:left; text-align:right; background:#CCCCCC; line-height:25px;"> รวมเงิน :&nbsp;</div>
                    <div style="width:30%; float:left; text-align:right; background:#CCCCCC; line-height:25px;">
                        <?= number_format($total, '2', '.', ',') ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div style="width:53%; height:470px; float:left;">
        <div style="width:100%; height:30px; line-height:30px; font-weight:bold; font-size:18px; border-bottom:#CCCCCC 1px dotted; text-align:left;">
            <div style="width:25%; float:left;"><?= $row['hn'] ?></div>
            <div style="width:55%; float:left;"><?= $row['pname'] . $row['fname'] . '   ' . $row['lname'] ?></div>
            <div style="width:20%; float:left;">อายุ<?= ' : ' . $age . 'ปี' ?></div>
        </div>
        <div style="width:100%; height:400px; background:#fffaf0; ">
            <div class="line" style="text-align:left; background:url(images/dot1.png) left center no-repeat; padding-left:20px; line-height:25px; font-weight:bold;">
                ยา
            </div>
            <div class="line">
                <div style="width:10%; float:left; text-align:right;"> ชื่อยา :&nbsp;</div>
                <div style="width:40%; float:left; text-align:right; text-align:left;">
                    <input type="hidden" id="did" />
                    <input type="text" id="dname" style="width:200px;" onkeyup="serchtxt('doctor/druge_list.php','dl',this)" />
                    <div id="dl" class="bl" style="width:100%;"></div>
                </div>
                <div style="width:10%; float:left; text-align:right;"> จำนวน :&nbsp;</div>
                <div style="width:10%; float:left;">
                    <input type="text" id="qty" style="width:20px;" onkeyup="calnum('price','qty','uprice')" />&nbsp;<span id="unit"></span>
                </div>
                <div style="width:6%; float:left; text-align:right;">ราคา :&nbsp;</div>
                <div style="width:14%; float:left;">
                    <input type="text" id="uprice" style="width:50px;" /><input type="hidden" id="price" />
                </div>
                <div style="width:10%; float:left;">
                    <input type="button" value="  " class="btn_add" onclick="addsaledlist('doctor/druge_add.php','content')" title="เพิ่ม" alt="เพิ่ม" />
                    <input type="button" value="  " class="btn_del" onclick="drugeDelete('doctor/druge_del.php','content')" title="ลบ" alt="ลบ" />
                </div>
            </div>

            <div class="line" style="text-align:left; background:url(images/dot1.png) left center no-repeat; padding-left:20px; line-height:25px; font-weight:bold;">
                หัตถการ / แล็บ
            </div>
            <div class="line">
                <div style="width:10%; float:left; text-align:right;">รายการ :&nbsp;</div>
                <div style="width:40%; float:left;">
                    <input type="hidden" id="lid" />
                    <input type="text" id="lname" style="width:200px;" onkeyup="serchlab('doctor/lab_list.php','ll',this)" />
                    <div id="ll" class="bl" style="width:100%;"></div>
                </div>
                <div style="width:10%; float:left; text-align:right;">จำนวน :&nbsp;</div>
                <div style="width:10%; float:left;">
                    <input type="text" id="lqty" style="width:20px;" onkeyup="calnum('lprice','lqty','luprice')" />
                </div>
                <div style="width:6%; float:left; text-align:right;">ราคา :&nbsp;</div>
                <div style="width:14%; float:left;">
                    <input type="text" id="luprice" style="width:50px;" /><input type="hidden" id="lprice" />
                </div>
                <div style="width:10%; float:left;">
                    <input type="button" value="  " class="btn_add" onclick="add_lab('doctor/lab_add.php','content')" title="เพิ่ม" alt="เพิ่ม" />
                    <input type="button" value="  " class="btn_del" onclick="labDelete('doctor/lab_del.php','content')" title="ลบ" alt="ลบ" />
                </div>

                <div id="THl" class="bl" style="width:100%;  background:#fffaf0; margin-top:26px; height:80px; display:none;">


                    <div class="line">
                        <div style="width:20%; float:left; text-align:right;">ผู้ทำ :&nbsp;</div>
                        <div style="width:46%; float:left;">
                            <input type="hidden" id="hcid" value="" size="5" />
                            <input type="text" id="hcname" style="width:200px;" onkeyup="serchtxt('doctor/hemp_list.php','hnl',this)" />
                            <div id="hnl" class="bl" style="width:100%; background:#FFFFFF"></div>
                        </div>
                        <div style="width:10%; float:left; text-align:right;">&nbsp;</div>
                        <div style="width:24%; float:left;">&nbsp;</div>
                    </div>

                    <div class="line">
                        <div style="width:20%; float:left; text-align:right;">หมายเหตุ :&nbsp;</div>
                        <div style="width:46%; float:left;">
                            <input type="text" id="hmem" style="width:200px;" />
                        </div>
                    </div>

                </div>




            </div>
            <div class="line" style="text-align:left; background:url(images/dot1.png) left center no-repeat; padding-left:20px; line-height:25px; font-weight:bold;">
                ทรีทเม้นท์ / เลเซอร์
            </div>
            <div class="line">
                <div style="width:10%; float:left; text-align:right;">รายการ :&nbsp;</div>
                <div style="width:60%; float:left;">
                    <input type="hidden" id="tid" /><input type="hidden" id="ttype" />
                    <input type="text" id="tname" style="width:280px;" onkeyup="serchlaer('doctor/treatment_list.php','tl',this)" />
                    <div id="tl" class="bl" style="width:100%;"></div>
                </div>
                <div style="width:6%; float:left; text-align:right;">ราคา :&nbsp;</div>
                <div style="width:14%; float:left;">
                    <input type="text" id="tuprice" style="width:50px;" /><input type="hidden" id="tprice" />
                </div>
                <div style="width:10%; float:left;">
                    <input id="tadd" type="button" value="  " class="btn_add" onclick="add_laser('doctor/pct_add.php','content')" title="เพิ่ม" alt="เพิ่ม" />
                    <input type="button" value="  " class="btn_del" onclick="laserDelete('doctor/pct_del.php','content')" title="ลบ" alt="ลบ" />
                </div>


                <div id="ull" class="bl" style="width:100%;  background:#fffaf0; margin-top:26px; height:80px; display:none;">


                    <div class="line">
                        <div style="width:20%; float:left; text-align:right;">ผู้สนับสนุน :&nbsp;</div>
                        <div style="width:46%; float:left;">
                            <input type="hidden" id="ncid" />
                            <input type="text" id="ncname" style="width:200px;" onkeyup="serchtxt('doctor/nemp_list.php','snl',this)" />
                            <div id="snl" class="bl" style="width:100%; background:#FFFFFF"></div>
                        </div>
                        <div style="width:10%; float:left; text-align:right;">&nbsp;</div>
                        <div style="width:24%; float:left;">&nbsp;</div>
                    </div>


                    <div class="line">
                        <div style="width:20%; float:left; text-align:right;">ผู้ทำ :&nbsp;</div>
                        <div style="width:46%; float:left;">
                            <input type="hidden" id="eid" />
                            <input type="text" id="ename" style="width:200px;" onkeyup="serchtxt('doctor/emp_list.php','el',this)" />
                            <div id="el" class="bl" style="width:100%; background:#FFFFFF;"></div>
                        </div>
                        <div style="width:10%; float:left; text-align:right;"> :&nbsp;</div>
                        <div style="width:24%; float:left;">
                            <input type="text" id="tqty" style="width:20px;" />
                            &nbsp;<span id="tunit"></span>
                        </div>
                    </div>

                    <div class="line" style="display:none;">
                        <div style="width:10%; float:left; text-align:right;">จำนวน :&nbsp;</div>
                        <div style="width:56%; float:left;">
                            <input type="hidden" id="seid" value="<?= $did ?>" />
                            <input type="text" id="sename" style="width:280px;" value="<?= $dname ?>" />
                            <div id="sel" class="bl" style="width:100%; background:#FFFFFF"></div>
                        </div>
                        <div style="width:10%; float:left; text-align:right;">&nbsp;</div>
                        <div style="width:24%; float:left;">&nbsp;</div>
                    </div>

                </div>

            </div>
            <div class="line" style="text-align:left; background:url(images/dot1.png) left center no-repeat; padding-left:20px; line-height:25px; font-weight:bold;">
                คอร์ส / แพ็คเกจ
            </div>
            <div class="line">
                <div style="width:10%; float:left; text-align:right;"> :&nbsp;</div>
                <div style="width:40%; float:left; text-align:right; text-align:left;">
                    <select id="ptype" onchange="clearpct()">
                        <option value="C">คอร์ส</option>
                        <option value="P">แพ็คเกจ</option>
                    </select>
                </div>
            </div>
            <div class="line">
                <div style="width:10%; float:left; text-align:right;">รายการ :&nbsp;</div>
                <div style="width:40%; float:left;">
                    <input type="hidden" id="pid" />
                    <input type="text" id="pname" style="width:200px;" onkeyup="serchpct('doctor/pct_list.php','pl',this)" />
                    <div id="pl" class="bl" style="width:100%;"></div>
                </div>
                <div style="width:10%; float:left; text-align:right;">จำนวน :&nbsp;</div>
                <div style="width:10%; float:left;">
                    <input type="text" id="pqty" style="width:20px;" onkeyup="calnum('pprice','pqty','puprice')" />
                </div>
                <div style="width:6%; float:left; text-align:right;">ราคา :&nbsp;</div>
                <div style="width:14%; float:left;">
                    <input type="text" id="puprice" style="width:50px;" /><input type="hidden" id="pprice" />
                </div>
                <div style="width:10%; float:left;">
                    <input type="button" id="ppadd" value="" class="btn_add" onclick="add_pct('doctor/pct_add.php','content')" title="เพิ่ม" alt="เพิ่ม" />
                    <input type="button" value="" class="btn_del" onclick="pctDelete('doctor/pct_del.php','content')" title="ลบ" alt="ลบ" />
                </div>

                <div id="cll" class="bl" style="width:100%;  background:#fffaf0; margin-top:26px; height:100px; display:none;">
                    <div class="line">
                        <div style="width:20%; float:left; text-align:right;">ผู้ขาย :&nbsp;</div>
                        <div style="width:46%; float:left;">
                            <input type="hidden" id="pseid" />
                            <input type="text" id="psename" style="width:280px;" onkeyup="serchtxt('doctor/psemp_list.php','psel',this)" />
                            <div id="psel" class="bl" style="width:100%; background:#FFFFFF"></div>
                        </div>
                        <div style="width:10%; float:left; text-align:right;">&nbsp;</div>
                        <div style="width:24%; float:left;">&nbsp;</div>
                    </div>
                    <div class="line">
                        <div style="width:20%; float:left; text-align:right;">ผู้สนับสนุน :&nbsp;</div>
                        <div style="width:46%; float:left;">
                            <input type="hidden" id="npseid" />
                            <input type="text" id="npsename" style="width:280px;" onkeyup="serchtxt('doctor/npsemp_list.php','npsel',this)" />
                            <div id="npsel" class="bl" style="width:100%; background:#FFFFFF"></div>
                        </div>
                        <div style="width:10%; float:left; text-align:right;">&nbsp;</div>
                        <div style="width:24%; float:left;">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="line" style="text-align:left; background:url(images/dot1.png) left center no-repeat; padding-left:20px; line-height:25px; font-weight:bold;">
                ใช้คอร์ส / แพ็คเกจ
            </div>
            <div class="line" style="height:auto; border:1px <?= $tabcolor ?> solid;">
                <div style="width:100%; height:20px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
                    <div style="width:75%;text-align:left; float:left; line-height:20px;">
                        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ
                    </div>
                    <div style="width:25%;text-align:left; float:left; line-height:20px;">
                        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวนคงเหลือ
                    </div>
                    <div id="pzone" class="pul" style="height:145px; text-align:center; display:none;">

                    </div>
                    <div id="pctl" style="display:none; height:200px;">
                        <div style="margin-top:5px; font-weight:bold; width:100%; height:20px;">
                            <div style="width:60%; float:left;">&nbsp;&nbsp;<span id="pctname"></span></div>
                            <div style="width:30%; float:left;">คงเหลือ :&nbsp;<span id="pctnum"></span></div>
                            <div style=" width:10%; text-align:right; float:left;">
                                <input type="button" value=" X " style="border:1px solid #CCCCCC; background:#CCCCCC; font-size:10px; height:15px; width:15px; text-align:center; margin-right:5px;" onclick="celpct()" />
                            </div>

                        </div>
                        <div style="margin-top:5px; width:100%; height:auto; float:left;">
                            <div style="width:20%; float:left; text-align:right;">ผู้ทำ :&nbsp;</div>
                            <div style="width:35%; float:left;">
                                <input type="hidden" id="peid" />
                                <input type="hidden" id="num" />
                                <input type="hidden" id="ptid" />
                                <input type="hidden" id="pvn" />
                                <input type="text" id="pename" style="width:150px;" onkeyup="serchtxt('doctor/pemp_list.php','eul',this)" />
                                <div id="eul" class="bl" style="width:100%;"></div>
                            </div>
                            <div style="width:15%; float:left; text-align:right;">จำนวน :&nbsp;</div>
                            <div style="width:25%; float:left;">
                                <input type="text" id="pctqty" style="width:40px;" value="1" />
                                &nbsp;<span id="tunit"></span>
                            </div>
                            <div style="width:5%; float:left;">
                                <input id="padd" type="button" value="  " class="btn_add" onclick="usepct('doctor/usepct.php','content')" title="เพิ่ม" alt="เพิ่ม" />
                            </div>
                        </div>

                        <div style="margin-top:5px; width:100%; height:auto; float:left;">
                            <div style="width:20%; float:left; text-align:right;">ผู้สนับสนุน :&nbsp;</div>
                            <div style="width:35%; float:left;">
                                <input type="hidden" id="peid1" />
                                <input type="text" id="pename1" style="width:150px;" onkeyup="serchtxt('doctor/pemp_list1.php','eul1',this)" />
                                <div id="eul1" class="bl" style="width:100%;"></div>
                            </div>
                            <div style="width:15%; float:left; text-align:right;">จำนวนช็อต :&nbsp;</div>
                            <div style="width:25%; float:left;">
                                <input type="text" id="pctTqty" style="width:40px;" value="1" />
                                &nbsp;<span id="tunit"></span>
                            </div>
                        </div>

                        <div style="margin-top:5px; width:100%; height:auto; float:left;">
                            <div style="width:20%; float:left; text-align:right;">ผู้สนับสนุน :&nbsp;</div>
                            <div style="width:35%; float:left;">
                                <input type="hidden" id="peid2" />
                                <input type="text" id="pename2" style="width:150px;" onkeyup="serchtxt('doctor/pemp_list2.php','eul2',this)" />
                                <div id="eul2" class="bl" style="width:100%;"></div>
                            </div>
                        </div>

                    </div>


                </div>




                <div id="z_use" class="line" style="height:125px; overflow:auto; background:#FFFFFF;">


            <?php
		   	$sql = "delete from tb_pctlist  ";
			mysql_query($sql) or die ("Error Query [".$sql."]");

            if($_SESSION['cross_branch_data'] == "1") {
                $where_branch_id = "";
            } else {
                include('../class/permission_user.php');
                $branch_id = $_SESSION['branch_id'];
                $company_data = $_SESSION['company_data'];
                $company_code = $_SESSION['company_code'];
                $where_data = set_where_user_data("a", $branch_id, $company_code, $company_data);
                $where_branch_id .= $where_data['where_branch_id'];
                $where_branch_id .= $where_data['where_company_code'];
            }

		    $sql_pct = "select a.* from tb_pctrec a,tb_vst b  where a.hn = '$hn' and total > 0 and a.vn = b.vn and a.hn = b.hn and b.status <>'CANCEL' $where_branch_id";
            // echo $sql_pct;exit();
			$str_pct = mysql_query($sql_pct) or die ("Error Query [".$sql_pct."]");
			while($rs_pct = mysql_fetch_array($str_pct)){

			    $pvn = $rs_pct['vn'];
			    $pid = $rs_pct['tid'];
				$pname = $rs_pct['tname'];
				$qty = $rs_pct['qty'];
				$type = $rs_pct['typ'];
				$unit = $rs_pct['unit'];

		   		if($type=='L' || $type=='T'){

					$sql = "select sum(qty) as total from tb_pctuse where hn='$hn' and vn='$pvn' and pid='$pid' and tid='$pid' and ftyp='T' ";
					$tr = mysql_query($sql);
					$rr = mysql_fetch_array($tr);
				    $uqty = $rr['total'];

					if( $tqty > $uqty){
						$sql = "select * from tb_pctlist where vn='$pvn' and hn='$hn' and tid='$pid'";
						$tr = mysql_query($sql);
						$n = mysql_num_rows($tr);
						if(empty($n)){
							$tqty = $qty  -  $uqty;
							$sql = "insert into tb_pctlist  values('$pvn','$hn','$pid','$pname','$tqty','$unit','$type','$branch_id','$company_code')";
							mysql_query($sql);
						} else {
							$rr = mysql_fetch_array($tr);
							$tqty = $qty +  $rr['qty'] - $uqty;
							$sql = "update tb_pctlist set qty='$tqty' where vn='$pvn' and hn='$hn' and tid='$pid'" . $where_branch . $where_company;
							mysql_query($sql);
						}
					}
				}
		        if($type=='P'){
					$sql = "select tb_package_detail.*,tb_treatment.unit,tb_treatment.typ from tb_package_detail,tb_treatment  where tb_package_detail.id=tb_treatment.tid and tb_package_detail.pid='$pid' and tb_package_detail.typ IN ('T','L')";
					// echo $sql;exit();
                    $str = mysql_query($sql) or die ("Error Query [".$sql."]");
                    $n = mysql_num_rows($str);
                    if($n > 0){
                        while($rs = mysql_fetch_array($str)){
                            $tid = $rs['id'];
                            $tname = $rs['name'];
                            $tqty = $qty * $rs['qty'];
                            $tunit = $rs['unit'];
                            $ttype = $rs['typ'];
    
                            $sql = "select sum(qty) as total from tb_pctuse where hn='$hn' and vn='$pvn' and pid='$pid' and tid='$tid' and ftyp='PT' ";
                            $tr = mysql_query($sql);
                            $rr = mysql_fetch_array($tr);
                            $uqty = $rr['total'];
    
                            if( $tqty > $uqty){
                                $sql = "select * from tb_pctlist where vn='$pvn' and hn='$hn' and tid='$tid'";
                                $tr = mysql_query($sql);
                                $n = mysql_num_rows($tr);
                                if(empty($n)){
                                    $tqty = $tqty  -  $uqty;
                                    $sql = "insert into tb_pctlist values('$pvn','$hn','$tid','$tname','$tqty','$tunit','$ttype','$branch_id','$company_code')";
                                    mysql_query($sql);
                                } else {
                                    $rr = mysql_fetch_array($tr);
                                    $tqty = $tqty +  $rr['qty'] - $uqty;
                                    $sql = "update tb_pctlist set qty='$tqty' where vn='$pvn' and hn='$hn' and tid='$tid'" . $where_branch . $where_company;
                                    mysql_query($sql);
                                }
                            }
                        }
                    }
					
					$sql = "select id,qty from tb_package_detail  where pid='$pid' and typ = 'C' ";
					$str = mysql_query($sql) or die ("Error Query [".$sql."]");
                    $n = mysql_num_rows($str);
                    if($n > 0){
                        // echo $sql;exit();
                        while($rs = mysql_fetch_array($str)){
                            // echo $sql;exit();
                            $cid = $rs['id'];
                            $cqty = $rs['qty'];
                            $sqlc  = "select tb_course_detail.*,tb_treatment.unit,tb_treatment.typ from tb_course_detail,tb_treatment ";
                            $sqlc .= "where tb_course_detail.tid=tb_treatment.tid and tb_course_detail.cid='$cid' and tb_course_detail.company_code = '$company_code' ";
                            // echo $sqlc;exit();
                            $strc = mysql_query($sqlc) or die ("Error Query [".$sqlc."]");
                            while($rc=mysql_fetch_array($strc)){
                                $tid = $rc['tid'];
                                $tname = $rc['tname'];
                                $tqty = $qty * ($rc['qty'] * $cqty ); //จำนวนใน ครั้งของ คอร์สใน tb_package_detail * จำนวนครั้งของ คอร์สใน tb_course_detail จะได้เป็น จำนวนคงเหลือในการ ใช้คอร์ส
                                $tunit = $rc['unit'];
                                $ttype = $rc['typ'];

                                $sql = "select sum(qty) as total from tb_pctuse where hn='$hn' and vn='$pvn' and pid='$pid' and cid='$cid' and tid='$tid' and ftyp='PC' ";
                                // echo $sql;exit();
                                $tr = mysql_query($sql);
                                $rr = mysql_fetch_array($tr);
                                $uqty = $rr['total'];
                                if( $tqty > $uqty){
                                    $sql = "select * from tb_pctlist where vn='$pvn' and hn='$hn' and tid='$tid'";
                                    // echo $sql;exit();
                                    $tr = mysql_query($sql);
                                    $n = mysql_num_rows($tr);
                                    
                                    if(empty($n)){
                                        $tqty = $tqty  -  $uqty;
                                        $sql = "insert into tb_pctlist  values('$pvn','$hn','$tid','$tname','$tqty','$tunit','$ttype','$branch_id','$company_code')";
                                        mysql_query($sql);
                                    } else {
                                        $rr = mysql_fetch_array($tr);
                                        $tqty = $tqty +  $rr['qty'] - $uqty;
                                        $sql = "update tb_pctlist set qty='$tqty' where vn='$pvn' and hn='$hn' and tid='$tid'" . $where_branch . $where_company;
                                        mysql_query($sql);
                                    }
                                }
                            }
                        }
                    }
				}

				if($type=='C'){

                    $sqlc  = "select  tb_course_detail.*,tb_treatment.unit,tb_treatment.typ from tb_course_detail,tb_treatment  ";
                    $sqlc .= "where tb_course_detail.tid=tb_treatment.tid  and  tb_course_detail.cid='$pid'  ";
                    $strc = mysql_query($sqlc) or die ("Error Query [".$sqlc."]");
                    while($rc=mysql_fetch_array($strc)){

                        $cid = $rc['cid'];
                        $tid = $rc['tid'];
                        $tname = $rc['tname'];
                        $tqty = $qty * $rc['qty'];
                        $tunit = $rc['unit'];
                        $ttype = $rc['typ'];

                        $sql = "select sum(qty) as total from tb_pctuse where hn='$hn' and vn='$pvn' and pid='$cid' and tid='$tid' and ftyp='C' ";
                        $tr = mysql_query($sql);
                        $rr = mysql_fetch_array($tr);
                        $uqty = $rr['total'];
                        if( $tqty > $uqty){
                            $sql = "select * from tb_pctlist where vn='$pvn' and hn='$hn' and tid='$tid'";
                            $tr = mysql_query($sql);
                            $n = mysql_num_rows($tr);
                            if(empty($n)){
                                $tqty = $tqty  -  $uqty;
                                $sql = "insert into tb_pctlist  values('$pvn','$hn','$tid','$tname','$tqty','$tunit','$ttype','$branch_id','$company_code')";
                                mysql_query($sql);
                            } else {
                                $rr = mysql_fetch_array($tr);
                                $tqty = $tqty +  $rr['qty'] - $uqty;
                                $sql = "update tb_pctlist set qty='$tqty' where vn='$pvn' and hn='$hn' and tid='$tid'" . $where_branch . $where_company;
                                mysql_query($sql);
                            }
                        }
                    }
				}
		    }

			$sql = "select * from tb_pctlist where hn='$hn' ";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]");
			while($rs = mysql_fetch_array($result)){
			?>
                    <div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
                        <div style="width:75%;float:left; padding-left:20px; cursor:pointer;" onclick="pctuse('<?= $rs['vn'] ?>','<?= $rs['tid'] ?>','<?= $rs['qty'] ?>','<?= $rs['tname'] ?>')">
                            <?= $rs['tname'] ?>&nbsp;
                        </div>
                        <div style="width:20%;float:left;text-align:right; cursor:pointer;" onclick="pctuse('<?= $rs['vn'] ?>','<?= $rs['tid'] ?>','<?= $rs['qty'] ?>','<?= $rs['tname'] ?>')">
                            <?= $rs['qty'] ?>&nbsp;&nbsp;
                        </div>


                    </div>
                    <?
			}
			?>
                </div>
            </div>
        </div>
        <div style="width:100%; height:40px; text-align:right; background:#f5f5f5;">

            <div style="width:100%; float:left; text-align:right;">
                <input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:40px;" onclick="addvst('doctor/add_vst.php','FIN')" />
                <input type="button" value="  เพิ่มคอร์สเก่า  " style="font-size:14px; display:none; font-weight:bold; height:40px;" onclick="oldcourse('<?= $hn ?>','<?= $vn ?>')" />
                <input type="button" value="   ยกเลิก   " style="font-size:14px; font-weight:bold; height:40px;" onClick="swabtab(1,2,'doctor/doctor.php','home','')" />
            </div>
        </div>


    </div>

</div>