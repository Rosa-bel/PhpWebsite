<?php

require_once("../app/models/Model.php");

class ProfilController { 



public function getInfoMembre ($id) { 

$membremodel = new Model("utilisateur") ;
$cond = ['id' => $id] ;
$attributs = ['id' , 'nom' , 'prenom' ,  'photo' , 'partenaire' ] ;
$resu = $membremodel->selectAttributes($attributs , $cond , []) ;
return $resu[0] ;

}

public function getMembrePrenom ($id) { 

$membremodel = new Model("utilisateur") ;
$cond = ['id' => $id] ;
$attributs = ['prenom' ] ;
$resu = $membremodel->selectAttributes($attributs , $cond , []) ;
return $resu[0] ;

}

public function getInfoAssociation () { 

    $membremodel = new Model("association") ;
    $attributs = ['logo', 'nom'] ;
    $resu = $membremodel->selectAttributes($attributs , [] , []) ;
    return $resu[0] ;
    
    }




public function getInfoCarte ($id) {

    $info = $this->getInfoMembre($id) ;
    $info['association'] = $this->getInfoAssociation() ;
    $info['qrcode'] = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . $info['id'] ;

    return $info ;
 }



 public function verifierAbonnement($id) { 

    $abonnementmodel = new Model("abonnement");

    $attributs = ['id', 'valide', 'expiration', 'carte_id'];
    $cond = ['utilisateur_id' => $id];

    $resu = $abonnementmodel->selectAttributes($attributs, $cond, []);

    if ($resu == NULL) { 
        return [
            'message' => 'Aucun abonnement trouvé',
            'card_info' => null,
        ]; 
    } else { 
        $resu = $resu[0];

        if ($resu['valide'] == "0000-00-00") { 
            return [
                'message' => 'En attente de validation',
                'card_info' => null,
            ]; 
        } else { 
            if ($resu['expiration'] < date("Y-m-d")) {
                return [
                    'message' => 'Expiré',
                    'card_info' => null,
                ]; 
            } else { 
                return [
                    'message' => 'Actif',
                    'card_info' => $this->getCarteType($resu['carte_id']),
                ];
            }
        }
    }
}



public function getCarteType ($id) { 

    $cartemodel = new Model("typecarte") ;
    $cond = ['id' => $id] ;
    $attributs= ['nom'] ;
    $resu = $cartemodel->selectAttributes($attributs , $cond , []) ;
  
    return $resu[0]['nom'] ;
}
public function getEventNom ($id) { 

    $cartemodel = new Model("evenement") ;
    $cond = ['id' => $id] ;
    $attributs= ['nom'] ;
    $resu = $cartemodel->selectAttributes($attributs , $cond , []) ;
    
    return $resu[0]['nom'] ;
}


public function updateMembreInfo ($id , $data) { 

    $model = new Model("utilisateur") ; 
    $info['nom'] = $data['Nom'] ; 
    $info['prenom'] = $data['Prénom'] ; 
   if($data['Password'] != "") 
   { $info['password'] =password_hash( $data['Password']  , PASSWORD_DEFAULT);  }

    $id = ['id'=> $id] ; 
    if($data["Photo"] !="") { 
        $info['photo'] = $data['Photo'] ; 
    }
    $results = $model->update($id , $info) ; 
}


public function getCarteAbonnement() { 
    
    $model = new Model("typecarte") ; 
    $resu = $model->selectAll() ; 
    return $resu ; 
}


public function acheterCarte($data) { 
    
    $model = new Model("abonnement") ; 
    $info['utilisateur_id'] = $_SESSION[USERKEY] ; 
    $info['carte_id'] = $data['Carte'] ; 
    $info['valide'] = "0000-00-00" ; 
    $info['recu_virement'] = $data['Reçu'] ;
    $info['expiration'] = date("Y-m-d", strtotime("+1 year")) ; 
    $resu = $model->insert($info) ; 
    return $resu ; 
}

public function getAbonnements() { 
    $model = new Model("abonnement"); 
    $cond = ['utilisateur_id' => $_SESSION[USERKEY]]; 
    $attributs = ['carte_id', 'valide', 'expiration', 'recu_virement'];
    $resu = $model->selectAttributes($attributs, $cond, []); 
    

    $renamedResults = [];
    foreach ($resu as $res) { 
        $renamedRes = [
            'Carte' => $this->getCarteType($res['carte_id']),
            'Date validation' => $res['valide'] == "0000-00-00" ? "En attente de validation" : "Validé",
            'Date expiration' => $res['expiration'],
            'Reçu' => $res['recu_virement']
        ];
        $renamedResults[] = $renamedRes;
    }
    return $renamedResults; 
}

public function getDons() { 
    $model = new Model("don"); 
    $cond = ['utilisateur_id' => $_SESSION[USERKEY]]; 
    $attributs = ['date','montant' , 'recu' ,'datevalidation'];
    $resu = $model->selectAttributes($attributs, $cond, []); 
    

    $renamedResults = [];
    foreach ($resu as $res) { 
        $renamedRes = [
            'Date' => ($res['date']),
            'Montant' => $res['montant'],
            'Reçu' => $res['recu'],
            'Date validation' => $res['datevalidation'] == "0000-00-00" ? "En attente de validation" : $res['datevalidation'],
           
        ];
        $renamedResults[] = $renamedRes;
    }
    return $renamedResults; 
}

public function getBenevolats() { 
    $model = new Model("benevolat"); 
    $cond = ['utilisateur_id' => $_SESSION[USERKEY]]; 
    $attributs = ['evenement_id', 'date','datevalidation'];
    $resu = $model->selectAttributes($attributs, $cond, []); 
    

    $renamedResults = [];
    foreach ($resu as $res) { 
        $renamedRes = [
            'Evenement' => $this->getEventNom($res['evenement_id']),
            'Date' => $res['date'],
            'Date validation' => $res['datevalidation'] == "0000-00-00" ? "En attente de validation" : $res['datevalidation'],
           
        ];
        $renamedResults[] = $renamedRes;
    }
    return $renamedResults; 
}


}

?>