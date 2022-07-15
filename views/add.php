<?php
$title = "Add";
function get_content(){
require_once '../controllers/connection.php';
$company_id = $_SESSION['user_info']['company_id'];
$outlet_query = "SELECT * FROM outlets WHERE company_id ='$company_id';";
$outlet_result = mysqli_query($cn, $outlet_query);
$outlets = mysqli_fetch_all($outlet_result, MYSQLI_ASSOC);
// var_dump($outlets);
// die();
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
                    <a href="/views/product.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-box-archive"></i>
                        <span class="d-none d-sm-inline mx-1">Product</span>
                    </a>
                </ul>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/add.php" class="d-flex align-items-center text-dark text-decoration-none fs-4">
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
            <div>
                <div class="container add">
                    <h1 class=" bg-light">Add</h1><br>
                    <div class="row bg-light p-4 shadow p-3 bg-body rounded"  data-aos="zoom-in">
                        <div class="add2 col-md-12 d-flex">
                            <div class="col-md-3 me-5">
                                <h4>Add Outlet</h4>
                            </div>
                            <form class="row" method="POST" action="/controllers/outlets/add_outlet.php">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Outlet Name</label>
                                    <input type="text" class="form-control border-dark" name="outlet" placeholder="*Outlet-001">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn mb-3">Add</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="add2 col-md-12 d-flex">
                            <div class="col-md-3 me-5">
                                <h4>Add Invoice</h4>
                            </div>
                            <form class="row" method="POST" action="/controllers/invoices/add_invoice.php" enctype="multipart/form-data">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Invoice No</label>
                                    <input type="text" class="form-control border-dark" name="invoice_no" placeholder="*2230/2022">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="text" class="form-control border-dark" name="amount" placeholder="*RM5000">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Outlet</label>
                                    <select class="form-select border-dark" name="outlet">
                                        <option disabled selected>Choose Outlet</option>
                                        <?php foreach($outlets as $outlet): ?>
                                        <option value="<?php echo $outlet['id'] ?>"><?php echo $outlet['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Photo Copy</label>
                                    <input type="file" class="form-control border-dark" name="image" >
                                </div>
                                <div class="col-md-6 mb-3 d-flex justify-content-evenly align-self-end">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="pending" name="status" id="1"  checked>
                                        <label class="form-check-label" for="1">
                                            Pending
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="completed" name="status" id="2">
                                        <label class="form-check-label" for="2">
                                            Completed
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn mb-3">Add</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="add2 col-md-12 d-flex">
                            <div class="col-md-3 me-5">
                                <h4>Add Product</h4>
                            </div>
                            <form class="row" method="POST" action="/controllers/products/add_product.php">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control border-dark" name="product" placeholder="*Coke">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Outlet</label>
                                    <select class="form-select border-dark" name="outlet">
                                        <option disabled selected>Choose Outlet</option>
                                        <?php foreach($outlets as $outlet): ?>
                                        <option value="<?php echo $outlet['id'] ?>"><?php echo $outlet['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Unit</label>
                                    <input type="text" class="form-control border-dark" name="unit" placeholder="*1ctn 24can">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Order Price</label>
                                    <input type="number" class="form-control border-dark" name="order_price" placeholder="*RM15">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Selling Price</label>
                                    <input type="number" class="form-control border-dark" name="selling_price" placeholder="*RM30">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn mb-3">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
}
require_once 'layout.php';
?>