<?php
$title = "Revenue";
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
    @import url(https://fonts.googleapis.com/css?family=Lato:400,700);
@font-face {
  font-family: Lato;
  src: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/176026/ProximaNova-Regular.otf);
  font-weight: 300;
}
body, html {
  font-family: Lato;
}

h1 {
  font-size: 28px;
  line-height: 40px;
  margin-top: 20px;
}
h1 a {
  text-decoration: none;
  color: #48c15e;
}
h1 p {
  font-size: 22px;
}

#grid {
  -moz-transform: translate(1px, 0px);
  -ms-transform: translate(1px, 0px);
  -webkit-transform: translate(1px, 0px);
  transform: translate(1px, 0px);
}

/* GRAPH - 1 */
#graph-1 {
  stroke: url(#gradient-1);
  stroke-width: 1.5;
  fill: transparent;
  stroke-linecap: round;
  stroke-linejoin: round;
  -moz-animation: lineani 1.3s linear forwards;
  -webkit-animation: lineani 1.3s linear forwards;
  animation: lineani 1.3s linear forwards;
}

#graph-2 {
  stroke: url(#gradient-2);
  stroke-width: 1.5;
  fill: transparent;
  stroke-linecap: round;
  stroke-linejoin: round;
  -moz-animation: lineani 1.3s linear forwards;
  -webkit-animation: lineani 1.3s linear forwards;
  animation: lineani 1.3s linear forwards;
}

#poly-1 {
  fill: url(#gradient-3);
}

#poly-2 {
  fill: url(#gradient-4);
}

@-moz-keyframes lineani {
  to {
    stroke-dashoffset: 0;
  }
}
@-webkit-keyframes lineani {
  to {
    stroke-dashoffset: 0;
  }
}
@keyframes lineani {
  to {
    stroke-dashoffset: 0;
  }
}
.underlay {
  stroke-width: 5;
  fill: transparent;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke: #24303a;
}

