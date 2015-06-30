<html>

	<head></head>

	<body>

		<?php
			require_once 'createConnexion.php';
			
			try{
				$records = array();

				$records[0] = new SObject();
				$records[0]->fields = array(
				    'FirstName' => $_POST['firstname'],
				    'LastName' => $_POST['lastname'],
				    'Phone' => $_POST['phone'],
				);
				$records[0]->type = 'Contact';
				
				$response = $mySforceConnection->create($records);
				?>
				Contact correctement créé !<br/>
				<table>
					<tr>
						<th>Id : </th>
						<td><?php echo $response[0]->Id; ?></td>
					</tr>
					<tr>
						<th>Nom : </th>
						<td><?php echo $response[0]->LastName; ?></td>
					</tr>
					<tr>
						<th>Prénom : </th>
						<td><?php echo $response[0]->FirstName; ?></td>
					</tr>
					<tr>
						<th>Téléphone : </th>
						<td><?php echo $response[0]->Phone; ?></td>
					</tr>
				</table><br/>
				<?php
			}catch(Exception $e){
				echo "Erreur à la création d'un contact :" . $e.getMessage();
			}
		?>
		
		<a href="/index.php?username=<?php echo USERNAME; ?>&token=<?php echo SECURITY_TOKEN; ?">Retour à la page principale</a>
	</body>
</html>
