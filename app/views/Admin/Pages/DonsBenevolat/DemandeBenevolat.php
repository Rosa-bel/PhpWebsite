<?php 
include_once("../app/views/Admin/Components/navbar.php");
include_once("../app/views/PageView.php");
include_once("../app\controllers\Admin\BenevolatDonController.php");

include_once("../app/views/Admin/Components/ValidationView.php");

class PageDemandeBenevolats extends PageView { 

    public function afficher() { 
        echo '<html lang="en">';
        $css = ['Admin/PagePartenaires.css' , 'Admin/Common.css'] ; 
        $this->entete($css , "Membres");
       
        echo '<body>';
        echo '<div class="container">';
        
        $nav = new NavBar("navbaradmin" , "admin1"); 
        $nav->afficher() ; 
        
        echo '<div class="content-right pagepartenaire">';
        echo '<div class="upperbar">';
        echo '</div>';
        echo '<div class="buttons">' ; 
        echo '<h2> Gestion des bénévolats </h2>' ; 
        echo '</div>' ; 
        $c = new BenevolatDonController();
        $data = $c->getBenevolats();
        $headers = [] ; 
        
        if (!empty($data) && is_array($data)) {
            $headers = array_keys($data[0]);
        }

        $table = new ValidationView( function ($id) use ($c){$c->validateBenevolat($id) ; } , $headers, $data ,  BASE_URL. "/admin/Membres" );
        $table->afficher() ; 
        echo '</div>';
    
        echo '</div>'; 
    
        echo '</body>';
        echo '</html>';
    }




}
?>
