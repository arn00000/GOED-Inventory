<?php
require_once '../connection.php';
// require_once '../../vendor/autoload.php';
// use Carbon\Carbon;
// $current_date = Carbon::create(Carbon::now()->toDateString());
$username = $_POST['username'];
$password = $_POST['password'];

$user_query = "SELECT companies.id AS company_id, companies.date AS end_date, users.id, users.username, users.password, users.isAdmin FROM users JOIN companies ON users.company_id = companies.id WHERE username = '$username';";
$user_result = mysqli_query($cn, $user_query);
$user = mysqli_fetch_assoc($user_result);

// foreach($users as $user);
$end_date = $user['end_date'];
$current_date = date("Y-m-d");
// var_dump ($end_date);
// die();

if($current_date > $end_date){
    echo ("<script LANGUAGE='JavaScript'>
            window. location. href='/views/login.php';
            window. alert('Your plan is expired, please resubscribe');
            </script>");
}


$query2 = "SELECT * FROM users WHERE username = '$username';";
$user2 = mysqli_fetch_assoc(mysqli_query($cn, $query2));

if($user2 && password_verify($password, $user2['password']) && ($current_date < $end_date)){
    session_start();
    $_SESSION['user_info'] = $user2;
    mysqli_close($cn);
    header('Location: /views/dashboard.php');
} else{
    echo ("<script LANGUAGE='JavaScript'>
            window. location. href='/views/login.php';
            window. alert('Wrong Credentials');
            </script>");
    // echo "Wrong Credentials";
    // echo "<br>";
    // echo "<a href='/views/login.php'>Go back to login</a>";
}
