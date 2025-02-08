<?php 
include_once("../app/views/Admin/Components/navbar.php");
include_once("../app/views/PageView.php");
include_once("../app/views/Users/Components/header.php");
include_once("../app/views/Users\Components\diaporama.php");
include_once("../app/views\Admin\Components/navbar.php");
include_once("../app/views\Users\Components/footer.php");


class Benevolat extends PageView { 

    public function afficher() { 

        echo '<html lang="en">';
      
        echo '<body>';
        $c = new LoginController() ; 
        $c->verifSessionUser() ; 

        $css = ['Users/Profil/Info.css' , 'Users/Profil/Paiement.css'] ;
        $this->entete($css, "Bénévolat");

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

         
            $formcont = new FormController() ; 
            $input = $formcont->getForm('benevolat') ;
            $c = new BenevolatDonController() ; 
    
            $view = new InsertView(BASE_URL. "/Profil/Benevolats" , function ($data) use ($c) { $c->benevolat($data) ; 
            } , "Bénévolat" , $input) ;
    
            $view->afficher() ;

          
            
        
            echo '</div>';
        echo '</div>'; 
        echo '</div>'; 
    

        echo '</body>';
        
        echo '</html>';
     
    }




}
?>
