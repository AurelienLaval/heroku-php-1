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
			require_once 'createConnexion.php';
			
			try{
				$query = "SELECT Id, FirstName, LastName, Phone from Contact ORDER BY CreatedDate DESC LIMIT 5";
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
			
			<form action="createContact.php" method="post">
				<table>
					<tr>
						<th>Nom : </th>
						<td><input type="text" name="lastname" /></td>
					</tr>
					<tr>
						<th>Prénom : </th>
						<td><input type="text" name="firstname" /></td>
					</tr>
					<tr>
						<th>Téléphone : </th>
						<td><input type="text" name="phone" /></td>
					</tr>
					<tr>
						<td><input type="submit" value="Valider" /></td>
					</tr>
				</table>
			</form>
		</fieldset>
	</body>
</html>
