<?php
$title = "Outlet";
function get_content(){
require_once '../controllers/connection.php';
$company_query = "SELECT * FROM companies;";
$company_result = mysqli_query($cn, $company_query);
$companies = mysqli_fetch_all($company_result, MYSQLI_ASSOC);

$user_query = "SELECT * FROM users;";
$user_result = mysqli_query($cn, $user_query);
$users = mysqli_fetch_all($user_result, MYSQLI_ASSOC);

$outlet_query = "SELECT * FROM outlets;";
$outlet_result = mysqli_query($cn, $outlet_query);
$outlets = mysqli_fetch_all($outlet_result, MYSQLI_ASSOC);
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
                    <a href="/views/outlet.php" class="d-flex align-items-center text-dark text-decoration-none fs-4">
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
                <?php foreach ($companies as $company): ?>
                <?php if(isset($_SESSION['user_info']['company_id']) == $company['id']):?>
                <?php if($_SESSION['user_info']['company_id'] == $company['id']): ?>
                <h1 class="my-4 bg-light"><?php echo $company['name'] ?> Outlet</h1>
                <div class="row" data-aos="zoom-in">
                    <?php $_SESSION['y'] = 0;?>
                    <?php foreach ($outlets as $outlet): ?>
                    <?php if($outlet['company_id'] == $_SESSION['user_info']['company_id']): ?>
                    <?php $_SESSION['y'] += 1; ?>
                    <div class="col-lg-3 align-self-center">
                        <div class="card border-0  shadow p-3 mb-5 bg-body rounded" style="border-left:#34a0a4 solid 4px !important;">
                            <div class="card-body text-center">
                                <img src="../images/outlet.png" class="img-fluid" alt="">
                            </div><hr>
                            <div class="d-flex justify-content-between">
                            <h6 class="card-text"><?php echo $outlet['name'] ?></h6>
                            <a href="/views/outlet_product.php?id=<?php echo $outlet['id'] ?>" class="fs-4" style="color:#34a0a4;"><i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                            <?php if(isset($_SESSION['user_info']) && $_SESSION['user_info']['isAdmin']): ?>
                            <button type="button" class="btn mb-1" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $outlet['id'] ?>">
                            Edit
                            </button>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $outlet['id'] ?>">
                            Delete
                            </button>
                            <?php endif; ?>
                            <!-- Modal -->
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                    <?php foreach($outlets as $outlet): ?>
                    <div class="modal fade" id="edit-<?php echo $outlet['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $outlet['name'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="row" method="POST" action="/controllers/outlets/edit_outlet.php">
                            <div class="modal-body">
                                <div class="modal-body col-md-12 mb-3">
                                    <label class="form-label">Outlet Name</label>
                                    <input type="text" class="form-control border-dark" name="outlet" value="<?php echo $outlet['name'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                                    <input type="hidden" name="id" value="<?php echo $outlet['id'] ?>">
                                    <button type="submit" class="btn">Edit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="modal fade" id="delete-<?php echo $outlet['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $outlet['name'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Are you sure you want to delete <?php echo $outlet['name'] ?>?</h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                            <form method="POST" action="/controllers/outlets/delete_outlet.php">
                                <input type="hidden" name="id" value="<?php echo $outlet['id'] ?>">
                                <button type="submit" class="btn">Delete</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<?php
}
require_once 'layout.php';
?>

