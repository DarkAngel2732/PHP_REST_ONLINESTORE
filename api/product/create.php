<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Product object
    $product = new Product($db);

    // Product query to fetch row count
    $result = $product->read();
    // Get Row Count
    $num = $result->rowCount();

    // Check if table is at 100 row limit
    if($num > 100){

        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $product->product_name = $data->product_name;
        $product->product_description = $data->product_description;
        $product->product_price = $data->product_price;
        $product->product_imageid = $data->product_imageid;
        $product->product_category_code = $data->product_category_code;

        // Create Product
        if($product->create()){
            echo json_encode(
                array('message' => 'Product Created')
            );
        }else{
            echo json_encode(
                array('message' => 'Product not created')
            );
        }
    }else{
        echo json_encode(
            array('message' => 'Product not created, 100 row limit reached')
        );
    }
