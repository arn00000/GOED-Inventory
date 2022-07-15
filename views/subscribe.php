<?php
$title = "Subscribe";
function get_content(){
?>
<style>
    h1{
        font-family: 'Kanit', sans-serif;
        font-family: 'Raleway', sans-serif;
        color:#34a0a4;
    }
</style>
<div class="subscribe">
<div class="container">
    <div class="row">
        <div class="text-center align-self-center col-lg-6 col-md-6 mx-auto">
            <img src="/images/goed.png" alt="" class="img-fluid w-50">
            <h1>Subscribe Your Company Now</h1>
        </div>
        <div class="col-lg-4 col-md-6 mx-auto">
            <div class="subscribe-now card text-bg-light mb-3 border-0 shadow p-3 mb-5 bg-body rounded">
                <div class="card-header border-0">
                    <h4>Premium Plan</h4>
                </div>
                <div class="card-body">
                    <h5 class="text-center">Business Inventory</h5>
                    <h6 class="text-center">$50 / Year</h6><hr>
                    <p><h5 class="card-title"><i class="fa-solid fa-check text-success"></i> All features in basic</h5></p>
                    <p class="card-text"><i class="fa-solid fa-check text-success"></i> Inventory Managment</p>
                    <p class="card-text"><i class="fa-solid fa-check text-success"></i> Inventory Forecast</p>
                    <p class="card-text"><i class="fa-solid fa-check text-success"></i> Unlimited Users</p>
                    <!-- <form action="/views/subscribe.php" class="me-1">
                    <button type="submit" class="btn ">Buy Now</button>
                    </form> -->
                    <button class="btn" id="subscribe">Buy Now</button>
                    <div id="paypal-button-container"></div>
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
<script src="https://www.paypal.com/sdk/js?client-id=AeaLljlZHGWrmB8clfOshFP5W_Ya48j3jl1SeQS372r1DShXV8xt3c6WdZEFJnGhaUpSQb4V68ndSYxT&currency=USD"></script>
<script>
    let subscribe = document.getElementById('subscribe')
    let paypalBtn = document.getElementById('paypal-button-container')

    paypalBtn.style.display = 'none'

    subscribe.addEventListener('click', function(e) {
        paypalBtn.style.display='block'
        e.target.style.display = 'none'
    })
</script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions){
            return actions.order.create({
                intent: "CAPTURE",
                purchase_units: [{
                    amount:{ value: 50 }
                }]
            })
        },
        onApprove: function(data, actions){
            return actions.order.capture().then(function(orderData){
                // alert(location.href='register_company.php');
                window. location. href='register_company.php'
                window.alert('Subscribed Successfully');

            })
        }
    }).render("#paypal-button-container");
</script>