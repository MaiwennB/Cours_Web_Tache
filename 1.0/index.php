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

		// Requette de selection
		$req = " CREATE TABLE IF NOT EXISTS `tache` (`id` int(11) NOT NULL,
	  												`libelle` varchar(340) NOT NULL)
				ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;";
		$taches = $bdd->query($req);
		// Requette de selection
		$req = "SELECT * FROM tache ORDER BY id";
		$taches = $bdd->query($req);
		
		$m = new Mustache_Engine(array(
			'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views'),
		));
		echo $m->render("liste", array('taches'=> $taches));



		// AJOUT
		if (isset ($_POST['valider']))
		{
			$newTask = $_POST['libTache'];
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

		// SUPPRESSION
		if (isset ($_POST['id']))
		{
		  	$tasksuppr = $_POST['id'];
			// Insertion dans la bdd
			$query = ("DELETE FROM tache WHERE id=(:tasksuppr)");
			$stmt = $bdd->prepare($query);
			$stmt->bindParam(':tasksuppr', $tasksuppr);
			if ($stmt->execute())
			{
				echo $info = 'Suppression réussi';
				header('Location: index.php');
			}
			else
			{
			echo $info = 'Erreur lors de la création de la tâche';
			}
		}