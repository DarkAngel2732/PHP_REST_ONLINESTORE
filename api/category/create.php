<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Category query to fetch row count
    $result = $category->read();
    // Get Row Count
    $num = $result->rowCount();

    // Checkd if table is at 10 row limit
    if($num < 10){

        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $category->category_name = $data->category_name;
        $category->category_description = $data->category_description;
        $category->category_code = $data->category_code;

        // Create category
        if($category->create()){
            echo json_encode(
                array('message' => 'category Created')
            );
        }else{
            echo json_encode(
                array('message' => 'category not created')
            );
        }
    }else{
        echo json_encode(
            array('message' => 'category not created, 10 row limit reached')
        );
    }
