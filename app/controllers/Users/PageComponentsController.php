<?php



Class PageComponentsController { 

 function getInfoHeader() { 

 $associationModel = new Model("association");
 $linkModel = new Model ("reseausociaux");

 $association = $associationModel->selectAll() ;
 $links = $linkModel->selectAll() ; 


 $data = [] ;
 $reseaux=[] ; 



 foreach($association as $asso) { 

 $data['nom'] = $asso['nom'] ;
 $data['logo'] = $asso['logo'] ; 
   
 }
 foreach ($links as $link) {
    $reseaux[] = [
        'lien' => $link['lien'], 
        'nom' => $link['nom']
    ];
}

// Combine the data and links
$data['reseaux'] = $reseaux;


 return $data ; 




 }

 function getSocialMedia() { 
    $linkModel = new Model ("reseausociaux");
    $links = $linkModel->selectAll() ; 
    return $links ; 

 }


 function getDiaporamaImages() { 

    $diapomodel = new Model("diaporama") ; 
    $images = $diapomodel->selectAll() ; 
    return $images ; 

 }

 

}




?>