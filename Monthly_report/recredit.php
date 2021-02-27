<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ"  value="">
<input type="hidden" id="id"  value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานรายได้แยกตามบัตรเครดิต</div>

  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99;  border:<?=$tabcolor?> 1px solid;">
    <div class="line" style="margin-top:5px; width:60%;">
      <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">วันที่ : </div>
      <div style="width:19%; float:left; margin-top:10px;">&nbsp;
          <input name="text" type="text" id="sdate" onkeyup="forDate(this)" size="8" maxlength="10" readonly="readonly" value="<?=$dat?>"  />
      </div>
	  <div style="width:3%; float:left; margin-top:10px;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;"  />        
        	<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>
	  
	  
      <div style="width:7%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">ถึง : </div>
      <div style="width:19%; float:left; margin-top:10px;">&nbsp;
          <input name="text" type="text" id="edate" onkeyup="forDate(this)" size="8" maxlength="10" readonly="readonly" value="<?=$dat?>"  />
      </div>
	  <div style="width:3%; float:left; margin-top:10px;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;"  />        
      		 <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
       </div>
	  
	  
      <div style="width:14%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">ธนาคาร : </div>
      <?
				$sql = "select * from tb_gernaral where typ='BK' ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
      <div style="width:25%; float:left; margin-top:10px; font-size:14px; ">&nbsp;&nbsp;
          <select name="select2" id="bk" style="width:80px; height:20px;">
            <option value="">ไม่ระบุ</option>
            <? while($rs=mysql_fetch_array($result)){  ?>
            <option value="<?=$rs['name']?>">
            <?=$rs['name']?>
            </option>
            <? } ?>
          </select>
      </div>
    </div>
    <div style="width:40%; float:left;margin-top:10px;">
      <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mcredit('Monthly_report/recredit_list.php','d_list')" value="แสดงรายงาน" />
      <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthcredit()" value="พิมพ์รายงาน" />
      <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value="Excel" />
    </div>
  </div>
  <div   style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?=$tabcolor?> 1px solid;">
  
    <div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">
      <?  require("recredit_list.php");	 ?>
    </div>
  </div>
</div>
