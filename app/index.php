<html>

	<head>
		<style type="text/css">
			table{
				border-collapse:collapse;
			}
		</style>
	</head>

	<body>
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
			
			try{
				$query = "SELECT Id, FirstName, LastName, Phone from Contact LIMIT 5";
				$response = $mySforceConnection->query($query);
				$queryResult = new QueryResult($response);
	
				echo "Results of query '$query'<br/><br/>\n";
				
				?>
				<fieldset>
					<legend>Récupération de résultats dans Salesforce</legend>
				
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
		</fieldset>
		
		<fieldset>
			<legend>Formulaire pour créer un enregistrement dans Salesforce</legend>
			
		</fieldset>
	</body>

</html>
