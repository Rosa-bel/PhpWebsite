<?php
require_once("../app/views/Admin/Pages/Membre/Membres.php");
require_once("../app/views/PageView.php");
require_once("../app/views/Admin/Components/InsertView.php");
require_once("../app\configuration\sessionKeys.php");

$files = glob("../app/views/Admin/Pages/**/*.php", GLOB_BRACE);
foreach ($files as $file) {
    require_once($file);
}

$files = glob("../app/views/Users/Pages/*.php", GLOB_BRACE);
foreach ($files as $file) {
    require_once($file);
}



//Controlleur permettant la navigation et l'affichage des pages avec les routes

class LoginController { 

function connection($username , $password) { 

   

    $modelcompte = new Model("utilisateur") ; 
    $info['username'] = $username ;  
    $attributs = ['id' ,'admin' , 'partenaire' , 'bloque' , 'valide' , 'password' ] ; 

    $negation['valide'] = '0000-00-00' ; 
    $result = $modelcompte->selectAttributes($attributs , $info , $negation) ;
     
   
    if ($result!=NULL &&  password_verify($password , $result[0]['password']) ) { 
        
   
        return $this->storesession($result) ; 
    }
     return NULL ; 
   


} 

function storesession($result) { 

    if (empty($result)) {
        return null;
    } 
    $result=$result[0] ; 
    if ($result['bloque'] === 1 || $result['valide'] === 0 ) { 
        return 0; 
    }

 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    
    $_SESSION[USERKEY] = $result['id'];
  
  
    if ($result['admin'] === 1) { 
       
        $_SESSION[ROLEKEY] = 'admin';
        header("Location:".BASE_URL."/admin"); 
        exit;
    } elseif ($result['partenaire'] === 1) { 
    
    
        $_SESSION[ROLEKEY] = 'partenaire';
        header("Location: ".BASE_URL."/Acceuil"); 
        exit;
    } else { 
      
        $_SESSION[ROLEKEY] = 'user';
        header("Location: ".BASE_URL."/Acceuil");
        exit;
    }
}



function verifSessionAdmin() { 

if(!isset($_SESSION[ROLEKEY])  || $_SESSION[ROLEKEY] !='admin' ) { 
    header("Location: ".BASE_URL."/Acceuil");

}


} 

function verifSessionUser() { 

    if(!isset($_SESSION[ROLEKEY]) || !($_SESSION[ROLEKEY] =='user' ||  $_SESSION[ROLEKEY] =='partenaire' )) { 
     
        header("Location: ".BASE_URL."/Acceuil");
    
    }


} 
function verifSessionPartenaire() { 

    if(!isset($_SESSION[ROLEKEY])  || $_SESSION[ROLEKEY] !='partenaire' ) { 
        header("Location: ".BASE_URL."/Acceuil");
    
    }


} 


function inscription ($data) { 
    

    $m= new Model ("utilisateur") ; 
    $inscription['username'] = $data["Username"] ; 
    $d['username'] = $data["Username"] ; 

    $result = $m->selectAttributes(['id'] , $d , []) ; 

    if (!$result) { 

    $inscription['nom'] = $data["Nom"] ; 
    $inscription['prenom'] = $data["Prénom"] ; 
    $inscription['username'] = $data["Username"] ; 
    $inscription['password'] = password_hash($data["Password"] , PASSWORD_DEFAULT) ;
    $inscription['photo'] = $data["Photo"] ;  
    $inscription['piece_identite'] = $data["Pièce-identité"] ;  
    $inscription['membre'] = 0 ;
    $inscription['admin'] = 0 ;
    $inscription['partenaire'] = 0 ;
    $inscription['valide'] = "0000-00-00" ;
    $inscription['bloque'] = 0 ;
  

    $m->insert($inscription) ; 

    }

    else { 
        echo "<script>alert('Username déja utilisé ! ');</script>";
        
    }




}


function deconnexion() {
  
    $_SESSION = [];
    session_destroy();
    header("Location: " . BASE_URL . "/Acceuil");
    exit;
}






}

?>