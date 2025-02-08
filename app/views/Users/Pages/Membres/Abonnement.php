<?php 

include_once("../app/views/PageView.php");
include_once("../app\controllers\Admin\LoginController.php");
include_once("../app/views\Users\Components\upperbarProfil.php");
include_once("../app/views\Users\Components\membres\Datatable.php");
include_once("../app\controllers\Users\ProfilController.php");

class UserPageAbonnement extends PageView { 

    public function afficher() {

        echo '<html lang="en">';
      
        echo '<body>';
        $c = new LoginController() ; 
        $c->verifSessionUser() ; 

        $css = ['Users/Profil/Info.css' , 'Users/Profil/DataTable.css'] ;
        $this->entete($css, "Abonnement");

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
           
    
          
            echo '<div class="info-display">';

         
            $profilcont = new ProfilController() ; 
            $abonnements = $profilcont->getAbonnements() ;
            $headers = [] ; 
            if (!empty($abonnements) && is_array($abonnements)) {
                $headers = array_keys($abonnements[0]);
               }
            $datatable = new DataTable("Mes abonnements" , $headers , $abonnements) ;
            $datatable->afficher() ;

          
            
        
            echo '</div>';
        echo '</div>'; 
        echo '</div>'; 
    

        echo '</body>';
        
        echo '</html>';



    
    
    }
}
?>
