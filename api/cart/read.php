<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Cart.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Cart object
    $cart = new Cart($db);

    // Cart query
    $result = $cart->read();
    // Get Row Count
    $num = $result->rowCount();

    // Check if there is any Cart information
    if($num > 0){
        // Cart array
        $cart_arr = array();
        $cart_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $cart_item = array(
                'id' => $id,
                'product_id' => $product_id,
                'product_name' => $product_name,
                'added_at' => $added_at

            );

            // Push to "data"
            array_push($cart_arr['data'], $cart_item);
        }

        //Turn to JSON
        echo json_encode($cart_arr);
    } else{
        //No cart Information
        echo json_encode(
            array('message' => 'No cart information')
        );
    }