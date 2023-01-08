<?php
    $css = '<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/login.css">';
    if(isset($_SESSION['logged']) && $_SESSION['logged'])
        header('Location: index.php');
	$pageName = 'LogIn - SoccerSearch';
	require 'ressources/header.php';
    require 'actions_php/connexion_traitement.php';
?>
<div id="content">
    <?php require 'ressources/navbar.php'; ?>
</div>
<form method="POST">
    <label class="username">Nom d'utilisateur</label>
        <input type="text" name="username" placeholder="Nom d'utilisateur">
    <label class="password">Mot de passe</label>
        <input type="password" name="password" placeholder="Mot de passe">
	<label class="password">Validation de Mot de passe</label>
        <input type="password" name="passwordconfirm" placeholder="Mot de passe">
    <label class="validate">Crée compte</label>
		<div class="submit"><div id="txt">Soumettre</div></div>
    <label class="err"><?php if(isset($errorMSG)){echo '<span class="errorMSG">'.$errorMSG.'</span>';}else{} ?></label>
	<label class="creat">Si vous avez déjà un compte : <a href="connexion.php">Se connecter</a></label>
</form>
<?php require 'ressources/footer.php'; ?>