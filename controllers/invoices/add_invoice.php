<?php
require_once '../connection.php';
session_start();
$company_id = $_SESSION['user_info']['company_id'];

$invoice_no = mysqli_real_escape_string($cn, $_POST['invoice_no']);
$amount = intval($_POST['amount']);
$outlet = $_POST['outlet'];
$status = $_POST['status'];
// var_dump($_POST);
// die();

$img_name = $_FILES['image']['name']; //dazn.png
// var_dump($img_name);
// die();
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name'];

$img_type = strtolower(pathinfo($img_name, PATHINFO_EXTENSION)); //jpg, svg, png, gif, jpeg
$is_img = false;
$has_details = false;
if($has_details == false || $is_img == false){
    echo "<a href='/views/add.php'>Go back Home</a> <br>";
}

$extensions = ['jpg', 'jpeg', 'svg', 'png', 'gif'];
$img_folder = '/public/'.time().'-'.$img_name;

if(in_array($img_type, $extensions)){
    $is_img = true;
}else {
    echo "Please upload an image <br>";
}

if(strlen($invoice_no) < 1){
    echo "Fill in title <br>";
    $has_details = false;
}

if(strlen($amount) < 1){
    echo "Fill in director <br>";
    $has_details = false;
}



if(strlen($invoice_no) > 0 && strlen($amount) > 0) {
    $has_details = true;
}

if($status == "completed"){
    $query = "SELECT status FROM invoices WHERE status  = '$status';";
    $status = true;
} elseif($status == "pending") {
    $status = false;
}


if($has_details  && $is_img && $img_size  > 0) {
    $query = "INSERT INTO invoices (invoice_no, amount, outlet_id, company_id, image, status) 
    VALUES ('$invoice_no', '$amount', $outlet, $company_id, '$img_folder', '$status');";
    move_uploaded_file($img_tmpname,'../../public/'.time().'-'.$img_name);
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header('Location: /views/add.php');
}

