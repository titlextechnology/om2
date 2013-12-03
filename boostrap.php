<?php

require_once(__DIR__ . '/vendor/autoload.php');
use Omnipay\Omnipay;
$gateway = Omnipay::create('Adyen');


//$gateway = Omnipay::getFactory('Adyen');

if(empty($_GET['authResult'])){
	

	//$gateway->setAmount(12.00);
	//$gateway->setMerchantReference('TEST-10000');
    //$gateway->setShipBeforeDate("2013-11-11");
    //$gateway->setSkinCode('05cp1ZtM');
   // $gateway->setShipBeforeDate(date('Y-m-d', time()));
    //$gateway->setSessionValidity(date(DATE_ATOM,mktime(date("i"), date("s"), date("m"), date("j"), date("Y")+1)));
    //$gateway->setMerchantAccount('BidZoneNL');
    //$gateway->setSecret('BidZoneNL');
    //$gateway->setShopperLocale('en_GB');

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
    
    //$response = $gateway->send();

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
