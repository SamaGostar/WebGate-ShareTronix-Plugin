<?php
	if( !$this->network->id ) {
		$this->redirect('home');
	}
	if( !$this->user->is_logged ) {
		$this->redirect('signin');
	}
	if($_SERVER['REQUEST_METHOD']!="GET" || base64_decode($_GET['uid']) ==""  ) die("Forbidden!");
$uid= base64_decode($_GET['uid']);

$alls = $this->network->get_user_by_id($uid, TRUE);
	
	if(!empty($alls)){
	
	$q = $db2->query('SELECT * FROM users_support WHERE user_id="'.$uid.'"');
	
$a = $db2->fetch_object($q);
	
	$amount = $a->amount;
	$amount_l = $a->l_amount2;
	$how = $a->how;
	$date = pdate("d / m / Y _ H:i:a",$a->date);
	
	}
	
	echo <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 

</head>
<body style="font-family:tahoma;background:#000;direction:rtl;text-align:right;line-height:60px">
<CENTER><a target="_blank" href="{$C->SITE_URL}{$alls->username}" ><img src="{$C->IMG_URL}avatars/thumbs3/{$alls->avatar}" /></a></CENTER>
<div style="font-size:15px;font-weight:bold;color:green">مقدار کمک تا کنون : <span style="color:red">{$amount} تومان</span> </div> 
<div style="font-size:15px;font-weight:bold;color:green">مقدار آخرین کمک : <span style="color:red">{$amount_l} تومان</span> </div> 
<div style="font-size:15px;font-weight:bold;color:green">زمان آخرین کمک : <span style="color:red">{$date} </span> </div> 
<div style="font-size:15px;font-weight:bold;color:green">دفعات : <span style="color:red">{$how}</span> </div> 
<CENTER>
<form action="{$C->SITE_URL}support-zarin" methode="post" target="_blank">
<button style="cursor:pointer;padding:4px;"> شما نیز حمایت کنید </button>
</form>

</CENTER>
</body>
</html>
EOD;
	
	
	
	
?>