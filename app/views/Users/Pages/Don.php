<?php 
include_once("../app/views/Admin/Components/navbar.php");
include_once("../app/views/PageView.php");
include_once("../app/views/Users/Components/header.php");
include_once("../app/views/Users\Components\diaporama.php");
include_once("../app/views\Admin\Components/navbar.php");
include_once("../app/views\Users\Components/footer.php");


class PageFaireUnDon extends PageView { 

    public function afficher() { 
        echo '<html lang="en">';
        $css = ['Users/Components.css' , 'Users/form.css'] ; 
        $this->entete($css , "Acceuil");
        echo '<body>';
        $header = new HeaderView ; 
        $header->afficher() ; 

        $diaporama = new Diaporama() ; 
        $diaporama->afficher() ; 

       
        $navbar = new NavBar("nav-acceuil" , "visiteur") ; 
        $navbar->afficher() ; 
        
        $formcont = new FormController() ; 
        $input = $formcont->getForm('faireundon') ;
        $c = new BenevolatDonController() ; 

        $view = new InsertView(BASE_URL. "/Acceuil" , function ($data) use ($c) { $c->faireUnDon($data) ; 
        } , "Faire Un don" , $input) ;

        $view->afficher() ;
    
        echo '</body>';
        $footer = new Footer() ;
        $footer->afficher() ; 
        echo '</html>';
    }




}
?>
