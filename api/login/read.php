<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Login.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate sign in object
    $login = new Login($db);

    // Login query
    $result = $login->read();
    // Get Row Count
    $num = $result->rowCount();

    // Check if there is any login information
    if($num > 0){
        // login array
        $login_arr = array();
        $login_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $login_item = array(
                'id' => $id,
                'username' => $username,
                'password' => $password,
                'created_at' => $created_at
            );

            // Push to "data"
            array_push($login_arr['data'], $login_item);
        }

        //Turn to JSON
        echo json_encode($login_arr);
    } else{
        //No Login Information
        echo json_encode(
            array('message' => 'No login information')
        );
    }
