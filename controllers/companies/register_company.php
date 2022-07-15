<?php
require_once '../../vendor/autoload.php';
use Carbon\Carbon;
require_once '../connection.php';
$companyname =  mysqli_real_escape_string($cn, $_POST['companyname']);
$companycode = $_POST['companycode'];
$errors = 0;
$date = Carbon::now()->addMonths(1);
// echo $current;
// $future = $current->addMonths();
// echo "<br>";
// echo $future->diffForHumans();
// var_dump($posts);
if(strlen($companyname) < 2){
    // echo ("<script LANGUAGE='JavaScript'>
    //         window. alert('Company Name should be atleast 2 character');
    //         window. location. href='/views/register_company.php';
    //         </script>");
    $errors++;
}

if(strlen($companycode) < 5){
    // echo ("<script LANGUAGE='JavaScript'>
    //         window. alert('Company Code should be atleast 5 character');
    //         window. location. href='/views/register_company.php';
    //         </script>");
    // echo "Company Code should be atleast 5 character <br>";
    $errors++;
}

if($companyname) {
    $query = "SELECT name FROM companies WHERE name = '$companyname';";
    $result = mysqli_fetch_assoc(mysqli_query($cn, $query));

    if($result){
        echo "Username is already taken";
        $errors++;
        mysqli_close($cn);
    }
}

if($errors == 0){
    $query = "INSERT INTO companies (name, code, date) VALUES ('$companyname','$companycode', '$date');";

    mysqli_query($cn, $query);
    mysqli_close($cn);
    // header('Location: /');
    echo ("<script LANGUAGE='JavaScript'>
            window. alert('Company Register Successfully');
            window. location. href='/index.php';
            </script>");
}