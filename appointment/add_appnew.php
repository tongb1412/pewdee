<?
include('../class/config.php');
if(empty($_GET['an'])){
	$an = 'AN'.date('ymdHis');
	$mod = 'Y'; $dis='none';
	$auto = "yes";
	$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว';
	if(!empty($_GET['hn'])){
		$hn = $_GET['hn']; 
		$sql = "select concat(pname,fname,'   ',lname) as pname,hn,cn from tb_patient where hn='$hn'";
		$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		$rs=mysql_fetch_array($str);

		$cn = "-";
		$pname = $rs['pname'];
		$atyp = "A";
		if($rs){
				$sqlvn="select a.tname,b.empid,b.empname from tb_pctuse a,tb_pctrec b where a.vn='".$_GET['vn']."' and a.vn=b.vn";
				$query = mysql_query($sqlvn) or die ("Error Query [".$sqlvn."]"); 
				$result=mysql_fetch_array($query);
				$tname=$result['tname'];
				//$dat = date('d-m-Y',strtotime("+1 week"));
				if($tname == "Ulthera" or $tname == "ulthera")	{		$dat=date("Y-m-d",strtotime("+104 week"));	}				
				else if($tname == "Filler" or $tname == "filler")					{		$dat=date("Y-m-d",strtotime("+52 week"));		}			
				else if($tname == "Thermage" or $tname == "thermage")	{		$dat=date("Y-m-d",strtotime("+52 week"));		}	
				else if($tname == "Hifu" or $tname == "hifu")					{		$dat=date("Y-m-d",strtotime("+12 week"));		}
				else if($tname == "Botox" or $tname == "botox")				{		$dat=date("Y-m-d",strtotime("+16 week"));		}
				else if($tname == "Liposonix" or $tname == "liposonix")		{		$dat=date("Y-m-d",strtotime("+8 week"));		}
				else{
					$dat = date('Y-m-d',strtotime("+4 week"));
				}

				$sqlvn2="select empid from tb_vst where vn='".$_GET['vn']."' ";
				$query2 = mysql_query($sqlvn2) or die ("Error Query [".$sqlvn2."]"); 
				$result3=mysql_fetch_array($query2);
				$pid=$result3['empid'];

				
				$sql2 = "insert into tb_appointment  values('$an','$hn','$cn','$pname','$pid','$atyp','$dat','','','','NONE')";
				$result2=mysql_query($sql2) or die ("Error Query [".$sql2."]");
				if($result2){?>
					<div style="width:400px;border:1px solid #e5e5e5;margin-top:100px;margin-left:auto;margin-right:auto;text-align:center;background:#fff;overflow:hidden;padding:50px;">
									<h1>บันทึกวันนัดเรียบร้อย</h1><img src="images/Check-icon.png" width="50" height="50" border="0" alt="" align="middle">
									<a href="javascript: loadmodule('home','register/register.php','')"><h3>กลับสู่หน้าหลัก</h3></a>
					</div>
				<?}
				
		}

	}
} 
?>
