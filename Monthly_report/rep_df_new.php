<?
include('../class/config.php');
//ออออ
?>
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
<form action="Monthly_report/report1_new.php" enctype="multipart/form-data" method="post" target="_blank">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >บัญชีแพทย์</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:15%;  border:<?=$tabcolor?> 1px solid; background-color: #FFD1A4;">

	<div class="line" style="margin-top:5px; width:60%;">

	  <div style="width:30%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">ระหว่างวันที่ : </div>
	  <div style="width:25%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" name="sdate" size="13" maxlength="10"  value="<?=$dat?>"   /></div>
	  <div style="width:3%; float:left; margin-top:10px;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;"  />
        	<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>

	  <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; font-weight:bold;">ถึง : </div>
	  <div style="width:25%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" name="edate" size="13" maxlength="10"  value="<?=$dat?>"   /></div>
	  <div style="width:3%; float:left; margin-top:10px;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;"  />
      		 <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
       </div>

      </div>
      <div style="width:15%; float:left;margin-top:10px; line-height:15px; color:#FF0000;">
       ตัวอย่าง<br />
       01-02-2012
       </div>
      <div style="width:25%; float:left;margin-top:10px;">
      	<input type="submit" value="แสดงบัญชีแพทย์" />        
      </div>
    </div>

    <div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">






     </div>
</form>

</div>
