<?php
$css = '<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/demande.css">';
$pageName = 'Demande - SoccerSearch';
require 'ressources/header.php';
?>

<body>
    <div class = "container">
    <?php require 'ressources/navbar.php'; ?>
        <section class = "demande">
            <div class = "demande-container">
                <div class = "red-title">Votre demande à bien été prise en compte</div>
                <div class = "bold-text">Le club choisi vous recontactera dans les plus brefs délais. Merci d’avoir utilisé Soccer Search</div>
                <button class = "button"><a href = "index.php">Retour à l'accueil</a></button>
            </div>
        </section>
        <?php require 'ressources/footer.php'; ?>
    </div>
</body>
</html>