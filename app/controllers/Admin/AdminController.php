<?php
require_once("../app/views/Admin/Pages/Membre/Membres.php");
require_once("../app/views/PageView.php");
require_once("../app/views/Admin/Components/InsertView.php");

$files = glob("../app/views/Admin/Pages/**/*.php", GLOB_BRACE);
foreach ($files as $file) {
    require_once($file);
}
$files = glob("../app/views/Users/Pages/**/*.php", GLOB_BRACE);
foreach ($files as $file) {
    require_once($file);
}

$files = glob("../app/views/Users/Pages/*.php", GLOB_BRACE);
foreach ($files as $file) {
    require_once($file);
}



//Controlleur permettant la navigation et l'affichage des pages avec les routes

class AdminController { 


public function afficherPagePartenaire() {  
$page = new PagePartenaire () ; 
$page->afficher() ; 
}


public function afficherPageAddPartenaire() { 
$page = new PageAddPartenaire() ; 
$page->afficher() ;

}


public function afficherPageModifyPartenaire() { 
$page = new PageModifyPartenaire() ; 
$page->afficher() ;

}


//Activites
public function afficherPageActivite() {  
    $page = new PageActivites () ; 
    $page->afficher() ; 
    }


 public function afficherPageAddActivite() { 
        $page = new PageAddActivite() ; 
        $page->afficher() ;
        
        }

public function afficherPageModifyActivite() { 
            $page = new PageModifyActivite() ; 
            $page->afficher() ;
            
}


public function afficherPageInscriptions() { 
            $page = new PageModifyActivite() ; 
            $page->afficher() ;
            
}

public function afficherPageMembre() { 
            $page = new PageMembre() ; 
            $page->afficher() ;
            
}
public function afficherPageDemandeAdhesion() { 
            $page = new PageDemandeAdhesion() ; 
            $page->afficher() ;
            
}

public function afficherPageDons() { 
            $page = new PageDons() ; 
            $page->afficher() ;
            
}
public function afficherPageAbonnements() { 
            $page = new PageAbonnements() ; 
            $page->afficher() ;
            
}

public function afficherDemandePageBenevolats() { 
            $page = new PageDemandeBenevolats() ; 
            $page->afficher() ;
            
}

public function afficherPageEvenements() { 
            $page = new PageEvenements() ; 
            $page->afficher() ;
            
}

public function afficherPageAddEvenement() { 
            $page = new PageAddEvenement() ; 
            $page->afficher() ;
            
}

public function afficherPageModifyEvenement() { 
    $page = new PageModifyEvenement() ; 
    $page->afficher() ;
    
}

public function afficherPageAcceuil() { 
            $page = new PageAcceuil() ; 
            $page->afficher() ;
            
}
public function afficherPageUserPartenaires($filters) { 
            $page = new PageUserPartenaires() ; 
            $page->afficher($filters) ;
            
}
public function afficherPageLogin() { 
            $page = new PageLogin() ; 
            $page->afficher() ;
            
}

public function afficherPageInscription() { 
            $page = new PageInscription() ; 
            $page->afficher() ;
            
}
public function afficherPageInformation() { 
            $page = new PageInformations() ; 
            $page->afficher() ;
            
}
public function  afficherPageChangeProfil() { 
            $page = new PageChangeProfil() ; 
            $page->afficher() ;
            
}
public function  afficherPagePaiement() { 
            $page = new PagePaiement() ; 
            $page->afficher() ;
            
}
public function  afficherUserPageAbonnement() { 
            $page = new UserPageAbonnement() ; 
            $page->afficher() ;
            
}
public function  afficherUserPageDons() { 
            $page = new UserPageDons() ; 
            $page->afficher() ;
            
}
public function  afficherUserPageBenevolats() { 
            $page = new UserPageBenevolats() ; 
            $page->afficher() ;
            
}
public function  afficherPageFaireUnDon() { 
            $page = new PageFaireUnDon() ; 
            $page->afficher() ;
            
}
public function  afficherFormBenevolat() { 
            $page = new Benevolat() ; 
            $page->afficher() ;
            
}
public function  afficherFormDemandeAide() { 
            $page = new UserDemandeAide() ; 
            $page->afficher() ;
            
}
public function  afficherPageVerification() { 
            $page = new PageVerification() ; 
            $page->afficher() ;
            
}




}

?>