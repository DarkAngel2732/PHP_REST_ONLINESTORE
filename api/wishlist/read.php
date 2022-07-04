<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Wishlist.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Wishlist object
    $wishlist = new Wishlist($db);

    // Wishlist query
    $result = $wishlist->read();
    // Get Row Count
    $num = $result->rowCount();

    // Check if there is any Wishlist information
    if($num > 0){
        // Wishlist array
        $wishlist_arr = array();
        $wishlist_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $wishlist_item = array(
                'id' => $id,
                'product_id' => $product_id,
                'product_name' => $product_name,
                'added_at' => $added_at

            );

            // Push to "data"
            array_push($wishlist_arr['data'], $wishlist_item);
        }

        //Turn to JSON
        echo json_encode($wishlist_arr);
    } else{
        //No wishlist Information
        echo json_encode(
            array('message' => 'No wishlist information')
        );
    }