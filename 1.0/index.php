<!DOCTYPE html>
<html>
	<head>
		<LINK rel="stylesheet" type="text/css" href="style.css">
		<meta charset="utf-8">
	</head>

	<?php
		// Variables de connection à la BDD
		$hostname = "localhost";
		$username = "root";
		$password = "root";
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

	?>
	<body>
		<div>
			<H1>Liste des taches</H1>
			<ul>
				<?php  
					foreach ($taches as $tache) {
						echo '<form action="index.php" method="post" enctype="multipart/form-data">';
						echo("<li>");
						echo $tache["libelle"];
						echo '<input type="image" action="index.php" src="img/suppr.png" class="img" id="suppr" name="taskSupr" ></input>';
						echo '<input  type="hidden" name="id"  value="'.$tache["id"].'"></input></form>';
						echo "</li>";
					}
				?>
			</ul>
		</div>
		<div>	
			<form action="index.php" method="post" enctype="multipart/form-data">
				<H1>Ajouter</H1>
				<libelle>Tache : </libelle>
				<input type="textarea" name="libTache"></input>
				<input type="submit" name="valider" id="valider" value="Valider">
			<form>
		</div>
	</body>
</html>
