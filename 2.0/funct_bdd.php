<?php
    function connectMysql(){
        // Ouverture du fichier environnement de l'application
        $filename = "envVar.ini";
        $ini_array =parse_ini_file ($filename,true);
        $HOST = $ini_array['MYSQL_HOST'];
        $BDD = $ini_array['MYSQL_BDD'];
        $USER = $ini_array['MYSQL_LOGIN']; 
        $PWD = $ini_array['MYSQL_PWD'];
        // Connection à la bdd
        try {
            $bdd =null;
            $bdd = new PDO("mysql:host=$HOST;dbname=$BDD", $USER, $PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $bdd;
    };
    function createTable(){
        $bdd =connectMysql();
        // Requette de selection
		$req = " CREATE TABLE IF NOT EXISTS `tache` (`id` int(11) NOT NULL,
        `libelle` varchar(340) NOT NULL)
        ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;";
        $bdd->query($req);
    };
    function selectTask(){
        $bdd =connectMysql();
        // Requette de selection
		$req = "SELECT * FROM tache ORDER BY id";
        $taches = $bdd->query($req);
        return $taches;
    };
    function addTask($newTask){
        $bdd =connectMysql();
        // Si le champ est vide, lancer une erreur
        if (empty ($newTask))
                echo $INFO = 'Veuillez renseigner le champ tâche';
        else
        {
            // Insertion dans la bdd
            $sql = ("INSERT INTO tache (`libelle`) VALUES(:newTask)");
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':newTask', $newTask);
        
            if ($stmt->execute())
            {
                $INFO = 'La news a été créé avec succès';
                header('Location: index.php');
            }
            //Si erreur lors de l'insertion	
            else
            {
                $INFO = "Erreur lors de l'insertion";
            }	
        }
        return $INFO;
    };
    function delTask($tasksuppr){
        $bdd = connectMysql();
        // Insertion dans la bdd
        $query = ("DELETE FROM tache WHERE id=(:tasksuppr)");
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':tasksuppr', $tasksuppr);
        if ($stmt->execute())
        {
            echo $INFO = 'Suppression réussi';
            header('Location: index.php');
        }
        else
        {
            echo $INFO = 'Erreur lors de la création de la tâche';
        }
        return $INFO;
    };

?>