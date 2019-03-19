<?php

//The API for cars

//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//constants
require_once($_SERVER['DOCUMENT_ROOT'] . "/qarson/config/constants.php");

//loading required the classes
require_once(APP_ROOT . 'helpers/utilities.php');
require_once(APP_MODEL . 'car.php');

// initiating the objects
$Util = new Utilities();
$Car = new Car();

// create connection with database
$PDO = $Util->dbConnection();

// the handle upload
if(count($_FILES) > 0){

    // variable require upload file
    $dir = "../data/";
    $file_upload = $_FILES['file_json'];
    $path_file = $dir . basename($file_upload["name"]);
    $file_ext = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));

    if($Util->upload($dir, $path_file, $file_ext, $file_upload) === false){
        $Util->redirect('views/form.html.php');
    } else {

        try {
                    
            $jsonContent = json_decode(file_get_contents($dir.$file_upload['name']), true);
        
            echo $Car->saveData($jsonContent["offers"], $PDO);

            $Util->redirect('views/form.html.php');
            
        } catch (PDOException $e) {
            echo $Util->generateStatement('error_app', 'Błąd aplikacji: '.$e->getMessage());
            $Util->redirect();
        }
    
    } 

} else {

    //shelling out with adress requests
    $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

    switch ($request[0]) {
        // get list of cars
        case 'cars':
            $results = $Car->getCars($PDO);
            $results['empty'] = $Car->getCars($PDO);
            if(count($results) > 0 && $results['empty'] === false){
                echo json_encode($results);
            } else {
                echo json_encode($results['empty']);
            }
            break;
        // change availbality cars
        case 'change':
            $data = json_decode(file_get_contents("php://input"));
            if($Car->changeAvailabilityCar($_GET['change'], $data->id, $PDO)){
                print_r(json_encode($Util->generateStatement('success_change', 'Status został zmieniony')));
            } else {
                print_r(json_encode($Util->generateStatement('error_change', 'Status nie został zmieniony')));
            }
            
            break;
        // delete cars
        case 'delete':
            $data = json_decode(file_get_contents("php://input"));
            if($Car->deleteCar($data->id, $PDO)){
                print_r(json_encode($Util->generateStatement('success_delete', 'Rekord został usunięty')));
            } else {
                print_r(json_encode($Util->generateStatement('error_delete', 'Rekord nie został usunięty')));
            }
            break;
        default:
            $results = $Car->getCars($PDO);
            $results['empty'] = $Car->getCars($PDO);
            if(count($results) > 0 && $results['empty'] === false){
                echo json_encode($results);
            } else {
                echo json_encode($results['empty']);
            }
            break;
    }

}





