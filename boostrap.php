<?php

require_once(__DIR__ . '/vendor/autoload.php');
use Omnipay\Omnipay;
$gateway = Omnipay::create('Adyen');


if(empty($_GET['authResult'])){
	
	$response = $gateway->purchase(array
        (
            'amount' => '10.00', 
            'currency' => 'EUR',
            'merchantReference' => 'TEST-10000',
            'shipBeforeDate' => date('Y-m-d', time()),
            'skinCode' => '05cp1ZtM',
            'sessionValidity' => date(DATE_ATOM,mktime(date("i"), date("s"), date("m"), date("j"), date("Y")+1)),
            'merchantAccount' => 'BidZoneNL',
            'secret' => 'test',
            'shopperLocale' => 'en_GB'
        )
    )->send();
    

    if ($response->isRedirect()) {
		$response->redirect();
		exit;

	} else {
		echo $response->getMessage();
	}
}else{
    
    $response = $gateway->completePurchase()->send();
    var_dump($response->isSuccessful());
    var_dump($response->getResponse());
}
?>
