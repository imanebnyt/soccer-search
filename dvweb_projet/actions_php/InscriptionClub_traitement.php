
<?php

require_once 'bdd.php';


if(isset($_POST['validate'])){//si bouton valider est cliqué
    if(!empty($_POST['name']) && !empty($_POST['nbAdherantsMax']) && !empty($_POST['AgeMin']) && !empty($_POST['adresse']) && !empty($_POST['nbAdherantsActuels'])){ //si rien n'est vide nbAdherantsActuels

        if($_POST['AgeMin']< 6 || $_POST['AgeMin']>100){
            $errorMSG = "L'age minimum doit etre compris entre 6 et 100 ans !";
        }
        if($_POST['nbAdherantsActuels'] <=0 || $_POST['nbAdherantsMax'] <= 0){
            $errorMSG = "Le nombre d'adherants et le nombre d'adherants maximum doivent etre superieurs a 0 !";
        }
        if($_POST['nbAdherantsActuels'] > $_POST['nbAdherantsMax']){
            $errorMSG = "Le nombre d'adherants actuel doit etre plus petit que le nombre d'adherants maximum !" ;
        }

        if(!isset($errorMSG)){
            $name = htmlspecialchars($_POST['name']);
            $nbAdherantsMax = htmlspecialchars($_POST['nbAdherantsMax']);
            $AgeMin = htmlspecialchars($_POST['AgeMin']);
            $adresse = htmlspecialchars($_POST['adresse']);
            $longitude = htmlspecialchars($_POST['longitude']);
            $latitude = htmlspecialchars($_POST['latitude']);

            $clubExist = $bdd->prepare('SELECT * FROM clubfoot WHERE NomClub = :NomClub OR Adresse = :adresse'); //prepare la requette get info user
            $clubExist->bindParam(':NomClub', $name);
            $clubExist->bindParam(':adresse', $adresse); //donne le paramètre username a la requette pour chercher
            $clubExist->execute();


            if($clubExist->rowCount() > 0){
                $errorMSG = 'Ce club existe deja !';
            }else{
                $insertClub = $bdd->prepare('INSERT INTO clubfoot(`Adresse`, `latitude`, `longitude`, `age`, `Nbr_adh`, `Nbr_adh_max`, `NomClub`)
                VALUES(:Adresse,:latitude , :longitude , :age, :Nbr_adh, :Nbr_adh_max, :NomClub)');
                $insertClub->bindParam(':Adresse', $adresse);
                $insertClub->bindParam(':age', $AgeMin);
                $insertClub->bindParam(':Nbr_adh', $AgeMin);
                $insertClub->bindParam(':Nbr_adh_max', $nbAdherantsMax);
                $insertClub->bindParam(':NomClub', $name);
                $insertClub->bindParam(':longitude', $longitude);
                $insertClub->bindParam(':latitude', $latitude);
                $insertClub->execute();
                $Success = "Club enregistree !";
            }
        }
    }else{
        $errorMSG = 'vous devez remplir tout les champs !';
    }
}
if(isset($errorMSG)){
    header('HTTP/1.1 302 ');
    die(json_encode($errorMSG));
}
else{
    die(json_encode($Success));
}
