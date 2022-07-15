<?php
$title = "GOED";
function get_content(){
?>
<section>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <iframe class="iframe1" src="https://embed.lottiefiles.com/animation/67404" style="height:70vh; width:100%;"></iframe>
        </div>
        <div class="col-md-6 align-self-center">
            <img src="./images/goed.png" alt="" class="img-fluid" style="width:180px;"><br><br>
            <h5 class="des">An inventory management system is the process by which you track your goods throughout your entire supply, from purchasing to production to end sales. It governs how you approach inventory management for your business.</h5>
            <div class="d-flex">
                <form action="/views/subscribe.php" class="me-1">
                    <button type="submit" class="btn ">Subscribe</button>
                </form>
                <form action="/views/register_user.php" class="me-1">
                    <button type="submit" class="btn ">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>
</section>

<?php
}
require_once 'views/layout.php';
?>