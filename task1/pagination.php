<?php  

 //pagination.php  
 include("connection.php"); 
 $record_per_page = 3;  
 $page = '';  
 $output = '';  
 if(isset($_POST["page"]))  
 {  
      $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }  
 $start_from = ($page - 1)*$record_per_page;  
 $query = "SELECT * FROM product ORDER BY id DESC LIMIT $start_from, $record_per_page";  
 $row = mysqli_query($conn, $query);  

     ?>
    <html>
    <head>
        <title>View</title>
     $output .= "  
      <table class='table table-bordered'>  
           <thead>  
                <th>id</th>
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
        ";
           <tbody>
               
 while($result = mysqli_fetch_array($row))  
 {  
         $output .= '  
      
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
                
           </tr>  
           ';
 }
 <?php
 $output .= '</table><br /><div align="center">';  
 $page_query = "SELECT * FROM product ORDER BY id DESC";  
 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  
 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
 }  
 $output .= '</div><br /><br />';  
 echo $output; 
 

?>


<tbody>
</body>
</html>




