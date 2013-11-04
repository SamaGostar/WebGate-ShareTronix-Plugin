<?






if (isset ($_POST['zp_on']) && $_POST['amount'] >= 1000){
require_once('helpers/nusoap.php');
	
	$merchantID = "5270ae52-3308-4d70-8c22-29b25ee8a9ca";
	$amount = $_POST['amount']; //Amount will be based on Toman
	$callBackUrl = $C->SITE_URL."verify-support";

	$client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
	 $client->soap_defencoding = 'UTF-8';
	$res = $client->call('PaymentRequest', array(
	array(
					'MerchantID' 	=> $merchantID ,
					'Amount' 		=> $amount ,
					'Description' 	=> "حمایت از ".$C->SITE_TITLE."",
					'Email' 		=> $_POST['email'] ,
					'Mobile' 		=> $_POST['tel'] ,
					'CallbackURL' 	=> $callBackUrl
					)
	));
	//print_r( $res);
	$offf = $db2->fetch_field('SELECT COUNT(id) FROM users_support WHERE user_id="'.$this->user->id.'"');
	if($offf == 0){
	$db2->query('INSERT INTO users_support SET user_id="'.$this->user->id.'" , l_amount="'.trim($_POST['amount']).'"');
	}elseif($offf == 1){
	$db2->query('UPDATE  users_support SET   l_amount="'.trim($_POST['amount']).'" WHERE user_id="'.$this->user->id.'" LIMIT 1');
	}
	//Redirect to URL You can do it also by creating a form
	if($res['Status'] == 100)
	{
		$this->redirect("https://de.zarinpal.com/pg/StartPay/" . $res['Authority'] . "/");
	}else{
		echo'ERR: '.$res['Status'];
	$D->err = TRUE;
	}
}else{
if(isset ($_POST['zp_on']) && $_POST['amount'] < 1000){
$D->err = TRUE;
}

}

$this->load_template('support-zarin.php');


?>
