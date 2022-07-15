<?php
$title = "Update";
function get_content(){
require_once '../controllers/connection.php';
$outlet_id = $_GET['id'];

$company_query = "SELECT * FROM companies;";
$company_result = mysqli_query($cn, $company_query);
$companies = mysqli_fetch_all($company_result, MYSQLI_ASSOC);

$outlet_query = "SELECT * FROM outlets WHERE id = $outlet_id;";
$outlet_result = mysqli_query($cn, $outlet_query);
$outlet = mysqli_fetch_assoc($outlet_result);

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
                <div class="dropdown pb-4">
                    <a href="/controllers/users/logout.php" class="d-flex align-items-center text-white text-decoration-none fs-4">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="d-none d-sm-inline mx-1">Logout</span>
                    </a>
                </div>
            </div>
        </div>
        <?php
        $stock_in_query = "SELECT products.id, products.name, stock_in.date, stock_in.quantity, stock_in.outlet_id FROM products JOIN stock_in ON products.id = stock_in.product_id WHERE stock_in.outlet_id = $outlet_id;";
        $stock_in_result = mysqli_query($cn, $stock_in_query);
        $stock_ins = mysqli_fetch_all($stock_in_result, MYSQLI_ASSOC);

        $sold_out_query = "SELECT products.id, products.name, sold_out.date, sold_out.outlet_id, sold_out.quantity FROM products JOIN sold_out ON products.id = sold_out.product_id WHERE sold_out.outlet_id = $outlet_id;";
        $sold_out_result = mysqli_query($cn, $sold_out_query);
        $sold_outs = mysqli_fetch_all($sold_out_result, MYSQLI_ASSOC);


        $damage_lost_query = "SELECT products.id, products.name, damage_lost.date, damage_lost.quantity, damage_lost.outlet_id FROM products JOIN damage_lost ON products.id = damage_lost.product_id WHERE damage_lost.outlet_id = $outlet_id;";
        $damage_lost_result = mysqli_query($cn, $damage_lost_query);
        $damage_losts = mysqli_fetch_all($damage_lost_result, MYSQLI_ASSOC);
        ?>
        <div class="col py-3">
            <div class="shadow p-3 mb-3 bg-body rounded">
                <?php if($outlet['company_id'] == $_SESSION['user_info']['company_id']): ?>
                <h4 class="mx-3 text-center"><?php echo $outlet['name'] ?></h4>
                <?php endif; ?>
                <label class="form-label">Update Selection</label>
                <select class="form-select border-dark" id="update" name="outlet">
                    <option disabled selected>Update Selection</option>
                    <option value="1" >Stock In</option>
                    <option value="2">Sold Out</option>
                    <option value="3">Damage / Lost</option>
                </select>
            </div>
            <div id="stock_in" class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <div class="d-flex justify-content-between">
                    <h4>Stock In</h4>
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling">View History</button>

                    <div class="offcanvas offcanvas-start" id="offcanvasScrolling" >
                    <div class="offcanvas-header bg-light">
                        <?php if($outlet['company_id'] == $_SESSION['user_info']['company_id']): ?>
                        <h5 class="offcanvas-title">(<?php echo $outlet['name'] ?>) Stock In History</h5>
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php foreach($stock_ins as $stock_in): ?>
                        <?php if($stock_in['outlet_id'] == $outlet_id): ?>
                            <div class="card-body alert alert-primary">
                            <h6>Product has been updated <i class="fa-regular fa-circle-check"></i></h6>
                            <hr>
                            <div class="d-flex justify-content-evenly">
                            <h6><?php echo $stock_in['date'] ?></h6>
                            <h6><?php echo $stock_in['name'] ?></h6>
                            <h6>+<?php echo $stock_in['quantity'] ?></h6>
                            </div>
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    </div>
                    </div>
                <table class="table table-hover">
                    <thead>
                        <tr class="text-success">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Current QTY</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $count=0;?>
                        <?php foreach($products as $product) :?>
                        <?php if($product['company_id'] == $_SESSION['user_info']['company_id']): ?>
                            <?php 

                            // SELECT SUM(quantity) FROM stock_in WHERE product_id = 5;
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
                        <tr>
                            <td><?php echo $count+=1; ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $product['unit'] ?></td>
                            <td><?php echo $total ?></td>
                            <form method="POST" action="../controllers/products/stock_in.php">
                            <td class="w-25"><input type="number" min="1" name="quantity" class="form-control"></td>
                            <td class="w-25"><input type="date" name="date" class="form-control"></td>
                            <input type="hidden" name="id2" value="<?php echo $product['id'] ?>">
                            <input type="hidden" name="id" value="<?php echo $product['outlet_id'] ?>">
                            <td class=""><button class="btn">Submit</button></td>
                            </form>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div> 
            <div id="sold_out" class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <div class="d-flex justify-content-between">
                    <h4>Sold Out</h4>
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling2">View History</button>

                    <div class="offcanvas offcanvas-start" id="offcanvasScrolling2" >
                    <div class="offcanvas-header bg-light">
                        <?php if($outlet['company_id'] == $_SESSION['user_info']['company_id']): ?>
                        <h5 class="offcanvas-title">(<?php echo $outlet['name'] ?>) Stock Out History</h5>
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php foreach($sold_outs as $sold_out): ?>
                        <?php if($sold_out['outlet_id'] == $outlet_id): ?>
                            <div class="card-body alert alert-success">
                            <h6>Product has been updated <i class="fa-regular fa-circle-check"></i></h6>
                            <hr>
                            <div class="d-flex justify-content-evenly">
                            <h6><?php echo $sold_out['date'] ?></h6>
                            <h6><?php echo $sold_out['name'] ?></h6>
                            <h6>-<?php echo $sold_out['quantity'] ?></h6>
                            </div>
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    </div>
                    </div>
                <table class="table table-hover">
                    <thead>
                        <tr class="text-success">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Current QTY</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $count=0;?>
                        <?php foreach($products as $product) :?>
                        <?php if($product['company_id'] == $_SESSION['user_info']['company_id']): ?>
                            <?php 

                            // SELECT SUM(quantity) FROM stock_in WHERE product_id = 5;
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
                        <tr>
                            <td><?php echo $count+=1; ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $product['unit'] ?></td>
                            <td><?php echo $total ?></td>
                            <form method="POST" action="../controllers/products/sold_out.php">
                            <td class="w-25"><input type="number"min="1" name="quantity" class="form-control"></td>
                            <td class="w-25"><input type="date" name="date" class="form-control"></td>
                            <input type="hidden" name="id2" value="<?php echo $product['id'] ?>">
                            <input type="hidden" name="id" value="<?php echo $product['outlet_id'] ?>">
                            <td class=""><button class="btn">Submit</button></td>
                            </form>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div> 
            <div id="damage_lost" class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <div class="d-flex justify-content-between">
                    <h4>Damage / Lost</h4>
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling3">View History</button>

                    <div class="offcanvas offcanvas-start" id="offcanvasScrolling3" >
                    <div class="offcanvas-header bg-light">
                        <?php if($outlet['company_id'] == $_SESSION['user_info']['company_id']): ?>
                        <h5 class="offcanvas-title">(<?php echo $outlet['name'] ?>) Damage/Lost History</h5>
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php foreach($damage_losts as $damage_lost): ?>
                        <?php if($damage_lost['outlet_id'] == $outlet_id): ?>
                            <div class="card-body alert alert-danger">
                            <h6>Product has been updated <i class="fa-regular fa-circle-check"></i></h6>
                            <hr>
                            <div class="d-flex justify-content-evenly">
                            <h6><?php echo $damage_lost['date'] ?></h6>
                            <h6><?php echo $damage_lost['name'] ?></h6>
                            <h6>-<?php echo $damage_lost['quantity'] ?></h6>
                            </div>
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    </div>
                    </div>
                <table class="table table-hover">
                    <thead>
                        <tr class="text-success">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Current QTY</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $count=0;?>
                        <?php foreach($products as $product) :?>
                        <?php if($product['company_id'] == $_SESSION['user_info']['company_id']): ?>
                            <?php 

                            // SELECT SUM(quantity) FROM stock_in WHERE product_id = 5;
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
                        <tr>
                            <td><?php echo $count+=1; ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $product['unit'] ?></td>
                            <td><?php echo $total ?></td>
                            <form method="POST" action="../controllers/products/damage_lost.php">
                            <td class="w-25"><input type="number" min="1" name="quantity" class="form-control"></td>
                            <td class="w-25"><input type="date" name="date" class="form-control"></td>
                            <input type="hidden" name="id2" value="<?php echo $product['id'] ?>">
                            <input type="hidden" name="id" value="<?php echo $product['outlet_id'] ?>">
                            <td class=""><button class="btn">Submit</button></td>
                            </form>
                        </tr>
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
<script>
    let update = document.getElementById('update')
    let stock_in = document.getElementById('stock_in')
    let sold_out = document.getElementById('sold_out')
    let damage_lost = document.getElementById('damage_lost')
    sold_out.style.display = 'none'
    damage_lost.style.display = 'none'
    update.addEventListener('change', function (e){
        if(e.target.value == 1){
            stock_in.style.display = 'block'
        }
        if(e.target.value == 2){
            sold_out.style.display = 'block'
            stock_in.style.display = 'none'
        }else{
            sold_out.style.display = 'none'
        }
        if(e.target.value == 3){
            damage_lost.style.display = 'block'
            stock_in.style.display = 'none'
        }else{
            damage_lost.style.display = 'none'
        }
    })
</script>