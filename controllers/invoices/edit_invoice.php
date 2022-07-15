<?php
require_once '../connection.php';

$invoice_no = mysqli_real_escape_string($cn, $_POST['invoice_no']);
$amount = intval($_POST['amount']);
// $outlet = $_POST['outlet'];
$status = $_POST['status'];
$id = $_POST['id'];

if(strlen($_FILES['image']['tmp_name']) > 0) {
        $img_name = $_FILES['image']['name']; 
    $img_size = $_FILES['image']['size'];
    $img_tmpname = $_FILES['image']['tmp_name'];
    $img_type = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $extensions = ['jpg', 'jpeg', 'svg', 'png', 'gif'];
    $img_folder = '/public/'.time().'-'.$img_name;

    if($status == "completed"){
        $query = "SELECT status FROM invoices WHERE status  = $status;";
        $status = true;
    } elseif($status == "pending") {
        $status = false;
    }

    $query = "UPDATE invoices 
    set invoice_no = '$invoice_no', amount = $amount, `status` = '$status', image = '$img_folder' WHERE id = $id;" ;
    move_uploaded_file($img_tmpname,'../../public/'.time().'-'.$img_name);
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    if($status == "completed"){
        $query = "SELECT status FROM invoices WHERE status  = $status;";
        $status = true;
    } elseif($status == "pending") {
        $status = false;
    }

    $query = "UPDATE invoices 
    set invoice_no = '$invoice_no', amount = $amount, `status` = '$status' WHERE id = $id;" ;
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}