<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Product object
    $product = new Product($db);

    // product query
    $result = $product->read();
    // Get Row Count
    $num = $result->rowCount();

    // Check if there is any product information
    if($num > 0){
        // product array
        $product_arr = array();
        $product_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $product_item = array(
                'id' => $id,
                'product_name' => $product_name,
                'product_description' => $product_description,
                'product_price' => $product_price,
                'product_imageid' => $product_imageid,
                'category_name' => $category_name

            );

            // Push to "data"
            array_push($product_arr['data'], $product_item);
        }

        //Turn to JSON
        echo json_encode($product_arr);
    } else{
        //No product Information
        echo json_encode(
            array('message' => 'No product information')
        );
    }