<?php
//include databse connection
include ("connection.php");
$category_id = $_POST["category_id"];
$sql = "SELECT * FROM subcategory where category_id=$category_id";
$q1 = mysqli_query($conn, $sql);
?>
<option value="">Select SubCategory</option>
<?php
while ($row = mysqli_fetch_array($q1)) {
    ?>
    <option value="<?php echo $row["subcategory_id"]; ?>"><?php echo $row["subcategory_name"]; ?></option>
    <?php
}
?>