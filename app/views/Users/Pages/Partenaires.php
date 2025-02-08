<?php 
include_once("../app/views/Admin/Components/navbar.php");
include_once("../app/views/PageView.php");
include_once("../app/views/Users/Components/header.php");
include_once("../app/views/Users\Components\diaporama.php");
include_once("../app/views\Admin\Components/navbar.php");
include_once("../app/views\Users\Components/footer.php");

include_once("../app/views\Users\Components\PartenaireTable.php");


class PageUserPartenaires extends PageView { 

    public function afficher($filters) { 
        echo '<html lang="en">';
        $css = ['Users/Components.css' , 'Users/PartenairesPage.css'] ; 
        $this->entete($css , "Acceuil");
        echo '<body>';
        $header = new HeaderView ; 
        $header->afficher() ; 

        $diaporama = new Diaporama() ; 
        $diaporama->afficher() ; 

        $navbar = new NavBar("nav-acceuil" , "visiteur") ; 
        $navbar->afficher() ; 
   

        $tablepartenaires = new PartenaireTable() ; 
        $tablepartenaires->afficher($filters) ;  
    
        echo '</body>';
        $footer = new Footer() ;
        $footer->afficher() ; 
        echo '</html>';
    }




}
?>
