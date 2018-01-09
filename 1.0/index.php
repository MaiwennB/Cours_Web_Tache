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

