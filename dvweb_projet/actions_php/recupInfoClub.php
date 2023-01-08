<?php
$req = $bdd->prepare("SELECT * FROM clubfoot");
$req->execute();
$clubs = $req->fetchAll();
