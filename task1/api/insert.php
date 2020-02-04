<?php

// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
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

//CREATE MESSAGE ARRAY AND SET EMPTY
$msg['message'] = '';

// CHECK IF RECEIVED DATA FROM THE REQUEST
if (isset($data->name) && isset($data->description) && isset($data->image) && isset($data->price) && isset($data->colour) && isset($data->start_date) && isset($data->end_date) && isset($data->category) && isset($data->sub_category)) {
    // CHECK DATA VALUE IS EMPTY OR NOT
    if (!empty($data->name) && !empty($data->description) && !empty($data->image) && !empty($data->price) && !empty($data->colour && !empty($data->start_date) && !empty($data->end_date) && !empty($data->category) && !empty($data->sub_category))) {

        $insert_query = "INSERT INTO  product_api ( name, description, image, price, colour, start_date, end_date, category, sub_category) VALUES ( :name, :description, :image, :price, :colour, :start_date, :end_date, :category, :sub_category)";

        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':name', htmlspecialchars(strip_tags($data->name)), PDO::PARAM_STR);
        $insert_stmt->bindValue(':description', htmlspecialchars(strip_tags($data->description)), PDO::PARAM_STR);
        $insert_stmt->bindValue(':image', htmlspecialchars(strip_tags($data->image)), PDO::PARAM_STR);
        $insert_stmt->bindValue(':price', htmlspecialchars(strip_tags($data->price)), PDO::PARAM_INT);
        $insert_stmt->bindValue(':colour', htmlspecialchars(strip_tags($data->colour)), PDO::PARAM_STR);
        $insert_stmt->bindValue(':start_date', htmlspecialchars(strip_tags($data->start_date)), PDO::PARAM_STR);
        $insert_stmt->bindValue(':end_date', htmlspecialchars(strip_tags($data->end_date)), PDO::PARAM_STR);
        $insert_stmt->bindValue(':category', htmlspecialchars(strip_tags($data->category)), PDO::PARAM_STR);
        $insert_stmt->bindValue(':sub_category', htmlspecialchars(strip_tags($data->sub_category)), PDO::PARAM_STR);


        if ($insert_stmt->execute()) {
            echo $success = $Response->success($data = null, $message = 'SUCCESS', $code = 200);

//             $msg['message'] = 'Data Inserted Successfully';
//             // set response code - 200 created
//            $msg['status'] = "http_response_code(200);";
        } else {
            echo $error = $Response->error($message = 'ERROR', $code = 422);

//            $msg['message'] = 'Data not Inserted';
//            //set respopnse code-404 not found
//            $msg['status'] = "404 not found";
        }
    } else {
        echo $validation = $Response->validationError($validation, $message = 'VALIDATION_ERROR', $code = 422);

//        $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
    }
}

//ECHO DATA IN JSON FORMAT
//echo  json_encode(array($msg));
?>

