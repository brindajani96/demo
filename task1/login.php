<?php
session_start();
//session_destroy();
if (isset($_SESSION['emailid'])) {
    header("location: view.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <center>
        <title>Login Form</title>
        <link rel="stylesheet" type="text/css" href="task.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    </head>


    <div class="input-container">

        <!-- <div class=""> -->
        <div class="col-sm-4">
        </div>

        <div class="col-sm-4">
            <form action="con_login.php" method="POST" style="max-width:600px; margin:auto">
                <center><h1>Login Form </h1>


                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i><input type="email" class="input-field" id="emailid" placeholder="Enter email" name="emailid">
                    </div>            
                    <br>
                    <div class="input-container">
                        <i class="fa fa-key icon"></i>
                        <input type="password" class="input-field" id="password" placeholder="Enter password" name="password">
                    </div>
                    <br>

                    <div>
                        <label><input id="rememberme" name="rememberme" value="remember" type="checkbox"/> &nbsp;Remember me </label>               <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <span class="txt1">Don't have an account?</span>
                    <a class="txt2" href="registration.php">registration</a>
                    <br>
                    <p class= "invalid_login" >
                        <?php
                        extract($_GET);
                        if (isset($msg))
                            echo $msg
                            ?>	
                    <p>

                        </div>

                    <div class="col-sm-4">	

                        </form>
                    </div>
                    </div>
                </center>
                </body>
                </html>

