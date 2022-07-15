<?php
require_once '../connection.php';
session_start();
$company_id = $_SESSION['user_info']['company_id'];

// $outlet_query = "SELECT id FROM outlets WHERE company_id=$company_id;";
// $outlet_result = mysqli_query($cn, $outlet_query);
// $outlet = mysqli_fetch_assoc($outlet_result);
$outlet_id = $_POST['id'];

// $product_query = "SELECT id FROM products WHERE outlet_id=$outlet_id;";
// $product_result = mysqli_query($cn, $product_query);
// $product = mysqli_fetch_assoc($product_result);
$product_id = $_POST['id2'];

$quantity = intval($_POST['quantity']);
$date = $_POST['date'];
$has_details = false;


if(strlen($quantity) < 1){
    echo "Fill in Quantity <br>";
    $has_details = false;
}

if(strlen($date) < 1){
    echo "Fill in Date <br>";
    $has_details = false;
}

if(strlen($quantity) > 0 && strlen($date) > 0) {
    $has_details = true;
}

if($has_details) {
    $query = "INSERT INTO sold_out (quantity, date, outlet_id, product_id) 
    VALUES ('$quantity', '$date', $outlet_id, $product_id);";
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}