<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$dat = date('d-m-Y');
$dd =  strtotime($dat) - (1*24*3600); 
$edate = date("Y-m-d", $dd); 
$dat1 = substr($dat,6,4).'-'.substr($dat,3,2).'-'.substr($dat,0,2);


	$cash_yes = 0;
	$to_day = 0;
    $coste=0;
	$doctor= 0;
	$bank= 0;
	$mem= 0;
	$casc_total = 0 ;
	
$sql = "select * from tb_totalcash where date = '$dat1'";
$price_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$num = mysql_num_rows($price_result);
if(!empty($num)){
	$row=mysql_fetch_array($price_result);
	$cash_yes = $row['cash_yes'];
	$to_day = $row['today_total'];
    $coste= $row['coste'];
	$doctor= $row['doctor_cos'];
	$bank= $row['bank'];
	$mem= $row['mem'];
	$casc_total= $row['total'];
	$empname = $row['empname'];
	$cashier = $row['cashier'];
	$cashier_check = $row['cashier_check'];
	
	
} else {
   	
	
	
	
	
$sql = "select * from tb_totalcash where date = '$edate'";
$price_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$num = mysql_num_rows($price_result);
if(!empty($num)){
  $row=mysql_fetch_array($price_result);
  $cash_yes = $row['total'];
} else {
  $cash_yes =0;
}

	$sql1 = "select sum(a.cash) as  cash from tb_payment a,tb_vst b   where (a.vn=b.vn)  and (a.pdate like '%$dat1%') and  (b.status='COM') ";
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
	$num=mysql_num_rows($str1);
	if(!empty($num)){
     	$row=mysql_fetch_array($str1);
     	$to_day = $row['cash'];
	}  else {
     	$to_day =0;
	}
	
	
	$sql2 = "select sum(cash) as  cash from tb_payment  where  (vn like '%AR%')   and (pdate like '%$dat1%') ";
	$str2 = mysql_query($sql2) or die ("Error Query [".$sql2."]"); 
	$num=mysql_num_rows($str2);
	if(!empty($num)){
     	$row=mysql_fetch_array($str2);
     	$to_day = $to_day + $row['cash'];
	}  else {
     	$to_day =$to_day + 0;
	}
	
	
	

$casc_total =  $cash_yes +  $to_day;

}



?>

<div id="main" class="main" style="width:99%; margin:auto; height:500px; overflow:hidden;">
  <div class="littleDD" style="font-size:18px; font-weight:bold; height:50px; " align="center"; >
    <div style="width:40%; height:50px; line-height:50px; text-align:right; float:left;">รายการสรุปยอดเงินสดประจำวัน
      
    </div>
    <div style="width:50%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;">
      	  
	  
    </div>

  </div>
  
  
    <div style="width:40%; height:auto;  float:left; margin-left:10px;">
      <div class="line" style="height:30px; line-height:30px; font-size:16px; font-weight:bold; border-bottom:#CCCCCC 1px dotted;">
	  
	     <div style="width:30%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">วันที่ :  </div>
	  	 <div   style="width:40%; float:left;  ">&nbsp; <?=$dat?> </div>
       	 
             
        

	  
	  
	  
	   </div>
      <div style="width:100%; height:400px; float:left; font-size:14px; background:#fffaf0   ; border-bottom:#CCCCCC 1px dotted  ">
        <div class="line" style="height:30px; line-height:30px; margin-top:5px;  ">
          <div style="width:30%; float:left; text-align:right; line-height:30px; ">ยอดยกมา :&nbsp;</div>
          <div style="width:70%; float:left; text-align:left; line-height:30px;">
            <input name="text2" type="text" id="cash_yes" disabled="disabled" value="<?=$cash_yes?>" style="text-align:right;  font-size:18px;" onkeyup="totalcash()"  size="10"    />
            &nbsp;&nbsp;บาท </div>
        </div>
         <div class="line" style="height:30px; line-height:30px; margin-top:5px;  ">
          <div style="width:30%; float:left;  text-align:right; line-height:30px; ">ยอดขาย :&nbsp;</div>
          <div style="width:70%; float:left; text-align:left; line-height:30px;">
            <input name="text2" type="text" id="to_day" disabled="disabled" value="<?=$to_day?>" style="text-align:right; font-size:18px;" onkeyup="totalcash()"  size="10"    />
            &nbsp;&nbsp;บาท (เงินสด)</div>
        </div>
        
        <div class="line" style="height:30px; line-height:30px; margin-top:20px; ">
          <div style="width:50%; float:left; text-align:right; line-height:30px; ">รายละเอียดค่าใช้จ่าย &nbsp;</div>
          
        </div>
		  <div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
          <div style="width:50%; float:left; text-align:right; line-height:30px; ">ค่าใช้จ่าย :&nbsp;</div>
          <div style="width:50%; float:left; text-align:left; line-height:30px;">
            <input name="text2" type="text" id="coste" style="text-align:right; font-size:18px;" value="<?=$coste?>" onkeyup="totalcash()"  size="10" />
            &nbsp;&nbsp;บาท </div>
        </div>
		
		  <div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
          <div style="width:50%; float:left; text-align:right; line-height:30px; ">แพทย์เบิก :&nbsp;</div>
          <div style="width:50%; float:left; text-align:left; line-height:30px;">
            <input name="text2" type="text" id="doctor" style="text-align:right; font-size:18px;" value="<?=$doctor?>" onkeyup="totalcash()"  size="10" />
            &nbsp;&nbsp;บาท </div>
        </div>
		
		  <div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
          <div style="width:50%; float:left; text-align:right; line-height:30px; ">นำฝากธนาคาร :&nbsp;</div>
          <div style="width:50%; float:left; text-align:left; line-height:30px;">
            <input name="text2" type="text" id="bank" style="text-align:right;  font-size:18px;" value="<?=$bank?>" onkeyup="totalcash()"  size="10" />
            &nbsp;&nbsp;บาท </div>
        </div>
		
				  <div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
          <div style="width:50%; float:left; text-align:right; line-height:30px; ">หมายเหตุ :&nbsp;</div>
          <div style="width:50%; float:left; text-align:left; line-height:30px;"> </div>
        </div>
		
				  <div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
          <div style="width:100%; float:left; text-align:right; line-height:30px; ">
            <textarea name="textarea" cols="45" rows="3" id="mem"  ><?=$row['mem']?></textarea>
            &nbsp;</div>
          
            
        </div>
        
       
		
		</div>

       

