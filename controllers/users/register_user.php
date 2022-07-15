<?php
require_once '../connection.php';
session_start();
$companycode = $_POST['companycode'];
$company_query = "SELECT * FROM companies WHERE code ='$companycode';";
$company_result = mysqli_query($cn, $company_query);
$company = mysqli_fetch_assoc($company_result);
$errors = 0;    
$company_id;


if(!isset($company)){
    echo ("<script LANGUAGE='JavaScript'>
    window. alert('Company Code doesn't match');
    window. location. href='/views/register_user.php';
    </script>");
    // echo "Company Code doesn't match <br>";
    $errors++;
} else {
    $company_id = $company['id'];
    $user_query = "SELECT * FROM users WHERE company_id = '$company_id';";
    $user_result = mysqli_query($cn, $user_query);
    $user = mysqli_fetch_assoc($user_result);
}


$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$isAdmin;




if(strlen($username) < 5){
    echo ("<script LANGUAGE='JavaScript'>
            window. alert('Username should be atleast 5 character');
            window. location. href='/views/register_user.php';
            </script>");
    // echo "Username should be atleast 5 character <br>";
    $errors++;
}

if(strlen($password) < 8){
    echo ("<script LANGUAGE='JavaScript'>
    window. alert('Password should be atleast 8 character ');
    window. location. href='/views/register_user.php';
    </script>");
    // echo "Password should be atleast 8 character <br>";
    $errors++;
}

if(strlen($password != $password2)){
    echo ("<script LANGUAGE='JavaScript'>
    window. alert('Password should be match');
    window. location. href='/views/register_user.php';
    </script>");
    // echo "Password should be match <br>";
    $errors++;
}



// if($isAdmin == 0){
//     $query = "SELECT isAdmin FROM users WHERE isAdmin = '$isAdmin';";
//     $isAdmin = true;
//     $result = mysqli_fetch_assoc(mysqli_query($cn, $query));
//     if($result){
//         $isAdmin = false;
//         mysqli_close($cn);
//     }
// }

if(!isset($user)) {
    $isAdmin = 1;
} else {
    $isAdmin = 0;
}


if($username) {
    $query = "SELECT username FROM users WHERE username = '$username';";
    $result = mysqli_fetch_assoc(mysqli_query($cn, $query));

    if($result){
        echo ("<script LANGUAGE='JavaScript'>
    window. alert('Username is already taken');
    window. location. href='/views/register_user.php';
    </script>");
        // echo "Username is already taken";
        $errors++;
        mysqli_close($cn);
    }
}

if($errors == 0){
    $companycode = $company['code'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, password, company_id, isAdmin) VALUES ('$username', '$password', $company_id, '$isAdmin');";

    mysqli_query($cn, $query);
    mysqli_close($cn);
    // header('Location: /views/login.php');
    echo ("<script LANGUAGE='JavaScript'>
            window. alert('User Register Successfully');
            window. location. href='/index.php';
            </script>");
}