#circle-graph-1 {
  stroke: url(#gradient-1);
  stroke-width: 5;
  fill: transparent;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.chart-circle {
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

#circle-graph-2 {
  stroke: url(#gradient-2);
  stroke-width: 5;
  fill: transparent;
  stroke-linecap: round;
  stroke-linejoin: round;
}

body {
  background-color: #24303a;
  color: white;
  text-align: center;
}

.charts-container {
  padding: 20px;
  width: 100%;
  max-width: 1024px;
  display: inline-block;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

.chart {
  color: #4a667a;
  text-align: left;
  position: relative;
  height: auto;
  background-color: #1e2730;
  display: inline-block;
  float: left;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 10px;
  padding: 15px 20px 65px 20px;
}
.chart.circle {
  padding: 15px 20px 40px 20px;
}
@media screen and (max-width: 700px) {
  .chart {
    width: calc(100% - 20px);
  }
}
@media screen and (min-width: 700px) {
  .chart {
    width: calc(50% - 20px);
  }
}

.title {
  font-size: 22px;
  margin-bottom: 12px;
}

.chart-circle {
  display: inline-block;
  position: relative;
}

.chart-svg {
  position: relative;
}

.circle-percentage {
  position: absolute;
  color: white;
  font-size: 30px;
  left: 50%;
  top: 50%;
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
.circle-percentage-1 {
  position: absolute;
  color: white;
  font-size: 30px;
  left: 50%;
  top: 50%;
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  display:none;
}
.chart-svg :hover .circle-percentage{
  display:none;
}
.circle-percentage-1 :hover h4{
  display:block;
}
@media screen and (max-width: 992px) {
  .circle-percentage {
    font-size: 15px;
  }
}

@media screen and (max-width:  576px) {
  .circle-percentage {
    font-size: 8px;
  }
}

.align-center {
  text-align: center;
}

.chart-line {
  width: 80%;
}

.valueX {
  font-size: 14px;
}

.chart-values {
  text-align: right;
  font-size: 18px;
  position: absolute;
  right: 0;
  bottom: 0;
  padding: 15px;
}

.h-value {
  -moz-transition: ease-in-out 700ms;
  -o-transition: ease-in-out 700ms;
  -webkit-transition: ease-in-out 700ms;
  transition: ease-in-out 700ms;
  opacity: 0;
}
.h-value.visible {
  opacity: 1;
}

.percentage-value {
  -moz-transition: ease-in-out 700ms;
  -o-transition: ease-in-out 700ms;
  -webkit-transition: ease-in-out 700ms;
  transition: ease-in-out 700ms;
  color: #48c15e;
  margin-top: 2px;
  opacity: 0;
}
.percentage-value.negative {
  color: #ef6670;
}
.percentage-value.visible {
  opacity: 1;
}

.total-gain {
  color: white;
  font-size: 48px;
}

.triangle {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 28px 0 0 28px;
  position: absolute;
  left: 0;
  bottom: 0;
}
.triangle.red {
  border-color: transparent transparent transparent #ef6670;
}
.triangle.green {
  border-color: transparent transparent transparent #48c15e;
}

.horizontal,
.vertical {
  stroke-width: 0.1;
  stroke: #4a667a;
}

/* CLEARFIX HELPER */
.cf:before,
.cf:after {
  content: " ";
  /* 1 */
  display: table;
  /* 2 */
}

.cf:after {
  clear: both;
}

/**
 * For IE 6/7 only
 * Include this rule to trigger hasLayout and contain floats.
 */
.cf {
  *zoom: 1;
}

/*IRRELEVANT CSS*/
.followlinks {
  position: fixed;
  right: 35px;
  bottom: 15px;
  display: table;
}
.followlinks a {
  display: table-cell;
  vertical-align: middle;
  padding-left: 10px;
  color: white;
}
.followlinks a svg path {
  fill: white;
}

.heartIt {
  margin-top: 50px;
  margin-bottom: 80px;
}
.heartIt p {
  font-size: 24px;
  line-height: 40px;
}
.heartIt img {
  width: 64px;
  height: auto;
  opacity: 0.7;
  -webkit-filter: invert(100%);
  filter: invert(100%);
}

.original {
  color: #ef6670;
  font-size: 14px;
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
                    <a href="/views/revenue.php" class="d-flex align-items-center text-dark text-decoration-none fs-4">
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
            <!-- <div class="container revenue">
                <?php if(isset($_SESSION['user_info']) && isset($company)):?>
                <h1 class="my-4 bg-light"><?php echo $company['name'] ?> Revenue</h1>
                <div class="row shadow p-3 mb-5 bg-body rounded" data-aos="zoom-in">
                    <div class="col-md-6">
                    <img src="/images/chart1.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-4 text-center mx-auto">
                        <?php 
                            $all_outlet_sales= 0;
                            $all_outlet_profit = 0;
                            $sales = 0;
                            $profit = 0;
                            $count =0;
                            foreach ($outlets as $outlet): 
                            if($outlet['company_id'] == $company['id']):
                            $count ++;
                        ?>  
                        <?php $sales = 0; ?>
                        <?php $profit = 0; ?>
                        <?php foreach($sold_outs as $sold_out): ?>
                            <?php if($outlet['id'] == $sold_out['outlet_id']): ?>
                                <?php  
                                $sales += $sold_out['selling_price'] * $sold_out['quantity'];
                                $profit += ($sold_out['selling_price'] - $sold_out['order_price']) * $sold_out['quantity'];
                                ?>
                            <?php endif;?>
                        <?php endforeach; ?>
                        <?php $sales; ?>
                        <?php $profit; ?>
                        <?php $all_outlet_sales += $sales; ?>
                        <?php $all_outlet_profit += $profit; ?>
                        <?php 
                            endif;
                            endforeach; 
                        ?>
                        
                        <div class="card border-0 mb-2">
                        <div class="card-body d-flex justify-content-around">
                            <h6>TOTAL SALES</h6>
                            <h6>RM<?php echo $all_outlet_sales ?></h6>
                        </div>
                        </div>
                        <div class="card border-0 mb-2">
                        <div class="card-body d-flex justify-content-around">
                            <h6>TOTAL PROFIT</h6>
                            <h6>RM<?php echo $all_outlet_profit ?></h6>
                        </div>
                        </div>
                        <div class="card border-0">
                        <div class="card-body d-flex justify-content-around">
                            <h6>TOTAL OUTLET</h6>
                            <h6>#<?php echo $count ?></h6>
                        </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div> -->

            <div class="charts-container cf">
            <?php 
                $all_outlet_sales= 0;
                $all_outlet_profit = 0;
                $sales = 0;
                $profit = 0;
                $count =0;
                foreach ($outlets as $outlet): 
                if($outlet['company_id'] == $company['id']):
                $count ++;
            ?>  
            <?php $sales = 0; ?>
            <?php $profit = 0; ?>
            <?php foreach($sold_outs as $sold_out): ?>
                <?php if($outlet['id'] == $sold_out['outlet_id']): ?>
                    <?php  
                    $sales += $sold_out['selling_price'] * $sold_out['quantity'];
                    $profit += ($sold_out['selling_price'] - $sold_out['order_price']) * $sold_out['quantity'];
                    ?>
                <?php endif;?>
            <?php endforeach; ?>
            <?php $sales; ?>
            <?php $profit; ?>
            <?php $all_outlet_sales += $sales; ?>
            <?php $all_outlet_profit += $profit; ?>
            <?php 
                endif;
                endforeach; 
            ?>
            <div class="chart circle" id="circle-1">
                <h2 class="title">TOTAL SALES</h2>
                <div class="chart-svg align-center">
                  <?php
                  if ($all_outlet_sales > 999 && $all_outlet_sales <= 999999) {
                    $result = floor($all_outlet_sales / 1000) . 'K';
                } elseif ($all_outlet_sales > 999999) {
                    $result = floor($all_outlet_sales / 1000000) . 'M';
                } else {
                    $result = $all_outlet_sales;
                }
                  ?>
                <h4 class="circle-percentage">RM <?php echo $result ?></h4>
                <h4 class="circle-percentage-1">RM <?php echo $all_outlet_sales ?></h4>
                <svg class="chart-circle" id="chart-2" width="50%" viewBox="0 0 100 100">
                    <path class="underlay" d="M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50"/>
                </svg>
                </div>
                <div class="triangle green"></div>
            </div>
            <div class="chart circle" id="circle-2">
                <h2 class="title">TOTAL PROFIT</h2>
                <div class="chart-svg align-center">
                <?php
                  if ($all_outlet_profit  > 999 && $all_outlet_profit  <= 999999) {
                    $result2 = floor($all_outlet_profit  / 1000) . 'K';
                } elseif ($all_outlet_profit  > 999999) {
                    $result2 = floor($all_outlet_profit  / 1000000) . 'M';
                } else {
                    $result2 = $all_outlet_profit;
                }
                  ?>
                <h4 class="circle-percentage">RM <?php echo $result2 ?></h4>
                <svg class="chart-circle" id="chart-3" width="50%" viewBox="0 0 100 100">
                    <path class="underlay" d="M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50"/>
                </svg>
                </div>
                <div class="triangle green"></div>
            </div>
            <div class="chart circle" id="circle-3">
                <h2 class="title">TOTAL OUTLET</h2>
                <div class="chart-svg align-center">
                <h4 class="circle-percentage">#<?php echo $count ?></h4>
                <svg class="chart-circle" id="chart-4" width="50%" viewBox="0 0 100 100">
                    <path class="underlay" d="M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50"/>
                </svg>
                </div>
                <div class="triangle green"></div>
            </div>
            </div>
        </div>
    </div>
</div>


<?php
}
require_once 'layout.php';
?>