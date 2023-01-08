<?php
require_once 'actions_php/bdd.php';

$validChar = array('.', '-', '_'); //caractères spéciaux valides pour le mot de passe

if(isset($_POST['validate'])){ //si bouton valider est cliqué
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['passwordconfirm'])){ //si rien n'est vide
        if(ctype_alnum(str_replace($validChar, '', $_POST['username']))){ //si aucun caractère interdit
            if($_POST['password'] == $_POST['passwordconfirm']){ //si les mdp sont pareils
                if(strlen($_POST['username']) >= 3){ //si username > 3
                    if(strlen($_POST['password']) >= 8){ //si mdp > 8
                        if($_POST['username'] != $_POST['password']){// si le mdp et l'username sont different

                            $username = htmlspecialchars($_POST['username']);
                            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                            //requette de recherche d'occurence du nom d'utilisateur
                            $userAlreadyExists = $bdd->prepare('SELECT username from utilisateurs where username = :usernameToSearch');
                            $userAlreadyExists->bindParam(':usernameToSearch', $username);
                            $userAlreadyExists->execute();

                            if($userAlreadyExists->rowCount() == 0){ //si le pseudo n'a pas été trouvé

                                //requette d'insertion d'utilisateur en bdd
                                $insertUser = $bdd->prepare('INSERT INTO utilisateurs(username, userPassword) VALUES(:username, :userPassword)');
                                $insertUser->bindParam(':username', $username);
                                $insertUser->bindParam(':userPassword', $password);
                                $insertUser->execute();

                                //requette de récupération de l'id de l'utilisateur
                                $getuserInfos = $bdd->prepare('SELECT idUser FROM utilisateurs WHERE username = :username');
                                $getuserInfos->bindParam(':username', $username);
                                $getuserInfos->execute();
                                $userInfos = $getuserInfos->fetch();
                                
                                //initialise les variables de session
                                $_SESSION['logged'] = true;
                                $_SESSION['idUser'] = $userInfos['idUser'];
                                $_SESSION['username'] = $username;

                                header('Location: index.php');
                                exit();
                            }else{
                                $errorMSG = 'Le nom d\'utilisateur est déjà utilisé';
                            }
                        }else{
                            $errorMSG = 'Le mot de passe ne peut pas être identique au nom d\'utilisateur';
                        }
                    }else{
                        $errorMSG = 'Le mot de passe doit contenir au moins 8 caractères';
                    }
                }else{
                    $errorMSG = 'Le nom d\'utilisateur doit contenir au moins 3 caractères';
                }
            }else{
                $errorMSG = 'Les mots de passe sont différents';
            }
        }else{
            $errorMSG = 'Les seuls caractères spéciaux autorisés sont (- , _ , .)';
        }
    }else{
        $errorMSG = 'Veuillez compléter tout les champs';
    }
}