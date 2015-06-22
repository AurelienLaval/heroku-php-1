<html>

	<head>

	</head>

	<body>
		<h1>Test !</h1>

		<?php
			define("USERNAME", "aurelien.laval@gmail.dev");

			define("PASSWORD", "a@!29011990");

			define("SECURITY_TOKEN", "QI5xcOaJAvmtfN92QqnUHwVvr"); 

			require_once ('soapclient/SforcePartnerClient.php'); 

			$mySforceConnection = new SforcePartnerClient();

			$mySforceConnection->createConnection("partner.wsdl.xml");

			$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
		?>

	</body>

</html>