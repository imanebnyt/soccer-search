<?php
require_once 'actions_php/bdd.php';

$NomClub = $_GET['NomClub'];
$IdClub = $_GET['IdClub'];
$IdUtil = $_SESSION['IdUser'];

if(isset($_POST['validate'])){//si bouton valider est cliqué
    if( !empty($_POST['prenom']) && 
        !empty($_POST['nom']) &&
        !empty($_POST['email']) &&
        !empty($_POST['phonenumber']) &&
        !empty($_POST['age'])
        ){ //si rien n'est vide

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $phonenumber = htmlspecialchars($_POST['phonenumber']);
        $age = htmlspecialchars($_POST['age']);

        $demandeExist = $bdd->prepare('SELECT * FROM candidature WHERE IdUtil = :IdUtil And IdClub = :IdClub'); //prepare la requette
        $demandeExist->bindParam(':IdUtil', $IdUtil); //donne le paramètre IdUtil a la requette pour chercher
        $demandeExist->bindParam(':IdClub', $IdClub); //donne le paramètre IdClub a la requette pour chercher
        $demandeExist->execute();

        if($demandeExist->rowCount() == 0){ //si un aucne demande avec ces deux infos sont trouvées alors

                $sql = "INSERT INTO candidature (IdUtil, IdClub, Nom, Prénom, email, numTel, age)
                        VALUES (:IdUtil, :IdClub, :nom, :prenom, :email, :phonenumber, :age)";
                        
                $trt = $bdd->prepare($sql);
                $trt->execute(array(':IdUtil' => $IdUtil, ':IdClub' => $IdClub, ':nom' => $nom, ':prenom' => $prenom, ':email' => $email,       ':phonenumber' => $phonenumber, ':age' => $age));

                header('Location: candidatureconfirmee.php');
                exit();
        }else{
            $errorMSG = 'Demande pour ce club déjà réalisée';
        }
    }else{
        $errorMSG = 'Veuillez compléter tout les champs';
    }
}