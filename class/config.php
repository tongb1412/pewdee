<?php
//$dblink=mysql_connect("localhost","root","02566") or die("cannot connect database");
// $dblink=mysql_connect("127.0.0.1","root","1234") or die("cannot connect database");
//$dblink=mysql_connect("10.255.248.77","dtcsw","1234") or die("cannot connect database");
//$dblink=mysql_connect("localhost","root","2520m") or die("cannot connect database");
$dblink = mysql_connect("localhost","user","1234") or die("cannot connect database");
mysql_select_db("db_clinic");
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET character_set_client = utf8");
mysql_query("SET character_set_connection = utf8");

date_default_timezone_set('Asia/Bangkok');
$tabcolor = '#EEF2F7';
$color1 = '#FFFFFF';
$color2 = '#FFFFFF';

$tgrp_1000000 = array("PD0098"=>30,"PDC244x"=>30,"PDC264"=>30, "PDC354"=>30, "PDC358"=>30,"PDC362"=>30, "PDC370"=>30,"PDC374"=>30,"PDC379"=>30,
"PDC386"=>30,"PDC391"=>30,"PDC395"=>30,
"PDC400"=>30,"PDC500"=>30,"PDC501"=>30,
"PDC503"=>30,"PDC506"=>30,"PDC502"=>30,   
"PDC504"=>30,"PDC505"=>30,"PDC507"=>30,"PDC508"=>30);
?>
