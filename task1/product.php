<?php
session_start();
include("connection.php");
if (!isset($_SESSION['emailid'])) {
    header("location: login.php");
}

extract($_POST);
//print_r($_POST);
//die();
// //Above HTML  

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


if (isset($_POST["btninsert"])) {
    if (empty($_POST["name"])) {
        $name_error = "<p>Please Enter Name</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["name"])) {
            $name_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($_POST["description"])) {
        $description_error = "<p>Please Enter description</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["description"])) {
            $description_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }

    if (empty($_POST["price"])) {
        $price_error = "<p>Please Enter price</p>";
    } else {
        if (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $_POST["price"])) {
            $price_error = "<p>Only numbers and whitespace allowed</p>";
        }
    }

//    // if(empty($_POST["image"]))  
//    // {  
//    //      $image_error = "<p>Please your image</p>";  
//    // } 
////    $target_dir = "image/";
////$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
////$uploadOk = 1;
////
////$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
////// Check if image file is a actual image or fake image
////// Check if file already exists
//
////// Check file size
////elseif ($_FILES["product_image"]["size"] > 500000) {
////     $_SESSION["image_error"]= "<p>Sorry, your file is too large.</p>";
////    $uploadOk = 0;
////}
////// Allow certain file formats
////if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
////&& $imageFileType != "gif" ) {
////    $_SESSION["image_error"]= "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
////    $uploadOk = 0;
////}

    if (empty($_POST["start_date"])) {
        $start_date_error = "<p>Please enter your start_date</p>";
    }
    if (empty($_POST["end_date"])) {
        $end_date_error = "<p>Please enter your end_date</p>";
    }
    if (empty($_POST["colour"])) {
        $colour_error = "<p>Please enter your colour</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["colour"])) {
            $colour_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($_POST["category"])) {
        $category_error = "<p>Select your category</p>";
    }
    if (empty($_POST["sub_category"])) {
        $sub_category_error = "<p>Select  your sub_category</p>";
    }
    if (strtotime($start_date) > strtotime($end_date)) {
        $end_date_error = "<p>end_date should be greater than start date</p>";
    }




    if ($name_error == "" && $description_error == "" && $price_error == "" && $start_date_error == "" && $end_date_error == "" && $colour_error == "" && $category_error == "" && $sub_category_error == "") {
        $output = '<p><label>Ouput-</label></p>  
           <p>Your name is ' . $_POST["name"] . '</p>  
           <p>Your description is ' . $_POST["description"] . '</p>  
           <p>Your price is ' . $_POST["price"] . '</p>  
//           
           <p>Your start_date is ' . $_POST["start_date"] . '</p>  
           <p>Your end_date is ' . $_POST["end_date"] . '</p>  
           <p>Your colour is ' . $_POST["colour"] . '</p>  
           <p>Your category is ' . $_POST["category"] . '</p>
            <p>Your sub_category is ' . $_POST["sub_category"] . '</p> 
            ';



        if (isset($btninsert)) {
            $name = $name;
            $description = $description;
            $price = $price;
            $image = $image;
            $date = $start_date;
            $end_date = $end_date;
            $colour = $colour;
            $category_id = $category;
            $subcategory_id = $sub_category;


            $sql1 = "SELECT * FROM user where emailid='" . $_SESSION['emailid'] . "'";

            $q = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_array($q);

            $user_id = $row['user_id'];



            $target_dir = "image/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;



            $q = "INSERT INTO product ( name, description, image, price, colour, start_date, end_date, category, sub_category,user_id) VALUES ( '$name', '$description', '$target_file', '$price', '$colour', '$date', '$end_date', '$category_id', '$subcategory_id','$user_id')";


            $data = mysqli_query($conn, $q);
            if ($uploadOk = 1) {
                header("Location:view.php");
            } else {
                echo "data not inserted";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Product Form</title>
        <link rel="stylesheet" type="text/css" href="task.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js">

        </script>
    </head>





    <div class="container">
        <h1> Product </h1>
        <form action="product.php" method="POST" enctype="multipart/form-data"> 


            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control col-sm-6" id="name"  placeholder="Enter product name" name="name"  value="<?php if (isset($_COOKIE['name'])) echo $_COOKIE['name']; ?>"  data-validation="length"
                       data-validation-length="3-12"><span class="text-danger"><?php echo $name_error; ?></span>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control col-sm-6" id="description" placeholder="Enter product description" name="description"  value="<?php if (isset($_COOKIE['description'])) echo $_COOKIE['description']; ?>"  data-validation="length"
                       data-validation-length="3-12"><span class="text-danger"><?php echo $description_error; ?></span>
            </div>   

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control  col-sm-6" id="price" placeholder="Enter product price"autocomplete="off"  name="price"  value="<?php if (isset($_COOKIE['price'])) echo $_COOKIE['price']; ?>" data-validation="number" data-validation-allowing="float"><span id="errmsg"><?php echo $price_error; ?></span>
            </div>    

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control col-sm-6" id="image" placeholder="Enter product image" name="image"  value="<?php if (isset($_COOKIE['image'])) echo $_COOKIE['image']; ?>" data-validation="required " data-validation-allowing="jpg, png, gif, jpeg" ><span class="text-danger"><?php echo $image_error; ?></span> 
            </div>

            <div class="form-group">
                <label for="start_date">Start date:</label>
                <input type="date" class="form-control col-sm-6" id="start_date" placeholder="Enter product date" name="start_date"  value="<?php if (isset($_COOKIE['start_date'])) echo $_COOKIE['start_date']; ?>" data-validation="date" 
                       data-validation-format="yyyy-mm-dd"><span class="text-danger"><?php echo $start_date_error; ?></span>
            </div>

            <div class="form-group">
                <label for="end_date">End date:</label>
                <input type="date" class="form-control col-sm-6" id="end_date" placeholder="Enter product enddate" name="end_date"  value="<?php if (isset($_COOKIE['end_date'])) echo $_COOKIE['end_date']; ?>" data-validation="date"  data-validation-format="yyyy-mm-dd"><span class="text-danger"><?php echo $end_date_error; ?></span>
            </div>

            <div class="form-group">
                <label for="colour">Colour:</label>
                <input type="text" class="form-control col-sm-6" id="colour" placeholder="Enter product colour" name="colour"  value="<?php if (isset($_COOKIE['colour'])) echo $_COOKIE['colour']; ?>" data-validation="length">
                <span class="text-danger"><?php echo $colour_error; ?></span>
            </div>   

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control col-sm-6" id="category" name="category" data-validation="length">
                    <option value="">Select Category</option>

                    <?php
                    $sql = "SELECT * FROM category";
                    $q1 = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($q1)) {
                        ?>
                        <option value="<?php echo $row["category_id"]; ?>"><?php echo $row["category_name"]; ?></option>
                        <?php
                    }
                    ?>
                </select><span class="text-danger"><?php echo $category_error; ?></span>
            </div>
            <div class="form-group">
                <label for="sub_category">Sub category:</label>
                <select class="form-control col-sm-6" id="subcategory" name="sub_category" data-validation="length">
                    <option value="">Select SubCategory</option>
                </select><span class="text-danger"><?php echo $sub_category_error; ?></span>
            </div>


            <button type="submit" name="btninsert" value="validate" class="btn btn-success">Submit</button>
            <a href="view.php">Back</a>

    </div>

    <?php
    extract($_GET);
    if (isset($msg))
        echo $msg
        ?>
    /<!--price should be in not type give validation//-->
    <script type="text/javascript">
        $(document).ready(function () {
            //called when key is pressed in textbox
            $("#price").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
                }
            });
        });
    </script>
    <!category-->
    <script type="text/javascript">
        $('#category').on('change', function () {
            var category_id = this.value;

            $.ajax({
                url: "subcategory.php",
                type: "POST",
                data: {
                    category_id: category_id
                },
                cache: false,
                success: function (dataResult) {
                    $("#subcategory").html(dataResult);
                }
            });
        });

    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</form>
</div>
</body>
</html>
<script type="text/javascript">

    // $.validate({
    //      modules : 'file, date, security'
    // });

</script>
