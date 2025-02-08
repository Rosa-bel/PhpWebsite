<?php 

require_once("..\app\controllers\Admin\PartenaireController.php");
require_once("..\app\controllers\Form.php");

class InsertView { 

    private $inputs; 
    private $title;
    private $controllerfunction;  
    private $url; 

    public function __construct($url, $function, $title, $inputs) {
        $this->inputs = $inputs;
        $this->title = $title; 
        $this->controllerfunction = $function;
        $this->url = $url; 
    }

    public function afficher() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $formcont= new FormController() ; 
            $data = $formcont->getSubmittedData($this->inputs , "submit"); 
            $result = call_user_func($this->controllerfunction, $data);
             
             header("Location:" . $this->url);
             exit;
       
        }

        echo '<form class="form" method="POST" enctype="multipart/form-data">'; 

        echo '<h2>' . $this->title . '</h2>';

        foreach ($this->inputs as $input) { 
            echo '<div class="inputcontainer">';
            if ($input['type'] != "select" && $input['type'] != "textarea" && $input['type'] != "file") { 
                echo '<div class="label">';
                echo '<p>' . htmlspecialchars($input['label']) . '</p>';
                echo '</div>';
                echo '<div class="input">';
                echo '<input required type="' . htmlspecialchars($input['type']) . '" name="' . htmlspecialchars($input['label']) . '">';
                echo '</div>';
            }

            if ($input['type'] === "textarea") { 
                echo '<div class="label">';
                echo '<p>' . htmlspecialchars($input['label']) . '</p>';
                echo '</div>';
                echo '<div class="input">';
                echo '<textarea required name="' . htmlspecialchars($input['label']) . '"></textarea>'; 
                echo '</div>'; 
            }

            if ($input['type'] === "select") { 
                echo '<div class="label">';
                echo '<p>' . htmlspecialchars($input['label']) . '</p>';
                echo '</div>';
                echo '<div class="input">';
                echo '<select required name="' . htmlspecialchars($input['label']) . '">';
                foreach ($input['options'] as $option) { 
                    echo '<option value="' . htmlspecialchars($option['id']) . '">' . htmlspecialchars($option['nom']) . '</option>';
                } 
                echo '</select>'; 
                echo '</div>';
            }

            if ($input['type'] === "file") { 
                echo '<div class="label">';
                echo '<p>' . htmlspecialchars($input['label']) . '</p>';
                echo '</div>';
                echo '<div class="input">';
                echo '<input required type="file" name="' . htmlspecialchars($input['label']) . '">';
                echo '</div>';
            }

            echo '</div>';
        }

        echo '<div class="button">';
        echo '<button type="submit" name="submit">Ajouter</button>'; 
        echo '</div>';

        echo '</form>'; 
    }




    
    
}

?>
