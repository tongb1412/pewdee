<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ"  value="">
<input type="hidden" id="id"  value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานรายได้ตามแพทย์</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; overflow:auto; border:<?=$tabcolor?> 1px solid;">
    <div class="line" style="margin-top:5px">
      <div style="width:20%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่  : </div>
      <div style="width:30%; float:left; margin-top:10px; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <?= date('d/m/Y',time());?>
      </div>
      <div style="width:30%; float:left;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value="  พิมพ์รายงาน  " />
      </div>
    </div>
  </div>
  
 
 	<div id="staffedit" style="width:58%; height:395px; margin-top:5px; margin-left:10px; float:left;  border:<?=$tabcolor?> 1px solid;">
    
	  <?  require("resumdr_paylist.php");	 ?>
	  
	</div> 
	
	
	<div id="staffedit" style="width:38%; height:395px; margin-top:5px;  margin-right:10px; float:right;  border:<?=$tabcolor?> 1px solid;">
		<?  require("resumdr_costlist.php");	 ?>
	
	</div>
	




</div>
