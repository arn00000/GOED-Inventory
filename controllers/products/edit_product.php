<?php
require_once '../connection.php';

$product = mysqli_real_escape_string($cn, $_POST['product']);
$unit = $_POST['unit'];
$order_price = intval($_POST['order_price']);
$selling_price = intval($_POST['selling_price']);
$id = $_POST['id'];


$query = "UPDATE products 
set name = '$product', unit = '$unit', order_price = '$order_price', selling_price = '$selling_price' WHERE id = $id;" ;
mysqli_query($cn, $query);
mysqli_close($cn);
header('Location: ' . $_SERVER['HTTP_REFERER']);
