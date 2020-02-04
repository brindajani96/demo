<?php
require("connection.php");
extract($_POST);
 $sql="DELETE FROM product WHERE id='$id'";
$q1=mysqli_query($conn,$sql);
  if($q1>0){
  	header("Location:view.php");
        echo "Are you sure you want to delete the record?";
  }else
  {
  	echo"Data is not deleted";
  }
  ?>
  