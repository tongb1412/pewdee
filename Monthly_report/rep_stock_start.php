<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<?
include('../class/config.php');
mysql_query("SET NAMES tis620");
$sqlC .="select clinicname from tb_clinicinformation ";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname']; 


$filName = "Rep_Stock.csv";
$objWrite = fopen("Rep_Stock.csv", "w");

fwrite($objWrite,"\"$cname\"");
fwrite($objWrite,"\n");

fwrite($objWrite,"\"code\",\"name\",\"unit\",\"price\",\"IN Com\",\"In Stock\",\" +-\"");
fwrite($objWrite,"\n");


$sql  = "select * from tb_druge where status = 'IN'  order by dgid,tname asc ";
$str  = mysql_query($sql);
$num = mysql_num_rows($str);
while($rs  = mysql_fetch_array($str)){
    $code = $rs['did'];
	$tname = $rs['tname'];
	$unit = $rs['unit'];
	$price = $rs['sprice'];
	$total = $rs['total'];

	fwrite($objWrite,"\"$code\""); 
	fwrite($objWrite,",\"$tname\"");			
	fwrite($objWrite,",\"$unit\"");
	fwrite($objWrite,",\"$price\"");
	fwrite($objWrite,",\"$total\"");
	fwrite($objWrite,",\" \"");
	fwrite($objWrite,",\" \"");
	fwrite($objWrite,"\n");

}

fclose($objWrite);
?>
<div style="width:300px; height:100px; margin:auto; text-align:center; font-size:20px; margin-top:100px;">
เตรียมข้อมูลเรียบร้อยแล้ว
<br />
<a href="Monthly_report/<?=$filName?>" target="_blank">Export File To Excel</a>

</div>

