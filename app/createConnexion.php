<?php
	try{
		error_reporting(E_ALL);

		define("USERNAME", $_GET['username']);

		define("SECURITY_TOKEN", $_GET['token']); 

		require_once ('soapclient/SforcePartnerClient.php'); 

		$mySforceConnection = new SforcePartnerClient();

		$mySforceConnection->createConnection("soapclient/partner.wsdl.xml");

		$mySforceConnection->login(USERNAME, SECURITY_TOKEN);
	}catch(Exception $e){
		echo "Erreur à la connexion : " . $e.getMessage();
	}
?>