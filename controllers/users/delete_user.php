<?php
require_once '../connection.php';
$id = $_POST['id'];
$query = "DELETE FROM users WHERE id = $id;";

mysqli_query($cn, $query);
mysqli_close($cn);
header('Location: ' . $_SERVER['HTTP_REFERER']);