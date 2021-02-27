<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

if(empty($_POST['cid'])){

$sql = "select * from tb_autonumber where typ='CT'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = substr($rs['number'],0,2);

$cid = $x ; 
$txt = substr($rs['last'],2,3);
$n = strlen($txt);
$num = intval($txt) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$cid .= $t; 
$cname = ''; 
$price = '';

} else {

$cid = $_POST['cid'];
$sql = "select * from tb_staff  ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row = mysql_fetch_array($result);


}
?>
<div class="littleDD" style="font-size:14px; font-weight:bold;" >ตั้งค่าผู้ใช้โปรแกรม</div>

<div style="width:100%; height:auto; margin:auto; text-align:center; margin-top:10px;">
<div  style="width:30%; height:450px; float:left; text-align:center; ">

	<div style="width:98%; height:auto; margin:auto; ">
		<div class="txt_serch" style="width:206px">
		<input class="input_serch" type="text" id="txts" size="28" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('setting/treatment_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','setting/treatment_list.php','txt=','p_list')" />
		</div>
	</div>
	<div style="width:98%; height:20px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; padding:opx; border:<?=$tabcolor?> 1px solid;">    
		<div style="width:100%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ทรีทเม้นท์</div>
	</div>	
	
    <div id="p_list" style="width:98%; height:400px; margin:auto;  border:<?=$tabcolor?> 1px solid;">
	<?  require("treatment_list.php");	 ?>

    </div>

</div>
<div  style="width:68%; height:auto; float:left; text-align:center; margin-left:10px; ">

        <input type="hidden" id="typ" value="new" />  
		<input type="hidden" id="uprice"  />	
		<div class="line">
    	<div style="width:17%; float:left; text-align:right;">รหัสคอร์ท :&nbsp;</div>
		<div style="width:15%; float:left;"><input type="text" id="cid" size="10"  value="<?=$cid?>" /></div> 
		<div style="width:20%; float:left; text-align:right;">ชื่อคอร์ท :&nbsp;</div>
		<div style="width:48%; float:left; "><input type="text" id="cname" size="34" value="<?=$cname?>"  /></div>   
		</div>	
		<div class="line">
    	<div style="width:17%; float:left; text-align:right;">รหัสทรีทเม้นท์:&nbsp;</div>
		<div style="width:15%; float:left;"><input type="text" id="tid" size="10"  /></div> 
		<div style="width:20%; float:left; text-align:right;">ชื่อทรีทเม้นท์ :&nbsp;</div>
		<div style="width:48%; float:left; "><input type="text" id="tname" size="34"  /></div>   
		</div>	
		<div class="line">
    	<div style="width:17%; float:left; text-align:right;">จำนวน:&nbsp;</div>
		<div style="width:15%; float:left;"><input type="text" id="qty" size="10" onBlur="xprice(this)"  /></div> 
		<div style="width:20%; float:left; text-align:right;">ราคา :&nbsp;</div>
		<div style="width:20%; float:left; "><input type="text" id="price" size="10"  /></div>   
		<div style="width:28%; float:left; text-align:right">
	    <input type="button" value=" เพิ่ม " onclick="addcourselist('setting/add_course_detail.php','cdlist')">
		</div> 
		</div>	
		
		<div class="line" style="border:<?=$tabcolor?> 1px solid; padding:0px; height:20px;">
		<div style="width:100%;  float:left; color:#000000; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; "> 
	
		<div style="width:15%;text-align:left; float:left; line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
		<div style="width:45%;text-align:left; float:left;  line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ทรีทเม้นท์</div>
		<div style="width:15%;text-align:left; float:left; line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
		<div style="width:15%;text-align:left; float:left; line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา</div>
	
		</div>		
		</div>
		<div id="cdlist" class="line" style="padding:0px; height:auto;">     
<div class="line" style="border:<?=$tabcolor?> 1px solid; padding:0px; height:300px;">
<?
include('../class/config.php');
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
				<input type="text" id="qty" size="10"  readonly="true" style="border:1px solid #CCCCCC; background:#CCCCCC;" value="<?=number_format($total,'2','.',',')?>"/>
				</div> 
				<div style="width:20%; float:left; text-align:right;">ราคาขาย :&nbsp;</div>
				<div style="width:20%; float:left; line-height:50px;"><input type="text" id="sprice" size="10" value="<?=$price?>"  /></div>   
				<div style="width:28%; float:left; text-align:right; line-height:50px;">
	    		<input type="button" value=" บันทึก "  style="font-size:14px; font-weight:bold; height:35px;" onclick="addcourse('setting/course_add.php','clist')">
				</div>   
  
</div>	
		
		</div>	
		
</div>  
  
</div>

