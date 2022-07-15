<?php
require_once '../connection.php';
session_start();
$company_id = $_SESSION['user_info']['company_id'];

$product = mysqli_real_escape_string($cn, $_POST['product']);
$unit = $_POST['unit'];
$order_price = intval($_POST['order_price']);
$selling_price = intval($_POST['selling_price']);
$outlet = $_POST['outlet'];
$has_details = false;

if(strlen($product) < 1){
    echo "Fill in Product Name <br>";
    $has_details = false;
}

if(strlen($unit) < 1){
    echo "Fill in Unit <br>";
    $has_details = false;
}

if(strlen($order_price) < 1){
    echo "Fill in Order Price <br>";
    $has_details = false;
}

if(strlen($selling_price) < 1){
    echo "Fill in Selling Price <br>";
    $has_details = false;
}


if(strlen($product) > 0 && strlen($unit) > 0 && strlen($order_price) > 0 && strlen($selling_price) > 0) {
    $has_details = true;
}

if($has_details) {
    $query = "INSERT INTO products (name, unit, order_price, selling_price, outlet_id, company_id) 
    VALUES ('$product', '$unit', '$order_price', '$selling_price', $outlet, $company_id);";
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header('Location: /views/add.php');
}