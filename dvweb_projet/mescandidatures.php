<?php
    $css = '<link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/mescandidatures.css">';
	$pageName = 'Mes Candidatures - SoccerSearch';
	require 'ressources/header.php';
    require 'actions_php/bdd.php';
	if(!isset($_SESSION['logged']))
	    header('Location: connexion.php');
?>

<body>
    <?php require 'ressources/navbar.php' ?>

    <?php
    
    $getCandidature = $bdd->prepare('SELECT `IdClub`, `Nom`, `Prénom`, `email`, `numTel`, `age` FROM `candidature` WHERE IdUtil = :IdUtil'); //prepare la requette
    $getCandidature->bindParam(':IdUtil', $_SESSION['IdUser']); //donne le paramètre IdUtil a la requette pour chercher
    $getCandidature->execute();
    
    $lesCandidature = $getCandidature->fetchAll();

    // Définition des dimensions du tableau
    $lignes = count($lesCandidature);
    $colonnes = count($lesCandidature[0])/2;

    $getNomClubs = $bdd->prepare('SELECT NomClub FROM clubfoot WHERE IdClub IN (SELECT IdClub FROM candidature)');
    $getNomClubs->execute();
    $getNomClubs = $getNomClubs->fetchAll();

    // Génération du tableau
    $columns = array('Club', 'Nom', 'Prénom', 'Email', 'Numéro de téléphone', 'Age renseigné', 'Annuler');

    echo '<table>';
    echo '<tr>';
    foreach ($columns as $column) { //crée les titres de colonnes
    echo '<th>' . $column . '</th>';
    }
    echo '</tr>';

    $row_colors = array('#f6f6f6', '#ffffff'); //permettra d'alterner les couleurs de chaque lignes avec $i et un modulo
    $i = 0;

    for ($l = 0; $l < $lignes; $l++) {
        $color = $row_colors[$i % 2];
        echo '<tr style="background-color: ' . $color . '">';
        echo '<td>' . $getNomClubs[$l][0] . '</td>';
        for ($c = 0; $c < $colonnes-1; $c++) {
            echo '<td>' . $lesCandidature[$l][$c+1] . '</td>';
        }
        echo '<td>' . '<p onclick="deleteCandidature(' . $c . ')">Supprimer</p>' . '</td>';
        echo '</tr>';
        $i++;
    }
    echo '</table>';
    ?>

    <!-- <script type="text/javascript">
        function deleteCandidature(ligne){	
            console.log(ligne);
            <?php ?>
        }
    </script> -->

</body>


