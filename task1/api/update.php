<?php

// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
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
    $get_post = "SELECT * FROM `product_api` WHERE id=:post_id";
    $get_stmt = $conn->prepare($get_post);
    $get_stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $get_stmt->execute();


    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if ($get_stmt->rowCount() > 0) {

        // FETCH POST FROM DATBASE 
        $row = $get_stmt->fetch(PDO::FETCH_ASSOC);

        // CHECK, IF NEW UPDATE REQUEST DATA IS AVAILABLE THEN SET IT OTHERWISE SET OLD DATA
        $post_name = isset($data->name) ? $data->name : $row['name'];
        $post_description = isset($data->description) ? $data->description : $row['description'];
        $post_image = isset($data->image) ? $data->image : $row['image'];
        $post_price = isset($data->price) ? $data->price : $row['price'];
        $post_colour = isset($data->colour) ? $data->colour : $row['colour'];
        $post_start_date = isset($data->start_date) ? $data->image : $row['start_date'];
        $post_end_date = isset($data->end_date) ? $data->end_date : $row['end_date'];
        $post_category = isset($data->category) ? $data->category : $row['category'];
        $post_sub_category = isset($data->sub_category) ? $data->sub_category : $row['sub_category'];



        $update_query = "UPDATE `product_api` SET name= :name, description= :description, image = :image,price=:price, colour= :colour, start_date = :start_date,end_date=:end_date,category=:category,sub_category=:sub_category
        WHERE id = :id";

        $update_stmt = $conn->prepare($update_query);

        // DATA BINDING AND REMOVE SPECIAL CHARS AND REMOVE TAGS
        $update_stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
        $update_stmt->bindValue(':name', htmlspecialchars(strip_tags($post_name)), PDO::PARAM_STR);
        $update_stmt->bindValue(':description', htmlspecialchars(strip_tags($post_description)), PDO::PARAM_STR);
        $update_stmt->bindValue(':image', htmlspecialchars(strip_tags($post_image)), PDO::PARAM_STR);
        $update_stmt->bindValue(':price', htmlspecialchars(strip_tags($post_price)), PDO::PARAM_STR);
        $update_stmt->bindValue(':colour', htmlspecialchars(strip_tags($post_colour)), PDO::PARAM_STR);
        $update_stmt->bindValue(':start_date', htmlspecialchars(strip_tags($post_start_date)), PDO::PARAM_STR);
        $update_stmt->bindValue(':end_date', htmlspecialchars(strip_tags($post_end_date)), PDO::PARAM_STR);
        $update_stmt->bindValue(':category', htmlspecialchars(strip_tags($post_category)), PDO::PARAM_STR);
        $update_stmt->bindValue(':sub_category', htmlspecialchars(strip_tags($post_sub_category)), PDO::PARAM_STR);

        if ($update_stmt->execute()) {
            echo $success = $Response->success($data = null, $message = 'SUCCESS', $code = 200);
//            $msg['message'] = 'Data updated successfully';
//             // set response code - 200 created
//            $msg['status'] = "http_response_code(200k);";
        } else {
            echo $error = $Response->error($message = 'ERROR', $code = 422);
//             // set response code - 404 not found 
//            $msg['status'] = "http_response_code(404 not found);";
//            $msg['message'] = 'data not updated';
        }
    } else {
        echo $validation = $Response->validationError($validation, $message = 'VALIDATION_ERROR', $code = 422);
//         // set response code - 503 service unavailable
//             http_response_code(503);
//        $msg['message'] = 'Invlid ID';
    }

//    echo  json_encode($msg);
}
?>
