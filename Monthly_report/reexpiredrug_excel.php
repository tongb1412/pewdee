<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
mysql_query('SET CHARACTER SET Tis620');
mysql_query("SET character_set_client = Tis620");
mysql_query("SET character_set_connection = Tis620");

date_default_timezone_set('Asia/Bangkok');
$tabcolor = '#EEF2F7';
$color1 = '#FFFFFF';
$color2 = '#FFFFFF';

?>
<html>
<head>
<title>ยาใกล้หมดอายุ excel</title>
</head>
<body>
<?
$filName = "reexpiredrug.csv";
$objWrite = fopen("reexpiredrug.csv", "w");
$objDB = mysql_select_db("$db_clinic");
$datenow= date("Y-m-d");
$strSQL= " select * from tb_temp_drugeinstock where bdate !='' and edate !='' and edate >= '$datenow'  ";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
fwrite($objWrite, "\"Lot\",\"name drug\",\"qty\",\"expire date\",\"day to expire\" \n");
while($objResult = mysql_fetch_array($objQuery))
{	
	$str_date = $objResult['edate'];
    $str_date = date("Y-m-d",strtotime(str_replace('/', '-',$str_date)));
	$expire_date = $str_date;
	$today_date = date("Y-m-d");
	if($today_date<=$expire_date){
			//echo $str_date."&nbsp;&nbsp;&nbsp;".$today_date;

		list($expire_year,$expire_month,$expire_day) = explode("-", $expire_date);
		list($today_year,$today_month,$today_day) = explode("-", $today_date);
		$expire = gregoriantojd($expire_month,$expire_day,$expire_year);
		$today = gregoriantojd($today_month,$today_day,$today_year);
		$date_current = $expire-$today; //หาวันที่ยังเหลืออยู่

		if($date_current<=150){
				fwrite($objWrite, "\"$objResult[lno]\",\"$objResult[dname]\",\"$objResult[qty]\",\"$objResult[edate]\",\"$date_current\" \n");
			}
	}
}
				fclose($objWrite);
				echo "<center><br>คลิ๊กเพื่อดาวน์โหลดเป็น Excel<br><a href=$filName>Download</a></center>"; 

//onclick='window.close();'
?>
</table>
</body>
</html>
