<html>

	<head>

	</head>

	<body>
		<h1>Test !</h1>

		<?php
			define("USERNAME", $_GET['username']);

			define("PASSWORD", $_GET['password']);

			define("SECURITY_TOKEN", $_GET['token']); 

			require_once ('soapclient/SforcePartnerClient.php'); 

			$mySforceConnection = new SforcePartnerClient();

			$mySforceConnection->createConnection("partner.wsdl.xml");

			$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
		?>

	</body>

</html>