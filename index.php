<html>

	<head>

	</head>

	<body>
		<h1>Test !</h1>

		<?php
			error_reporting(E_ALL);

			define("USERNAME", $_GET['username']);

			define("PASSWORD", $_GET['password']);

			define("SECURITY_TOKEN", $_GET['token']); 

			require_once ('soapclient/SforcePartnerClient.php'); 

			$mySforceConnection = new SforcePartnerClient();

			$mySforceConnection->createConnection("partner.wsdl.xml");

			$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

			$query = "SELECT Id, FirstName, LastName, Phone from Contact";
			$response = $mySforceConnection->query($query);

			echo "Results of query '$query'<br/><br/>\n";
			foreach ($response->records as $record) {
			    echo $record->Id . ": " . $record->FirstName . " "
			        . $record->LastName . " " . $record->Phone . "<br/>\n";
			}
		?>

	</body>

</html>