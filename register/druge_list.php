<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cl = $color1;
$txt = $_GET['txt'];
if(! empty($txt)){
$sql = "select did,tname,duse,sprice,unit from tb_druge where ( did like '%$txt%'  or tname like '%$txt%') and (status='IN')   order by tname asc   limit 15";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n = mysql_num_rows($result);
if(! empty($n)){
?>
<div style=" width:100%; height:auto;">

<div style="width:99%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
    <div style="width:35%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
	<div style="width:40%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการยา</div>

	<div style="width:15%;text-align:left; float:left;">&nbsp;</div>
</div>



<?

while($rs=mysql_fetch_array($result)){ 
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>
<div  style="width:99%; height:20px; line-height:20px; text-align:left; margin-left:1px; border-bottom:#CCCCCC 1px dotted;background:#CCCCCC; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" onclick="movedruge('<?=$rs['did']?>','<?=$rs['tname']?>','<?=$rs['sprice']?>','<?=$rs['unit']?>')"  > 
    <div style="width:25%; float:left; padding-left:20px; line-height:20px;"  >
	<?=$rs['did']?>&nbsp;
	</div>
    <div style="width:67%; float:left; line-height:20px;"  >
	<?=$rs['tname']?>&nbsp;
	</div>
   
</div>
<? 
} 
} 
?>
</div>
<? } ?>