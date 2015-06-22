<html>

	<head>

	</head>

	<body>
		<h1>Test !</h1>

		<?php
			//echo file_get_contents("soapclient/partner.wsdl.xml");

			//echo phpinfo();

			error_reporting(E_ALL);

			define("USERNAME", $_GET['username']);

			define("PASSWORD", $_GET['password']);

			define("SECURITY_TOKEN", $_GET['token']); 

			require_once ('soapclient/SforcePartnerClient.php'); 

			$mySforceConnection = new SforcePartnerClient();

			$mySforceConnection->createConnection("soapclient/partner.wsdl.xml");

			$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

			$query = "SELECT Id, FirstName, LastName, Phone from Contact";
			$response = $mySforceConnection->query($query);
			$queryResult = new QueryResult($response);

			echo "Results of query '$query'<br/><br/>\n";
			for ($queryResult->rewind(); $queryResult->pointer < $queryResult->size; $queryResult->next()) {
			    $record = $queryResult->current();
			    // Id is on the $record, but other fields are accessed via
			    // the fields object
			    echo $record->Id.": ".$record->fields->FirstName." "
			            .$record->fields->LastName." "
			            .$record->fields->Phone."<br/>\n";
			}
		?>

	</body>

</html>
