<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_POST['hn'];
$sql = "select * from tb_patient where hn='$hn'";
$str  = mysql_query($sql);
$rs=mysql_fetch_array($str);
?>
<div style="width:99%; margin:auto; height:25px;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left; line-height:20px;">
	<img src="images/icon/group.png" align="absmiddle" />&nbsp;ค้างชำระ
	</div>
	<div style="width:80%; text-align:right; float:left; line-height:20px;">
	<input type="button" value="  รายชื่อทั้งหมด  " onclick="loadmodule('home','register/register.php','')" style="height:25px; font-size:13px; line-height:25px;" />
	</div>
</div>
<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
<div class="littleDD" style="font-size:18px; font-weight:bold; height:50px;" >   
	<div style="width:20%; height:50px; line-height:50px; text-align:right; float:left;">Card No : <?=$rs['cradno']; ?></div> 
	<div style="width:25%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ : <?=$hn; ?></div>
	<div style="width:50%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']; ?></div>
</div>

<div style="width:100%; height:auto; margin-top:10px; text-align:left;">
	<div style="width:47%; margin-left:15px; margin-right:10px; float:left; height:auto;">
		<div class="line" style="font-size:14px; font-weight:bold; height:20px; line-height:20px;">
		รายการค้างชำระ
		</div>	
		<div style="width:99%; height:415px; float:left; border:#CCCCCC 1px solid;">	
			<div style="width:98%; height:20px;padding-top:5px;margin-left:5px; margin-top:5px; color:#000000; font-weight:bold; float:left; font-size:13px;background:<?=$tabcolor?>;">
				<div style="width:25%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่</div>
				<div style="width:45%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หมายเลขใบเสร็จ</div>
				<div style="width:30%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
				
			</div>			
		    <div style=" width:99%; margin-left:5px; float:left; height:355px; overflow:auto;">
			<?
			$sql = "select * from tb_apayment where hn='$hn'  ";
			$str = mysql_query($sql);
			$dat = ''; $total = 0; $n=1;
			while($rs=mysql_fetch_array($str)){
				if($dat!=$rs['pdate']){ $dat=$rs['pdate']; $dd= $rs['pdate']; } else { $dd='-';  }
				$total = $total + $rs['total'];
			?>
				<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="background:<?=$cl?>; width:94%; cursor:pointer;" onClick="movear(<?=$rs['total']?>,<?=$n?>)" >
					<div style="width:25%; float:left;"  ><?=substr($dd,0,10)?>&nbsp;</div>
					<div style="width:45%; float:left; "><?=$rs['billno']?>&nbsp;</div>					
					<div style="width:30%; float:left; text-align:right;" ><?=number_format($rs['total'],'2','.',',')?>&nbsp;</div>
				</div>			
		    <? $n++; } ?>
			</div>		
			<div style="width:98%; height:25px; float:left; margin-left:5px; font-size:15px; font-weight:bold; color:#FF0000;  border:#CCCCCC 1px dotted;">
				<div class="line"  >
					<div style="width:70%; float:left; text-align:right; background:#CCCCCC; line-height:25px;">ค้างชำระ :&nbsp;</div>
					<div style="width:30%; float:left; text-align:right; background:#CCCCCC; line-height:25px;">
					<?=number_format($total,'2','.',',')?>&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
				</div>
			</div>		
	
	
		</div>
	</div>
	<div style="width:48%; margin-left:10px; margin-right:10px; float:left; height:auto;">
	    <input name="hidden" type="hidden" id="hn" value="<?=$hn?>" />		
		<input name="hidden2" type="hidden" id="mode" value="P"  />
	
		<div class="line" style="font-size:14px; font-weight:bold; height:20px; line-height:20px;">
		ชำระเงิน
		</div>	
		<div style="width:99%; height:415px; float:left; border:#CCCCCC 1px solid;">	
			<div class="line"  style="height:30px; background:#CCCCCC" >
				<div style="width:30%; float:left; text-align:right; font-size:14px; font-weight:bold; line-height:30px;">รวมทั้งหมด :&nbsp;</div>
				<div style="width:70%; float:left; line-height:30px; margin-top:2px;">
				<input type="text" id="sum" size="10" value="" style="text-align:right; font-size:14px; color:#FF0000; font-weight:bold;" readonly="true">
				&nbsp;&nbsp;บาท 					
				</div>
			</div>		
		
			<div class="line"  style="margin-top:15px;" >
				<div style="width:30%; float:left; text-align:right; line-height:25px;">เงินสด :&nbsp;</div>
				<div style="width:70%; float:left; line-height:25px;">
					<input type="text" id="cash" size="10" value="" style="text-align:right;font-size:14px;font-weight:bold;" onKeyUp="changemoneyar(1)" >	&nbsp;&nbsp;บาท 			
				</div>
			</div>		
			<div class="line"  style="margin-top:15px;" >
				<div style="width:30%; float:left; text-align:right; line-height:25px;">บัตรเครดิต :&nbsp;</div>
				<div style="width:70%; float:left; line-height:25px;">
					<input type="text" id="credit" size="10" value="" style="text-align:right;font-size:14px;font-weight:bold;" onKeyUp="changemoneyar(2)">&nbsp;&nbsp;บาท 			
				</div>
			</div>	
			<?
			$sql = "select * from tb_gernaral where typ='BK'";
			$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
			
			?>
			<div class="line" style="height:30px; line-height:25px; margin-top:5px; ">
			  <div style="width:30%; float:left; text-align:right; line-height:25px; ">ธนาคาร :&nbsp;</div>
			  <div style="width:70%; float:left; text-align:left; line-height:25px;">
				<select name="select" id="bank" style="font-size:18px; width:200px;">
				  <option value=""></option>
				  <? while($rs=mysql_fetch_array($str)){ ?>
				  <option value="<?=$rs['name']?>">
					<?=$rs['name']?>
				  </option>
				  <? } ?>
				</select>
			  </div>
			</div>			

			<div class="line" style="height:30px; line-height:25px; margin-top:5px; ">
			  <div style="width:30%; float:left; text-align:right; line-height:25px; display:none ">เลขบัตร :&nbsp;</div>
			  <div style="width:70%; float:left; text-align:left; line-height:25px;">
				<input type="hidden" id="ctype" style="font-size:18px; width:200px;" value="-" />
			  </div>
			</div>			
			
			<div class="line" style="height:30px; line-height:30px; margin-top:10px; color:#FF0000 ;  font-weight:bold;  font-size:20px;">
			  <div style="width:30%; float:left; text-align:right; line-height:30px; "><span id="ptxt"></span>&nbsp;</div>
			  <div style="width:70%; float:left; text-align:left; line-height:30px;">
				<input name="hidden2" type="hidden" id="rmoney"  value="0" size="10" readonly="true" />
				<span id="rtxt"></span>&nbsp;</div>
			</div>
			<div class="line" style="height:30px; line-height:30px; margin-top:30px;  font-size:18px;">
			  <div style="width:70%; float:left; text-align:right; line-height:30px; ">&nbsp;</div>
			  <div style="width:30%; float:left; text-align:left; line-height:30px;">
				<input name="button" type="button" style="font-size:14px; font-weight:bold; height:35px; " onclick="addapayment('register/add_apayment.php','home')" value="  ชำระเงิน  " />
			  </div>
			</div>


			
	
		</div>	
	
	</div>
</div>