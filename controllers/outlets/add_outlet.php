<?php
require_once '../connection.php';
session_start();
// echo $_SESSION['user_info']['company_id'];
// die();
// $company_query = "SELECT id FROM companies WHERE id={$_SESSION['user_info']['company_id']};";
// $user_result = mysqli_query($cn, $user_query);
// $user = mysqli_fetch_assoc($user_result);
$company_id = $_SESSION['user_info']['company_id'];

$outlet = mysqli_real_escape_string($cn, $_POST['outlet']);
$has_details = false;

if(strlen($outlet) < 1){
    echo "Fill in Outlet Name <br>";
    $has_details = false;
}

if(strlen($outlet) > 0) {
    $has_details = true;
}

if($has_details) {
    $query = "INSERT INTO outlets (name, company_id) VALUES ('$outlet', $company_id);";
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header('Location: /views/add.php');
}