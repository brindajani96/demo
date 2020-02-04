<?php
//fetch.php
$conn = mysqli_connect("localhost", "root", "root", "login");
$output = '';
$query = "SELECT * FROM student ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$output = '
<br />
<center><h1>Student Form</h1></center>
   <br />
   
   <div class="table-responsive">
    <table class="table table-bordered" id="insert">
    <tr>
      <th width="20%"> Id</th>
      <th width="70%"> Student Name</th>
      <th width="60%"> Passing Year</th>
      <th width="30%"> CPI </th>
       <th width="60%"> Address</th>
      <th width="30%"> Gender</th>
       <th width="60%"> College Name</th>
      <th width="30%"> DOB </th>
       <th width="30%"> IP Address</th>
      <th width="30%"> Date created</th>
      <th width="60%"> Comments</th>
    </tr>
';
while($row = mysqli_fetch_array($result))
{
 $output .= '
 <tr>
  <td>'.$row["Student Name"].'</td>
  <td>'.$row["Passing Year"].'</td>
  <td>'.$row["CPI"].'</td>
  <td>'.$row["Address"].'</td>
 </tr>
 ';
}
$output .= '</table>';
echo $output;
?>

 
 