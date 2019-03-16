<?php

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//constants
require_once($_SERVER['DOCUMENT_ROOT'] . "/qarson/config/constants.php");


require_once(APP_ROOT . 'helpers/utilities.php');

require_once(APP_MODEL . 'car.php');


$Util = new Utilities();
$Car = new Car();

$PDO = $Util->dbConnection();

// variable require upload file
$dir = "../data/";
$file_upload = $_FILES['file_json'];
$path_file = $dir . basename($file_upload["name"]);
$file_ext = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));

//the handling error upload file
if($Util->upload($dir, $path_file, $file_ext, $file_upload) === false){
    $Util->redirect();
} else {
        //set variable session
        // $_SESSION['table_name'] = explode(".", $file_upload['name'])[0];

        // load data with file csv
        // $rows = $file->loadDataCsv($path_file);

        // the handling errors insert data to database
        try {
            echo "Sukces";
            
            $jsonContent = json_decode(file_get_contents($dir.$file_upload['name']), true);
            // print_r ($jsonContent["offers"][0]['make']);
            // $newData = $Util->loadData($jsonContent["offers"]);

            // print_r($jsonContent["offers"]);
            // print_r(count($jsonContent["offers"]));
            echo $Car->saveData($jsonContent["offers"], $PDO);
            // save data to database
            // $file->insertData($_SESSION['table_name'], $rows['headers'], $rows, $pdo);
        
        } catch (PDOException $e) {
            echo $e->getMessage();
            //set variable session
            // $_SESSION['error_db'] = "<div class='alert alert-danger'>".$e->getMessage()."</div>";
        }
        
        // redirect to csv page
        // $Util->redirect();

}



