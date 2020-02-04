<?php
//session start
session_start();
//database connection
include("connection.php");
if (!isset($_SESSION['loginSuccess'])) {
    header("location: login.php");
}
extract($_POST);
////get the page number//
//if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
//    $page_no = $_GET['page_no'];
//} else {
//    $page_no = 1;
//}
////total recordsa per value//
//$total_records_per_page = 3;
//
////calculating offset value and set variables/
//$offset = ($page_no - 1) * $total_records_per_page;
//$previous_page = $page_no - 1;
//$next_page = $page_no + 1;
//$adjacents = "2";
//// Number List
////total number of page for pagination//
//$sql1 = "SELECT * FROM user where emailid='" . $_SESSION['emailid'] . "'";
//
//$q = mysqli_query($conn, $sql1);
//$row = mysqli_fetch_array($q);
//$user_id = $row['user_id'];
//
//$result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM `product`WHERE user_id = '$user_id'");
//$total_records = mysqli_fetch_array($result_count);
//$total_records = $total_records['total_records'];
//$total_no_of_pages = ceil($total_records / $total_records_per_page);
//$second_last = $total_no_of_pages - 1; // total pages minus 
//$count = (is_numeric($_GET['count']) ? $_GET['count'] : 0);
?>
<!--html form-->
<!DOCTYPE html>
<html>
    <head>
        <title>View</title>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


        <style>


        </style>

    </head>
    <body>

        <div class="container">
            <div class="row">

                <h1>Welcome <?php echo $_SESSION ['emailid']; ?></h1>

                <br>
            </div>

            <div class="row">
                <div style="width: 100%">
                    <div class="col-6 float-left">
                        <form action="product.php" method="POST">
                            <button type="submit" name="id" class="btn btn-primary float-left" value="<?php echo $result['id']; ?>">ADD</button>
                        </form>
                    </div>
                    <div class="col-6 float-right">
                        <form action= "logout.php" method="POST">
                            <button type="SUBMIT" name="id" class="btn btn-danger float-right" value="<?php echo $result['id']; ?>">logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="padd">
                    <table id="example" class="display  table table-striped table-bordered">

                        <thead>
                        <th>Id</th>
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

                                $q = "SELECT product.*,category.category_name,subcategory.subcategory_name FROM ((product INNER JOIN category ON product.category = category.category_id) INNER JOIN subcategory ON product.sub_category = subcategory.subcategory_id) WHERE user_id='$user_id' and  name LIKE '%" . $search . "%' ";
                            } else {

                                $q = "SELECT product.*,category.category_name,subcategory.subcategory_name FROM ((product INNER JOIN category ON product.category = category.category_id) INNER JOIN subcategory ON product.sub_category = subcategory.subcategory_id) WHERE user_id='$user_id'";
                            }
//                                    $data = mysqli_query($conn, $q);
//                            $q = "SELECT * FROM product WHERE user_id='$user_id'";
                            $data = mysqli_query($conn, $q);
                            $row1 = mysqli_num_rows($data);
                            if ($row1 == 0) {
                                ?>
                                <tr>
                                    <td>no records found </td>
                                    <?php
                                } else {
                                    $i = 0;
                                    while ($result = mysqli_fetch_array($data)) {


                                        $i++;
//                                //echo "<pre>"; print_r($result);
//                                // (exit);
//                                
                                        ?>
                                    <tr>

                                        <td><?php echo $result['id']; ?></td>	  
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
                                    <?php
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

<!--pagination & searching-->
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            "pagingType": "numbers",
            "pageLength": 3
        });
    });
</script>