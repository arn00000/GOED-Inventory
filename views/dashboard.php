<?php
$title = "Dashboard";
function get_content(){
require_once '../controllers/connection.php';
$company_query = "SELECT * FROM companies;";
$company_result = mysqli_query($cn, $company_query);
$companies = mysqli_fetch_all($company_result, MYSQLI_ASSOC);

$user_query = "SELECT * FROM users;";
$user_result = mysqli_query($cn, $user_query);
$users = mysqli_fetch_all($user_result, MYSQLI_ASSOC);
?>
<style>
    footer {
        display: none;
    }
    nav {
        display: none !important;
    }
    
</style>
<?php if(isset($_SESSION['user_info'])):?>
<div class="container-fluid">
    <div class="row flex-nowrap">
    <div class="side-nav col-auto col-md-3 col-xl-2 px-sm-2 px-0">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <a href="/views/dashboard.php" class="d-flex align-items-center text-dark text-decoration-none fs-4">
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
            <div class="container dashboard">
            <?php foreach ($companies as $company): ?>
            <?php if($_SESSION['user_info']['company_id'] == $company['id']): ?>
            <h1 class="my-4 bg-light"><?php echo $company['name'] ?> Dashboard</h1>
            <?php endif; ?>
            <?php endforeach; ?>
            <br><br>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="dash1 card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <iframe class="img-fluid" src="https://embed.lottiefiles.com/animation/86938" style="height:130px;"></iframe>
                        </div>
                    </div>
                </div>
                <?php if(isset($_SESSION['user_info']) && $_SESSION['user_info']['isAdmin']): ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="dash1 card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-around text-center">
                                <div class="">
                                <img src="../images/user.png" class="img-fluid" alt="">
                                </div>
                                <div>
                                <br>
                                <h5 class="card-text">User</h5>
                                </div>
                            </div>
                            <hr>
                            <a href="/views/user.php" class="link-info text-decoration-none">View User <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-around text-center">
                                <div class="">
                                <img src="../images/revenue.png" class="img-fluid" alt="">
                                </div>
                                <div>
                                <br>
                                <h5 class="card-text">Forecast</h5>
                                </div>
                            </div>
                            <hr>
                            <a href="/views/revenue.php" class="link-info text-decoration-none">View Revenue <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-around text-center">
                                <div class="">
                                <img src="../images/profit.png" class="img-fluid" alt="">
                                </div>
                                <div>
                                <br>
                                <h5 class="card-text">Profit</h5>
                                </div>
                            </div>
                            <hr>
                            <a href="/views/profit.php" class="link-info text-decoration-none">View Profit <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-around text-center">
                                <div class="">
                                <img src="../images/sales.png" class="img-fluid" alt="">
                                </div>
                                <div>
                                <br>
                                <h5 class="card-text">Sales</h5>
                                </div>
                            </div>
                            <hr>
                            <a href="/views/sales.php" class="link-info text-decoration-none">View Sales <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-around text-center">
                                <div class="">
                                <img src="../images/outlet.png" class="img-fluid" alt="">
                                </div>
                                <div>
                                <br>
                                <h5 class="card-text">Outlet</h5>
                                </div>
                            </div>
                            <hr>
                            <a href="/views/outlet.php" class="link-info text-decoration-none">View Outlet <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-around text-center">
                                <div class="">
                                <img src="../images/product.png" class="img-fluid" alt="">
                                </div>
                                <div>
                                <br>
                                <h5 class="card-text">Product</h5>
                                </div>
                            </div>
                            <hr>
                            <a href="/views/product.php" class="link-info text-decoration-none">View Product <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-around text-center">
                                <div class="">
                                <img src="../images/add.png" class="img-fluid" alt="">
                                </div>
                                <div>
                                <p class="card-title text-muted">Add</p>
                                <h5 class="card-text">Outlet /<br>Product</h5>
                                </div>
                            </div>
                            <hr>
                            <a href="/views/add.php" class="link-info text-decoration-none">Add <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card border-0 shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-around text-center">
                                <div class="">
                                <img src="../images/update.png" class="img-fluid" alt="">
                                </div>
                                <div>
                                <p class="card-title text-muted">Update</p>
                                <h5 class="card-text">Product</h5>
                                </div>
                            </div>
                            <hr>
                            <a href="/views/update.php" class="link-info text-decoration-none">Update <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php endif;?>

<?php
}
require_once 'layout.php';
?>