
<?php 
function validateMember()
{
    $valid = true;
    $errorMessage = array();
    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $valid = false;
        }
    }
    if (! isset($error_message)) {
            if (empty($_POST['firstname'] )) {
            $errorMessage[] = 'please enter firstname.';
            $valid = false;
            }
        }
        if (! isset($error_message)) {
            if (empty($_POST['firstname'] )) {
            $errorMessage[] = 'please enter lastname.';
            $valid = false;
            }
        }

    if (! isset($error_message)) {
            if (! filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
                $errorMessage[] = "Invalid email address.";
                $valid = false;
            }
        }
    
    if($valid == true) {
        if ($_POST['password'] != $_POST['confirm_password']) {
            $errorMessage[] = 'Passwords should be same.';
            $valid = false;
        }
        
        
        
        if (! isset($error_message)) {
            if (! isset($_POST["terms"])) {
                $errorMessage[] = "Accept terms and conditions.";
                $valid = false;
            }
        }
    }
    
    
    if ($valid == false) {
        return $errorMessage;
    }
    return;
}
?>