<?php  
 //sort.php  
 $connect = mysqli_connect("localhost", "root", "", "testing");  
 $output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
      $order = 'asc';  
 }  
 else  
 {  
      $order = 'desc';  
 }  
 $query = "SELECT * FROM tbl_employee ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-bordered">  
      <tr>  
           <th><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>  
           <th><a class="column_sort" id="name" data-order="'.$order.'" href="#">Name</a></th>  
           <th><a class="column_sort" id="gender" data-order="'.$order.'" href="#">Gender</a></th>  
           <th><a class="column_sort" id="designation" data-order="'.$order.'" href="#">Designation</a></th>  
           <th><a class="column_sort" id="age" data-order="'.$order.'" href="#">Age</a></th>  
      </tr>  
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr>  
           <td>' . $row["id"] . '</td>  
           <td>' . $row["name"] . '</td>  
           <td>' . $row["gender"] . '</td>  
           <td>' . $row["designation"] . '</td>  
           <td>' . $row["age"] . '</td>  
      </tr>  
      ';  
 }  
 $output .= '</table>';  
 echo $output;  
 ?>  
