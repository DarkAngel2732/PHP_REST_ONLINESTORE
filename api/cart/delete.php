<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Cart.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Cart object
    $cart = new Cart($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to delete
    $cart->id = $data->id;

    // Delete cart item
    if($cart->delete()){
        echo json_encode(
            array('message' => 'Cart item Deleted')
        );
    }else{
        echo json_encode(
            array('messafe' => 'Cart item not Deleted')
        );
    }
    