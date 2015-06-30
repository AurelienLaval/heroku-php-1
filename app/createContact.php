<html>

	<head></head>

	<body>

		<?php
			require_once 'createConnexion.php';
			
			try{
				$records = array();

				$records[0] = new SObject();
				$records[0]->fields = array(
				    'FirstName' => $_POST[''],
				    'LastName' => $_POST[''],
				    'Phone' => $_POST[''],
				);
				$records[0]->type = 'Contact';
				
				$response = $mySforceConnection->create($records);
			}catch(Exception $e){
				echo "Erreur à la création d'un contact :" . $e.getMessage();
			}
		?>

		Bla bla !
	</body>
</html>
