<?php
$title = "Register Company";
function get_content(){
?>
<style>
    footer {
        display: none;
    }
</style>
<!-- <script>
    alert('Subscribed Succesfully')
</script> -->
<div>
    <div class="container">
        <div class="row my-4 shadow p-3 mb-5 bg-body rounded">
            <div class="company col-md-6">
                <img src="../images/register.png" alt="" class="img-fluid" >
            </div>
            <div class="col-md-5 align-self-center">
                <h4 class="register">Register Company</h4>
                <small class="text-muted">*Note Kindly Register Your Company Before You Leave</small>
                <form method="POST" action="/controllers/companies/register_company.php" data-aos="fade-right"
                    data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    <div class=" col-md-10 form-floating mb-3">
                        <input type="name" class="form-control border-dark" name="companyname">
                        <label for="companyName">Company Name</label>
                    </div>
                    <div class=" col-md-10 form-floating mb-3">
                        <input type="password" class="form-control border-dark" name="companycode">
                        <label for="companycode">Company Code</label>
                    </div>
                    <button class="btn mb-3">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
require_once 'layout.php';
?>

