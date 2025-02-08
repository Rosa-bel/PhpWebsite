<?php 
class FormController { 

//récupérer les inputs d'un formulaires de la BDD   
public function getForm ($name) { 

    $elements = new Model ("input") ; 
    $data ['formname'] = $name ; 
    $inputs = $elements->selectwhere($data) ;
    $results=[] ; 

    foreach($inputs as $input) { 

       
        if ($input['type'] ==='select') { 

            $inputmodel = new Model ($input['nomtable']) ; 
            $options = $inputmodel->selectAll() ; 
            $input['options'] = $options ; 
          
        }
        $results[] = $input ; 
    }
   
    return $results ; 



}


//Logique d'upload d'un fichier
public function handleFileUploads($input) {
   
    if ($input['type'] === "file" && isset($_FILES[$input['label']])) {
       
      
        $fileTmpPath = $_FILES[$input['label']]['tmp_name'];
        $fileSize = $_FILES[$input['label']]['size'];
        $fileName = $_FILES[$input['label']]['name'];
  
  
        $fileExt = explode('.', $fileName);
        $fileUpdatedExt = strtolower(end($fileExt));
  
  
        $allowed = ['jpg', 'jpeg', 'png', 'pdf', 'rar' , 'jfif'];
  
  
        if (in_array($fileUpdatedExt, $allowed)) {
         
            if ($_FILES[$input['label']]['error'] === 0) {
                
                if ($fileSize < 1000000) { 
              
                    $basePath = rtrim(BASE_URL, '/public');
           
                    $uploadDir = '../app/Files/'.$input['label'].'/'; 

                    $fileDestination = $uploadDir . $fileName;
                  
  
         
                    if (move_uploaded_file($fileTmpPath, $fileDestination)) {
        
                        return '/app/Files/'.$input['label'].'/'.$fileName;  
                        echo( 'Upload successful!');
                    } else {
                        echo ('Error moving the uploaded file!');
                    }
                } else {
                    echo ('Error: File is too large!');
                }
            } else {
                echo ('Error: An error occurred during file upload!');
            }
        } else {
            echo ('Error: Invalid file type!');
        }
    }
  
  
  return "";
  }


  //récupérer les valeurs des inputs d'un form
  public function getSubmittedData($inputs , $var) {
 
    $data = [];
    foreach ($inputs as $input) {
 
        if (isset($_POST[$var])) {
   
            if ($input['type'] !== "file") {
           
                $data[$input['label']] = htmlspecialchars($_POST[$input['label']]);
            } 
    
            elseif ($input['type'] === "file") {
                 
                    $data[$input['label']] = $this->handleFileUploads($input) ; 
                
            }
        }
    }

    return $data;
}

}




?>