<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');
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


if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = '';
}
$as = "a";
// echo "x".$branchid."x";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];




$filName = "reexpiredrug.csv";
$objWrite = fopen("reexpiredrug.csv", "w");
$objDB = mysql_select_db("$db_clinic");
$datenow= date("Y-m-d");
$strSQL= " select a.*,branchname from tb_temp_drugeinstock a LEFT JOIN tb_branch b ON a.branchid = b.branchid  where bdate !='' and edate !='' and edate >= '$datenow'  $where_branch_id";
// echo $strSQL;
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");

if ($branchid == "") {
    fwrite($objWrite, "\"Lot\",\"name drug\",\"qty\",\"expire date\",\"day to expire\" \n");
}else {
	fwrite($objWrite, "\"Lot\",\"name drug\",\"qty\",\"expire date\",\"day to expire\",\"branch name\" \n");
}
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
		$branchname = $objResult['branchname'];
		if($date_current<=150){
            if ($branchid == "") {
				fwrite($objWrite, "\"$objResult[lno]\",\"$objResult[dname]\",\"$objResult[qty]\",\"$objResult[edate]\",\"$date_current\" \n");
            }else {
				fwrite($objWrite, "\"$objResult[lno]\",\"$objResult[dname]\",\"$objResult[qty]\",\"$objResult[edate]\",\"$date_current\",\"$branchname\" \n");
			}
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
