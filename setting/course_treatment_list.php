<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cid = $_GET['mode'];
$cl = $color1;
?>


<div class="line" style="border:<?=$tabcolor?> 1px solid; padding:0px; height:300px;">
<?
$total = 0;

$sql = "select * from tb_course_detail where cid ='$cid' ";

$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);
if($result){
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}
$total = $total + $rs['price']; 
?>  
  <div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:95%;background:<?=$cl?>; height:20px; "  >
	<div style="width:15%; float:left; font-size:12px;"><?=$rs['tid']?></div>
	<div style="width:50%; float:left; font-size:12px;"><?=$rs['tname']?></div>
	<div style="width:15%; float:left; font-size:12px;"><?=$rs['qty']?></div>
	<div style="width:20%; float:left; text-align:right"><?=number_format($rs['price'],'2','.',',')?>&nbsp;&nbsp;&nbsp;
  
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('setting/del_course_detail.php','cdlist','id=<?=$rs['tid']?>&cid=<?=$cid?>')" />
	</div>
</div>
  
  
  
  
<? } } ?>  
</div>
		
<div class="line" style="padding:0px; margin-top:10px;">
    			<div style="width:17%; float:left; text-align:right;">ราคารวม:&nbsp;</div>
				<div style="width:15%; float:left; line-height:50px;">
				<input type="text" id="qty" size="10"  readonly="true" style="border:1px solid #CCCCCC; background:#CCCCCC;" value="<? echo number_format($total,'2','.',',')?>"/>
				</div> 
				<div style="width:20%; float:left; text-align:right;">ราคาขาย :&nbsp;</div>
				<div style="width:20%; float:left; line-height:50px;"><input type="text" id="sprice" size="10"  /></div>   
				<div style="width:28%; float:left; text-align:right; line-height:50px;">
	    		<input type="button" value=" บันทึก "  style="font-size:14px; font-weight:bold; height:35px;"  onclick="addcourse('setting/course_add.php','clist')">
				</div>   
  
</div>	
