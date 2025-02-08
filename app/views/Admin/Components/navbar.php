<?php 
require_once("../app/controllers/navbar.php");
require_once("../app\configuration\sessionKeys.php");

class NavBar {
    private $id; 
    private $navbarname; 
    
    public function __construct($id, $navname) { 
        $this->id = $id; 
        $this->navbarname = $navname; 
    }

    public function afficher() {
        echo '<div id="'. $this->id .'">'; 
        ?>
        <div class="links">
            <?php
            $controller = new NavBarController($this->navbarname);
            $elements = $controller->getInfoNavBar();

            echo '<ul>';
            foreach ($elements as $elem) {
               

                if (
                    (($elem['session'] === "user" && isset($_SESSION[USERKEY])) || 
                    ($elem['session'] === "visiteur" ) ||
                    ($elem['session'] === "partenaire"  &&  isset($_SESSION[ROLEKEY]) && $_SESSION[ROLEKEY] === "partenaire") ||
                    ($elem['session'] === "admin"  &&  isset($_SESSION[ROLEKEY]) && $_SESSION[ROLEKEY] === "admin" ) 
                     
                    )
                ) {
                    echo '<li>';
                    $link = isset($elem['lien']) ? BASE_URL . '/' . ltrim($elem['lien'], '/') : '#';
                    echo '<a href="' . htmlspecialchars($link) . '">' . htmlspecialchars($elem['nom']) . '</a>';

                    if (!empty($elem['children'])) {
                        echo '<ul>';
                        foreach ($elem['children'] as $child) {
           
                   
                     if (
    
    
                        (($child['session'] === "user" && isset($_SESSION[USERKEY])) || 
                        ($child['session'] === "visiteur" ) ||
                        ($child['session'] === "partenaire"  &&  isset($_SESSION[ROLEKEY]) && $_SESSION[ROLEKEY] === "partenaire")  ||
                        ($child['session'] === "admin"  &&  isset($_SESSION[ROLEKEY]) && $_SESSION[ROLEKEY] === "admin" ) )
                        
                     
                    )
                     {  
                        echo '<li>';
                        $link = isset($child['lien']) ? BASE_URL . '/' . ltrim($child['lien'], '/') : '#';
                        echo '<a href="' . htmlspecialchars($link) . '">' . htmlspecialchars($child['nom']) . '</a>';
                        echo '</li>';
                    }
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
             

              
                echo '</li>';
            }
            echo '</ul>';
            ?>
        </div>
        <?php
        if ($this->navbarname === "admin1") { 
            
            echo '<div class="logout">'; 
            echo '<a href="'.BASE_URL.'/Logout">Logout</a>'; 
            echo '</div>'; 
        }
        echo '</div>';
    }
}
?>