</div>

<div style="width:50%; height:100px;  float:left; margin-left:10px;  ">
<div class="line" style="height:30px; line-height:30px; font-size:16px; font-weight:bold; border-bottom:#CCCCCC 1px dotted; background-color:#FFFFFF">
	&nbsp;
 </div>

	 <div style="width:100%; height:70px; float:left; font-size:14px; background:#fffaf0   ;   ">
        
	   	<div class="line" style="height:30px; line-height:30px; margin-top:5px;  ">  
	   		<div class="line" style="height:30px; line-height:30px; margin-top:5px; ">
          		<div style="width:60%; float:left; text-align:right; line-height:30px; "> ยอดเงินคงเหลือในเครื่อง : &nbsp;</div>
       		</div>
	   		<div class="line" style="height:30px; line-height:30px; margin-top:5px; "> 
		  		<div style="width:50%; float:left; text-align:right; line-height:30px; ">&nbsp;</div>
          			<div style="width:50%; float:left; text-align:left; line-height:30px;">
           					 <input name="text2" type="text" id="check"  style="text-align:right; font-size:18px;" disabled="disabled" value="<?=$casc_total?>"  size="10" />
            		&nbsp;&nbsp;บาท </div>
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
			<option value="<?=$rs['staffid']?>" <? if($empname==$rs['staffid']){ ?>  selected="selected" <? }?>><?=$rs['fname'].'    '.$rs['lname']  ?></option>
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
			<option value="<?=$rs['staffid']?>" <? if($cashier==$rs['staffid']){ ?>  selected="selected" <? }?>  ><?=$rs['fname'].'    '.$rs['lname']  ?></option>
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
			<option value="<?=$rs['staffid']?>" <? if($cashier_check==$rs['staffid']){ ?>  selected="selected" <? }?>  ><?=$rs['fname'].'    '.$rs['lname']  ?></option>
			<? } ?>		
			</select>
			</div>
		</div>
		
	
	
	</div>
	

	<div class="line" style="height:30px; line-height:30px; margin-top:50px;  ">
		<div class="line" style="margin-top:10px; text-align:right; width:90%;" > 
   			 <input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:30px;" onclick="addtotalcash('daily_report/add_totalcash.php','content')" />
    		<? if($mod!='NEW'){ ?>
   			 <input type="button" value="  ลบข้อมูล  " style="font-size:14px; font-weight:bold; height:30px;" onclick="" />
    
   			 <? } ?>
  		</div>
	
	
	
	</div>

</div>
</div>

