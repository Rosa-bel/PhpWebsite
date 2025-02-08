<?php 
include_once("../app/views/Admin/Components/navbar.php");
include_once("../app/views/PageView.php");
include_once("../app/views/Users/Components/header.php");
include_once("../app/views/Users\Components\diaporama.php");
include_once("../app/views\Admin\Components/navbar.php");
include_once("../app/views\Users\Components/footer.php");
include_once("../app/views\Users\Components\ZoneContenu.php");
include_once("../app/views\Users\Components\ZoneEvents.php");


class PageAcceuil extends PageView { 

    public function afficher() { 
        echo '<html lang="en">';
        $css = ['Users/Components.css' , 'Users/zone.css'] ; 
        $this->entete($css , "Acceuil");
        echo '<body>';
        $header = new HeaderView ; 
        $header->afficher() ; 

        $diaporama = new Diaporama() ; 
        $diaporama->afficher() ; 

       
        $navbar = new NavBar("nav-acceuil" , "visiteur") ; 
        $navbar->afficher() ; 

    
        echo '</body>';

        $zoneActivite = new ZoneContenu(BASE_URL.'/Activites') ; 
        $zoneActivite->afficher(3 , "Nos activités") ; 

        $zoneEvent = new ZoneEvents(BASE_URL.'/Evenements') ; 
        $zoneEvent->afficher(3 , "Nos évenements") ; 

        $footer = new Footer() ;
        $footer->afficher() ; 
        echo '</html>';
    }




}
?>
