<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<style type="text/css">
			table{
				border-collapse:collapse;
			}
		</style>
	</head>

	<body>
		<div>
			Ceci une page de test pour interfacer Heroku avec Salesforce !<br/><br/>
			Comment essayer ?<br/><br/>
			Rien de plus simple !<br/><br/>
			Il suffit d'ajouter votre nom d'utilisateur (paramètre 'username') ainsi que votre mot de passe et votre jeton de sécurité (paramètre 'token')<br/>
			à l'URL au dessus sous la forme de : ?username=myUsername&token=myPasswordMyToken<br/><br/>
			Enjoy !<br/><br/><br/>
		</div>
		
		<?php
			if(!empty($_GET['username']) && !empty($_GET['token'])){
				echo urldecode('a%40%2129011990QI5xcOaJAvmtfN92QqnUHwVvr');
				
				require_once 'createConnexion.php';
			
				try{
					$query = "SELECT Id, FirstName, LastName, Phone from Contact ORDER BY CreatedDate DESC LIMIT 5";
					$response = $mySforceConnection->query($query);
					$queryResult = new QueryResult($response);
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
		
		<br/><br/>
		
		<fieldset>
			<legend>Formulaire pour créer un enregistrement dans Salesforce</legend>
			
			<form action="createContact.php?username=<?php echo USERNAME; ?>&token=<?php echo SECURITY_TOKEN; ?>" method="post">
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

		<?php
		}else{
				?>
				<fieldset>
					<form action="index.php" method="GET">
						<table>
							<tr>
								<th>Nom d'utilisateur : </th>
								<td><input type="text" name="username" /></td>
							</tr>
							<tr>
								<th>Mot de passe et jeton de sécurité :</th>
								<td><input type="text" name="token" /></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Valider" /></td>
							</tr>
						</table>
					</form>
				</fieldset>
				<?php
			}
		?>
	</body>
</html>
