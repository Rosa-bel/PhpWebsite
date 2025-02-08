<?php
require_once("../app/models/Model.php") ; 

class NavBarController { 

private $name ;

public function __construct($name ) {
    $this->name = $name;
}


public function getInfoNavBar() { 
$navbar = new Model ("elementnav") ; 

$data = [] ; 
$data['navbar'] = $this->name;

$resu = $navbar->selectwhere($data) ; 


$navelements=[];

foreach ($resu as $key => $element) 
{   if ($element['parent']== NULL){
    $navelements[$element['id']] = [
        'lien' => $element['lien'], 
        'nom' => $element['nom'] , 
        'session' => $element['session'] , 
        'children' => [] 
    ];
    unset($resu[$key]);

}
}

while ($resu!= NULL) {
foreach($resu as $key => $elem) 
{
    
   $navelements[$elem['parent']]['children'][] = [  
    'lien' => $elem['lien'], 
    'session' => $elem['session'], 
   'nom' => $elem['nom']] ; 
  
   unset($resu[$key]);


}
}


return $navelements ; 

}



}

?>