<?php
$title = "Profit";
function get_content(){
require_once '../controllers/connection.php';
$company_id = $_SESSION['user_info']['company_id'];
$company_query = "SELECT * FROM companies WHERE id = $company_id;";
$company_result = mysqli_query($cn, $company_query);
$company = mysqli_fetch_assoc($company_result);

$outlet_query = "SELECT * FROM outlets";
$outlet_result = mysqli_query($cn, $outlet_query);
$outlets = mysqli_fetch_all($outlet_result, MYSQLI_ASSOC);


$sold_outs_query = "SELECT products.name, products.selling_price, products.order_price, sold_out.id, sold_out.quantity, sold_out.product_id, outlets.id AS outlet_id, outlets.name, outlets.company_id FROM products JOIN sold_out ON products.id = sold_out.product_id JOIN outlets ON sold_out.outlet_id = outlets.id;";
$sold_outs_result = mysqli_query($cn, $sold_outs_query);
$sold_outs = mysqli_fetch_all($sold_outs_result, MYSQLI_ASSOC);


?>
<style>
    footer {
        display: none;
    }
    nav {
        display: none !important;
    }
</style>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="side-nav col-auto col-md-3 col-xl-2 px-sm-2 px-0">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/dashboard.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-house"></i>
                        <span class="d-none d-sm-inline mx-1">Dashboard</span>
                    </a>
                </ul>
                <?php if(isset($_SESSION['user_info']) && $_SESSION['user_info']['isAdmin']): ?>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/user.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-user-tie"></i>
                        <span class="d-none d-sm-inline mx-1">User</span>
                    </a>
                </ul>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/revenue.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-square-poll-vertical"></i>
                        <span class="d-none d-sm-inline mx-1">Forecast</span>
                    </a>
                </ul>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/profit.php" class="d-flex align-items-center text-dark text-decoration-none fs-4">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                        <span class="d-none d-sm-inline mx-1">Profit</span>
                    </a>
                </ul>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/sales.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        <span class="d-none d-sm-inline mx-1">Sales</span>
                    </a>
                </ul>
                <?php endif; ?>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/outlet.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-store"></i>
                        <span class="d-none d-sm-inline mx-1">Outlet</span>
                    </a>
                </ul>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/invoice.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span class="d-none d-sm-inline mx-1">Invoice</span>
                    </a>
                </ul>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/product.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-box-archive"></i>
                        <span class="d-none d-sm-inline mx-1">Product</span>
                    </a>
                </ul>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/add.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        <span class="d-none d-sm-inline mx-1">Add</span>
                    </a>
                </ul>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/update.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-file-pen"></i>
                        <span class="d-none d-sm-inline mx-1">Update</span>
                    </a>
                </ul>
                <hr>
                <?php if(isset($_SESSION['user_info'])): ?>
                <div class="pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none fs-5">
                        <i class="fa-solid fa-user-large"></i>
                        <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['user_info']['username'] ?></span>
                    </a>
                </div>
                <?php endif; ?>
                <div class="pb-4">
                    <a href="/controllers/users/logout.php" class="d-flex align-items-center text-white text-decoration-none fs-5">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="d-none d-sm-inline mx-1">Logout</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col py-3">
            <div class="container user">
                <?php if(isset($_SESSION['user_info']) && isset($company)):?>
                <h1 class="my-4 bg-light"><?php echo $company['name'] ?> Profit</h1>
                <div class="row shadow p-3 mb-5 bg-body rounded" data-aos="zoom-in">
                                <div class="col-md-10 mx-auto">
                                    <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Outlet Name</th>
                                        <th>Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <tr>
                                            <?php 
                                                $all_outlet_total = 0;
                                                $total = 0;
                                                $count =0;
                                                foreach ($outlets as $outlet): 
                                                if($outlet['company_id'] == $company['id']):
                                            ?>  
                                            <td><h5><?php echo $count+=1 ?></h5></td>
                                            <td><h5><?php echo $outlet['name'] ?></h5></td>
                                            <?php $total = 0; ?>
                                            <?php foreach($sold_outs as $sold_out): ?>
                                                <?php if($outlet['id'] == $sold_out['outlet_id']): ?>
                                                    <?php  $total += ($sold_out['selling_price'] - $sold_out['order_price']) * $sold_out['quantity'];?>
                                                <?php endif;?>
                                            <?php endforeach; ?>
                                            <td><h5 style="color:#34a0a4;">RM<?php echo $total; ?></h5></td>
                                        </tr> 
                                            <?php 
                                                endif;
                                                endforeach; 
                                            ?>
                                    </tbody>
                                    </table>
                                </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php
}
require_once 'layout.php';
?>