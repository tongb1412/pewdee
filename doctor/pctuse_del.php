<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$svn = $_POST['svn'];
$tid = $_POST['tid'];
$pid = $_POST['pid'];
$eid = $_POST['eid'];
$type = $_POST['type'];
$qty = $_POST['qty'];
$con = 'ADD';
$txt = '';






//$sql = "delete from tb_pctrec  Where vn='$vn' and tid='$tid' and typ='$type' ";
//mysql_query($sql);

$sql = "select  total  from tb_pctrec  Where vn='$svn' and tid='$pid' and typ='$type' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
$rs=mysql_fetch_array($str);
$s1 = $sql.'-'.$rs['total'];
$sum = $rs['total'] + $qty;

$sql_in = "Update tb_pctrec Set total='$sum' Where vn='$svn' and tid='$pid'  and typ='$type' ";
mysql_query($sql_in);

			//$sqls = "select sum(qty) as total from tb_pctuse  where vn='$vn' and hn='$hn' and pid='$pid' and cid='$cid' and tid='$tid'  and ftyp='PC' ";
			//$strs = mysql_query($sqls) or die ("Error Query [".$sqls."]");
			//$rss=mysql_fetch_array($strs);
			//$sum = $rss['total'];




switch($type){
case "PT" :
			$sql = "delete from tb_pctuse  Where uvn='$vn' and pid='$pid' and vn='$svn'   ";
			mysql_query($sql);
			//$sql = "delete from tb_drugerec  Where vn='$vn' and tid='$tid' ";
			//mysql_query($sql) or die ("Error Query [".$sql."]");
			break;
case "C" :
			$sql = "delete from tb_pctuse  Where uvn='$vn'  and vn='$svn' and tid='$tid' and ftyp='C' and empid='$eid' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");
			break;
case "T" :
			$sql = "delete from tb_pctuse  Where uvn='$vn'  and vn='$svn' and tid='$tid' and ftyp='T' and empid='$eid' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");
			break;
}
$txt = 'ลบข้อมูลเรียบร้อยแล้ว';

echo '||doctor/doctor_form.php'.'||'.$vn.'||'.$con.'||'.$txt;

?>
