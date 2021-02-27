<? include('../class/config.php'); 

$sql = "select * from tb_autonumber where typ='PD'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = substr($rs['number'],0,3);

$sid = $x ;  
$txt = substr($rs['last'],3,3);
$n = strlen($txt);
$num = intval($txt) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$sid .= $t; 

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />




<div id="t_main" class="tmain" style="width:100%; margin:auto; height:495px; overflow:hidden; ">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >ข้อมูลพนักงาน - แพทย์</div>
   
  
  <div id="staffedit" style="width:55%; height:470px;  margin-top:5px; float:left;">
    <input type="hidden" id="typ" value="new" />
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">รหัสพนักงาน :&nbsp;</div>
      <div style="width:25%; float:left;">
	    
        <input name="text" type="text" id="staffid" value="<?=$sid?>" size="15" />
      </div>
      <?
				$sql = "select branchid,branchname from tb_branch ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
      <div style="width:25%; float:left; text-align:right;">สาขา :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="branch" style="width:117px;">
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['branchid']?>"> <?=$rs['branchname']?></option>
          <? } ?>
        </select>
      </div>
    </div>
    <!--รหัสพนักงาน-->
    <div class="line">
      <?
	$sql = "select * from tb_gernaral where typ='PN'";
	$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	  ?>
      <div style="width:21%; float:left; text-align:right;">คำนำหน้าชื่อ :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="pname" style="width:117px;">
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['name']?>">
            <?=$rs['name']?>
          </option>
          <? } ?>
        </select>
      </div>
      <div style="width:25%; float:left; text-align:right;">เพศ :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="sex" style="width:117px;">
          <option value="นาย">ชาย</option>
          <option value="นางสาว">หญิง</option>
        </select>
      </div>
    </div>
    <!--คำนำหน้าชื่อ-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">ชื่อ :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="fname" size="15" />
      </div>
      <div style="width:25%; float:left; text-align:right;">สกุล :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="lname" size="15" />
      </div>
    </div>
    <!--ชื่อ-สกุล-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">ชื่อเล่น :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="nname" size="15" />
      </div>
      <?
				$sql = "select * from tb_gernaral where typ='ST'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
      <div style="width:25%; float:left; text-align:right;">สถานะภาพ :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="st" style="width:117px;">
          <option value="ไม่ระบุ">ไม่ระบุ</option>
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['name']?>">
            <?=$rs['name']?>
          </option>
          <? } ?>
        </select>
      </div>
    </div>
    <!--ชื่อเล่น-->
    <div class="line">
      <?
				$sql = "select * from tb_gernaral where typ='BL'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
      <div style="width:21%; float:left; text-align:right;">หมู่เลือด :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="bl" style="width:117px;">
          <option value="ไม่ระบุ">ไม่ระบุ</option>
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['name']?>">
            <?=$rs['name']?>
          </option>
          <? } ?>
        </select>
      </div>
      <?
				$sql = "select * from tb_gernaral where typ='DE'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
      <div style="width:25%; float:left; text-align:right;">วุฒิการศึกษา :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="degree" style="width:117px;">
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['name']?>">
            <?=$rs['name']?>
          </option>
          <? } ?>
        </select>
      </div>
    </div>
    <!--หมู่เลือด-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">วัน-เดือน-ปี เกิด :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input  type="text" id="dd" style="width:22px" size="2"  maxlength="2" />-<input  type="text" id="dm" style="width:22px" size="2" maxlength="2"  />-<input  type="text" id="dy" style="width:31px" size="4" maxlength="4"  />
      </div>
      <div style="width:25%; float:left; text-align:right;">บัตรประชาชน :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input type="text" id="idcard" value="000-0000-0000" size="15" />
      </div>
    </div>
    <!--วัน เดือน ปี เกิด-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">แสดง :&nbsp;</div>
      <div style="width:25%; float:left;">
         <select id="eshow">
        <option value="N">ไม่แสดง</option>
        <option value="Y">แสดง</option>
        </select>     
      
      </div>
      <div style="width:25%; float:left; text-align:right;">&nbsp;</div>
      <div style="width:25%; float:left; display:none;">
        <input name="text2" type="text" id="age"  style="width:20px" size="5" readonly="TRUE" />
     </div>
    </div>
    <!--เดือน-->
    <!--วัน เดือน ปี เกิด-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">Username :&nbsp;</div>
      <div style="width:25%; float:left;">
         <input  type="text" id="user"   size="15"  />
      
      </div>
      <div style="width:25%; float:left; text-align:right;">Password :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input  type="password" id="pass"  size="15"  />
     </div>
    </div>    
    
    
    
    
    
    <div class="line">&nbsp;</div>
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">ที่อยู่ :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="address" size="51" />
      </div>
    </div>
    <!--ที่อยู่-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">เบอร์มือถือ :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="tel" size="15" />
      </div>
      <div style="width:25%; float:left; text-align:right;">E-mail :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="mail" size="15" />
      </div>
    </div>
    <!--เบอร์่-->
    <div class="line">&nbsp;</div>
    <div class="line">
      <?
			$sql = "select * from tb_gernaral where typ='PS'";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	?>
      <div style="width:21%; float:left; text-align:right;">ตำแหน่ง :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="pos" >
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['name']?>"><?=$rs['name']?></option>
          <? } ?>
        </select>
      </div>
	  <div style="width:25%; float:left; text-align:right;">ประเภท :&nbsp;</div>
	  <div style="width:25%; float:left;">
        <select name="select" id="mode" >          
        <option value="D">แพทย์</option>
        <option value="E">พนักงาน</option>
		
        </select>	  
	  </div>
    </div>
    <!--ตำแหน่ง-->
   <?
	$sql = "select * from tb_gernaral where typ='SS'";
	$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
   ?>	
	
	
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">สถานะ :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="status" >
		<? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['name']?>"><?=$rs['name']?></option>
        <? } ?>
        </select>
      </div>
      <div style="width:25%; float:left; text-align:right;">ประเภท :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="tpy" style="width:117px;">
          <option value="รายเดิอน">รายเดือน</option>
          <option value="รายวัน">รายวัน</option>
        </select>
      </div>
    </div>
    <!--สถานะ-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">วันเริ่มทำงาน :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="sdate" size="15" />
      </div>
      <div style="width:25%; float:left; text-align:right;">อายุงาน :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="dday" size="15" />
      </div>
    </div>
    <!--วันที่เริ่มทำงาน-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">สิทธิวันลา :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="ll" size="15" />
      </div>
      <div style="width:25%; float:left; text-align:right;">เลขที่บัญชี:&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="acc" size="15"  />
      </div>
    </div>
    <!--สิทธิวันลา-->
    <div class="line">
      <div style="width:21%; float:left; text-align:right;">ประกันสังคม :&nbsp;</div>
      <div style="width:25%; float:left;">
        <select name="select" id="sso" >
          <option value="มี">มี</option>
          <option value="ไม่มี">ไม่มี</option>
        </select>
      </div>
      <div style="width:25%; float:left; text-align:right;">เลขที่ประกันสังคม :&nbsp;</div>
      <div style="width:25%; float:left;">
        <input name="text2" type="text" id="ssonum" size="15" />
      </div>
    </div>
    <!--สิทธิวันลา-->
   
    <div style="width:78%; text-align:right; float:left;">
      <input name="button" type="button" style="height:25px; font-size:13px; line-height:25px;"  onclick="addstaff('setting/staff_add.php','settingpage')" value="      บันทึก       " />
      <input name="button" type="button" style="height:25px; font-size:13px; line-height:25px;" onclick="ajaxLoad('post','setting/employee.php','','settingpage')" value=" รายการใหม่ "/>
    </div>
  </div>
  
  
  <div class="txt_serch">
			<input class="input_serch" type="text" id="txts" size="41" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('setting/staff_list.php','d_tall',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','setting/staff_list.php','txt=','d_tall')" />
	</div>
  
   <div style="width:45%; height:20px; margin-top:5px;  float:left; color:#000000; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; ">
      <div style="width:30%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
      <div style="width:70%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อพนักงาน</div>
   </div>
  
  
  
  	<div id="d_tall" style="width:40%; height:auto;  float:left;  margin-left:5px; margin-top:5px ">
   		<?  require("staff_list.php");	 ?>	
   
  
	</div>
