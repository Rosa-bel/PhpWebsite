<?php 

include_once("../app/views/PageView.php");
include_once("../app\controllers\Admin\LoginController.php");
include_once("../app/views\Users\Components\upperbarProfil.php");
include_once("../app/views\Users\Components\membres\Datatable.php");
include_once("../app\controllers\Users\ProfilController.php");

class UserDemandeAide extends PageView { 

    public function afficher() {

        echo '<html lang="en">';
      
        echo '<body>';
        $c = new LoginController() ; 
        $c->verifSessionUser() ; 

        $css = ['Users/Profil/Info.css' , 'Users/Profil/Paiement.css'] ;
        $this->entete($css, "Demande d'aide");

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
            $aideController = new BenevolatDonController() ;
            $formcontroller = new FormController() ; 
            $input = $formcontroller->getForm("demandeaide") ; 
           $view = new InsertView(BASE_URL. "/Profil" , function ($data) use ($aideController) { $aideController->demanderAide($data) ; 
             } , "Demande aide " , $input) ; 
             $view->afficher() ;

          
            
        
            echo '</div>';
        echo '</div>'; 
        echo '</div>'; 
    

        echo '</body>';
        
        echo '</html>';



    
    
    }
}
?>
