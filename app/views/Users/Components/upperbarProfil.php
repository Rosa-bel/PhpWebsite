<?php

require_once('../app/controllers/Users/PageComponentsController.php') ; 

Class upperBarProfil { 

    function afficher() { 
    $c = new ProfilController() ; 
    $username = $c->getMembrePrenom($_SESSION[USERKEY])['prenom'] ;
    echo '<div class="upper-bar">';
    echo '<div class="user-info">Welcome, '. $username . '</div>'; // Replace 'Username' dynamically
    echo '<div class="links">';
    echo '<a href="'.BASE_URL.'/Acceuil"> Revenir à l\'acceuil </a>' ; 
    echo '</div>';
    echo '</div>';
    echo '</div>';

}


}



?>





