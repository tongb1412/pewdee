<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$branch_id = "";
if($_SESSION['branch_id'] != ""){
	$branch_id = $_SESSION['branch_id'];
	$where_branch_id = "and a.branchid = '$branch_id'";
}


if(empty($_GET['dat'])){
	$dat = date('Y-m-d');
	$sdat = date('d-m-Y');
} else {
	$dat = substr($_GET['dat'],6,4).'-'.substr($_GET['dat'],3,2).'-'.substr($_GET['dat'],0,2)  ;
	$sdat = substr($_GET['dat'],0,2).'-'.substr($_GET['dat'],3,2).'-'.substr($_GET['dat'],6,4);
}

?>
<div style="width:100%; height:35px;">
	<div class="line" style="margin-top:10px;" >
		<div style="width:10%; float:left; text-align:right;">วันที่ :&nbsp;</div>
		<div style="width:14%; float:left;">
        <input type="text" id="dat" size="19" readonly="readonly" value="<?=$sdat?>" />
        </div>
		<div style="width:5%; float:left;">
        <img src="calendar/calendar.jpg" width="16" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl','dat','cl1')" style="margin-top:5px; cursor:pointer;"  />        
        <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
		<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>	
        <div style="width:14%; float:left;">
        <input type="button" value="  แสดงข้อมูล "  onclick="showapplist('appointment/list_2.php','content')" /> 
        </div>
     </div>
</div>
<div style=" width:98%; height:25px;; border:<?=$tabcolor?> 1px solid; background:<?=$tabcolor?>; margin-left:10px;">

    <div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; ">    
        <div style="width:6%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ
        </div>
        <div style="width:10%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Card No.
        </div>
        <div style="width:18%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ - สกุล
        </div>    
        <div style="width:15%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เบอร์โทร
        </div>    
        <div style="width:18%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้นัด
        </div>  
        <div style="width:10%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลา
        </div>    
        <div style="width:23%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายละเอียด
        </div>    
    </div>
</div>
<div id="applist" style=" width:98%; height:400px; border:<?=$tabcolor?> 1px solid;  margin-left:10px; overflow:auto">
<?
$sql  = "select a.*,concat(b.pname,b.fname,b.lname) as cname,c.selfphone from tb_appointment a,tb_staff b,tb_patient c  ";
$sql .= "where a.pid=b.staffid and a.hn=c.hn and a.dat like '%$dat%'  and atyp='S' " . $where_branch_id . " order by pid,cname   ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n = 1;
while($rs=mysql_fetch_array($str)){ 
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}
?>

<div  style="width:99%; height:25px; line-height:25px; text-align:left; margin-left:1px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>;  cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" onclick="cleartabreg(6,4,7,'appointment/new_form.php?an=<?=$rs['an']?>','content','')"  >

    <div style="width:6%; float:left; line-height:25px;text-align:center"  >
	<?=$n?>
	</div>
    <div style="width:10%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['cn']?>
	</div>
    <div style="width:18%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['pname']?>
	</div>   
    <div style="width:15%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['selfphone']?>
	</div>   
    <div style="width:18%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['cname']?>
	</div>  
    <div style="width:13%; float:left; line-height:25px; text-align:center"  >
	<?=$rs['stim'].'-'.$rs['etim']?>
	</div>  
    <div style="width:20%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['mem']?>
	</div> 
</div>
<? $n++; } ?>

<div style="width:100%; float:left; height:10px;">&nbsp;</div>
</div>