<?php 

require_once("..\app\controllers\Admin\PartenaireController.php") ; 
require_once("..\app\controllers\Form.php");

class ModifyView { 

    private $inputs ; 
    private $title ;
    private $controllerfunction ;  
    private $url ; 

    public function __construct($url , $function , $title , $inputs) {
        $this->inputs = $inputs;
        $this->title = $title ; 
        $this->controllerfunction = $function ;
        $this->url = $url ; 
    }

    public function afficher($info) {

    

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $formcont= new FormController() ; 
            $data = $formcont->getSubmittedData($this->inputs , "update"); 
          
            if (isset($_GET['id'])) { 
            call_user_func($this->controllerfunction, $_GET['id'], $data);
            header("Location: " . $this->url);
            exit;  
         
         } 
            elseif (isset($info['id'])) { 
                call_user_func($this->controllerfunction, $info['id'], $data); 
                header("Location: " . $this->url);
                exit;  
            }
          
       
        } 

        
        echo '<form class="form" method="POST" enctype="multipart/form-data" >';
        echo '<h2>'.$this->title. '</h2>' ; 

        foreach($this->inputs as $input) { 
            echo '<div class="inputcontainer">' ;

        switch ($input['type']) {

                case 'select':
            
                    echo '<div class="label">';
                    echo '<p>' . htmlspecialchars($input['label']) . '</p>';
                    echo '</div>';
                    echo '<div class="input">';
                    echo '<select required name="' . htmlspecialchars($input['label']) . '">';
                
                    foreach ($input['options'] as $option) { 
                        // Compare the option ID with the value to be selected
                        $selected = ($option['id'] === $info[$input["label"]]) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($option['id']) . '" ' . $selected . '>' . htmlspecialchars($option['nom']) . '</option>';
                    }
                
                    echo '</select>'; 
                    echo '</div>';
                    break;

                 case 'password':
                    case 'password':
                    echo '<div class="label">';
                    echo '<p>' . htmlspecialchars($input['label']) . '</p>';
                    echo '</div>';
                    echo '<div class="input">';
                    
            
                    $currentPage = $_SERVER['REQUEST_URI'];
                    $nonRequiredPages = [BASE_URL.'/Profil/Informations', BASE_URL.'/Profil/Informations']; 
                    $requiredAttribute = in_array($currentPage, $nonRequiredPages) ? '' : 'required';
            
                    echo '<input type="password" name="' . htmlspecialchars($input['label']) . '" ' . $requiredAttribute . '>';
                    echo '</div>';
                    break;
                    
                    
                case 'textarea':
                    echo '<div class="label">' ;
                    echo '<p>' . $input['label'] . '</p>' ;
                    echo '</div>' ;
                    echo '<div class="input">' ;
                    echo '<textarea required name="' . $input['label'] . '">' . (isset($info[$input["label"]]) ? htmlspecialchars($info[$input["label"]]) : "") . '</textarea>' ; 
                    echo '</div>' ; 
                    break;

                case 'file':
                    echo '<div class="label">';
                    echo '<p>' . htmlspecialchars($input['label']) . '</p>';
                    echo '</div>';
                    echo '<div class="input">';
                    echo '<input  type="file" name="' . htmlspecialchars($input['label']) . '">';
                    echo '</div>';
                    break;

                default:
                    echo '<div class="label" >' ;
                    echo '<p>' . $input['label'] . '</p>' ;
                    echo '</div>' ;
                    echo '<div class="input">' ;
                    echo '<input required type="' . htmlspecialchars($input['type']) . '" name="' . htmlspecialchars($input['label']) . '" value="' . (isset($info[$input["label"]]) ? htmlspecialchars($info[$input["label"]]) : "") . '">';
                    echo '</div>' ;
                    break;
            }

            echo '</div>';
        }

        echo '<div class="button">' ; 
        echo '<button type="submit" name="update">Modifier</button>' ; 
        echo '</div>' ; 
        echo '</form>' ; 
    }
}
?>
