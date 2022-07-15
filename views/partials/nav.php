<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand"><img src="../images/goed.png" alt="" class="img-fluid" style="width:150px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if(!isset($_SESSION['company_info']) && !isset($_SESSION['user_info'])): ?>
        <li class="nav-item fs-5 mx-2">
          <a  <?php if($_SERVER['SCRIPT_NAME']=="/index.php") { ?>  class="nav-link " style="color: #34a0a4;"   <?php   }  ?> class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item fs-5 mx-2">
          <a <?php if($_SERVER['SCRIPT_NAME']=="/views/subscribe.php") { ?>  class="nav-link " style="color: #34a0a4;"   <?php   }  ?> class="nav-link" href="/views/subscribe.php">Subscribe</a>
        </li>
        <li class="nav-item fs-5 mx-2">
          <a <?php if($_SERVER['SCRIPT_NAME']=="/views/register_user.php") { ?>  class="nav-link " style="color: #34a0a4;"   <?php   }  ?>  class="nav-link" href="/views/register_user.php">Sign Up</a>
        </li>
        <li class="nav-item fs-5 mx-2">
          <a <?php if($_SERVER['SCRIPT_NAME']=="/views/login.php") { ?>  class="nav-link " style="color: #34a0a4;"   <?php   }  ?> class="nav-link" href="/views/login.php">Login</a>
        </li>
        <?php else: ?>
        <li class="nav-item fs-5 mx-2">
          <a class="nav-link" aria-current="page" href="/views/dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
        </li>
        <li class="nav-item fs-5 mx-2">
          <a class="nav-link" href="/controllers/users/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>