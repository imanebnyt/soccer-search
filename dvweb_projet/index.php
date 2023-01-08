<?php
	$css = '<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="crossorigin=""/>';
	$js = '<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="crossorigin=""></script>';
	$pageName = 'Accueil - SoccerSearch';
	require 'ressources/header.php';
	require 'actions_php/bdd.php';
	require 'actions_php/recupInfoClub.php';
?>
<!-- a faire en PHP
	améliorer traitement candidature : on peut modifier l'url /!\ on peut ecrire nimporte quoi dans les champs etc 
	faire fonctionner les filtres dans l'index ou ya la map
	Faire fonctionner le bouton supprimer de la rubrique mescandidatures
	afficher plus de markers
	mettre le js dans des fichiers séparer
	Agemin agemax marchent pas le GET es pas défini
-->
<body>
	<div id="content">
		<div id="banniere">
			<div id="nav_bar">
					<?php 
					if(isset($_SESSION['logged']) && $_SESSION['logged']){
						echo '<a href="mescandidatures.php">Espace Club<br>';
						echo isset($_SESSION['username'])?$_SESSION['username']:''; 
						echo '<a/>';
					}else{
						echo '<a href="#title_rcu">Trouver un club</a>';
					}
				?>
				<img src="images/logo_gris.png" alt="soccer search logo" onclick="location.href = 'index.php';">
				<?php	if(isset($_SESSION['logged']) && $_SESSION['logged'])
							echo '<a href="actions_php/deconnexion.php">déconnexion</a>';
						else
							echo '<a href="connexion.php">se connecter</a>';
				?>
			</div>
			<div id="txt_ban">Trouves le club qui te conviens dès aujourd’hui</div>
			<div id="bouton">
				<a href=""><div id="txt_btn">Rechercher un club</div></a>
			</div>
		</div>
		<div id="search_club">
			<div id="title_rcu">Rechercher un club</div>
			<input id="in1"></input>
			<div id="filtre">
				<div id="Tranche_dage">
					<label for="ageRangeSelect">Tranche d'âge :</label>
					<select id="ageRangeSelect">
					<option value="0, 100">-</option>
					<option value="6,12">6 - 12 ans</option>
					<option value="13,17">13 - 17 ans</option>
					<option value="18,45">+ 18 ans</option>
					</select>
				</div>
			</div>
			<div id="mapid">

			</div>			
		</div>	
		
		<script type="text/javascript">
			// Afficher la MAP
			var map = L.map('mapid').setView([48.88, 2.33], 10.5);
			L.tileLayer('https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=zXWma8gDUYjZyNg2h6Y5', {attribution :'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',}).addTo(map);
			function ajaxPlacerMarqueurs(ageMin, ageMax){
				<?php
				echo 'let url; let data;';
				foreach($clubs as $club): ?>
					if(ageMax > <?php echo $club['age'] ?> && <?php echo $club['age'] ?> > ageMin){
				<?php
						echo 'url = "https://us1.locationiq.com/v1/search";
						data = "key=pk.f6fa35e331b50cb86b98353c9410c66e&q=' . $club['Adresse'] . '&format=json";';
						echo '$.ajax({
							type: "GET",
							dataType: "JSON",
							url: url,
							data:data,
							error: function(){console.log("pb in .ajax")}, 
							success: function(result){';
								echo 'Marqueur_bdd= L.marker([result[0].lat, result[0].lon]).addTo(map).bindPopup("';
								echo $club['NomClub'] . '<br> Age minimal : ' .
								$club['age'] . '<br> Adresse :' .
								$club['Adresse'] . '<br> Complet : ';
								if($club['Nbr_adh_max'] - $club['Nbr_adh'] <= 0){
									echo'Oui <br>';
								}
								else{
									echo'Non <br>';
								}
								echo '<a onclick=hrefCandidature(\"' . str_replace(" ", "&nbsp;", $club['NomClub']) . '\",' . $club['IdClub'] . ');>S\'inscrire</a>");}';
						echo '});'; ?>
					}
				<?php
				endforeach;
			?>
		}

		function hrefCandidature(NomClub, IdClub){	
			window.location.href = "candidature.php?NomClub=" + NomClub + "&IdClub=" + IdClub;
		}

		document.getElementById("ageRangeSelect").addEventListener("change", function(event) {
			// Suppression de tous les marqueurs de la carte
			map.eachLayer(function(layer) {
				if (layer instanceof L.Marker) {
				map.removeLayer(layer);
				}
			});
			ageslimites = event.target.value.split(',');
			[ageMin, ageMax] = ageslimites;
			// window.location.href = "index.php#title_rcu?filtreageMin=" + ageMin + "&filtreageMax=" + ageMax;
			ajaxPlacerMarqueurs(ageMin, ageMax);
		});

		ajaxPlacerMarqueurs(0, 100);

		$(document).ready();
	</script>
	<div id="appd">
			À propos de Soccer Search
		</div>
		<div id="appd1">
			<div id="img1"><img src="images/img1.png" alt="img1"></div>
			<div id="txt1">Soccer Search est le moteur de recherche numéro 1 un France pour trouver un club de Football à proximité et y candidater en quelques minutes.</div>
		</div>
		<div id="appd2">
			<div id="img2"><img src="images/img2.png" alt="img2"></div>
			<div id="txt2">Trouvez un club partout en France métropolitaine, quelque soit votre niveau ou tranche d’age</div>
		</div>
		<?php require 'ressources/footer.php'; ?>
	</div>
</body>
</html>