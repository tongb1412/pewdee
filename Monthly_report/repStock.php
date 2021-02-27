<?
include('../class/config.php');
//ออออ
?>
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานยาคงคลัง</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%;  border:<?=$tabcolor?> 1px solid; background-color: #FFD1A4;">
    
	<div class="line" style="margin-top:5px; width:60%;">

      <div style="width:100%; float:left;margin-top:10px; margin-left:20px;">
	  
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthD('Monthly_report/rep_stock.php?')" value=" พิมพ์รายงาน " />
        &nbsp;
        <!-- <input type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="repStock('Monthly_report/rep_stock_start.php','d_list')" value=" เตรียมข้อมูลของ Excel" /> -->
        <input type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="repstock1('Monthly_report/rep_stock1.php?')" value=" Excel" />
		
      </div>
    </div>
	

</div>    
<div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">
     
 
     
     
     
     
 </div>	
