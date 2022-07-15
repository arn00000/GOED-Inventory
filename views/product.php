<?php
$title = "Product";
function get_content(){
require_once '../controllers/connection.php';
$company_query = "SELECT * FROM companies;";
$company_result = mysqli_query($cn, $company_query);
$companies = mysqli_fetch_all($company_result, MYSQLI_ASSOC);

$outlet_query = "SELECT * FROM outlets;";
$outlet_result = mysqli_query($cn, $outlet_query);
$outlets = mysqli_fetch_all($outlet_result, MYSQLI_ASSOC);

$product_query = "SELECT * FROM products;";
$product_result = mysqli_query($cn, $product_query);
$products = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

?>
<style>
    footer {
        display: none;
    }
    nav {
        display: none !important;
    }
    .accordion-button:not(.collapsed) {
    color: var(--bs-accordion-active-color)unset !important;
    background-color: var(--bs-accordion-active-bg)unset !important;
    box-shadow: inset 0 calc(var(--bs-accordion-border-width) * -1) 0 var(--bs-accordion-border-color) unset !important;
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
                    <a href="/views/profit.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
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
                    <a href="/views/product.php" class="d-flex align-items-center text-dark text-decoration-none fs-4">
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
        <div class="col py-3 product">
            <?php foreach($companies as $company): ?>
            <?php if($company['id'] == $_SESSION['user_info']['company_id']): ?>
            <h1 class="my-4 bg-light"><?php echo $company['name'] ?> Product</h1>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php foreach($outlets as $outlet): ?>
            <?php if($outlet['company_id'] == $_SESSION['user_info']['company_id']): ?>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item border-0 shadow-lg p-3 mb-5 bg-body rounded">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button btn"  type="button" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#outlet-<?php echo $outlet['id'] ?>">
                       <?php echo $outlet['name'] ?>
                    </button>
                    </h2>
                    <div id="outlet-<?php echo $outlet['id'] ?>" class="accordion-collapse collapse border-0" aria-labelledby="headingOne">
                        <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table caption-top table-striped table-bordered">
                                <caption>List of All Products</caption>
                                <thead>
                                    <tr class="text-success">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Order Price</th>
                                        <th scope="col">Selling Price</th>
                                        <th scope="col">Unit</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php $count=0;?>
                                    <?php $_SESSION['z'] = 0;?>
                                    <?php foreach($products as $product) :?>
                                    <?php if($product['outlet_id'] == $outlet['id']): ?>
                                    <?php $_SESSION['z'] += 1;?>
                                    <tr>
                                        <td><?php echo $count+=1; ?></td>
                                        <td><?php echo $product['name'] ?></td>
                                        <td>RM <?php echo $product['order_price'] ?></td>
                                        <td>Rm <?php echo $product['selling_price'] ?></td>
                                        <td><?php echo $product['unit'] ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php
}
require_once 'layout.php';
?>