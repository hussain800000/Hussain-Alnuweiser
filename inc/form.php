<?php

$firstName = $_POST['firstName'];
$lastName =  $_POST['lastName'];
$email =     $_POST['email'];

$errors = [
    'firstNameError' => '',
    'lastNameError' => '',
    'emailError' => '',
];

if (isset($_POST['submit'])){

   

    //تحقق الاسم الاول
    if(empty($firstName)){
        $errors['firstNameError'] = '<font color=red>يرجى إدخال الأسم الأول</font>';
    }
    // تحقق الاسم الأخير
    if(empty($lastName)){
        $errors['lastNameError'] = '<font color=red>يرجى إدخال الأسم الأخير</font>';
    }
    // تحقق البريد الالكتروني
    if(empty($email)){
        $errors['emailError'] = '<font color=red>يرجى إدخال البريد الألكتروني</font>';
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['emailError'] = '<font color=red>يرجى إدخال البريد الألكتروني صحيح</font>';
    }

    // تحقق لايوجد اخطاء
    if(!array_filter($errors)){
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName =  mysqli_real_escape_string($conn, $_POST['lastName']);
        $email =     mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "INSERT INTO users(firstName, lastName, email) 
            VALUES('$firstName', '$lastName', '$email')";

        if(mysqli_query($conn, $sql)){
            header('location: ' . $_SERVER['PHP_SELF']);
        }
        else{
            echo 'Error:' . mysqli_error($conn);
        }
    }
}
    
    