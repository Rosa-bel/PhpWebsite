<?php 
include_once("../app/views/PageView.php");
include_once("../app\controllers\Admin\LoginController.php");
include_once("../app/views\Users\Components\upperbarProfil.php");
include_once("../app\controllers\Users\ProfilController.php");
include_once("../app/views\Users\Components\membres\TypeCartes.php");

class PagePaiement extends PageView { 

    public function afficher() {

        echo '<html lang="en">';
      
        echo '<body>';
      

        $css = ['Users/Profil/Info.css' , 'Users/Profil/Paiement.css'] ;
        $this->entete($css, "Paiement");

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
            $result = $profilController->verifierAbonnement($_SESSION[USERKEY]);

            if (  $result['message'] == "Aucun abonnement trouvé" || $result['message'] == "Expiré") {
           

             $formcontroller = new FormController() ; 
             $input = $formcontroller->getForm("paiement") ; 
            $view = new InsertView(BASE_URL. "/Profil/Abonnements" , function ($data) use ($profilController) { $profilController->acheterCarte($data) ; 
              } , "Acheter une carte " , $input) ; 
              $view->afficher() ;

              $grillecartes = new TypeCartes();
              $grillecartes->afficher($result["card_info"] ?? "");


              } elseif ($result["message"] == "En attente de validation") {
                echo '<h2>En attente de vérification de votre carte</h2>';
              }else  {

             echo '<h2>Vous avez déjà un abonnement en cours</h2>';
            }

         
            echo '</div>';
        echo '</div>'; 
        echo '</div>'; 
    

        echo '</body>';
        
        echo '</html>';



    
    
    }
}
?>
