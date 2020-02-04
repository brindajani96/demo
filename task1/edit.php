<?php
//session start
session_start();
//database connection
require("connection.php");
extract($_POST);
extract($_GET);
extract($_SESSION);
$response = $_SESSION;

//echo "<pre>";print_R($response);die;
//html form
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
        $sql = "SELECT * FROM product where id='$id'";
        $q1 = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($q1);
        ?>
        <link rel="stylesheet" type="text/css" href="task.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <div class="container">
            <h1> Product </h1>
            <form action="updatecontroller.php" method="POST" enctype="multipart/form-data"> 
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>"> <br>      

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control col-sm-4" id="name" placeholder="Enter product name" name="name"  value="<?php echo $data['name']; ?>"><span class="text-danger"><?php echo isset($response['name_error']) ? $response['name_error'] : ""; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control col-sm-4" id="description" placeholder="Enter product description" name="description"  value="<?php echo $data['description']; ?>"><span class="text-danger"><?php echo isset($response['description_error']) ? $response['description_error'] : ""; ?></span>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control col-sm-4" id="price" placeholder="Enter product price" name="price"  value="<?php echo $data['price']; ?>"><span class="text-danger"><?php echo isset($response['price_error']) ? $response['price_error'] : ""; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <img src="<?php echo $data['image']; ?>" height="42" width="55">
                    <input type="file" class="form-control col-sm-4" id="image" placeholder="Enter product image" name="image">
                    <span class="text-danger"><?php echo isset($response['image_error']) ? $response['image_error'] : ""; ?></span>  
                    <div class="form-group">
                        <label for="start_date">Start date:</label>
                        <input type="date" class="form-control col-sm-4" id="start_date" placeholder="Enter product date" name="start_date"  value="<?php echo $data['start_date']; ?>"><span class="text-danger"><?php echo isset($response['start_date_error']) ? $response['start_date_error'] : ""; ?></span>
                    </div>		

                    <div class="form-group">
                        <label for="end_date">End date:</label>
                        <input type="date" class="form-control col-sm-4" id="end_date" placeholder="Enter product enddate" name="end_date"  value="<?php echo $data['end_date']; ?>"><span class="text-danger"><?php echo isset($response['end_date_error']) ? $response['end_date_error'] : ""; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="colour">Colour:</label>
                        <input type="text" class="form-control col-sm-4" id="colour" placeholder="Enter product colour" name="colour"  value="<?php echo $data['colour']; ?>"><span class="text-danger"><?php echo isset($response['colour_error']) ? $response['colour_error'] : ""; ?></span></div>

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="form-control col-sm-4" id="category" name="category" data-validation="length" placeholder="Enter category">
                            <option value="">Select Category</option>

                            <?php
                            $sql = "SELECT * FROM category";
                            $q1 = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($q1)) {
                                $selected = ( $row['category_id'] == $data['category'] ? ' selected' : '' );
                                echo '<option value="' . $row['category_id'] . '"' . $selected . '>' . $row['category_name'] . '</option>';
                            }
                            ?>
                        </select>
                        <span class="text-danger"><?php echo isset($response['category_error']) ? $response['category_error'] : ""; ?>
                        </span>
                    </div>


                    <div class="form-group">
                        <label for="sub_category">Sub category:</label>
                        <select class="form-control col-sm-4" id="subcategory" name="sub_category" data-validation="length"><option value="">Select Sub Category</option>
                            <?php
                            $sql = "SELECT * FROM subcategory where category_id= " . $data['category'];
                            $q1 = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($q1)) {
                                $selected = ( $row['subcategory_id'] == $data['sub_category'] ? ' selected' : '' );
                                echo '<option value="' . $row['subcategory_id'] . '"' . $selected . '>' . $row['subcategory_name'] . ''
                                . '</option>';
                            }
                            ?>
                        </select>
                        <span class="text-danger"><?php echo isset($response['sub_category_error']) ? $response['sub_category_error'] : ""; ?></span>
                    </div>

                    <br>  

                    <script type="text/javascript">
                        //ajax
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
                    <button type="submit" name="btnupdate" value="submit" class="btn btn-success">Submit</button>
                    <a class="txt1" href="view.php">Back</a>


            </form>
    </body>
</html>