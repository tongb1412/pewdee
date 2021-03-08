<? 
include('../class/config.php');
if(empty($_POST['hn'])){ 
	$hn = $_GET['hn'];
	$vn = $_GET['vn'];
} else {
	$hn = $_POST['hn'];
	$vn = 'VN09'.date('mdHis');
}



$sql = "select * from tb_patient where hn = '$hn'";
$str = mysql_query($sql) or die ("Error Query ".$sql); 
$row=mysql_fetch_array($str);
$pname = $row['pname'].$row['fname'].'   '.$row['lname'];

if(! empty($row['birthday'])){

$y = date('Y',time());
$age = intval($y) - intval(substr($row['birthday'],6,4));
if($age < 0) {
	$age = (intval($y) + 543 ) - intval(substr($row['birthday'],6,4)) ;
}
} else {
	$age = '-';
}


?>









<div style="width:98%; height:100px; margin:auto;">
    <input type="hidden" id="hn" value="<?=$hn?>" />
	<input type="hidden" id="vn" value="<?=$vn?>" />
	
	<div style="width:45%; height:470px; margin-right:10px; margin-left:5px; float:left; border:1px <?=$tabcolor?> solid;">
		<div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">    				
			<div style="width:65%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
			<div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคารวม</div>
		</div>    
		<div id="sdlist" style="width:100%; height:auto; text-align:left;">
		
		<div style="width:100%; height:420px; text-align:left; overflow:auto ">




<? 
$n=1;
$sql = "select * from tb_pctrec where vn='$vn' and typ IN ('P','C')  ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  "   > 
	<div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">คอร์ส / แพ็คเกจ</div>

</div>
<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
$total = $total +  $rs['totalprice'] ;
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

$price = $rs['price'];
$sid = $rs['empid'];
$sname = $rs['empname'];
$cid = $rs['cid'];
$cname = $rs['cname'];

?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:5%;float:left; "><?=$n.'.'?></div>
	<div style="width:65%;float:left; cursor:pointer;" onClick="movepctEdit('<?=$rs['tid']?>','<?=$rs['tname']?>','<?=$rs['qty']?>','<?=$price?>','<?=$rs['typ']?>','<?=$rs['totalprice']?>','<?=$sid?>','<?=$sname?>','<?=$cid?>','<?=$cname?>')">
	<?=$rs['tname']?>&nbsp;</div>
	<div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movepctEdit('<?=$rs['tid']?>','<?=$rs['tname']?>','<?=$rs['qty']?>','<?=$price?>','<?=$rs['typ']?>','<?=$rs['totalprice']?>')">
	<?=$rs['qty']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movepctEdit('<?=$rs['tid']?>','<?=$rs['tname']?>','<?=$rs['qty']?>','<?=$price?>','<?=$rs['typ']?>','<?=$rs['totalprice']?>')">
	<?=number_format($rs['totalprice'],'2','.',',')?>&nbsp;</div>

</div>
<? 
$n++; 
}



$sql = "select * from tb_pctuse where uvn='$vn' and ftyp IN ('P','C') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  "   > 
	<div style="width:100%;float:left; font-weight:bold; color:#0033FF;">รายการใช้ทรีทเม้นท์ </div>

</div>
<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 

if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

?>

<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:5%;float:left; "><?=$n.'.'?></div>
	<div style="width:65%;float:left; "><?=$rs['tname']?>&nbsp;</div>
	<div style="width:15%;float:left;  text-align:right" ><?=$rs['qty']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; " ><input type="button" value="  " class="btn_del" onclick="rpctUseDelete('register/pctuse_del.php','content','<?=$rs['uvn']?>','<?=$rs['hn']?>','<?=$rs['tid']?>','<?=$rs['empid']?>','<?=$rs['ftyp']?>')"  title="ลบ" alt="ลบ" />	</div>

