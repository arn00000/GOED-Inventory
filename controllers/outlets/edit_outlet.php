<?php
require_once '../connection.php';

$id = $_POST['id'];
$outlet = $_POST['outlet'];


$query = "UPDATE outlets 
set name = '$outlet' WHERE id = $id;" ;
mysqli_query($cn, $query);
mysqli_close($cn);
header('Location: ' . $_SERVER['HTTP_REFERER']);