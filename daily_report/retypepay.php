<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ"  value="">
<input type="hidden" id="id"  value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานรายได้แยกตามการชำระ</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; overflow:auto; border:<?=$tabcolor?> 1px solid; background-color: #FFD1A4;">
    <div class="line" style="margin-top:5px">
      <div style="width:20%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่  : </div>
      <div style="width:30%; float:left; margin-top:10px; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <?= date('d/m/Y',time());?>
      </div>
      <div style="width:30%; float:left;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printtypepay()" value="  พิมพ์รายงาน  " />
      </div>
    </div>
  </div>
  <div   style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?=$tabcolor?> 1px solid;">


	
    <div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">
      <?  require("retypepay_list.php");	 ?>
	  
	  
	  
    </div>
	
  </div>
</div>
