<?php

class Utilities
{
     //properties class
     public $dir;
     public $path_file;
     public $file_ext;
     public $upload_success = 1;
     
     
     /**
      * upload
      * upload file json on server
      * 
      * @param  mixed $dir
      * @param  mixed $path_file
      * @param  mixed $file_ext
      *
      * @return void
      */
     public function upload(string $dir, string $path_file, string $file_ext, array $file_upload){
 
         $this->dir = $dir;
         $this->path_file = $path_file;
         $this->file_ext = $file_ext;
 
         //check whether file has extension csv
         if($file_ext !== 'json' ) {
             echo json_encode($this->generateStatement("error_upload", "Plik nie jest w formacie json. Plik nie moze zostać przesłany."));
             $this->upload_success = 0;
             return false;
         }
         
         //check whether file exist
         if (file_exists($path_file)) {
             echo json_encode($this->generateStatement("error_upload", "Plik już istnieje. Plik nie moze zostać przesłany."));
             $this->upload_success = 0;
             return false;
         }
         
         // upload file
         if (move_uploaded_file($file_upload["tmp_name"], $path_file)) {
            //  echo json_encode($this->generateStatement("success_upload", "Plik ". basename( $file_upload["name"]). " został przesłany na serwer. Dane zostały zapisane w bazie"));
             $this->upload_success = 1;
             
             return true;
         } else {
             echo json_encode($this->generateStatement("error_upload", "Plik nie moze zostać przesłany."));
             $this->upload_success = 0;
             return false;
         }
 
     }

      /**
     * generateStatement
     * generate statement to json and $_SESSION for users
     * @param  mixed $key
     * @param  mixed $stmt
     *
     * @return array
     */
    public function generateStatement(string $key, string $stmt): array {
        

        $json[$key] = $stmt;

        $_SESSION[$key] = $stmt;

        return $json;
    }

   
    /**
     * checkFields
     * check whether fields are empty
     * @param  mixed $input
     *
     * @return void
     */
    public function checkEmptyFields(array $input){
        
        $empty = false;

        foreach($input as $key => $row){
            
            if($input[$key] === ''){
               $empty = true;
            }

        }

        if($empty){
            echo json_encode($this->generateStatement('error_empty', 'Uzupełnij wszystkie pola'));
            return true;
        }
        
        
    }

    /**
     * redirect
     * redirect to other page
     * @param  mixed $path
     *
     * @return void
     */
    public function redirect($path = ""){
        
        header('Location: http://localhost/qarson/'.$path);

    }
}