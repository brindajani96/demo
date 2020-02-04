
<!DOCTYPE html> 
<html> 
  <head> 
    <title></title> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" 
     href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  </head> 
  <body> 
  <?php 
      
    // Import the file where we defined the connection to Database.   
    require_once "connection.php"; 
  
    $limit = 3;  // Number of entries to show in a page. 
    // Look for a GET variable page if not found default is 1.      
    if (isset($_GET["page"])) {  
      $pn  = $_GET["page"];  
    }  
    else {  
      $pn=1;  
    };   
  
    $start_from = ($pn-1) * 3;   
  
    $sql = "SELECT * FROM product LIMIT $start_from, $limit";   
    $rs_result = mysql_query ($sql);  
  
  ?> 
  <div class="container"> 
    <br> 
    <div> 
      <h1></h1> 
      <p>This page is just for demonstration of  
                 Basic Pagination using PHP.</p> 
      <table class="table table-striped table-condensed table-bordered"> 
        <thead> 
        <tr> 
          <th width="10%">Rank</th> 
          <th>Name</th> 
          <th>College</th> 
          <th>Score</th> 
        </tr> 
        </thead> 
        <tbody> 
        <?php   
          while ($row = mysql_fetch_array($rs_result, MYSQL_ASSOC)) {  
                  // Display each field of the records.  
        ?>   
        <tr>   
          <td><?php echo $row["rank"]; ?></td>   
          <td><?php echo $row["name"]; ?></td> 
          <td><?php echo $row["college"]; ?></td> 
          <td><?php echo $row["score"]; ?></td>                                         
        </tr>   
        <?php   
        };   
        ?>   
        </tbody> 
      </table> 
      <ul class="pagination"> 
      <?php   
        $sql = "SELECT COUNT(*) FROM product";   
        $rs_result = mysql_query($sql);   
        $row = mysql_fetch_row($rs_result);   
        $total_records = $row[0];   
          
        // Number of pages required. 
        $total_pages = ceil($total_records / $limit);   
        $pagLink = "";                         
        for ($i=1; $i<=$total_pages; $i++) { 
          if ($i==$pn) { 
              $pagLink .= "<li class='active'><a href='view.php?page="
                                                .$i."'>".$i."</a></li>"; 
          }             
          else  { 
              $pagLink .= "<li><a href='view.php?page=".$i."'> 
                                                ".$i."</a></li>";   
          } 
        };   
        echo $pagLink;   
      ?> 
      </ul> 
    </div> 
  </div> 
  </body> 
</html> 

//<?php
//include("connection.php");
//?>
<html>
<head>
    <title>Pagination</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    //<?php
//
//        if (isset($_GET['pageno'])) {
//            $pageno = $_GET['pageno'];
//        } else {
//            $pageno = 1;
//        }
//        $no_of_records_per_page = 3;
//        $offset = ($page-1) * $no_of_records_per_page;
//
//        $total_pages_sql = "SELECT COUNT(*) FROM product";
//        $result = mysqli_query($conn,$total_pages_sql);
//        $total_rows = mysqli_fetch_array($result)[0];
//        $total_pages = ceil($total_rows / $no_of_records_per_page);
//
//        $sql = "SELECT * FROM product LIMIT $offset, $no_of_records_per_page";
//        $data = mysqli_query($conn,$sql);
//        
//mysqli_close($conn);
//    ?>
    <ul class="pagination">
        <li><a href=view.php>1</a></li>
        <li class="//<?php if($page <= 1){ echo 'disabled'; } ?>">
            <a href="//<?php if($page <= 1) { echo "?page=".($page - 1); } ?>">2</a>
        </li>
        <li class="//<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
            <a href="//<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">3</a>
        </li>
        <li><a href="?page=//<?php echo $total_pages; ?>">4</a></li>
    </ul>