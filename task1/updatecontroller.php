<?php

//session start
session_start();
//database connection
require("connection.php");
extract($_POST);
if (!isset($_SESSION['loginSuccess'])) {
    header("location: login.php");
}
// image condition if file is empty
if ($_FILES['image']) {
    $image = "SELECT image FROM product WHERE id = '$id'";
    $result = mysqli_query($conn, $image);
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];
} else {
    "image not there";
}
// variable
$name_error = '';
$description_error = '';
$price_error = '';
// $image_error = '';
$start_date_error = '';
$end_date_error = '';
$colour_error = '';
$category_error = '';
$sub_category_error = '';
$output = '';

//unset session
if (isset($_POST["btnupdate"])) {
    unset($_SESSION["name_error"]);
    unset($_SESSION["description_error"]);
    unset($_SESSION["price_error"]);
//    unset($_SESSION["image_error"]);
    unset($_SESSION["start_date_error"]);
    unset($_SESSION["end_date_error"]);
    unset($_SESSION["colour_error"]);
    unset($_SESSION["category_error"]);
    unset($_SESSION["sub_category_error"]);
// server side validation 
    if (empty($_POST["name"])) {
        $_SESSION["name_error"] = "<p>Please Enter Name</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["name"])) {
            $_SESSION["name_error"] = "<p>Only Letters and whitespace allowed</p>";
        }
    }

    if (empty($_POST["description"])) {
        $_SESSION["description_error"] = "<p>Please Enter description</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["description"])) {
            $_SESSION["description_error"] = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($_POST["price"])) {
        $_SESSION["price_error"] = "<p>Please Enter price</p>";
    } else {
        if (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $_POST["price"])) {
            $_SESSION["price_error"] = "<p>Only numbers and whitespace allowed</p>";
        }
    }
    // if(empty($_POST["image"]))  
//     {  
//          $image_error = "<p>Please your image</p>";  
//    }  
//    $target_dir = "image/";
//$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
//$uploadOk = 1;
//
//echo$imageFileType = strtolower(pathinfo($_FILES["product_image"]["tmp_name"],PATHINFO_EXTENSION));
//// Check if image file is a actual image or fake image
//// Check if file already exists
//
//// Check file size
//if ($_FILES["product_image"]["size"] > 500000) {
//     $_SESSION["image_error"]= "<p>Sorry, your file is too large.</p>";
//    $uploadOk = 0;
//}
//// Allow certain file formats
//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//&& $imageFileType != "gif" ) {
//    $_SESSION["image_error"]= "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
//    $uploadOk = 0;
//}

    if (empty($_POST["start_date"])) {
        $_SESSION["start_date_error"] = "<p>Please enter your start_date</p>";
    }
    if (empty($_POST["end_date"])) {
        $_SESSION["end_date_error"] = "<p>Please enter your end_date</p>";
    }
    if (empty($_POST["colour"])) {
        $_SESSION["colour_error"] = "<p>Please enter your colour</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["colour"])) {
            $_SESSION["colour_error"] = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($_POST["category"])) {
        $_SESSION["category_error"] = "<p>Select your category</p>";
    }
    if (empty($_POST["sub_category"])) {
        $_SESSION['sub_category_error'] = "<p>Select  your sub_category</p>";
    }

    if (strtotime($start_date) > strtotime($end_date)) {
        $_SESSION["end_date_error"] = "<p>end_date should be greater than start date</p>";
    }



    if (!isset($_SESSION['name_error']) && !isset($_SESSION['description_error']) && !isset($_SESSION['price_error']) && !isset($_SESSION['image_error']) && !isset($_SESSION['start_date_error']) && !isset($_SESSION['end_date_error']) && !isset($_SESSION['colour_error']) && !isset($_SESSION['category_error']) && !isset($_SESSION['sub_category_error'])) {

        $output = '<p><label>Ouput-</label></p>  
    <p>Your name is ' . $_POST["name"] . '</p>  
    <p>Your description is ' . $_POST["description"] . '</p>  
    <p>Your price is ' . $_POST["price"] . '</p>  
    <p>Your image is ' . $_POST["image"] . '</p> 
    <p>Your start_date is ' . $_POST["start_date"] . '</p>  
    <p>Your end_date is ' . $_POST["end_date"] . '</p>  
    <p>Your colour is ' . $_POST["colour"] . '</p>  
    <p>Your category is ' . $_POST["category"] . '</p>
    <p>Your sub_category is ' . $_POST["sub_category"] . '</p> 
    ';

// updating the data
        if (isset($btnupdate)) {
            $sql = "UPDATE product SET
      name= '$name',
      description= '$description',
      price = '$price',
      image= '$image',
      start_date = '$start_date',
      end_date= '$end_date',
      colour= '$colour',
      category= '$category',
      sub_category= '$sub_category' WHERE id='$id'";
            $q1 = mysqli_query($conn, $sql);

//unset data
            if ($q1 > 0) {
                unset($_SESSION["name_error"]);
                unset($_SESSION["description_error"]);
                unset($_SESSION["price_error"]);
                unset($_SESSION["image_error"]);
                unset($_SESSION["start_date_error"]);
                unset($_SESSION["end_date_error"]);
                unset($_SESSION["colour"]);
                unset($_SESSION["category"]);
                unset($_SESSION["sub_category_error"]);

                header("Location:view.php");
            } else {
                header("location:edit.php?id=$id");
            }
        }
    } else {
        header("location:edit.php?id=$id");
    }
}
?> 