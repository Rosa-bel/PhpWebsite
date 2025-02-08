<?php 

include_once("../app/views/PageView.php");
include_once("../app\controllers\Admin\LoginController.php");
include_once("../app/views\Users\Components\upperbarProfil.php");
include_once("../app/views\Users\Components\membres\Carte.php");
include_once("../app\controllers\Users\ProfilController.php");

class PageInformations extends PageView { 

    public function afficher() {

        echo '<html lang="en">';
      
        echo '<body>';
      

        $css = ['Users/Profil/Info.css' , 'Users/Profil/card.css'] ;
        $this->entete($css, "Informations");

        echo '<div class="page-layout">';
        // Sidebar section profil
        echo '<aside class="sidebar">';
        $navbar = new NavBar("nav-profil", "Profil");
        $navbar->afficher();
        echo '</aside>';
    
        echo '<div class="main-content">';
            
            //affichage de la upper bar
            
            $navbar = new upperBarProfil();
            $navbar->afficher();
        
    
            //affichage des informations
            echo '<div class="info-display">';
            $profilController = new ProfilController();
            $card = new Carte();
           
            $info = $profilController->getInfoCarte($_SESSION[USERKEY]);
            $card->afficher($info);
            echo '</div>';
        echo '</div>'; 
        echo '</div>'; 
    

        echo '</body>';
        
        echo '</html>';



    
    
    }
}
?>
