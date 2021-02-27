<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_GET['mode'];
$cl = $color1;
$sql = "select * from tb_dinoseanti where hn='$hn'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

$Per_Page = 15;   // Per Page

$Page = $_GET["Page"];
if(!$_GET["Page"])	{	$Page=1;	}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
		$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
		$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
}
$sql .=" order by dname asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
$Num = mysql_num_rows($result);

if($result){

$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}


?>


<div style="width:88%; height:20px; line-height:20px; text-align:left; padding-left:20px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" >
	
	<div style="width:92%; float:left; line-height:20px;"><?=$rs['dname']?></div>
	<div style="width:8%; float:left; text-align:right; line-height:20px;">
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('register/sql_dinoseanti_del.php','doz','id=<?=$rs['did']?>&hn=<?=$hn?>&url=register/druganti_list.php')" />
	</div>
</div>
<? 
$n++; 
} 
}
mysql_close($dblink);
?>