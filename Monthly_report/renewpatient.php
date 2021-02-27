
<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานคนไข้ใหม่ประจำเดือน</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; border:<?=$tabcolor?> 1px solid;">
    <div class="line" style="margin-top:5px; width:60%;">
 <!--     <div style="width:30%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">ระหว่างวันที่ : </div>
      <div style="width:30%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" size="10" maxlength="10" onkeyup="forDate(this)"   /></div>
	  <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; font-weight:bold;">ถึง : </div>
      <div style="width:30%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" size="10" maxlength="10" onkeyup="forDate(this)"   /></div> -->
	  
	  
	  <div style="width:30%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">ระหว่างวันที่ : </div>
	  <div style="width:25%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" size="13" maxlength="10" readonly="readonly" value="<?=$dat?>"   /></div>
	  <div style="width:3%; float:left; margin-top:10px;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;"  />        
        	<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>
	  
	  <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; font-weight:bold;">ถึง : </div>
	  <div style="width:25%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" size="13" maxlength="10" readonly="readonly" value="<?=$dat?>"   /></div>
	  <div style="width:3%; float:left; margin-top:10px;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;"  />        
      		 <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
       </div>
	  
	  
	  
	  
	  
     
      </div>
      <div style="width:40%; float:left;margin-top:10px;">
	  <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mpatient('Monthly_report/renewpatient_list.php','pa_list')" value=" แสดงรายงาน " />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonth('Monthly_report/re_newpatient.php?')" value=" พิมพ์รายงาน " />
		<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value=" Excel " />
      </div>
    </div>
 
  
 
 	<div id="pa_list" style="width:98%; height:395px; margin-top:5px; margin-left:10px; float:left;  border:<?=$tabcolor?> 1px solid;">
      <?  require("renewpatient_list.php");	 ?>
	
	  
	</div> 
 </div>  