<?php
//session start
session_start();
//database connection
include("connection.php");
if (!isset($_SESSION['loginSuccess'])) {
    header("location: login.php");
}

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('id','name', 'description', 'price', 'image', 'start_date', 'end_date', 'colour', 'category', 'subcategory_name', 'Action');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'desc' : 'asc';
$up_or_down = str_replace(array('asc', 'desc'), array('up', 'down'), $sort_order);
$asc_or_desc = $sort_order == 'asc' ? 'desc' : 'asc';
$add_class = ' class="highlight"';


//get the page number//
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
//total recordsa per value//
$total_records_per_page = 3;

//calculating offset value and set variables/
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
// Number List
//total number of page for pagination//
$sql1 = "SELECT * FROM user where emailid='" . $_SESSION['emailid'] . "'";

$q = mysqli_query($conn, $sql1);
$row = mysqli_fetch_array($q);
$user_id = $row['user_id'];

$result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM `product`WHERE user_id = '$user_id'");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total pages minus 
$count = (is_numeric($_GET['count']) ? $_GET['count'] : 0);
?>
<!--html form-->
<!DOCTYPE html>
<html>
    <head> 

        <title>View</title>
        <link rel="stylesheet" type="text/css" href="task.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">



        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!--icon-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--symbol-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>      

    </head>
    <body>
        <div class="col">
            <div class="row">
                <div class="col12">
                    <h1>Welcome <?php echo $_SESSION ['emailid']; ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 float-right">
                    <form action="" method="POST">

                        <input type="text" placeholder="Search" autocomplete="off" name="search" id="search" class="float-right">

                        <button type="submit" formaction="view.php" class="float-right" ><i class="fa fa-search"></i></button>

                    </form>
                </div>
            </div>


            <div class="row" style="padding-top: 5px;">
                <div class="col pull-left">

                    <form action="product.php" method="POST">
                        <button type="submit" name="id" class="btn btn-primary" value="<?php echo $result['id']; ?>">ADD</button>
                    </form>
                </div>

                <div class="col pull-right">
                    <form action= "logout.php" method="POST">
                        <button type="SUBMIT" name="id" class="btn btn-danger pull-right" value="<?php echo $result['id']; ?>">Logout</button>
                    </form>
                </div>
            </div>

            <div class="row" style="padding-top: 10px">
                <table class="table table-striped table-bordered">

                    <thead>
                    <th><a href="view.php?column=id & order=<?php echo $asc_or_desc; ?>">Id<i class="fas fa-sort <?php echo $column == 'id' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=name & order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=description & order=<?php echo $asc_or_desc; ?>">Descri ption<i class="fas fa-sort<?php echo $column == 'description' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=price & order=<?php echo $asc_or_desc; ?>">Price<i class="fas fa-sort<?php echo $column == 'price' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=image & order=<?php echo $asc_or_desc; ?>">Image<i class="fas fa-sort<?php echo $column == 'image' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=start_date & order=<?php echo $asc_or_desc; ?>">Start date<i class="fas fa-sort<?php echo $column == 'start_date' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=end_date & order=<?php echo $asc_or_desc; ?>">End date<i class="fas fa-sort<?php echo $column == 'end_date' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=colour & order=<?php echo $asc_or_desc; ?>">Colour<i class="fas fa-sort<?php echo $column == 'colour' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=category & order=<?php echo $asc_or_desc; ?>">Category<i class="fas fa-sort<?php echo $column == 'category' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="view.php?column=subcategory_name & order=<?php echo $asc_or_desc; ?>">Sub category<i class="fas fa-sort<?php echo $column == 'subcategory_name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
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

                            $q = "SELECT product.*,category.category_name,subcategory.subcategory_name FROM ((product INNER JOIN category ON product.category = category.category_id) INNER JOIN subcategory ON product.sub_category = subcategory.subcategory_id) WHERE user_id='$user_id' and  name LIKE '%" . $search . "%' LIMIT $offset, $total_records_per_page";
                        } else {

                            $q = "SELECT product.*,category.category_name,subcategory.subcategory_name FROM ((product INNER JOIN category ON product.category = category.category_id) INNER JOIN subcategory ON product.sub_category = subcategory.subcategory_id) WHERE user_id='$user_id'ORDER BY  $column $sort_order  LIMIT $offset, $total_records_per_page ";
                        }

//                                    $data = mysqli_query($conn, $q);
//                            $q = "SELECT * FROM product WHERE user_id='$user_id'";
                        $data = mysqli_query($conn, $q);
                        $row1 = mysqli_num_rows($data);
                        if ($row1 == 0 || empty($_POST['search']) && isset($_POST['search'])) {
                            ?>
                            <tr>
                                <td colspan="11" style="text-align:center">no records found </td>
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

                                    <td<?php echo $column == 'id' ? $add_class : ''; ?>><?php echo $result['id']; ?></td>	  
                                    <td<?php echo $column == 'name' ? $add_class : ''; ?>><?php echo $result['name']; ?></td>
                                    <td<?php echo $column == 'description' ? $add_class : ''; ?>><?php echo $result['description']; ?></td>
                                    <td<?php echo $column == 'price' ? $add_class : ''; ?>><?php echo $result['price']; ?></td>
                                    <td<?php echo $column == 'image' ? $add_class : ''; ?>><img src="<?php echo $result['image']; ?>" height="42" width="55"></td>
                                    <td<?php echo $column == 'start_date' ? $add_class : ''; ?>><?php echo $result['start_date']; ?></td>
                                    <td<?php echo $column == 'end_date' ? $add_class : ''; ?>><?php echo $result['end_date']; ?></td>
                                    <td<?php echo $column == 'colour' ? $add_class : ''; ?>><?php echo $result['colour']; ?></td>
                                    <td<?php echo $column == 'category_name' ? $add_class : ''; ?>><?php echo $result['category_name']; ?></td>
                                    <td<?php echo $column == 'subcategory_name' ? $add_class : ''; ?>><?php echo $result['subcategory_name']; ?></td>
                                    <td><form action= "edit.php" method="POST"><button type="SUBMIT" name="id" class="btn btn-primary" value="<?php echo $result['id']; ?>">Edit</button></form>
                                        <form action='delete.php' method='post'><button type="SUBMIT" name="id"   class="btn btn-danger" onclick="confirmation()" value="<?php echo $result['id']; ?>">Delete</button>
                                        </form></td>
                                </tr>    
                                <?php
                            }
                        }
                        ?>


                    </tbody>

                </table>
            </div>

            <div class="row">
                <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
            </div>
            <ul class="pagination">

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

            </ul>


        </div>


    </body>
</html>

<!--delete pop up-->
<script type="text/javascript">

    function confirmation() {
        var answer = confirm('Are you sure you want to delete?');
        if (answer) {
            submit();
        } else {
            alert("Cancelled the delete!")
        }
    }

</script>
</script>
<!-- search with ajax-->
<script type="text/javascript">
    $(document).ready(function () {

        $('#search').typeahead({
            source: function (query, result)
            {

                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {query: query},
                    dataType: "json",
                    success: function (data)
                    {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                })
            }
        });

    });
</script>












