<?php

// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// INCLUDING DATABASE AND MAKING OBJECT
require 'connection.php';
require 'product.php';

$db_connection = new Database();
$conn = $db_connection->dbConnection();

//Call a class using object//
$Response = new ResponseTrait;


// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));


//CHECKING, IF ID AVAILABLE ON $data
if (isset($data->id)) {
    $msg['message'] = '';

    $post_id = $data->id;

    //GET POST BY ID FROM DATABASE
    // YOU CAN REMOVE THIS QUERY AND PERFORM ONLY DELETE QUERY
    $check_post = "SELECT * FROM `product_api` WHERE id=:post_id";
    $check_post_stmt = $conn->prepare($check_post);
    $check_post_stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $check_post_stmt->execute();

    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if ($check_post_stmt->rowCount() > 0) {

        //DELETE POST BY ID FROM DATABASE
        $delete_post = "DELETE FROM `product_api` WHERE id=:post_id";
        $delete_post_stmt = $conn->prepare($delete_post);
        $delete_post_stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);

        if ($delete_post_stmt->execute()) {
            $msg['message'] = 'Deleted Successfully';
            $msg['status'] = 'http_response code 200k';
        } else {
            $msg['message'] = 'not Deleted';
            $msg['status'] = 'http_response code (503)';
        }
    } else {
        $msg['message'] = 'Invlid ID';
    }
    // ECHO MESSAGE IN JSON FORMAT
    echo json_encode($msg);
}
?>

