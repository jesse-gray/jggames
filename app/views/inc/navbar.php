<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-genre" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/products/shop">Store</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/posts">Forum</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">        
        <!-- Show account and logout if logged in -->
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/edit/<?php echo $_SESSION['user_id']; ?>">Welcome <?php echo $_SESSION['user_name']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/cart/index">Shopping Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/orders/index">Orders</a>
          </li>
          <?php if ($_SESSION['admin'] > 0): ?>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/dashboard">Dashboard</a>
            </li>            
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
          </li>
        <?php else: ?>
          <!-- Show register and log in if user not logged in -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>