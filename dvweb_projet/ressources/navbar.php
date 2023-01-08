<div id="nav_bar">
        <?php 
        if(isset($_SESSION['logged']) && $_SESSION['logged']){
            echo '<a href="mescandidatures.php"> Espace Club <br>';
            echo isset($_SESSION['username'])?$_SESSION['username']:''; 
            echo '<a/>';
        }else{
            echo '<a href="index.php">Trouver un club</a>';
        }
       ?>
    <img src="images/logo_couleur.png" alt="soccer search logo" onclick="location.href = 'index.php';">
    <?php	if(isset($_SESSION['logged']) && $_SESSION['logged'])
                echo '<a href="actions_php/deconnexion.php">déconnexion</a>';
            else
                echo '<a href="connexion.php">se connecter</a>';
    ?>
</div>