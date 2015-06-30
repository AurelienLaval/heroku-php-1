<html>

	<head>

	</head>

	<body>
		<h1>Test !</h1>

		<?php
			try{
				error_reporting(E_ALL);
	
				define("USERNAME", $_GET['username']);
	
				define("SECURITY_TOKEN", $_GET['token']); 
	
				require_once ('soapclient/SforcePartnerClient.php'); 
	
				$mySforceConnection = new SforcePartnerClient();
	
				$mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
	
				$mySforceConnection->login(USERNAME, SECURITY_TOKEN);
	
				$query = "SELECT Id, FirstName, LastName, Phone from Contact";
				$response = $mySforceConnection->query($query);
				$queryResult = new QueryResult($response);
	
				echo "Results of query '$query'<br/><br/>\n";
				
				?>
				
				<table border="1">
					<tr>
						<th>Id</th>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Phone</th>
					</tr>
					<?php
					
					for ($queryResult->rewind(); $queryResult->pointer < $queryResult->size; $queryResult->next()) {
					    $record = $queryResult->current();
					    
					    echo "<tr>";
					    	echo "<td>" . $record->Id . "</td>";
					    	echo "<td>" . $record->fields->FirstName . "</td>";
					    	echo "<td>" . $record->fields->LastName . "</td>";
					    	echo "<td>" . $record->fields->Phone . "</td>";
					    echo "</tr>";
					}
					?>
				</table>
				
				<?php
			}catch(Exception $e){
				echo 'Exception reçue : ',  $e->getMessage(), "\n";
			}
		?>

	</body>

</html>
