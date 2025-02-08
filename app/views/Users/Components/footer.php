<?php

require_once('../app/controllers/Users/PageComponentsController.php') ; 

Class Footer { 

    function afficher() { 
 
   
        echo '<footer class="main-footer">';
        
        echo '<div class="footer-content">';
        
        // Social Media Column
        echo '<div class="footer-column">';
        echo '<h3>Follow Us</h3>';
        echo '<div class="social-links">';
        $controller = new PageComponentsController();
        $socials = $controller->getSocialMedia();

        foreach($socials as $social) {
            echo '<a href="'.$social['lien'].'" class="social-link">'.$social['nom'].'</a>';
        }
       
        echo '</div>';
        echo '</div>';
        
        // Navigation Column
        echo '<div class="footer-column">';
        echo '<h3>Nos services</h3>';
        echo '<a href="'.BASE_URL.'/Partenaires" class="social-link">Nos partenaires</a>';
        echo '<a href="'.BASE_URL.'/Remises" class="social-link">Remises</a>';
        echo '<a href="'.BASE_URL.'/Dons" class="social-link">Dons</a>';
        echo '</div>';
        
        // Auth Buttons Column
        echo '<div class="footer-column auth-buttons">';
        echo '<h3>Join Us</h3>';
        //session_start();
        if (isset($_SESSION[USERKEY])) {
        
            echo '<a href="'.BASE_URL.'/Logout" class="btn-logout">Déconnexion</a>';
        } else {
          
            echo '<a href="'.BASE_URL.'/Inscription" class="btn-register">S\'inscrire</a>';
            echo '<a href="'.BASE_URL.'/Login" class="btn-login">Se connecter</a>';
        }

      
        echo '</div>';
        
        echo '</div>';
        echo '</footer>';
    }
}








?>