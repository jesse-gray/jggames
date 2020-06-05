<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Shopping Cart</h1>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <?php if (empty($data['products'])): ?>
    <div class="text-center">
      <img src="https://chocogrid.com/img/images/cart-empty.jpg" class="img-fluid mx-auto" alt="Empty cart icon">
    </div>
  <?php endif; ?>

  <!-- loop through products -->
  <?php foreach ($data['products'] as $products): ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $products->name; ?></h4>
      <p class="card-text"><?php echo $products->description; ?></p>
      <h6 class="card-text"><?php echo 'Quantity: ', $products->quantity; ?></h6>
      <?php if (isset($_SESSION['user_id'])): ?>
          <form class="pull-right" action="<?php echo URLROOT; ?>/cart/remove/<?php echo $products->product_id; ?>" method="post">
            <input type="submit" value="Remove from Cart" class="pull-right btn btn-danger">
          </form>      
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
  <?php if (!empty($data['products']) && isset($_SESSION['user_id'])): ?>       
    <a class="btn btn-dark pull-right" href="<?php echo URLROOT; ?>/checkout/index">Proceed to Checkout</a>    
  <?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>