<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Login.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate sign in object
    $login = new Login($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $login->username = $data->username;
    $login->password = $data->password;

    //Create post

    if($login->create()){
        echo json_encode(
            array('message' => 'login Created')
        );
    }else{
        echo json_encode(
            array('messafe' => 'Login not created')
        );
    }
