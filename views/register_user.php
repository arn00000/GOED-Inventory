<?php
$title = "Register User";
function get_content(){
?>
<style>
    footer {
        display: none;
    }
</style>

<div>
    <div class="container">
        <div class="row my-4 shadow p-3 mb-5 bg-body rounded">
            <div class="sign-up col-md-6">
                <img src="../images/register.png" alt="" class="img-fluid" >
            </div>
            <div class="col-md-5 align-self-center">
            <h4 class="register">Sign Up</h4>
            <small class="text-muted">*First user sign up will be Admin</small>
                <form method="POST" action="/controllers/users/register_user.php" data-aos="fade-right"
                    data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    <div class=" col-md-10 form-floating mb-3">
                        <input type="username" class="form-control border-dark" name="username">
                        <label for="username">Username</label>
                    </div>
                    <div class=" col-md-10 form-floating mb-3">
                        <input type="password" class="form-control border-dark" name="password">
                        <label for="password">Password</label>
                    </div>
                    <div class=" col-md-10 form-floating mb-3">
                        <input type="password" class="form-control border-dark" name="password2">
                        <label for="password2">Confirm Password</label>
                    </div>
                    <div class=" col-md-10 form-floating mb-3">
                        <input type="password" class="form-control border-dark" name="companycode">
                        <label for="companycode">Company Code</label>
                    </div>
                    <small>Already sign up? 
                        <a href="login.php" class="link-info">Login</a>
                    </small> or
                    <small>back to 
                        <a href="/" class="link-info">Home</a>
                    </small>
                    <br>
                    <button class="btn mb-3">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
require_once 'layout.php';
?>