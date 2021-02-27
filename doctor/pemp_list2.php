<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cl = $color1;
$txt = $_GET['txt']; 
if(! empty($txt)){
$sql = "select * from tb_staff where (staffid like '%$txt%' or fname like '%$txt%'  or nickname like '%$txt%') and (eshow='Y')   order by fname asc   limit 5";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n = mysql_num_rows($result);
if(! empty($n)){
?>
<div style=" width:100%; height:auto; border:<?=$tabcolor?> 1px solid; background:#FFFFFF">
<?

while($rs=mysql_fetch_array($result)){ 
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>
<div  style="width:99%; height:25px; line-height:25px; text-align:left; margin-left:1px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" onclick="moveempp2('<?=$rs['staffid']?>','<?=$rs['pname'].$rs['fname'].'   '.$rs['lname']?>')"  >
    <div style="width:97%; float:left; line-height:25px; padding-left:20px;"  >
	<?=$rs['pname'].$rs['fname'].'   '.$rs['lname'].'  ['.$rs['nickname'].']';?>&nbsp;
	</div>
   
</div>
<? 
} 
} 
?>
<br />
</div>
<? } ?>