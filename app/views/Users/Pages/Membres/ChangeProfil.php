<?php 

include_once("../app/views/PageView.php");
include_once("../app\controllers\Admin\LoginController.php");
include_once("../app/views\Users\Components\upperbarProfil.php");
include_once("../app/views\Users\Components\membres\Carte.php");
include_once("../app\controllers\Users\ProfilController.php");

class PageChangeProfil extends PageView { 

    public function afficher() {

        echo '<html lang="en">';
      
        echo '<body>';
        $c = new LoginController() ; 
        $c->verifSessionUser() ; 

        $css = ['Users/Profil/Info.css' , 'Users/Profil/ChangeProfile.css'] ;
        $this->entete($css, "Modifier-Infos");

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
           
    
            //affichache de la section modifier informations
            echo '<div class="info-display">';

            $formcontroller = new FormController() ; 
            $input = $formcontroller->getForm("profil") ; 
            $profilcont = new ProfilController() ; 

            
            $info = $profilcont->getInfoMembre($_SESSION[USERKEY]) ; 
            $data['Nom'] = $info['nom'] ;
            $data['Prénom'] = $info['prenom'] ;
            $data['Photo'] = $info['photo'] ;
            $data['id'] = $info['id'] ;
          
            $view = new ModifyView( BASE_URL. "/Profil" , function ($id , $data) use ($profilcont) { $profilcont->updateMembreInfo($id , $data) ; 
            } , "Mes informations" , $input) ; 

            $view->afficher($data) ;
            
        
            echo '</div>';
        echo '</div>'; 
        echo '</div>'; 
    

        echo '</body>';
        
        echo '</html>';



    
    
    }
}
?>
