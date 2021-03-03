<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$dd = $_POST['dd'];

if(empty($dd)){
   $dat = date('d-m-Y');
} else {
   $dat = $dd;
}




$dat1 = substr($dat,6,4).'-'.substr($dat,3,2).'-'.substr($dat,0,2);
	$cash = 0;
	$kasikorn = 0;
    $scb=0;
	$krungsri= 0;
	$Amax= 0;
	$UOB= 0;
	$ktc=0;
	$tana= 0;
	$totalcash = 0;



$sql = "select * from tb_totalprice where date = '$dat1'";
$price_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$num = mysql_num_rows($price_result);
if(!empty($num)){
	$row=mysql_fetch_array($price_result);
	$cash = $row['cash'];
	$kasikorn = $row['k_kasikorn'];
    $scb= $row['k_thai'];
	$krungsri= $row['k_krungsri'];
	$Amax= $row['k_amax'];
	$UOB= $row['k_uob'];
	$ktc= $row['k_ktc'];
	$tana= $row['k_tana'];
	$totalcash = $row['total'];
	$empname = $row['empname'];
	$cashier = $row['cashier'];
	$cashier_check = $row['cashier_check'];
	
	
} else {
   

	$sql1 = "select sum(a.cash) as  cash from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') ";
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
	$num=mysql_num_rows($str1);
	if(!empty($num)){
     	$row=mysql_fetch_array($str1);
     	$cash = $row['cash'];
	} else {
	    $cash =0;
	}
	
	
	$sqlx = "select sum(cash) as  cash from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') ";
	$strx = mysql_query($sqlx) or die ("Error Query [".$sqlx."]"); 
	$num=mysql_num_rows($strx);
	if(!empty($num)){
     	$row=mysql_fetch_array($strx);
     	$cash = $cash + $row['cash'];
	}  else {
     	$cash =$cash + 0;
	}
	
	
	
	$sql2 = "select sum(a.credit)  credit from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') and a.creditname like'ธนาคารไทยพาณิชย์%' group by a.creditname ";
	$str2 = mysql_query($sql2) or die ("Error Query [".$sql2."]"); 
	$num=mysql_num_rows($str2);
	if(!empty($num)){
     	$row=mysql_fetch_array($str2);
     	$scb = $row['credit'];
	} else {
	    $scb =0;
	}
	
	$sql2x = "select sum(credit) as  credit from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') and creditname like'ธนาคารไทยพาณิชย์%' group by creditname  ";
	$str2x = mysql_query($sql2x) or die ("Error Query [".$sql2x."]"); 
	$num=mysql_num_rows($str2x);
	if(!empty($num)){
     	$row=mysql_fetch_array($str2x);
     	$scb = $scb + $row['credit'];
	}  else {
     	$scb =$scb + 0;
	}
	


 	$sql3 = "select sum(a.credit)  credit from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') and a.creditname like'ธนาคารกสิกรไทย%' group by a.creditname ";
	$str3 = mysql_query($sql3) or die ("Error Query [".$sql3."]"); 
	$num=mysql_num_rows($str3);
	if(!empty($num)){
     	$row=mysql_fetch_array($str3);
     	$kasikorn = $row['credit'];
	} else {
	    $kasikorn =0;
	}
		
	$sql3x = "select sum(credit) as  credit from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') and creditname like'ธนาคารกสิกรไทย%' group by creditname  ";
	$str3x = mysql_query($sql3x) or die ("Error Query [".$sql3x."]"); 
	$num=mysql_num_rows($str3x);
	if(!empty($num)){
     	$row=mysql_fetch_array($str3x);
     	$kasikorn = $kasikorn + $row['credit'];
	}  else {
     	$kasikorn =$kasikorn + 0;
	}
	

 	$sql4 = "select sum(a.credit)  credit from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') and a.creditname like'ธนาคารกรุงศรีอยุธยา%' group by a.creditname ";
	$str4 = mysql_query($sql4) or die ("Error Query [".$sql4."]"); 
	$num=mysql_num_rows($str4);
	if(!empty($num)){
     	$row=mysql_fetch_array($str4);
     	$krungsri = $row['credit'];
	} else {
	    $krungsri =0;
	}

	$sql4x = "select sum(credit) as  credit from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') and creditname like'ธนาคารกรุงศรีอยุธยา%' group by creditname  ";
	$str4x = mysql_query($sql4x) or die ("Error Query [".$sql4x."]"); 
	$num=mysql_num_rows($str4x);
	if(!empty($num)){
     	$row=mysql_fetch_array($str4x);
     	$krungsri = $krungsri + $row['credit'];
	}  else {
     	$krungsri =$krungsri + 0;
	}


 	$sql5 = "select sum(a.credit)  credit from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') and a.creditname like 'ธนาคาร Amax%' group by a.creditname ";
	$str5 = mysql_query($sql5) or die ("Error Query [".$sql5."]"); 
	$num=mysql_num_rows($str5);
	if(!empty($num)){
     	$row=mysql_fetch_array($str5);
     	$Amax  = $row['credit'];
	} else {
	    $Amax  =0;
	}
	
		$sql5x = "select sum(credit) as  credit from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') and creditname like'ธนาคาร Amax%' group by creditname  ";
	$str5x = mysql_query($sql5x) or die ("Error Query [".$sql5x."]"); 
	$num=mysql_num_rows($str5x);
	if(!empty($num)){
     	$row=mysql_fetch_array($str5x);
     	$Amax = $Amax + $row['credit'];
	}  else {
     	$Amax =$Amax + 0;
	}



 	$sql6 = "select sum(a.credit)  credit from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') and a.creditname like'ธนาคาร UOB%' group by a.creditname ";
	$str6 = mysql_query($sql6) or die ("Error Query [".$sql6."]"); 
	$num=mysql_num_rows($str6);
	if(!empty($num)){
     	$row=mysql_fetch_array($str6);
     	$UOB = $row['credit'];
	} else {
	    $UOB =0;
	}
	
	
	$sql6x = "select sum(credit) as  credit from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') and creditname like'ธนาคาร UOB%' group by creditname  ";
	$str6x = mysql_query($sql6x) or die ("Error Query [".$sql6x."]"); 
	$num=mysql_num_rows($str6x);
	if(!empty($num)){
     	$row=mysql_fetch_array($str6x);
     	$UOB = $UOB + $row['credit'];
	}  else {
     	$UOB =$UOB + 0;
	}

	

 	$sql7 = "select sum(a.credit)  credit from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') and a.creditname like'ธนาคารกรุงไทย%' group by a.creditname ";
	$str7 = mysql_query($sql7) or die ("Error Query [".$sql7."]"); 
	$num=mysql_num_rows($str7);
	if(!empty($num)){
     	$row=mysql_fetch_array($str7);
     	$ktc = $row['credit'];
	} else {
	    $ktc =0;
	}
	
	
		$sql7x = "select sum(credit) as  credit from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') and creditname like'ธนาคารกรุงไทย%' group by creditname  ";
	$str7x = mysql_query($sql7x) or die ("Error Query [".$sql7x."]"); 
	$num=mysql_num_rows($str7x);
	if(!empty($num)){
     	$row=mysql_fetch_array($str7x);
     	$ktc = $ktc + $row['credit'];
	}  else {
     	$ktc =$ktc + 0;
	}
	
	
	
	 	$sql8 = "select sum(a.credit)  credit from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') and a.creditname like'ธนาคารธนชาติ%' group by a.creditname ";
	$str8 = mysql_query($sql8) or die ("Error Query [".$sql8."]"); 
	$num=mysql_num_rows($str8);
	if(!empty($num)){
     	$row=mysql_fetch_array($str8);
     	$tana = $row['credit'];
	} else {
	    $tana =0;
	}


		$sql8x = "select sum(credit) as  credit from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') and creditname like'ธนาคารธนชาติ%' group by creditname  ";
	$str8x = mysql_query($sql8x) or die ("Error Query [".$sql8x."]"); 
	$num=mysql_num_rows($str8x);
	if(!empty($num)){
     	$row=mysql_fetch_array($str8x);
     	$tana = $tana + $row['credit'];
	}  else {
     	$tana =$tana + 0;
	}


}





