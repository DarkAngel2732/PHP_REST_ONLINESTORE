<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Cart.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Cart object
    $cart = new Cart($db);

    // Read query to fetch row count
    $result = $cart->read();
    // Get Row Count
    $num = $result->rowCount();

    // Checkd if table is at 20 row limit
    if($num < 20){

        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $cart->product_id = $data->product_id;

        // Create post
        if($cart->add()){
            echo json_encode(
                array('message' => 'Product added')
            );
        }else{
            echo json_encode(
                array('message' => 'Product has not been added')
            );
        }
    }else{
        echo json_encode(
            array('message' => 'Product not added, 20 row limit reached')
        );
    }
