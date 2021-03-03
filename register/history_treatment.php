<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_POST['hn'];

$sql = "select * from tb_patient where hn='$hn'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);
?>
<div style="width:99%; margin:auto;  height:25px; display:none;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left; line-height:20px;">
	<img src="images/icon/group.png" align="absmiddle" />&nbsp;ประวัติทรีทเม้นท์ 
	</div>
	<div style="width:80%; text-align:right; float:left; line-height:20px;">

	<input type="button"  value="  รายชื่อทั้งหมด  " onclick="loadmodule('home','register/register.php','')"  style="height:25px; font-size:13px; line-height:25px;" />	
	</div>
</div>
<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
<div class="littleDD" style="font-size:18px; font-weight:bold; height:50px;" >    
	<div style="width:30%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ : <?=$hn; ?></div>
	<div style="width:65%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;"><?=$row['pname'].$row['fname'].'    '.$row['lname']; ?></div>
</div>
<div style="width:100%; height:auto; margin-top:10px; text-align:left;">
	<div style="width:47%; margin-left:15px; margin-right:10px; float:left; height:auto;">	
		<div class="line" style="font-size:14px; font-weight:bold; height:20px; line-height:20px;">
		ประวัติการซื้อทรีทเม้นท์
		</div>
		<div style="width:99%; height:382px; float:left; border:#CCCCCC 1px solid;">	
			<div class="line" style="height:25px; line-height:20px; margin-top:5px;">
				<div style="width:10%; float:left; text-align:right; line-height:20px; font-weight:bold;">วันที่ :&nbsp;</div>
				<div style="width:70%; float:left; text-align:left; line-height:20px;">
				<select id="sdate" onchange="loadmodule('p_list','register/his_spct.php','hn=<?=$hn?>&dat='+this.value)">
				<?
				$sql = "select DISTINCT(a.dat),a.dat from tb_pctrec a,tb_vst b where a.vn=b.vn and b.status='COM' and a.hn='$hn' order by a.dat asc";
				$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				$n = mysql_num_rows($str);
				if($n){
				$dat = '00';
				?>
				<option value="00">แสดงทั้งหมด</option>
				<? while($rs=mysql_fetch_array($str)){ ?>
				<option value="<?=$rs['dat']?>"><?=$rs['dat']?></option>
				<? } } else { 
				$dat='-';
				?>
				<option value="-">ไม่พบประวัติการซื้อ</option>
				<? } ?>
				</select>
				</div>
			</div>
			<div style="width:98%; height:20px;padding-top:5px;margin-left:5px; color:#000000; font-weight:bold; float:left; font-size:13px;background:<?=$tabcolor?>;">
				<div style="width:25%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่</div>
				<div style="width:35%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
				<div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
				<div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา</div>
			</div>		
		    <div id="p_list" style=" width:99%; margin-left:5px; float:left; height:350px; overflow:auto;">
			<? include('his_spct.php'); ?>
			
		
			</div>
		</div>
	</div>
	<div style="width:48%; margin-left:10px; margin-right:10px; float:left; height:auto;">
		<div class="line" style="font-size:14px; font-weight:bold; height:20px; line-height:20px;">
		ประวัติการทำทรีทเม้นท์
		</div>
		<div style="width:99%; height:382px; float:left; border:#CCCCCC 1px solid;">	
			<div style="width:98%; height:20px;padding-top:5px;margin-left:5px;  margin-top:5px; color:#000000; font-weight:bold; float:left; font-size:13px;background:<?=$tabcolor?>;">
				<div style="width:40%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
				<div style="width:25%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวนทั้งหมด</div>
				<div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ใช้ไป</div>
				<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
			</div>		
		    <div id="d_list" style=" width:99%; margin-left:5px; float:left; height:350px; overflow:auto;">
				       	<?
		   	$sql = "delete from tb_temphispct where hn='$hn' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");
		   
		    $sql_pct = "select * from tb_pctrec  where hn='$hn' and total > 0  ";
			$str_pct = mysql_query($sql_pct) or die ("Error Query [".$sql_pct."]");	
			while($rs_pct=mysql_fetch_array($str_pct)){
			    $pvn = $rs_pct['vn']; 
				
				
			    $pid = $rs_pct['tid'];
				$pname = $rs_pct['tname'];
				$qty = $rs_pct['qty'];
				$type = $rs_pct['typ'];
				$unit = $rs_pct['unit'];
				
			  
				
		   		if($type=='L' || $type=='T'){
				
					$sql = "select sum(qty) as total from tb_pctuse where hn='$hn' and vn='$pvn' and pid='$pid' and tid='$pid' and ftyp='T' ";
					$tr = mysql_query($sql);
					$rr = mysql_fetch_array($tr);			
				    $uqty = $rr['total'];
					if( $tqty > $uqty){
						$sql = "select * from tb_temphispct where hn='$hn' and tid='$pid'";
						$tr = mysql_query($sql);
						$n = mysql_num_rows($tr);
						if(empty($n)){
							//$tqty = $qty  -  $uqty;
							$sql = "insert into tb_temphispct  values('$hn','$pid','$pname','$qty','$uqty','$type')";
							mysql_query($sql);	
						} else {
							$rr = mysql_fetch_array($tr);
							$tqty = $qty +  $rr['qty'] ;
							//$uqty;
							$sql = "update tb_temphispct set qty='$tqty',un='$uqty' where hn='$hn' and tid='$pid'";
							mysql_query($sql);								
						}	
					}				
									
				}
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
								$sql = "select * from tb_temphispct where hn='$hn' and tid='$tid'";
								$tr = mysql_query($sql);
								$n = mysql_num_rows($tr);
								if(empty($n)){
									//$tqty = $tqty  -  $uqty;
									$sql = "insert into tb_temphispct  values('$hn','$tid','$tname','$tqty','$uqty','$ttype')";
									mysql_query($sql);	
								} else {
									$rr = mysql_fetch_array($tr);
									$tqty = $tqty +  $rr['qty']; //$uqty;
									$sql = "update tb_temphispct set  qty='$tqty',un='$uqty' where hn='$hn' and tid='$tid'";
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
							
								$sql = "select * from tb_temphispct where hn='$hn' and tid='$tid'";
								$tr = mysql_query($sql);
								$n = mysql_num_rows($tr);
								if(empty($n)){
									//$tqty = $tqty  -  $uqty;
									$sql = "insert into tb_temphispct  values('$hn','$tid','$tname','$tqty','$uqty','$ttype')";
									mysql_query($sql);	
								} else {
									$rr = mysql_fetch_array($tr);
									$tqty = $tqty +  $rr['qty'] ; // $uqty;
									$sql = "update tb_temphispct set qty='$tqty',un='$uqty' where hn='$hn' and tid='$tid'";
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
							$uqty = 0;
							if(!empty($rr['total'])){									
								$uqty = $rr['total'];	
							} 
							
							
							
														
							if( $tqty > $uqty){
								$sql = "select * from tb_temphispct where hn='$hn' and tid='$tid'";
								$tr = mysql_query($sql);
								$n = mysql_num_rows($tr);
								if(empty($n)){
									//$tqty = $tqty  -  $uqty;
									$sql = "insert into tb_temphispct  values('$hn','$tid','$tname','$tqty','$uqty','$ttype')";
									mysql_query($sql);	
								} else {
									$rr = mysql_fetch_array($tr);
									$tqty = $tqty +  $rr['qty']; 
									$uqty = $uqty +  $rr['un']; 
								
									$sql = "update tb_temphispct set qty='$tqty',un='$uqty' where hn='$hn' and tid='$tid'";
									mysql_query($sql);								
								}
							}							
						}					
				}		   
		    }
			
		   
	         
   

			$sql = "select * from tb_temphispct where hn='$hn' ";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]");			
			while($rs=mysql_fetch_array($result)){ 
			?>
			
				<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 					
					<div style="width:35%;float:left; padding-left:20px; "  >
					<?=$rs['tname']?>&nbsp;
					</div>
					<div style="width:20%;float:left;text-align:right;"   >
					<?=$rs['qty']?>&nbsp;&nbsp;
					</div>
					<div style="width:20%;float:left;text-align:right;"   >
					<?=$rs['un']?>&nbsp;&nbsp;
					</div>				
					<div style="width:20%;float:left;text-align:right;"   >
					<?=$rs['qty'] - $rs['un']?>&nbsp;&nbsp;
					</div>				
				</div>			
			
			
		    <? } ?>
			</div>		
		
		
		
		
		</div>
	</div>
</div>



</div>