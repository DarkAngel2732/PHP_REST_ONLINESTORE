<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Category object
    $category = new Category($db);

    // Category query
    $result = $category->read();
    // Get Row Count
    $num = $result->rowCount();

    // Check if there is any Category information
    if($num > 0){
        // Category array
        $category_arr = array();
        $category_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id' => $id,
                'category_name' => $category_name,
                'category_description' => $category_description,
                'category_code' => $category_code

            );

            // Push to "data"
            array_push($category_arr['data'], $category_item);
        }

        //Turn to JSON
        echo json_encode($category_arr);
    } else{
        //No category Information
        echo json_encode(
            array('message' => 'No category information')
        );
    }