<?php
		require_once 'vendor/autoload.php';
		// Variables de connection à la BDD
		$hostname = "localhost";
		$username = "root";
		$password = "pwsio";
		$dbname = "students";
		$bdd =null;

		// Connection à la bdd
		try {
			$bdd = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	


		// AJOUT
		if (isset ($_POST['value']))
		{
			$newTask = $_POST['value'];
			// Si le champ est vide, lancer une erreur
			if (empty ($newTask))
					echo $info = 'Veuillez renseigner le champ tâche';
			else
			{
				// Insertion dans la bdd
				$sql = ("INSERT INTO tache (`libelle`) VALUES(:newTask)");
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':newTask', $newTask);
			
				if ($stmt->execute())
				{
					$info = 'La news a été créé avec succès';
					header('Location: index.php');
				}
				//Si erreur lors de l'insertion	
				else
				{
					echo$info = "Erreur lors de l'insertion";
				}	
		  	}
		}
		

		