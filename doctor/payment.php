<?php ?><?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];
$where_data = set_where_user_data('', $branch_id, $company_code, $company_data);

$vn = $_POST['vn'];

$sql = "select * from tb_patient,tb_vst where tb_patient.hn = tb_vst.hn and tb_vst.vn = '$vn'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row = mysql_fetch_array($patient_result);
$hn = $row['hn'];
$pt = $row['level'];

$dtotal = 0;
$sql5 = "select * from tb_level where velname like '%$pt%' ";
$str5 = mysql_query($sql5) or die ("Error Query [".$sql5."]"); 
$rs5 = mysql_fetch_array($str5);
if(empty($rs5['disdrug'])){ $d_dis=0; } else {$d_dis = $rs5['disdrug'];  }
if(empty($rs5['dislab'])){ $l_dis=0; } else {$l_dis = $rs5['dislab'];  }
if(empty($rs5['dislaser'])){ $t_dis=0; } else {$t_dis = $rs5['dislaser'];  }
if(empty($rs5['discourse'])){ $c_dis=0; } else {$c_dis = $rs5['discourse'];  }
if(empty($rs5['dispg'])){ $p_dis=0; } else {$p_dis = $rs5['dispg'];  }

$sql = "select qty,price from tb_drugerec where vn='$vn' and fis='Y'";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
while($rs=mysql_fetch_array($str)){
	$dtotal = $dtotal + ($rs['price'] * $rs['qty']);	 
}
$d_dp =  ($dtotal * $d_dis) / 100;
$dsum = $dtotal - $d_dp;

$ltotal = 0;
$sql = "select * from tb_labrec where vn='$vn' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
while($rs=mysql_fetch_array($str)){
	$ltotal = $ltotal + ($rs['price'] * $rs['qty']);	 
}

$l_dp =  ($ltotal * $l_dis) / 100;
$lsum = $ltotal - $l_dp;

$ttotal = 0;
$sql = "select * from tb_pctrec where vn='$vn' and typ IN ('T','L') ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
while($rs=mysql_fetch_array($str)){
	$ttotal = $ttotal + $rs['totalprice'];	 
}

$t_dp =  ($ttotal * $t_dis) / 100;
$tsum = $ttotal - $t_dp;


$ctotal = 0;
$sql = "select * from tb_pctrec where vn='$vn' and typ = 'C' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
while($rs=mysql_fetch_array($str)){
	$ctotal = $ctotal + $rs['totalprice'];	 
}

$c_dp =  ($ctotal * $c_dis) / 100;
$csum = $ctotal - $c_dp;

$ptotal = 0;
$sql = "select * from tb_pctrec where vn='$vn' and typ = 'P' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
while($rs=mysql_fetch_array($str)){
	$ptotal = $ptotal + $rs['totalprice'];	 
}

$p_dp =  ($ptotal * $p_dis) / 100;
$psum = $ptotal - $p_dp;

$discount = $d_dp + $l_dp + $t_dis + $c_dis + $p_dis;

$sum = $dsum + $lsum + $tsum + $csum + $psum;

$total = $sum - $discount;
$pctotal = $ttotal + $ctotal + $ptotal;
?>
<div style="width:99%; margin:auto; height:25px;">
    <div style="width:20%; font-size:16px; font-weight:bold; float:left;">
        <img src="images/icon/group.png" align="absmiddle" />&nbsp;ชำระเงิน
    </div>
    <div style="width:80%; text-align:right; float:left;">
        &nbsp;
    </div>