</div>
<? 
$n++; 
} 
?>




		</div>

	
		</div>

	</div>
    <div style="width:53%; height:470px; float:left;">
     	<div style="width:100%; height:30px; line-height:30px; font-weight:bold; font-size:18px; border-bottom:#CCCCCC 1px dotted; text-align:left;">
			<div style="width:25%; float:left;"><?=$hn?></div>
			<div style="width:55%; float:left;"><?=$pname;?></div>
			<div style="width:20%; float:left;"><?='อายุ : '.$age.' ปี'?></div>
		</div>		
		<div style="width:100%; height:400px; background:#fffaf0; ">
	

			<div class="line" style="text-align:left; background:url(images/dot1.png) left center no-repeat; padding-left:20px; line-height:25px; font-weight:bold;" >
			คอร์ส / แพ็คเกจ
			</div>				
		    <div class="line" >
			    <div style="width:10%; float:left; text-align:right;">ประเภท :&nbsp;</div>
				<div style="width:40%; float:left; text-align:right; text-align:left;">
		        <select id="ptype" onchange="clearpct()">
				<option value="C">คอร์ส</option>
				<option value="P">แพ็คเกจ</option>
				</select>
				</div>
			</div>			
			<div class="line">
				<div style="width:10%; float:left; text-align:right;">รายการ :&nbsp;</div>
				<div style="width:40%; float:left;">
				    <input type="hidden" id="pid" />
					<input type="text" id="pname" style="width:200px;" onkeyup="serchpct('doctor/pct_list.php','pl',this)"  />
					<div id="pl" class="bl" style="width:100%;"></div>
				</div>
				<div style="width:10%; float:left; text-align:right;">จำนวน :&nbsp;</div>
				<div style="width:10%; float:left;">
				<input type="text" id="pqty" style="width:20px;" onkeyup="calnum('pprice','pqty','puprice')" />
				</div>	
				<div style="width:6%; float:left; text-align:right;">ราคา:&nbsp;</div>
				<div style="width:14%; float:left;">
				<input type="text" id="puprice" style="width:50px;" /><input type="hidden" id="pprice"/>
				</div>			
				<div style="width:10%; float:left;">
				<input type="button" id="ppadd" value="  " class="btn_add" onclick="add_pct('register/pct_add.php','content')" title="เพิ่ม" alt="เพิ่ม" />
				<input type="button" value="  " class="btn_del" onclick="rpctDelete('register/pct_del.php','content')" title="ลบ" alt="ลบ" />				
				</div>	
				
				<div id="cll" class="bl" style="width:100%;  background:#fffaf0; margin-top:26px; height:100px; display:none;">
				
						<div class="line" >
							<div style="width:20%; float:left; text-align:right;">ผู้ขาย :&nbsp;</div>
							<div style="width:46%; float:left;">
							<input type="hidden" id="pseid" />				    
							<input type="text" id="psename"  style="width:280px;" onkeyup="serchtxt('doctor/psemp_list.php','psel',this)"  />		
							<div id="psel" class="bl" style="width:100%; background:#FFFFFF"></div>				
							</div>	
							<div style="width:10%; float:left; text-align:right;">&nbsp;</div>
							<div style="width:24%; float:left;">&nbsp;</div>																		
						</div>	
                        
 						<div class="line" >
							<div style="width:20%; float:left; text-align:right;">ผู้สนับสนุน :&nbsp;</div>
							<div style="width:46%; float:left;">
							<input type="hidden" id="npseid" />				    
							<input type="text" id="npsename"  style="width:280px;" onkeyup="serchtxt('doctor/npsemp_list.php','npsel',this)"  />		
							<div id="npsel" class="bl" style="width:100%; background:#FFFFFF"></div>				
							</div>	
							<div style="width:10%; float:left; text-align:right;">&nbsp;</div>
							<div style="width:24%; float:left;">&nbsp;</div>																		
						</div>	                       
                        
                        			

				</div>				
				
				
							
			</div>			
			<div class="line" style="text-align:left; background:url(images/dot1.png) left center no-repeat; padding-left:20px; line-height:25px; font-weight:bold;" >
			ใช้คอร์ส / แพ็คเกจ
			</div>	
			<div class="line" style="height:auto; border:1px <?=$tabcolor?> solid;">
				<div style="width:100%; height:20px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">    				
					<div style="width:75%;text-align:left; float:left; line-height:20px;">
					<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ
					</div>
					<div style="width:25%;text-align:left; float:left; line-height:20px;">
					<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวนคงเหลือ
					</div>
			    	<div id="pzone" class="pul" style="height:145px; text-align:center; display:none;">
							
					</div>   
					<div id="pctl" style="display:none; height:80px;">
					    <div  style="margin-top:5px; font-weight:bold; width:100%; height:20px;">
							<div style="width:70%; float:left;">&nbsp;&nbsp;<span id="pctname"></span></div>
							<div style="width:30%; float:left;">คงเหลือ :&nbsp;<span id="pctnum"></span></div>
						</div>
						<div  style="margin-top:5px; width:100%; height:auto;">
							<div style="width:10%; float:left; text-align:right;">ผู้ทำ :&nbsp;</div>
							<div style="width:45%; float:left;">
							<input type="hidden" id="peid" />
							<input type="hidden" id="num" />	
							<input type="hidden" id="ptid" />			    
							<input type="text" id="pename"  style="width:210px;" onkeyup="serchtxt('doctor/pemp_list.php','eul',this)"  />		
							<div id="eul" class="bl" style="width:100%;"></div>				
							</div>	
							<div style="width:15%; float:left; text-align:right;">จำนวน :&nbsp;</div>
							<div style="width:25%; float:left;">
							<input type="text" id="pctqty" style="width:40px;"  value="1"/>
							&nbsp;<span id="tunit"></span>
							</div>		
							<div style="width:5%; float:left;">
							<input id="padd" type="button" value="  " class="btn_add" onclick="usepct('register/usepct.php','content')" title="เพิ่ม" alt="เพิ่ม" />
							</div>																
						</div>		
					    <div  style="margin-top:25px; width:100%; text-align:right; padding-top:10px;">
						<input type="button" value=" X " style="border:1px solid #CCCCCC; background:#CCCCCC; font-size:10px; height:15px; width:15px; text-align:center; margin-right:5px;"  onclick="celpct()"/>
						</div>
					
					</div>  
					
					               
				</div> 			
			

			
			
				<div id="z_use" class="line" style="height:280px; overflow:auto; background:#FFFFFF;">

				
	       	<?
		   	$sql = "delete from tb_pctlist  ";
			mysql_query($sql) or die ("Error Query [".$sql."]");
		   
		    $sql_pct = "select * from tb_pctrec  where hn='$hn' and total > 0 and vn='$vn'  ";
			$str_pct = mysql_query($sql_pct) or die ("Error Query [".$sql_pct."]");	
			while($rs_pct=mysql_fetch_array($str_pct)){
			    $pvn = $rs_pct['vn']; 
			    $pid = $rs_pct['tid'];
				$pname = $rs_pct['tname'];
				$qty = $rs_pct['qty'];
				$type = $rs_pct['typ'];
				$unit = $rs_pct['unit'];

		        if($type=='P'){
					$sql = "select tb_package_detail.*,tb_treatment.unit,tb_treatment.typ from tb_package_detail,tb_treatment  where tb_package_detail.id=tb_treatment.tid and   tb_package_detail.pid='$pid' and tb_package_detail.typ IN ('T','L')";
					$str = mysql_query($sql) or die ("Error Query [".$sql."]");	
					while($rs=mysql_fetch_array($str)){		
						$tid = $rs['id'];
						$tname = $rs['name'];
						$tqty = $qty * $rs['qty'];
						$tunit = $rs['unit'];
						$ttype = $rs['typ'];
						    
		
							$sql = "select sum(qty) as total from tb_pctuse where hn='$hn' and vn='$pvn' and pid='$pid' and tid='$tid' and ftyp='PT' ";
							$tr = mysql_query($sql);
							$rr = mysql_fetch_array($tr);			
							$uqty = $rr['total'];
							
							if( $tqty > $uqty){							    
								$sql = "select * from tb_pctlist where vn='$pvn' and hn='$hn' and tid='$tid'";
								$tr = mysql_query($sql);
								$n = mysql_num_rows($tr);
								if(empty($n)){
									$tqty = $tqty  -  $uqty;
									$sql = "insert into tb_pctlist  values('$pvn','$hn','$tid','$tname','$tqty','$tunit','$ttype')";
									mysql_query($sql);	
								} else {
									$rr = mysql_fetch_array($tr);
									$tqty = $tqty +  $rr['qty'] - $uqty;
									$sql = "update tb_pctlist set qty='$tqty' where vn='$pvn' and hn='$hn' and tid='$tid'";
									mysql_query($sql);								
								}	
						    }									
					}
					
					
					$sql = "select id,qty from tb_package_detail  where pid='$pid' and typ = 'C' ";
					$str = mysql_query($sql) or die ("Error Query [".$sql."]");	
					while($rs=mysql_fetch_array($str)){
						$cid = $rs['id'];
						$cqty = $rs['qty'];
						$sqlc  = "select  tb_course_detail.*,tb_treatment.unit,tb_treatment.typ from tb_course_detail,tb_treatment  ";
						$sqlc .= "where tb_course_detail.tid=tb_treatment.tid  and  tb_course_detail.cid='$cid'  ";
						$strc = mysql_query($sqlc) or die ("Error Query [".$sqlc."]");	
						while($rc=mysql_fetch_array($strc)){		
							$tid = $rc['tid'];
							$tname = $rc['tname'];
							$tqty = $qty * ($rc['qty'] * $cqty );
							$tunit = $rc['unit'];
							$ttype = $rc['typ'];
							
							$sql = "select sum(qty) as total from tb_pctuse where hn='$hn' and vn='$pvn' and pid='$pid' and cid='$cid' and tid='$tid' and ftyp='PC' ";
							$tr = mysql_query($sql);
							$rr = mysql_fetch_array($tr);			
							$uqty = $rr['total'];
														
							if( $tqty > $uqty){
							
								$sql = "select * from tb_pctlist where vn='$pvn' and hn='$hn' and tid='$tid'";
								$tr = mysql_query($sql);
								$n = mysql_num_rows($tr);
								if(empty($n)){
									$tqty = $tqty  -  $uqty;
									$sql = "insert into tb_pctlist  values('$pvn','$hn','$tid','$tname','$tqty','$tunit','$ttype')";
									mysql_query($sql);	
								} else {
									$rr = mysql_fetch_array($tr);
									$tqty = $tqty +  $rr['qty'] - $uqty;
									$sql = "update tb_pctlist set qty='$tqty' where vn='$pvn' and hn='$hn' and tid='$tid'";
									mysql_query($sql);								
								}		
							}
							
						}		
					}
				}	
				if($type=='C'){
                        
						$sqlc  = "select  tb_course_detail.*,tb_treatment.unit,tb_treatment.typ from tb_course_detail,tb_treatment  ";
						$sqlc .= "where tb_course_detail.tid=tb_treatment.tid  and  tb_course_detail.cid='$pid'  ";
						$strc = mysql_query($sqlc) or die ("Error Query [".$sqlc."]");	
						while($rc=mysql_fetch_array($strc)){
						    $cid = $rc['cid'];	
							$tid = $rc['tid'];
							$tname = $rc['tname'];
							$tqty = $qty * $rc['qty'];
							$tunit = $rc['unit'];
							$ttype = $rc['typ'];							
							
							$sql = "select sum(qty) as total from tb_pctuse where hn='$hn' and vn='$pvn' and pid='$cid' and tid='$tid' and ftyp='C' ";
							$tr = mysql_query($sql);
							$rr = mysql_fetch_array($tr);			
							$uqty = $rr['total'];								
							if( $tqty > $uqty){
								$sql = "select * from tb_pctlist where vn='$pvn' and hn='$hn' and tid='$tid'";
								$tr = mysql_query($sql);
								$n = mysql_num_rows($tr);
								if(empty($n)){
									$tqty = $tqty  -  $uqty;
									$sql = "insert into tb_pctlist  values('$pvn','$hn','$tid','$tname','$tqty','$tunit','$ttype')";
									mysql_query($sql);	
								} else {
									$rr = mysql_fetch_array($tr);
									$tqty = $tqty +  $rr['qty'] - $uqty;
									$sql = "update tb_pctlist set qty='$tqty' where vn='$pvn' and hn='$hn' and tid='$tid'";
									mysql_query($sql);								
								}
							}							
						}					
				}		   
		    }
			
		   
	         
   

			$sql = "select * from tb_pctlist where hn='$hn' ";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]");			
			while($rs=mysql_fetch_array($result)){ 
			?>
				<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 					
					<div style="width:75%;float:left; padding-left:20px; cursor:pointer;" onclick="pctuse('<?=$rs['tid']?>','<?=$rs['qty']?>','<?=$rs['tname']?>')" >
					<?=$rs['tname']?>&nbsp;
					</div>
					<div style="width:20%;float:left;text-align:right; cursor:pointer;" onclick="pctuse('<?=$rs['tid']?>','<?=$rs['qty']?>','<?=$rs['tname']?>')"  >
					<?=$rs['qty']?>&nbsp;&nbsp;
					</div>
				
				
				</div>
			<? 
			}
			?>			
				</div>	
			</div>
		</div>
		<div style="width:100%; height:40px; text-align:right; background:#f5f5f5;">
		
			<div style="width:100%; float:left; text-align:right;">
			<input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:40px;" onclick="slippct('<?=$hn?>','<?=$vn?>')" />
			</div>
		</div>
		

	</div>

</div>




</div>

