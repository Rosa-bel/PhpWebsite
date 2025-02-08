<?php 
$path = "";
require_once("../app/controllers\Admin\AdminController.php") ; 

return [ 
    $path.'/admin' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
        $c->afficherPagePartenaire() ; 
    } , 
    $path.'/admin/Partenaires/Ajouter' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ;
        $c->afficherPageAddPartenaire() ; 
    }
     , 
    $path.'/admin/Partenaires/Modifier' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ;
        $c = new AdminController() ; 
        $c->afficherPageModifyPartenaire() ; 
    }
     , 
    $path.'/admin/Activites' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
        $c->afficherPageActivite() ; 
    } , 
    $path.'/admin/Activites/Ajouter' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
        $c->afficherPageAddActivite() ; 
    } , 

    $path.'/admin/Activites/Modifier' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
        $c->afficherPageModifyActivite() ; 
    } , 

    $path.'/admin/Membres' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
        $c->afficherPageMembre() ; 
    } , 
    $path.'/admin/DemandesAdhesion' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
        $c->afficherPageDemandeAdhesion() ; 
    } , 
    $path.'/admin/Dons' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
        $c->afficherPageDons() ; 
    } , 
    $path.'/admin/Benevolats' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ;
        $c = new AdminController() ; 
        $c->afficherDemandePageBenevolats() ; 
    } , 
    $path.'/admin/Evenements' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
        $c->afficherPageEvenements() ; 
    } , 
    $path.'/admin/Evenements/Ajouter' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
       $c->afficherPageAddEvenement() ; 
    } , 
    $path.'/admin/Evenements/Modifier' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
       $c->afficherPageModifyEvenement() ; 
    } , 
    $path.'/admin/Abonnements' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionAdmin() ; 
        $c = new AdminController() ; 
       $c->afficherPageAbonnements() ; 
    } , 


    //Pages des utilisateurs
    $path.'/Acceuil' => function () {  $c = new AdminController() ; 
    $c->afficherPageAcceuil() ; 
    } , 
    $path.'/' => function () {  $c = new AdminController() ; 
    $c->afficherPageAcceuil() ; 
    } , 
    $path.'/Partenaires' => function () {  
        
        $c = new AdminController(); 
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        $components = parse_url($url); 
        isset($components['query']) ? parse_str($components['query'], $filters) : $filters = [];
    
        $c->afficherPageUserPartenaires($filters);
    
    
 
    } , 

    $path.'/Login' => function () {  $c = new AdminController() ; 
        $c->afficherPageLogin() ; 
        } , 
    $path.'/Inscription' => function () {  $c = new AdminController() ; 
        $c->afficherPageInscription() ; 
        } , 
    
    $path.'/Logout' => function () {  $c = new LoginController() ; 
        $c->deconnexion() ; 
        } , 
    
    $path.'/Profil' => function () {
        $verif = new LoginController() ; 
        $verif->verifSessionUser() ; 
        $c = new AdminController() ;
        $c->afficherPageInformation() ; 
        } , 
    $path.'/Profil/Informations' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionUser() ; 
         $c = new AdminController() ; 
        $c->afficherPageChangeProfil() ; 
        } , 

    $path.'/Profil/Paiement' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionUser() ; 
         $c = new AdminController() ; 
        $c->afficherPagePaiement() ; 
        } , 

    $path.'/Profil/Abonnements' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionUser() ; 
         $c = new AdminController() ; 
        $c->afficherUserPageAbonnement() ; 
        } , 
    
    $path.'/Profil/Benevolats' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionUser() ; 
         $c = new AdminController() ; 
        $c->afficherUserPageBenevolats() ; 
        } , 
    $path.'/Profil/Benevolat' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionUser() ; 
         $c = new AdminController() ; 
        $c->afficherFormBenevolat() ; 
        } , 
    
    $path.'/Profil/Dons' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionUser() ; 
         $c = new AdminController() ; 
        $c->afficherUserPageDons() ; 
        } , 
    $path.'/Profil/DemandeAide' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionUser() ; 
         $c = new AdminController() ; 
        $c->afficherFormDemandeAide() ; 
        } , 
    $path.'/Profil/Verification' => function () { 
        $verif = new LoginController() ; 
        $verif->verifSessionPartenaire() ; 
         $c = new AdminController() ; 
        $c->afficherPageVerification() ; 
        } , 

    $path.'/don' => function () { 
        $verif = new LoginController() ; 
         $c = new AdminController() ; 
        $c->afficherPageFaireUnDon() ; 
        } , 
    


] ; 

?>