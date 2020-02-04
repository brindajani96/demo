<?php
    require("connection.php");
    extract($_POST);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
     $sql="SELECT * FROM product where product_id='$id'";
     $q1 = mysqli_query($conn,$sql);
     $data= mysqli_fetch_array($q1);
 ?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 <style >
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

       input[type=email], input[type=password]
        {
           width: 100%;
           padding: 12px 20px;
           margin: 8px 0;
           display: inline-block;
           border: 1px solid #ccc;
           box-sizing: border-box;
        }
        button 
        {
           background-color: blue;
           color: white;
           padding: 14px;
           margin: center;
           border: none;
           cursor: pointer;
           width: 100%;
        }
        button:hover {
        opacity: 0.8;
        }

</style>
          
                     
                <div class="container">
                <h1> Product </h1>
     			 <form action="updatecontroller.php" method="POST" enctype="multipart/form-data"> 
 	           
                 <input type="hidden" name="id" value="<?php echo $data['product_id'];?>"> <br>      
  			    <div class="form-group">
                        <label for="Product_name">Product_name:</label>
       					<input type="text" class="form-control" id="product_name" placeholder="Enter product_name" name="product_name"  value="<?php echo $data['product_name'];?>">
       			<div class="form-group">
                        <label for="Product_descryption">Product_descryption:</label>
       					<input type="text" class="form-control" id="product_descryption" placeholder="Enter product_descryption" name="product_descryption"  value="<?php echo $data['product_descryption'];?>">
                <div class="form-group">
                        <label for="Product_price">Product_price:</label>
       					<input type="text" class="form-control" id="product_price" placeholder="Enter product_price" name="product_price"  value="<?php echo $data['product_price'];?>">
                 <div class="form-group">
                        <label for="Product_image">Product_image:</label>
                        <img src="<?php echo $data['product_image'];?>" height="42" width="55">
       					<input type="file" class="form-control" id="product_image" placeholder="Enter product_image" name="product_image">
       			<div class="form-group">
                        <label for="product_date">Product_date:</label>
       					<input type="text" class="form-control" id="product_date" placeholder="Enter product_date" name="product_date"  value="<?php echo $data['product_date'];?>">		
                <div class="form-group">
                        <label for="product_end_date">Product_end_date:</label>
       					<input type="text" class="form-control" id="product_end_date" placeholder="Enter product_end_date" name="product_end_date"  value="<?php echo $data['product_end_date'];?>">
                <div class="form-group">
                        <label for="product_colour">Product_colour:</label>
       					<input type="text" class="form-control" id="product_colour" placeholder="Enter product_colour" name="product_colour"  value="<?php echo $data['product_colour'];?>"> 
       		   <div class="form-group">
                        <label for="category_id">Product_category_id:</label>
       					<input type="text" class="form-control" id="category_id" placeholder="Enter category_id" name="category_id"  value="<?php echo $data['category_id'];?>">
       		   <div class="form-group">
                        <label for="sub_category_id">sub_category_id:</label>
       					<input type="text" class="form-control" id="sub_category_id" placeholder="Enter sub_category_id" name="sub_category_id"  value="<?php echo $data['sub_category_id'];?>">		
       					<br>	
                <button type="submit" name="btnupdate" value="submit" class="btn btn-primary">Submit</button>

 
 
</form>
</body>
</html>