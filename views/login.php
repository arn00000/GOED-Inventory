<?php
$title = "Login";
function get_content(){
?>
<style>
    footer {
        display: none;
    }
    nav {
        background-color:;
    }
</style>

<div class="login">
    <div class="container shadow p-3 mb-5 bg-body rounded p-5">
        <h2 class="text-center">Login</h2>
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form method="POST" action="/controllers/users/login_user.php" data-aos="zoom-in">
                    <div class="col-md-12 form-floating mb-3">
                        <input type="username" class="form-control border-dark" name="username">
                        <label for="username">Username</label>
                    </div>
                    <div class="col-md-12 form-floating mb-3">
                        <input type="password" class="form-control border-dark" name="password">
                        <label for="password">Password</label>
                    </div>
                    <button class="btn">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div class="text-center">
        <small>Don't have an account? 
            <a href="register_user.php" class="link-info">Sign Up</a> now
        </small><br>
        <small>Back to 
            <a href="/" class="link-info">Home</a>
        </small>
        <br><br>
    </div>
</div>
<?php
}
require_once 'layout.php';
?>

<script>
     const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');
 
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>