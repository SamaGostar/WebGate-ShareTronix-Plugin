<?php
	if( !$this->network->id ) {
		$this->redirect('home');
	}
	if( !$this->user->is_logged ) {
		$this->redirect('signin');
	}
	require_once('helpers/nusoap.php');

	if(!$_POST['au']){
			$this->redirect('home');
	
	}
	///////////////////////////
	
	
	/*CREATE TABLE `users_support` (
`id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
`user_id` INT( 10 ) UNSIGNED NOT NULL ,
`date` VARCHAR( 255 ) NOT NULL ,
`how` INT( 10 ) NOT NULL ,
`amount` INT( 10 ) NOT NULL ,
`l_amount` INT( 10 ) NOT NULL,
`l_amount2` INT( 10 ) NOT NULL,
`active` ENUM( '0', '1' ) NOT NULL , 
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;
ALTER TABLE `users_support` ADD INDEX ( `user_id` ) 

*/
	////////////////////////
	$D->submit = FALSE;
	$merchantID = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
	if($_GET['Status'] != "OK" )
	{
		$D->submit = FALSE;
		return false;
	}else{	
			$D->amount    = $db2->fetch_field('SELECT  l_amount FROM users_support WHERE user_id="'.$this->user->id.'" LIMIT 1'); ; //Amount will be based on Toman
			$au = $_GET['Authority'];
			
			$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
			$res = $client->call("PaymentVerification", array(
			array(
						'MerchantID'	 => $merchantID ,
						'Authority' 	 => $au ,
						'Amount'		 => $D->amount
						)
			));

			if($res->status  == "100"){
			$D->submit = TRUE;
			
			$db2->query('UPDATE  users_support SET   amount=amount+"'.trim($D->amount).'" ,date="'.time().'" , how=how+1 ,  l_amount2="'.$D->amount.'",l_amount="", active="1"   WHERE user_id="'.$this->user->id.'" LIMIT 1');
			
			
			
			}else{
			$D->submit = FALSE;
			}
		
	}
	$this->load_template('verify-support.php');
?>