</div>
<div id="main" class="main" style="width:99%; margin:auto; height:500px; overflow:hidden;">
    <div class="littleDD" style="font-size:25px; font-weight:bold; height:50px;">
        <div style="width:30%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ :
            <?= $row['hn']; ?>
        </div>
        <div style="width:50%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;">
            <?= $row['pname'] . $row['fname'] . '    ' . $row['lname']; ?>
        </div>
        <div style="width:16%; height:50px; line-height:50px; text-align:right; float:left;">
            <?= $row['level'] ?>
        </div>
    </div>
    <div style="width:98%; height:40px; margin:auto; margin-top:10px; text-align:left; background:#f8f8ff; border-bottom:#CCCCCC 1px dotted;">
        <div class="line" style="height:30px; line-height:30px;  font-size:20px;">
            <div style="width:10%; float:left; text-align:right; line-height:30px; ">รวม :&nbsp;</div>
            <div style="width:20%; float:left; text-align:left; line-height:30px;">
                <input name="text" type="text" id="total" style="text-align:right; font-size:18px;" value="<?= number_format($sum, '2', '.', ',') ?>" size="10" readonly="true" />
                &nbsp;&nbsp;บาท
            </div>
            <div style="width:10%; float:left; text-align:right; line-height:30px; ">ส่วนลด :&nbsp;</div>
            <div style="width:20%; float:left; text-align:left; line-height:30px;">
                <input name="text2" type="text" id="discount" style="text-align:right; font-size:18px;" readonly="true" value="<?= number_format($discount, '2', '.', ',') ?>" size="10" />
                &nbsp;&nbsp;บาท
            </div>
            <div style="width:15%; float:left; text-align:right; line-height:30px; ">รวมทั้งหมด :&nbsp;</div>
            <div style="width:20%; float:left; text-align:left; line-height:30px;">
                <input name="text2" type="text" id="sum" style="text-align:right; font-size:18px; color:#FF0000;" value="<?= number_format($total, '2', '.', ',') ?>" size="10" readonly="true" />
                &nbsp;&nbsp;บาท
            </div>
        </div>
    </div>
    <div style="width:100%; height:auto; margin-top:10px; text-align:left;">
        <input name="hidden" type="hidden" id="hn" value="<?= $row['hn'] ?>" />
        <input name="hidden2" type="hidden" id="vn" value="<?= $vn ?>" />
        <input name="hidden2" type="hidden" id="mode" value="P" />
        <div style="width:60%; height:300px; margin-left:10px; margin-right:10px; float:left; font-size:16px; color:#FF0000; font-weight:bold; text-align:center; padding-top:50px;">
            ส่วนลดทุกรายการให้ใส่ในช่อง
            <span style="font-size:30px"> คูปอง</span>
            <br />
            พร้อมใส่หมายเหตุในช่อง
            <span style="font-size:30px">หมายเหตุ</span>
        </div>


        <div style="width:60%; height:380px;; margin-left:10px; margin-right:10px; float:left; font-size:16px; display:none;">

            <div class="line" style="height:30px; line-height:30px; font-weight:bold; border-bottom:#CCCCCC 1px dotted;"> </div>
            <div style="width:100%; height:auto;; float:left; font-size:15px; background:#fffaf0   ; border-bottom:#CCCCCC 1px dotted  ">
                <div class="line" style="height:30px; line-height:30px; margin-top:10px;">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">ค่ายา :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="ds" style="text-align:right;" value="<?= number_format($dtotal, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">ลด :&nbsp;</div>
                    <div style="width:25%; float:left; line-height:30px;  ">
                        <input name="text2" type="text" id="dsn" style="text-align:right; width:30px;" onkeyup="caldisperDC(this,<?= $d_dp ?>,<?= $dtotal ?>,1)" value="0" />
                        %&nbsp;
                        <input name="text2" type="text" id="dp" style=" width:50px; text-align:right;" onkeyup="sumdiscount()" value="<?= number_format($d_dp, '2', '.', ',') ?>" />
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">รวม :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="dsum" style="text-align:right;" value="<?= number_format($dsum, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:5px;">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">หัตถการ :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="ls" style="text-align:right;" value="<?= number_format($ltotal, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">ลด :&nbsp;</div>
                    <div style="width:25%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="lsn" style="text-align:right; width:30px;" onkeyup="caldisperDC(this,<?= $l_dp ?>,<?= $ltotal ?>,2)" value="0" />
                        %&nbsp;
                        <input name="text2" type="text" id="lp" style=" width:50px; text-align:right;" onkeyup="sumdiscount()" value="<?= number_format($l_dp, '2', '.', ',') ?>" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">รวม :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="lsum" style="text-align:right;" value="<?= number_format($lsum, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:5px;">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">ทรีทเม้นท์ :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="ts" style="text-align:right;" value="<?= number_format($ttotal, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">ลด :&nbsp;</div>
                    <div style="width:25%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="tsn" style="text-align:right; width:30px;" onkeyup="caldisperDC(this,<?= $t_dp ?>,<?= $ttotal ?>,3)" value="0" />
                        %&nbsp;
                        <input name="text2" type="text" id="tp" style=" width:50px; text-align:right;" onkeyup="sumdiscount()" value="<?= number_format($t_dp, '2', '.', ',') ?>" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">รวม :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="tsum" style="text-align:right;" value="<?= number_format($tsum, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:5px;">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">คอร์ส :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="cs" style="text-align:right;" value="<?= number_format($ctotal, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">ลด :&nbsp;</div>
                    <div style="width:25%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="csn" style="text-align:right; width:30px;" onkeyup="caldisperDC(this,<?= $c_dp ?>,<?= $ctotal ?>,4)" value="0" />
                        %&nbsp;
                        <input name="text2" type="text" id="cp" style=" width:50px; text-align:right;" onkeyup="sumdiscount()" value="<?= number_format($c_dp, '2', '.', ',') ?>" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">รวม :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="csum" style="text-align:right;" value="<?= number_format($csum, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:5px;">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">แพ็คเกจ :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="ps" style="text-align:right;" value="<?= number_format($ptotal, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">ลด :&nbsp;</div>
                    <div style="width:25%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="psn" style="text-align:right; width:30px;" onkeyup="caldisperDC(this,<?= $p_dp ?>,<?= $ptotal ?>,5)" value="0" />
                        %&nbsp;
                        <input name="text2" type="text" id="pp" style=" width:50px; text-align:right;" onkeyup="sumdiscount()" value="<?= number_format($p_dp, '2', '.', ',') ?>" />
                        &nbsp;
                    </div>
                    <div style="width:10%; float:left; text-align:right; line-height:30px; ">รวม :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="psum" style="text-align:right;" value="<?= number_format($psum, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                </div>


            </div>


            <div style="width:100%; height:auto;; float:left; font-size:15px; background:#f5f5f5  ; border-bottom:#CCCCCC 1px dotted  ">
                <div class="line" style="height:30px; line-height:30px; margin-top:5px; font-weight:bold;">
                    <div style="width:85%; float:left; text-align:right; line-height:30px; ">ส่วนลด :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="tdis" style="text-align:right; font-weight:bold;" value="<?= number_format($discount, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:5px; font-weight:bold;">
                    <div style="width:85%; float:left; text-align:right; line-height:30px; ">รวมทั้งหมด :&nbsp;</div>
                    <div style="width:15%; float:left; line-height:30px; ">
                        <input name="text2" type="text" id="ttotal" style="text-align:right; font-weight:bold;" value="<?= number_format($sum, '2', '.', ',') ?>" size="8" readonly="true" />
                        &nbsp;
                    </div>
                </div>
            </div>
            <? if($pctotal > 0){  ?>
            <div style="width:90%; height:90px; margin-top:10px;  float:left;">
                <?
		$sql = "select * from tb_pctrec where vn='$vn' and typ = 'C' ";
		$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		while($rs = mysql_fetch_array($str)){	
            $page =  'report/course_form.php?hn='.$hn.'&vn='.$vn.'&tid='.$rs['tid'].'&type=C';  
            ?>
                    <input name="button" type="button" style="font-size:14px;  height:25px; " value="  <?= 'พิมพ์ ' . $rs['tname']; ?>  " onclick="openpop('<?= $page ?>')" />
                    <? 
		} 
		
		$sql = "select * from tb_pctrec where vn='$vn' and typ = 'P' ";
		$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		while($rs = mysql_fetch_array($str)){	
			$tid = $rs['tid'];
		    
			$sql1 = "select * from tb_package_detail where pid='$tid' and typ='C' ";
			$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
			while($rs1=mysql_fetch_array($str1)){		
		
			$page =  'report/course_form.php?hn='.$hn.'&vn='.$vn.'&tid='.$tid.'&cid='.$rs1['id'].'&type=P';  
		 ?>
                <input name="button" type="button" style="font-size:14px;  height:25px; " value="  <?= 'พิมพ์ ' . $rs1['name']; ?>  " onclick="openpop('<?= $page ?>')" />
                <? } } ?>
            </div>
            <? } ?>
        </div>
        <div style="width:35%; height:auto;  float:left; margin-left:10px;">
            <div class="line" style="height:30px; line-height:30px; font-size:16px; font-weight:bold; border-bottom:#CCCCCC 1px dotted;"> รับเงิน </div>
            <div style="width:100%; height:250px; float:left; font-size:14px; background:#fffaf0   ; border-bottom:#CCCCCC 1px dotted  ">
                <div class="line" style="height:30px; line-height:30px; margin-top:5px;  ">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">เงินสด :&nbsp;</div>
                    <div style="width:75%; float:left; text-align:left; line-height:30px;">
                        <input name="text2" type="text" id="cash" style="text-align:right; font-size:18px;" onkeyup="changemoney(1)" value="<?= number_format($total, '2', '.', ',') ?>" size="10" />
                        &nbsp;&nbsp;บาท
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:20px; ">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">บัตรเครดิต :&nbsp;</div>
                    <div style="width:75%; float:left; text-align:left; line-height:30px;">
                        <input name="text2" type="text" id="credit" style="text-align:right; font-size:18px;" onkeyup="changemoney(2)" size="10" />
                        &nbsp;&nbsp;บาท
                    </div>
                </div>
                <?
			
			$sql = "select * from tb_gernaral where typ='BK'";
			$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
			
			?>
                <div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">ธนาคาร :&nbsp;</div>
                    <div style="width:75%; float:left; text-align:left; line-height:30px;">
                        <select name="select" id="bank" style="font-size:18px; width:200px;">
                            <option value=""></option>
                            <? while($rs=mysql_fetch_array($str)){ ?>
                            <option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:5px;">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; display:none ">เลขบัตร :&nbsp;</div>
                    <div style="width:75%; float:left; text-align:left; line-height:30px;">
                        <input name="text2" type="hidden" id="ctype" style="font-size:18px; width:200px;" />
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:20px; ">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">

                        <select name="select" id="ktype">
                            <option value="K">คูปอง</option>
                            <option value="B">โอนเงิน</option>
                            <option value="P">ไปรษณีย์</option>
                            <?php if ($_SESSION["mode"] == 'A') { ?>
                                <option value="A"></option>
                            <?php
                            } ?>
                        </select>
                        :&nbsp;
                    </div>
                    <div style="width:75%; float:left; text-align:left; line-height:30px;">
                        <input name="text2" type="text" id="kupong" style="text-align:right; font-size:18px;" onkeyup="changemoney(3)" size="10" />
                        &nbsp;&nbsp;บาท
                    </div>
                </div>
                <div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
                    <div style="width:25%; float:left; text-align:right; line-height:30px; ">หมายเหตุ :&nbsp;</div>
                    <div style="width:75%; float:left; text-align:left; line-height:30px;">
                        <input name="text2" type="text" id="kno" style="font-size:18px; width:200px;" />
                    </div>
                </div>
            </div>
            <div class="line" style="height:30px; line-height:30px; margin-top:30px; color:#FF0000 ; font-weight:bold;  font-size:20px;">
                <div style="width:30%; float:left; text-align:right; line-height:30px; "><span id="ptxt"></span>&nbsp;</div>
                <div style="width:40%; float:left; text-align:left; line-height:30px;">
                    <input name="hidden2" type="hidden" id="rmoney" value="0" size="10" readonly="true" />
                    <span id="rtxt"></span>&nbsp;บาท
                </div>
                <div style="width:30%; float:left; text-align:right; line-height:30px;">
                    <input id="paybtn" name="button" type="button" style="font-size:18px; font-weight:bold; height:40px; " value="  ชำระเงิน  " onclick="addsdpaymentDC('doctor/add_payment.php','home',<?= $pctotal ?>)" />
                                                                                                                                                                                                
                </div>
            </div>
        </div>
    </div>
</div>