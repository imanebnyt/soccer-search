<?php 
    $css = '<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">';
    $pageName = 'Suscribe Club - SoccerSearch';
    require 'ressources/header.php';
?>

<script>
    onload= ()=>{
        const err = document.querySelector("#err");
        const succes = document.querySelector("#succes");
    }
        

    
    let url = "https://us1.locationiq.com/v1/search";
    let data = "key=pk.f6fa35e331b50cb86b98353c9410c66e&q=" + "5 Allee du midi, 94310 Orly" + "&format=json";
    function sub(){
        const adresse = document.querySelector("#adresse").value;
        let data = "key=pk.f6fa35e331b50cb86b98353c9410c66e&q=" + adresse + "&format=json";
        $.ajax(
            {
                type: "GET",
                dataType: "JSON",
                url: url,
                data:data,
                error: function(){

                    if (adresse === ""){
                        err.innerHTML = "Il faut remplir tous les champs !";
                    }else{
                        err.innerHTML = "L'adresse doit etre erronnee";
                    }
                    succes.innerHTML= "";
                },
                success: function(result){
                    let LatLon = [];
                    LatLon.push(result[0]['lat']);
                    LatLon.push(result[0]['lon']);
                    

                const name = document.querySelector("#name").value;
                const nbAdherantsActuels = document.querySelector("#nbAdherantsActuels").value;
                const nbAdherantsMax = document.querySelector("#nbAdherentsMax").value;
                const AgeMin = document.querySelector("#AgeMin").value;
                

                
                $.ajax({url : "actions_php/InscriptionClub_traitement.php", 
                        method :"POST",
                        dataType : "json",
                        data : {
                            name: name,
                            nbAdherantsActuels : nbAdherantsActuels,
                            nbAdherantsMax : nbAdherantsMax,
                            AgeMin :AgeMin,
                            adresse : adresse,
                            validate : 'ok',
                            latitude : LatLon[0],
                            longitude : LatLon[1]
                        },
                        success : function(data){
                            console.log("Success")
                            succes.innerHTML= "Votre club a ete enregistree avec succes";
                            err.innerHTML= "";
                        },
                        error : function(data){
                            err.innerHTML = data['responseJSON'];
                            succes.innerHTML= "";
                        }
                     });
                },
            }
        )
    }

</script>

<div id="content">
    <?php require 'ressources/navbar.php'; ?>
</div>
<form method="POST" id="form" action="inscriptionClub.php">
    <label class="username">Nom du club</label>
    <input type="text" id="name" name="name" placeholder="Nom du club...">

    <label class="username">Nombre d'adherants maximum</label>
    <input type="number" id="nbAdherentsMax" name="nbAdherantsMax" placeholder="Nombre d'adherants maximum...">

    <label class="username">Nombre d'adherants actuels</label>
    <input type="number" id="nbAdherantsActuels" name="nbAdherantsActuels" placeholder="Nombre d'adherants Actuels...">

    <label class="username">Age minimum pour etre admis</label>
    <input type="number" id="AgeMin" name="AgeMin" placeholder="Age minimum...">

    <label class="username">Adresse du club</label>
    <input type="text" id="adresse"name="adresse" placeholder="Adresse...">

    <input type = "text" name="validate" value="Envoyer" style="cursor:pointer; margin-top:30px; padding-right:20px;font-size:3em;color:white;text-align:center; background-color:darkblue;" onclick="sub()">

    <label class="err" id="err"></label>
    <label class="err" style="color:green" id="succes"></label>
</form>
