<?php
$title = "Outlet Product";
function get_content(){
require_once '../controllers/connection.php';
$outlet_id = $_GET['id'];

$outlet_query = "SELECT * FROM outlets WHERE id = $outlet_id;";
$outlet_result = mysqli_query($cn, $outlet_query);
$outlets = mysqli_fetch_all($outlet_result, MYSQLI_ASSOC);

$product_query = "SELECT * FROM products WHERE outlet_id = $outlet_id;";
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
            <div class="d-flex justify-content-between bg-light">
                <div class="d-flex">
                    <?php foreach($outlets as $outlet): ?>
                    <?php if($outlet['company_id'] == $_SESSION['user_info']['company_id']): ?>
                    <h4 class="mx-3 text-decoration-underline"><?php echo $outlet['name'] ?></h4>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div><br>
            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table table-hover">
                    <thead>
                        <tr style="color:#34a0a4;">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Order Price</th>
                            <th scope="col">Selling Price</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Quantity</th>
                            <?php if(isset($_SESSION['user_info']) && $_SESSION['user_info']['isAdmin']): ?>
                            <th scope="col">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $count=0;?>
                        <?php 

                            // SELECT SUM(quantity) FROM stock_in WHERE product_id = 5;
                            foreach($products as $product) :
                            $product_id = $product['id'];
                            $stock_in_query = "SELECT SUM(quantity) AS stock_in_sum FROM stock_in WHERE product_id = $product_id;";
                            $stock_in_result = mysqli_query($cn, $stock_in_query);
                            $stock_in = mysqli_fetch_assoc($stock_in_result); 

                            $sold_out_query = "SELECT SUM(quantity) AS sold_out_sum FROM sold_out WHERE product_id = $product_id;";
                            $sold_out_result = mysqli_query($cn, $sold_out_query);
                            $sold_out = mysqli_fetch_assoc($sold_out_result);  

                            $damage_lost_query = "SELECT SUM(quantity) AS damage_lost_sum FROM damage_lost WHERE product_id = $product_id;";
                            $damage_lost_result = mysqli_query($cn, $damage_lost_query);
                            $damage_lost = mysqli_fetch_assoc($damage_lost_result);  
                            $total = ( intval($product['quantity']) + intval($stock_in['stock_in_sum'])) - (intval($sold_out['sold_out_sum']) + intval($damage_lost['damage_lost_sum']));
                        ?>
                        <?php if($product['company_id'] == $_SESSION['user_info']['company_id']): ?>
                        <tr>
                            <td><?php echo $count+=1; ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td>RM <?php echo $product['order_price'] ?></td>
                            <td>Rm <?php echo $product['selling_price'] ?></td>
                            <td><?php echo $product['unit'] ?></td>
                            <td><span class="badge bg-secondary p-2"><?php echo $total?></span></td>
                            <?php if(isset($_SESSION['user_info']) && $_SESSION['user_info']['isAdmin']): ?>
                            <td>
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $product['id'] ?>">
                                <i class="fa-regular fa-pen-to-square"></i>
                                </button>

                                <div class="modal fade" id="edit-<?php echo $product['id'] ?>" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit <?php echo $product['name'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="/controllers/products/edit_product.php">
                                            <div class="row modal-body">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Product Name</label>
                                                    <input value="<?php echo $product['name'] ?>" type="text" class="form-control border-dark" name="product" placeholder="*Coke">
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
                                                    <input value="<?php echo $product['unit'] ?>" type="text" class="form-control border-dark" name="unit" placeholder="*1ctn 24can">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Order Price</label>
                                                    <input value="<?php echo $product['order_price'] ?>" type="number" class="form-control border-dark" name="order_price" placeholder="*RM15">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Selling Price</label>
                                                    <input value="<?php echo $product['selling_price'] ?>" type="number" class="form-control border-dark" name="selling_price" placeholder="*RM30">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                                                <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                                                <button class="btn">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>


                                <button class="btn" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $product['id'] ?>">
                                <i class="fa-regular fa-trash-can"></i>
                                </button>

                                <div class="modal fade" id="delete-<?php echo $product['id'] ?>" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Delete <?php echo $product['name'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>Are you sure want to delete (<?php echo $product['name'] ?>)?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                                            <form method="POST" action="/controllers/products/delete_product.php">
                                            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                                            <button class="btn">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>         
        </div>
    </div>
</div>


<?php
}
require_once 'layout.php';
?>