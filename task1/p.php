
<?php
include("connection.php");
extract($_POST);
//get the page number//
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
//total recordsa per value//
$total_records_per_page = 5 ;

//calculating offset value and set variables/
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
//total number of page for pagination//
$result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM `product`");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total pages minus 
//query for fetching records using limit//

    ?>
    <html>
        <head>
            <title>pagination</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
            <style>
              




                /* Style the search field */
                form.example input[type=text] {
                    padding: 10px;
                    font-size: 10px;
                    border: 1px solid grey;
                    float: right;
                    width: 20%;
                    background: #f1f1f1;
                }

                /* Style the submit button */
                form.example button {
                    float: right;
                    width: 5%;
                    padding: 10px;
                    background: #2196F3;
                    color: white;
                    font-size: 10px;
                    border: 1px solid grey;
                    border-left: none; /* Prevent double borders */
                    cursor: pointer;
                }

                form.example button:hover {
                    background: #0b7dda;
                }

                /* Clear floats */
                form.example::after {
                    content: "";
                    clear: both;
                    display: table;
                }

            </style>

        </head>
        <body>

         
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">

                        <h1>Welcome <?php echo $_SESSION ['emailid']; ?></h1>
                        <form class="example" action="" method="POST">
                            <input type="text" placeholder="Search" name="search" id="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <br>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <form action="product.php" method="POST">
                            <button type="submit" name="id" class="btn btn-primary" value="<?php echo $result['id']; ?>">ADD</button>
                        </form>
                    </div>

                    <div class="col-sm-6">
                        <form action= "logout.php" method="POST">
                            <button type="SUBMIT" name="id" class="btn btn-danger pull-right" value="<?php echo $result['id']; ?>">logout</button>
                        </form>
                          
                    </div>

                <table  class=""table table-striped table-bordered"">

                    <thead>
                    <th style='width:50px;'>id</th>
                    <th>Name</th>
                    <th>Descryption</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Start_date</th>
                    <th>End_date</th>
                    <th>Colour</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
    <?php
    $sql1 = "SELECT * FROM user where emailid='" . $_SESSION['emailid'] . "'";

    $q = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($q);
    $user_id = $row['user_id'];


    //select query//

    if (isset($_POST['search'])) {

        $q = "SELECT product.*,category.category_name,subcategory.subcategory_name FROM ((product INNER JOIN category ON product.category = category.category_id) INNER JOIN subcategory ON product.sub_category = subcategory.subcategory_id) WHERE name LIKE '%" . $search . "%'";
    } else {

       echo  $q = "SELECT product.*,category.category_name,subcategory.subcategory_name FROM ((product INNER JOIN category ON product.category = category.category_id) INNER JOIN subcategory ON product.sub_category = subcategory.subcategory_id) WHERE user_id='$user_id'LIMIT $offset, $total_records_per_page";
    }
    $data = mysqli_query($conn, $q);
    $row = mysqli_num_rows($data);
    if ($row == 0) {
        ?>
                            <tr>
                                <td>no records found </td>
                            <?php
                        } else {
                            $i = 0;
                            while ($result = mysqli_fetch_array($data)) {
                                $i++;
                             //echo "<pre>"; print_r($result);
                               //(exit);
                                
                                ?>
                                <tr>
                                     <td><?php echo $i; ?></td>	  
                                            <td><?php echo $result['name']; ?></td>
                                            <td><?php echo $result['description']; ?></td>
                                            <td><?php echo $result['price']; ?></td>
                                            <td><img src="<?php echo $result['image']; ?>" height="42" width="55"></td>
                                            <td><?php echo $result['start_date']; ?></td>
                                            <td><?php echo $result['end_date']; ?></td>
                                            <td><?php echo $result['colour']; ?></td>
                                            <td><?php echo $result['category_name']; ?></td>
                                            <td><?php echo $result['subcategory_name']; ?></td>
                                    <td><form action= "edit.php" method="POST"><button type="SUBMIT" name="id" class="btn btn-primary" value="<?php echo $result['id']; ?>">Edit</button></form>
                                        <form action= "delete.php" method="POST"><button type="SUBMIT" name="id" class="btn btn-danger" value="<?php echo $result['id']; ?>">Delete</button></form>
                                </tr>
            <?Php
        }
    }
    
    ?>


                    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                        <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
                    </div>

                   
           
    <?php
    if ($total_no_of_pages <= 6) {

        for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
            if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
            } else {
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
            }
        }
    }
    ?>
                     </tbody>
                    </table>
 </div>
            </div>
        </div>
    
    </body>
    </html>
               