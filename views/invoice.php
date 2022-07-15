<?php
$title = "Outlet";
function get_content(){
require_once '../controllers/connection.php';
$company_query = "SELECT * FROM companies;";
$company_result = mysqli_query($cn, $company_query);
$companies = mysqli_fetch_all($company_result, MYSQLI_ASSOC);

$invoice_query = "SELECT * FROM invoices;";
$invoice_result = mysqli_query($cn, $invoice_query);
$invoices = mysqli_fetch_all($invoice_result, MYSQLI_ASSOC);

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
    .accordion-button:not(.collapsed) {
    color: var(--bs-accordion-active-color)unset !important;
    background-color: var(--bs-accordion-active-bg)unset !important;
    box-shadow: inset 0 calc(var(--bs-accordion-border-width) * -1) 0 var(--bs-accordion-border-color) unset !important;
}
.accordion{
    --bs-accordion-btn-focus-border-color: transparent !important;
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
                    <a href="/views/invoice.php" class="d-flex align-items-center text-dark text-decoration-none fs-4">
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
        <div class="col py-3 invoice">
            <?php foreach($companies as $company): ?>
            <?php if($company['id'] == $_SESSION['user_info']['company_id']): ?>
            <h1 class="my-4 bg-light"><?php echo $company['name'] ?> Invoice</h1>
            <?php endif; ?>
            <?php endforeach; ?>
            <div class="container user">
                <?php foreach($outlets as $outlet): ?>
                <?php if($outlet['company_id'] == $_SESSION['user_info']['company_id']): ?>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item shadow p-3 mb-5 bg-body rounded">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#invoice-<?php echo $outlet['id'] ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                            <?php echo $outlet['name'] ?>
                        </button>
                        </h2>
                        <div id="invoice-<?php echo $outlet['id'] ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table caption-top table-striped table-bordered ">
                                    <caption>List of All Invoices</caption>
                                    <thead>
                                        <tr class="text-success">
                                            <th scope="col">#</th>
                                            <th scope="col">Photo Copy</th>
                                            <th scope="col">Invoice No</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php $count=0;?>
                                        <?php $_SESSION['z'] = 0;?>
                                        <?php foreach($invoices as $invoice) :?>
                                        <?php if($invoice['outlet_id'] == $outlet['id']): ?>
                                        <?php $_SESSION['z'] += 1;?>
                                        <tr>
                                            <td><?php echo $count+=1; ?></td>
                                            <td><img class="img-fluid" style="width:50px;" src="<?php echo $invoice['image'] ?>" alt=""></td>
                                            <td><?php echo $invoice['invoice_no'] ?></td>
                                            <td>RM <?php echo $invoice['amount'] ?></td>
                                            <td>
                                                <?php if($invoice['outlet_id'] == $outlet['id'] && $invoice['status'] == 0):?>
                                               <h5 class="text-danger" value="0">Pending</h5> 
                                               <?php else:?>
                                               <h5 class="text-success" id="<?php echo $invoice['status'] ?>" name="status" value="<?php echo $invoice['status'] ?>">Completed</h5>
                                                <?php endif;?>
                                            </td>
                                            <td >
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#invoice-<?php echo $invoice['id'] ?>">
                                                Edit
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="invoice-<?php echo $invoice['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <div class="add2 col-md-12 d-flex">
                                                        <form class="row" method="POST" action="/controllers/invoices/edit_invoice.php" enctype="multipart/form-data">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Invoice No</label>
                                                                <input type="text" class="form-control border-dark" name="invoice_no" value="<?php echo $invoice['invoice_no'] ?>">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Amount</label>
                                                                <input type="text" class="form-control border-dark" name="amount" value="<?php echo $invoice['amount'] ?>">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Photo Copy</label>
                                                                <input type="file" value="<?php echo $invoice['image'] ?>" class="form-control border-dark" name="image" >
                                                            </div>
                                                            <div class="col-md-6 mb-3 d-flex justify-content-evenly align-self-end">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" value="pending" name="status" id="1">
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
                                                                <input type="hidden" value="<?php echo $invoice['id'] ?>" name="id">
                                                                <button class="btn mb-3">Edit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#view-<?php echo $invoice['id'] ?>">
                                                View
                                                </button>

                                                <div class="modal fade" id="view-<?php echo $invoice['id'] ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $invoice['invoice_no'] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="<?php echo $invoice['image'] ?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
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
</div>


<?php
}
require_once 'layout.php';
?>

<!-- <script>
    let button = document.getElementById('button')
    let pending = document.getElementById('pending')
    let completed = document.getElementById('completed')
    completed.style.display = 'none'
    button.addEventListener('click', function (e){
        if(e.target.value=0){
            completed.style.display = 'block'
            pending.style.display = 'none'
        }
        if(e.target.value=1){
            completed.style.display = 'none'
            pending.style.display = 'block'
        }
    })
</script> -->
