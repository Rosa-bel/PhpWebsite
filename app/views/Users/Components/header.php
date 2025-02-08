<?php

require_once('../app/controllers/Users/PageComponentsController.php') ; 

Class HeaderView { 

    function afficher() { 

    //fetch the data du header 
    $controller = new PageComponentsController() ;
    $data = $controller->getInfoHeader() ; 

    $reseaux = $data["reseaux"] ; 
    
    echo '<div id="header-acceuil">' ; 
    echo '<div>' ; 
    $baseFolder = rtrim(BASE_URL, '/public');
         echo '<img src="'.$baseFolder.'/'.$data["logo"].'">';
         echo '<a href="'.BASE_URL.'/Acceuil"> Acceuil </a>' ; 
         echo '</div>';
         echo '<div>';
         foreach($reseaux as $reseau) { 
            echo '<a href="'.$reseau['lien'].'">'.$reseau['nom'].'<a>' ; 
         }
         echo '</div>';
    echo '</div>'; }


}








?>