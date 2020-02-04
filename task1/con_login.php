<?php

session_start();
include_once("connection.php");
extract($_POST);

if (!isset($message)) {
    if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid UserEmail";
        $type = "error";
    }
}
$emailid = $emailid;
$password = $password;
$passwordHash = md5($password);

$sql = "SELECT * FROM user WHERE emailid = '$emailid' AND password = '$passwordHash'";
$q1 = mysqli_query($conn, $sql);
$row = mysqli_num_rows($q1);






// /while ($row = mysql_fetch_assoc($row) {
//      $check_username = $row['username'];
//     $check_password = $row['password'];*/
if (isset($_POST['rememberme'])) {
    //$times = new date();
    //$times = $times + 90;

    $_SESSION["emailid"] = $emailid;
    setcookie("emailid", $emailid, time() + 60);
    setcookie("password", $password, time() + 60);
    header("Location: view.php");
}
if ($row == 1) {

    $_SESSION["emailid"] = $emailid;
    $_SESSION['loginSuccess'] = "true";
    //setcookie("emailid", $emailid, time() + (86400 * 30)); 
    //setcookie("password", $password, time() + (86400 * 30)); */
    header("Location: view.php");
} else {
    "invalid emailid or password";
    header('Location:login.php?msg=invalid emailid or password');
}
?>
