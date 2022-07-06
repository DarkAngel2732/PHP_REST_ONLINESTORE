<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Wishlist.php';

// Instantiate Database & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Wishlist object
$wishlist = new Wishlist($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$wishlist->product_id = $data->product_id;

// Add Product
if ($wishlist->add()) {
    echo json_encode(
        array('message' => 'Product added')
    );
} else {
    echo json_encode(
        array('message' => 'Product has not been added')
    );
}
