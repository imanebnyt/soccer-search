<?php
	$css = '<link rel="stylesheet" href="css/candidature.css">';
	$pageName = 'Candidature - SoccerSearch';
	require 'ressources/header.php';
	require 'actions_php/candidature_traitement.php';
	if(!isset($_SESSION['logged']))
	header('Location: connexion.php');
?>

<body>
	<div id="content">
		<?php require 'ressources/navbar.php'; ?>
	
		<div id="title_frm">Demande d'inscription : <?php echo isset($_GET['NomClub'])?$_GET['NomClub']:'Nom du club inconnu';?></div>
		<form id="form" method="POST">

			<div id="form_l">
				<input id="in2" type="text" name="prenom" placeholder="Prénom" class="left"></input>
				<input id="in3" type="text" name="nom" placeholder="Nom de famille" class="right"></input>
			</div>	

			<input id="in1" type="mail" name="email" placeholder="adresse e-mail">
			<input id="in1" type="text" name="phonenumber" placeholder="Numéro de téléphone">
			<input id="in1" type="text" name="age" placeholder="Age">

			<input id="in1" type="submit" name="validate">

			<label class="err"><?php if(isset($errorMSG)){echo '<span class="errorMSG">'.$errorMSG.'</span>';}else{} ?></label>
			<label id="MesDemandes"><a href="mesdemandes.php">Mes demandes</a></label>
		</form>

		<?php require 'ressources/footer.php'; ?>
	</div>
</body>
</html>