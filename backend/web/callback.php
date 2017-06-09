<?php
	date_default_timezone_set('PRC'); 
	$mysql_server_name='127.0.0.1:3306';
	$mysql_username='root';
	$mysql_password='snipeglee';
	$mysql_database='mokeapp';
	$con= mysql_connect($mysql_server_name,$mysql_username,$mysql_password);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	mysql_query("SET NAMES utf8"); 
  	mysql_select_db($mysql_database);

  	$Sjt_TransID=mysql_real_escape_string($_GET['Sjt_TransID']);
  	$Sjt_UserName=mysql_real_escape_string($_GET['Sjt_UserName']);
  	$Sjt_factMoney=mysql_real_escape_string($_GET['Sjt_factMoney']);
  	$Sjt_SuccTime=mysql_real_escape_string($_GET['Sjt_SuccTime']);
  	$Sjt_BType=mysql_real_escape_string($_GET['Sjt_BType']);

  	$sql="INSERT INTO tbl_third (out_trade_no,attach,total_fee,out_transaction_id,createTime,type) values(':out_trade_no',':attach',:total_fee,':out_transaction_id',':createTime',:type)";

  	$sql=str_replace(':out_trade_no', $Sjt_TransID, $sql);
	$sql=str_replace(':out_trade_no', $Sjt_TransID,$sql);
	$sql=str_replace(':attach', $Sjt_UserName,$sql);
	$sql=str_replace(':total_fee',$Sjt_factMoney,$sql);
	$sql=str_replace(':out_transaction_id', $Sjt_TransID,$sql);
	$sql=str_replace(':createTime', date('Y-m-d H:i:s', $Sjt_SuccTime),$sql);
	$sql=str_replace(':type', $Sjt_BType,$sql);

  	$result =mysql_query($sql,$con);
	mysql_close($con);
	echo 'OK';
?>