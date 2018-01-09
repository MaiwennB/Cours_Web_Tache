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

	
// SUPPRESSION
if (isset ($_POST['value']))
{
	  $tasksuppr = $_POST['value'];
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
		

		