?>

<div id="main" class="main" style="width:99%; margin:auto; height:500px; overflow:hidden;">
	<div class="littleDD" style="font-size:18px; font-weight:bold; height:50px; " align="center" ;>
		<div style="width:30%; height:50px; line-height:50px; text-align:right; float:left;">รายการสรุปยอดเงินประจำวัน

		</div>
		<div style="width:50%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;">


		</div>

	</div>


	<div style="width:40%; height:auto;  float:left; margin-left:10px;">
		<div class="line" style="height:30px; line-height:30px; font-size:16px; font-weight:bold; border-bottom:#CCCCCC 1px dotted;">

			<div style="width:30%; float:left; margin-top:7px; text-align:right; line-height:20px; font-size:14px;">วันที่ : </div>
			<div style="width:40%; float:left; margin-top:5px;">
				<input type="text" id="dat" size="10" readonly="readonly" value="<?= $dat ?>" />
			</div>
			<div style="width:7%; float:left; margin-top:3px;">
				<img src="calendar/calendar.jpg" width="16" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','dat','cl1')" style="margin-top:5px; cursor:pointer;" />
				<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
				<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
			</div>



		</div>
		<div style="width:100%; height:400px; float:left; font-size:14px; background:#fffaf0   ; border-bottom:#CCCCCC 1px dotted  ">
			<div class="line" style="height:30px; line-height:30px; margin-top:5px;  ">
				<div style="width:30%; float:left; text-align:right; line-height:30px; ">เงินสด :&nbsp;</div>
				<div style="width:70%; float:left; text-align:left; line-height:30px;">
					<input name="text2" type="text" id="cash" value="<?= $cash ?>" style="text-align:right; font-size:18px;" onkeyup="changemoney(1)" size="10" />
					&nbsp;&nbsp;บาท
				</div>
			</div>
			<div class="line" style="height:30px; line-height:30px; margin-top:20px; ">
				<div style="width:30%; float:left; text-align:right; line-height:30px; ">บัตรเครดิต &nbsp;</div>

			</div>
			<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
				<div style="width:50%; float:left; text-align:right; line-height:30px; ">ธนาคารกรุงศรีฯ :&nbsp;</div>
				<div style="width:50%; float:left; text-align:left; line-height:30px;">
					<input name="text2" type="text" id="credit" style="text-align:right; font-size:18px;" value="<?= $krungsri ?>" onkeyup="changemoney(2)" size="7.5" />
					&nbsp;&nbsp;บาท
				</div>
			</div>

			<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
				<div style="width:50%; float:left; text-align:right; line-height:30px; ">ธนาคารกสิกร :&nbsp;</div>
				<div style="width:50%; float:left; text-align:left; line-height:30px;">
					<input name="text2" type="text" id="credit1" style="text-align:right; font-size:18px;" value="<?= $kasikorn ?>" onkeyup="changemoney(2)" size="7.5" />
					&nbsp;&nbsp;บาท
				</div>
			</div>

			<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
				<div style="width:50%; float:left; text-align:right; line-height:30px; ">ธนาคารไทยพาณิชย์ :&nbsp;</div>
				<div style="width:50%; float:left; text-align:left; line-height:30px;">
					<input name="text2" type="text" id="credit2" style="text-align:right;  font-size:18px;" value="<?= $scb ?>" onkeyup="changemoney(2)" size="7.5" />
					&nbsp;&nbsp;บาท
				</div>
			</div>

			<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
				<div style="width:50%; float:left; text-align:right; line-height:30px; ">ธนาคาร Amax :&nbsp;</div>
				<div style="width:50%; float:left; text-align:left; line-height:30px;">
					<input name="text2" type="text" id="credit3" style="text-align:right; font-size:18px;" value="<?= $Amax ?>" onkeyup="changemoney(2)" size="7.5" />
					&nbsp;&nbsp;บาท
				</div>
			</div>

			<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
				<div style="width:50%; float:left; text-align:right; line-height:30px; ">ธนาคาร OUB :&nbsp;</div>
				<div style="width:50%; float:left; text-align:left; line-height:30px;">
					<input name="text2" type="text" id="credit4" style="text-align:right; font-size:18px;" value="<?= $UOB ?>" onkeyup="changemoney(2)" size="7.5" />
					&nbsp;&nbsp;บาท
				</div>
			</div>

			<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
				<div style="width:50%; float:left; text-align:right; line-height:30px; ">ธนาคาร กรุงไทย:&nbsp;</div>
				<div style="width:50%; float:left; text-align:left; line-height:30px;">
					<input name="text2" type="text" id="credit5" style="text-align:right; font-size:18px;" value="<?= $ktc ?>" onkeyup="changemoney(2)" size="7.5" />
					&nbsp;&nbsp;บาท
				</div>
			</div>


			<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
				<div style="width:50%; float:left; text-align:right; line-height:30px; ">ธนาคาร ธนชาติ :&nbsp;</div>
				<div style="width:50%; float:left; text-align:left; line-height:30px;">
					<input name="text2" type="text" id="credit6" style="text-align:right; font-size:18px;" value="<?= $tana ?>" onkeyup="changemoney(2)" size="7.5" />
					&nbsp;&nbsp;บาท
				</div>
			</div>

		</div>



	</div>

	<div style="width:50%; height:100px;  float:left; margin-left:10px;  ">
		<div class="line" style="height:30px; line-height:30px; font-size:16px; font-weight:bold; border-bottom:#CCCCCC 1px dotted; background-color:#FFFFFF">
			<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="loadmodule('reportpage','daily_report/totalprice.php','dd='+document.getElementById('dat').value)" value=" แสดงรายงาน " />
		</div>

		<div style="width:100%; height:80px; float:left; font-size:14px; background:#fffaf0   ;   ">

			<div class="line" style="height:30px; line-height:30px; margin-top:5px;  ">
				<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
					<div style="width:60%; float:left; text-align:right; line-height:30px; "> ยอดเงินคงเหลือในเครื่อง : &nbsp;</div>
				</div>
				<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
					<div style="width:50%; float:left; text-align:right; line-height:30px; ">&nbsp;</div>
					<div style="width:50%; float:left; text-align:left; line-height:30px;">
						<input name="text2" type="text" id="check" value="<?= $totalcash ?>" style="text-align:right; font-size:18px;" onkeyup="changemoney(2)" size="10" />
						&nbsp;&nbsp;บาท
					</div>
				</div>
			</div>

		</div>
		<div class="line" style="height:30px; line-height:30px; font-size:16px; font-weight:bold; border-bottom:#CCCCCC 1px dotted;"> &nbsp;</div>






		<div style="width:100%; height:70px; background-color:#33FF33">
			<div class="line" style="margin-top:5px; height:30px; font-size:16px;">
				<div style="width:40%; float:left; text-align:right; line-height:50px; height:30px;">พนักงานผู้บันทึก :&nbsp;</div>

			</div>
			<div class="line" style=" height:30px; font-size:16px;">
				<div style="width:25%; float:left; text-align:right; line-height:50px; height:30px;">&nbsp;</div>

				<div style="width:75%; float:left; line-height:50px; height:30px; padding-top:15px;">
					<select id="asempid" style="width:300px; font-size:16px;">

						<?
			$sql = "select * from tb_staff where  eshow='Y' and typ='E' and eshow='Y' order by fname  ";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
			while($rs=mysql_fetch_array($result)){
			?>
						<option value="<?= $rs['staffid'] ?>" <? if($empname==$rs['staffid']){ ?> selected="selected"
							<? }?> ><?= $rs['fname'] . '    ' . $rs['lname']; ?>
						</option>
						<? } ?>
					</select>
				</div>
			</div>



			<div class="line" style="margin-top:5px; height:30px; font-size:16px;">
				<div style="width:40%; float:left; text-align:right; line-height:50px; height:30px;">แคชเขียร์ประจำวัน :&nbsp;</div>

			</div>
			<div class="line" style=" height:30px; font-size:16px;">
				<div style="width:25%; float:left; text-align:right; line-height:50px; height:30px;">&nbsp;</div>

				<div style="width:75%; float:left; line-height:50px; height:30px; padding-top:15px;">
					<select id="cempid" style="width:300px; font-size:16px;">

						<?
			$sql = "select * from tb_staff where  eshow='Y' and typ='E'   and eshow='Y' order by fname  ";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
			while($rs=mysql_fetch_array($result)){
			?>
						<option value="<?= $rs['staffid'] ?>" <? if($cashier==$rs['staffid']){ ?> selected="selected"
							<? }?> ><?= $rs['fname'] . '    ' . $rs['lname']  ?>
						</option>
						<? } ?>
					</select>
				</div>
			</div>


			<div class="line" style="margin-top:10px; height:30px; font-size:16px;">
				<div style="width:46%; float:left; text-align:right; line-height:50px; height:40px;">พนักงานตรวจสอบยอด :&nbsp;</div>

			</div>
			<div class="line" style=" height:30px; font-size:16px;">
				<div style="width:25%; float:left; text-align:right; line-height:50px; height:30px;">&nbsp;</div>

				<div style="width:75%; float:left; line-height:50px; height:30px; padding-top:15px;">
					<select id="empid" style="width:300px; font-size:16px;">

						<?
			$sql = "select * from tb_staff where  eshow='Y' and typ='E'  and eshow='Y' order by fname  ";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
			while($rs=mysql_fetch_array($result)){
			?>
						<option value="<?= $rs['staffid'] ?>" <? if($cashier_check==$rs['staffid']){ ?> selected="selected"
							<? }?> ><?= $rs['fname'] . '    ' . $rs['lname']  ?>
						</option>
						<? } ?>
					</select>
				</div>
			</div>



		</div>


		<div class="line" style="height:30px; line-height:30px; margin-top:50px;  ">
			<div class="line" style="margin-top:10px; text-align:right; width:90%;">
				<input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:30px;" onclick="addtotalprice('daily_report/add_totalprice.php','content')" />
				<? if($mod!='NEW'){ ?>
				<input type="button" value="  ลบข้อมูล  " style="font-size:14px; font-weight:bold; height:30px;" onclick="" />

				<? } ?>
			</div>



		</div>

	</div>
</div>