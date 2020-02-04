<?php

$conn = mysqli_connect("localhost", "root", "root", "login");

    $student_name_error = '';
$passing_year_error = '';
$CPI_error = '';
$address_error = '';
$gender_error = '';
$college_name_error = '';
$DOB_error = '';
$comments_error = '';
$output = '';

 
  $student_name = $_POST['student_name'];
        $passing_year = $_POST['passing_year'];
        $CPI = $_POST["CPI"];
        $address = ($_POST['address']);
        $gender = ($_POST['gender']);
         $college_name = $_POST["college_name"];
        $DOB = ($_POST['DOB']);
        $comments =($_POST['comments']);

        
        
//whether ip is from share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
//whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
//whether ip is from remote address
    else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }

    
    $query = '';
    for ($count = 0; $count < count($student_name); $count++) {

        $student_name_clean = mysqli_real_escape_string($conn, $student_name[$count]);
        $passing_year_clean = mysqli_real_escape_string($conn, $passing_year[$count]);
        $CPI_clean = mysqli_real_escape_string($conn, $CPI[$count]);
        $address_clean = mysqli_real_escape_string($conn, $address[$count]);
        $gender_clean = mysqli_real_escape_string($conn, $gender[$count]);
        $college_name_clean = mysqli_real_escape_string($conn, $college_name[$count]);
        $DOB_clean = mysqli_real_escape_string($conn, $DOB[$count]);
        $comments_clean = mysqli_real_escape_string($conn, $comments[$count]);
      
        if (empty($student_name_clean)) {
          
        $student_name_error = "<p>Please Enter student name</p>";
    } else { 
        if (!preg_match("/^[a-zA-Z ]*$/", $student_name_clean)) {
            $student_name_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($passing_year_clean)) {  
        $passing_year_error = "<p>Please Enter passing year</p>";
    } else {
       if (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $passing_year_clean)) {
            $passing_year_error = "<p>Only numbers and whitespace allowed</p>";
        }
    }
    if (empty($CPI_clean)) { 
        $CPI_error = "<p>Please Enter CPI</p>";
    } else {
        if (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $CPI_clean)) {
            $CPI_error = "<p>Only numbers and whitespace allowed</p>";
        }
    }
    if (empty($address_clean)) {
        $address_error = "<p>Please Enter address</p>";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $address_clean)) {
            $address_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($gender_clean)) {
        $gender_error = "<p>Please Enter gender</p>";
    } else {
       if (!preg_match("/^[a-zA-Z ]*$/", $gender_clean)) {
            $gender_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($college_name_clean)) {
        $college_name_error = "<p>Please Enter college name</p>";
    } else {
       if (!preg_match("/^[a-zA-Z ]*$/", $college_name_clean)) {
            $college_name_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($DOB_clean)) {
        $DOB_error = "<p>Please Enter DOB</p>";
    } else {
       if (1 !== preg_match('/(0[1-9]|1[0-9]|2[0-9]|3(0|1))\/(0[1-9]|1[0-2])\/\d{4}/', $DOB_clean)) {
            $DOB_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    if (empty($comments_clean)) { 
        $comments_error = "<p>Please Enter college name</p>";
    } else {
       if (!preg_match("/^[a-zA-Z ]*$/", $comments_clean)) {
            $comments_error = "<p>Only Letters and whitespace allowed</p>";
        }
    }
    
        
        if ($student_name_clean != '' && $passing_year_clean != '' && $CPI_clean != '' && $address_clean != '' && $gender_clean != '' && $college_name_clean != '' && $DOB_clean != '' && $comments_clean != '') {
                      
       
          $query = 'INSERT INTO student(student_name,passing_year,CPI,address,gender,college_name,DOB,ip_address, comments) VALUES("' . $student_name_clean . '","' . $passing_year_clean . '","' . $CPI_clean . '","' . $address_clean . '","' . $gender_clean . '","' . $college_name_clean . '","' . $DOB_clean . '","' . $ip_address . '","' . $comments_clean . '")';
        } else{
            $output = '<p><label>Ouput-</label></p>  
           <p>Your student_name is ' . $student_name_error  . '</p>  
           <p>Your passing_year is ' . $passing_year_error . '</p>  
           <p>Your CPI is ' . $CPI_error . '</p>  
           <p>Your address is ' . $address_error . '</p>  
           <p>Your gender_clean is ' . $gender_error . '</p>  
           <p>Your college_name is ' . $college_name_error . '</p>  
            <p>Your DOB is ' . $DOB_error. '</p>  
           <p>Your comments is ' . $comments_error. '</p>      
            ';
        }
    
    }
    if ($query != '') {
        if (mysqli_multi_query($conn, $query)) {
            echo 'Item Data Inserted';
        } else {
            echo 'Error';
        }
    }

?>



