<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Orders</h1>
    </div>
  </div>
  <!-- loop through products -->
  <?php foreach($data['orders'] as $order) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title">Order #<?php echo $order->order_id; ?></h4>
      <p class="card-text">$<?php echo $order->total; ?></p>
      <p class="card-text"><?php echo $order->placed_date; ?></p>
      <a href="<?php echo URLROOT; ?>/orders/show/<?php echo $order->order_id; ?>" class="btn btn-dark">View Details</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>