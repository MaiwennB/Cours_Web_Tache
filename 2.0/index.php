<!DOCTYPE html>
<html>
	<head>
		<LINK rel="stylesheet" type="text/css" href="style.css">
		<meta charset="utf-8">
	</head>

	<?php
		require ('funct_bdd.php');
		createTable();
		$taches = selectTask();
		
		$INFO = "";

		// AJOUT
		if (isset ($_POST['valider']))
		{
			$newTask = $_POST['libTache'];
			$INFO = addTask($newTask);
		}
		// SUPPRESSION
		if (isset ($_POST['id']))
		{
		  	$tasksuppr = $_POST['id'];
			$INFO = delTask($tasksuppr);
		}
		message($INFO);

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
