<?php
session_start();
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//include_once('/home/brinda_jani/htdocs/php/task1/vendor/phpmailer/phpmailer/src/PHPMailer.php');
//server side validation 

$firstname_error = '';
$lastname_error = '';
$email_error = '';
$password_error = '';
$confirmpassword_error = '';
$output = '';
if (isset($_POST["submit"])) {
    if (empty($_POST["firstname"])) {
        $firstname_error = "<p>Please Enter firstName</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["firstname"])) {
            $firstname_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($_POST["lastname"])) {
        $lastname_error = "<p>Please Enter lastName</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["lastname"])) {
            $lastname_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($_POST["emailid"])) {
        $email_error = "<p>Please Enter Email</p>";
    } else {
        if (!filter_var($_POST["emailid"], FILTER_VALIDATE_EMAIL)) {
            $email_error = "<p>Invalid Email formate</p>";
        }
    }
    if (empty($_POST["password"])) {
        $password_error = "<p>Please your password</p>";
    }
    if (empty($_POST["confirmpassword"])) {
        $confirmpassword_error = "<p>Please enter your match password</p>";
    }
    if ($firstname_error == "" && $lastname_error == "" && $email_error == "" && $password_error == "" && $confirmpassword_error == "") {
        $output = '<p><label>Ouput-</label></p>  
           <p>Your firstname is ' . $_POST["firstname"] . '</p>  
           <p>Your lastname is ' . $_POST["lastname"] . '</p>  
           <p>Your Emailid is ' . $_POST["emailid"] . '</p>  
           <p>Your password is ' . $_POST["password"] . '</p>
            <p>Your confirmpassword is ' . $_POST["confirmpassword"] . '</p> 
            ';

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $emailid = $_POST["emailid"];
        $password = md5($_POST['password']);
        $confirmpassword = md5($_POST['confirmpassword']);

        $q = "INSERT INTO user(firstname,lastname,emailid,password,confirmpassword) VALUES('$firstname','$lastname','$emailid','$password','$confirmpassword')";
        $data = mysqli_query($conn, $q);

        require('vendor/autoload.php');
        $mail = new PHPMailer();

        
           //Sets Mailer to send message using SMTP
        
        $mail->isSMTP();                                             // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                      // Set the SMTP server to send through
        $mail->Port = '587';                                  //Sets the default SMTP server port
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'crazydev82@gmail.com';                 // SMTP username
        $mail->Password = 'mitul123';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
           //Recipients
        $mail->setFrom('crazydev82@gmail.com', 'TeseDemo');
        
     $mail->addAddress($emailid, "$firstname $lastname"); 
//     print($mail->addAddress($emailid, "$firstname $lastname"));
//        die();// Add a recipient
          // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'task1';
        $mail->Body = '
        <html>
            <head>
        <title>Send email</title> 
        </head>
         <h1> Welcome  '.$firstname.'</h1>
        <p> you have successfully registered</p>
        <body></body>
        </html>';



        //send the message, check for errors//
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            header("location:login.php");
            echo 'you have successfully registered!';
        }
    }
}
?>

<!--    //   $email_exists = mysqli_query($conn,"SELECT * FROM user WHERE emailid = '$emailid'");
    //   if (mysqli_num_rows($email_exists) > 0) {
    //   // header('Location: registration.php');
    //   echo "Email is already registered.";
    //   }
    //   else
    // { 
    // // if($data==true)
    // if(mail($emailid, "You have successfully registered", "Welcome to the page"))
    //  {
    //   echo "successfully sent";
    //  }
    //   header("Location:login.php");
    //  }
    // else 
    //  {
    //   echo "data not inserted";
    //  }
    // }-->

<!--html-->
<html>
    <head>
        <title>Registration Form</title>
        <link rel="stylesheet" type="text/css" href="task.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <link rel="stylesheet" type="text/css" href="task.css">
        <!--      < script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" ></script>-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
         <!--form validation-->
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
         
    </head>

    <center><h1>Registration form</h1></center>



    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>

            <div class="col-sm-4">
                <form action="" method="POST">


                    <div class="form-group">
                        <label for="firstname">FirstName:</label>
                        <input type="text" class="form-control" id="firstname" placeholder="Enter firstname" name="firstname"  value="<?php
                        if (isset($code) && $code == 1) {
                            echo "class=errorMsg";
                        }
                        ?>" 
                               data-validation="length"
                               data-validation-length="3-12"><span class="text-danger"><?php echo $firstname_error; ?></span>  
                    </div>   

                    <div class="form-group">
                        <label for="lastname">LastName:</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Enter lastname" name="lastname" data-validation="length" data-validation-length="3-12"> <?php
                        if (isset($code) && $code == 1) {
                            echo "class=errorMsg";
                        }
                        ?><span class="text-danger"><?php echo $lastname_error; ?></span> 

                    </div>

                    <div class="form-group">
                        <label for="emailid">Emailid:</label>
                        <input type="email" class="form-control" id="emailid" placeholder="Enter emailid" name="emailid" data-validation="email"> <?php
                        if (isset($code) && $code == 1) {
                            echo "class=errorMsg";
                        }
                        ?><span class="text-danger"><?php echo $email_error; ?></span> 

                    </div>



                    <div class="form-group">  
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" data-validation="strength" data-validation-strength="5"><?php
                        if (isset($code) && $code == 1) {
                            echo "class=errorMsg";
                        }
                        ?><span class="text-danger"><?php echo $password_error; ?></span> 
                    </div>

                    <div class="form-group">
                        <label for="confirmpassword">Confirmpassword:</label>
                        <input type="password" class="form-control" id="confirmpassword" placeholder="Enter confirmpassword" name="confirmpassword"
                               data-validation="strength"
                               data-validation-strength="3"><span class="text-danger"><?php echo $confirmpassword_error; ?></span> 
                    </div> 
                    <div class="form-group">
                        <input type="checkbox" name="terms" data-validation="required" 
                               data-validation-error-msg="You have to agree to our terms">
                        I accept Terms and Conditions 
                    </div>
                    <button type="submit" name="submit" value="Validate" class="btn btn-primary">Sign in</button>
                    <a href="login.php ">login</a>
                    <?php
                    extract($_GET);
                    if (isset($msg))
                        echo $msg
                        ?>

            </div>
            <div class="col-sm-4">  
                </form>
            </div>
        </div>

        <script type="text/javascript">
            //ajax

            // $.validate({
            //      modules : 'file, date, security'
            // });

        </script>
    </body>
</html>

