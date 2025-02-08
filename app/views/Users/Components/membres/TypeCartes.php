<?php

require_once('../app/controllers/Users/PageComponentsController.php');
require_once('../app/controllers/Users/ProfilController.php');

class TypeCartes {

    function afficher($message) {
        $cartecontroller = new ProfilController();
        $cartes = $cartecontroller->getCarteAbonnement();

       
        echo '<div class="message-title">';
        echo '<h2>' . htmlspecialchars($message) . '</h2>';
        echo '</div>';

   
        echo '<div class="card-grid">';
        
        foreach ($cartes as $carte) {
      
            echo '
            <div class="card">
                <h2 class="card-title">' . htmlspecialchars($carte['nom']) . '</h2>
                <p class="card-price">Prix: ' . htmlspecialchars($carte['prix']) . ' DA/an</p>
                <p class="card-description">' . htmlspecialchars($carte['description']) . '</p>
            </div>';
        }

       
        echo '</div>';
    }
}
?>
