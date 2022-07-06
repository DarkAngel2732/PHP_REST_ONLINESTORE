<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Product object
    $product = new Product($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $product->id = $data->id;

    $product->product_name = $data->product_name;
    $product->product_description = $data->product_description;
    $product->product_price = $data->product_price;
    $product->product_imageid = $data->product_imageid;
    $product->product_category_code = $data->product_category_code;

    // Update Product

    if($product->update()){
        echo json_encode(
            array('message' => 'Product Updated')
        );
    }else{
        echo json_encode(
            array('message' => 'Product not Updated')
        );
    }