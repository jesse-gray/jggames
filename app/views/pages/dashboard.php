<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="header">
    <h1><?php echo $data['title']; ?></h1>
    </div>
    <p><?php echo $data['description']; ?></p>
    <div class="container">
    <div class="card" style="width: 25rem;">
  <div class="card-header">
    Editable
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/categories/manage">Categories</a>
    </li>
    <li class="list-group-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/genres/manage">Genres</a>
    </li>
    <li class="list-group-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/products/manage">Products</a>
    </li>
    <li class="list-group-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/users/manage">Users</a>
    </li>
    <li class="list-group-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/orders/manage">Orders</a>
    </li>
    <li class="list-group-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/posts/manage">Posts</a>
    </li>
  </ul>
</div>
    </div>
</div> 
  
<?php require APPROOT . '/views/inc/footer.php'; ?>