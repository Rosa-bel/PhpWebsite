<?php 
include_once("../app/views/PageView.php");
include_once("../app/views/Users/Components/header.php");
include_once("../app/views/Users\Components\diaporama.php");
include_once("../app/views\Users\Components/footer.php");
include_once("../app\controllers\Admin\LoginController.php");


class PageInscription extends PageView { 

    public function afficher() { 
        echo '<html lang="en">';
        $css = ['Users/Components.css' , 'Users/Inscription.css'] ; 
        $this->entete($css , "Acceuil");
        echo '<body>';
        $header = new HeaderView ; 
        $header->afficher() ; 

        $diaporama = new Diaporama() ; 
        $diaporama->afficher() ; 

        $formcontroller = new FormController() ; 
        $input = $formcontroller->getForm("inscription") ; 
        $c = new LoginController() ; 
    
        $view = new InsertView(BASE_URL. "/Acceuil" , function ($data) use ($c) { $c->inscription($data) ; 
        } , "Inscription" , $input) ; 


        echo '<div id ="inscription-form">' ; 
        $view->afficher() ; 
        echo '</div>' ; 
     

    
        echo '</body>';
        $footer = new Footer() ;
        $footer->afficher() ; 
        echo '</html>';
    }




}
?>
