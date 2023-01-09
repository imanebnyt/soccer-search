<?php
if(session_status() == 1){
    session_start();
}

try{
    $bdd = new PDO('mysql:host=localhost;dbname=soccersearch;charset=utf8', 'root', '');
}catch(Exception $e){
    die('Erreur : '. $e->getMessage());
}

//Le code SQL de la table si elle existe pas chez vous

// CREATE TABLE Utilisateurs(
    // idUser INT,
    // username VARCHAR(25),
    // userPassword VARCHAR(100),
    // PRIMARY KEY(id),
    // UNIQUE(username)
//  );
 