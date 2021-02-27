<?
include('class/config.php');
$hn = $_GET['hn'];
$sql  = "select img from tb_img where hn='$hn'  ";
$str  = mysql_query($sql);
$num = mysql_num_rows($str);

if(!empty($num)){
$rs = mysql_fetch_array($str);

$dir  = 'thump.php?size=100&file=ptImg/'.$rs['img']; 

?>
<div style="width:100%; height:100%;">
<img src="<?=$dir?>" align="absmiddle" />
</div>
<? } ?>