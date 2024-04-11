$(document).ready(function(){
    //Inverse l'état de visibilité de h1 lors d'un clic sur #b1     
    $("#car").change(function(){
        $("#voiture").toggle();
        $("#voiture2").toggle();

    });
});