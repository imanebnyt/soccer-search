<?php
require_once 'actions_php/bdd.php';

if(isset($_POST['validate'])){//si bouton valider est cliqué
    if(!empty($_POST['username']) && !empty($_POST['password'])){ //si rien n'est vide

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $userExist = $bdd->prepare('SELECT * FROM utilisateurs WHERE username = :username'); //prepare la requette get info user
        $userExist->bindParam(':username', $username); //donne le paramètre username a la requette pour chercher
        $userExist->execute();

        if($userExist->rowCount() > 0){ //si un utilisateur avec cet username est trouvé alors
            $userInfos = $userExist->fetch(); //converti le resultat de requette en tableau exploitable en php
            if(password_verify($password, $userInfos['userPassword'])){ 
                $_SESSION['userInfos'] = $userInfos;
                $_SESSION['logged'] = true;
                $_SESSION['IdUser'] = $userInfos['IdUser'];
                $_SESSION['username'] = $userInfos['username'];
                header('Location: index.php');
                exit();
            }else{
                $errorMSG = 'Mot de passe incorrect';
            }
        }else{
            $errorMSG = 'Aucun compte associé à ce nom d\'utilisateur';
        }
    }else{
        $errorMSG = 'Veuillez compléter tout les champs';
    }
}