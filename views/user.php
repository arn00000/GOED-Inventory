<?php
$title = "User";
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
    .btn{
        color: unset;
        background-color: unset;
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
                    <a href="/views/user.php" class="d-flex align-items-center text-dark text-decoration-none fs-4">
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
            <div class="container user">
                <?php foreach ($companies as $company): ?>
                <?php if(isset($_SESSION['user_info']['company_id']) == $company['id']):?>
                <?php if($_SESSION['user_info']['company_id'] == $company['id']): ?>
                <h1 class="my-4 bg-light"><?php echo $company['name'] ?> User</h1>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                    <iframe class="iframe2" src="https://embed.lottiefiles.com/animation/10535" style="height:70vh; width:100%;"></iframe>
                    </div>
                    <div class="col-md-5 align-self-center">
                        <div class="offcanvas-body " style="height:400px;">
                            <?php $_SESSION['x'] = 0;?>
                            <?php foreach ($users as $user): ?>
                            <?php if($user['company_id'] == $company['id']): ?>
                            <?php $_SESSION['x'] += 1; ?>
                            <div class="col-md-8 mx-auto">
                                <div class="card border-0 bg-light">
                                    <div class="card-header d-flex justify-content-between">
                                        <div>
                                            <i class="fa-solid fa-circle-user fs-4"></i>
                                        </div>
                                        <div>
                                            <?php if(isset($_SESSION['user_info']) && $_SESSION['user_info']['isAdmin']): ?>
                                            <button class="btn" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $user['id'] ?>">
                                            <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                            <?php endif; ?>

                                            <div class="modal fade" id="delete-<?php echo $user['id'] ?>" >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" >Delete <?php echo $user['username'] ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Are you sure want to delete ?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                                                        <form method="POST" action="/controllers/users/delete_user.php">
                                                        <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                                                        <button class="btn btn-outline-dark">Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex justify-content-evenly">
                                        <h6>#<?php echo $_SESSION['x'] += 0; ?></h6>
                                        <h6>id: <small class="text-primary"><?php echo $user['id'] ?></small></h6>
                                        <h6>User: <small class="text-primary"><?php echo $user['username'] ?></small></h6>
                                    </div>
                                </div>
                            </div><br>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
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


