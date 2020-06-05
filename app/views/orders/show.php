<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Order #<?php echo $data['order']{0}->order_id; ?></h1>
      <small class="text-muted">Placed on <?php echo $data['order']{0}->placed_date; ?></small><br>
      <?php if (is_null($data['order']{0}->shipped_date)): ?>
        <small class="text-muted">Unshipped</small>
      <?php else: ?>
        <small class="text-muted">Shipped on <?php echo $data['order']{0}->shipped_date; ?></small>
      <?php endif; ?>
    </div>
  </div>
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col-8">Product Name</th>
      <th scope="col-1">Quantity</th>
      <th scope="col-1">Unit Price</th>
      <th scope="col-2">Subtotal</th>
    </tr>
  </thead>
  <tbody>

  <!-- loop through products -->
  <?php foreach ($data['order'] as $order): ?>
    <tr>
      <td><?php echo $order->product_name; ?></td>
      <td><?php echo $order->quantity; ?></td>
      <td>$<?php echo $order->price; ?></td>
      <td>$<?php echo number_format((float)$order->price * $order->quantity, 2, '.', ''); ?></td>
    </tr>
  <?php endforeach; ?>  
  <tr>
      <td></td>
      <td></td>
      <td><span style="font-weight: bold;">Total</span></td>
      <td><span style="font-weight: bold;">$<?php echo $order->total; ?></span></td>
    </tr>
  </tbody>
  </table>

  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <address>
            <?php echo $data['order']{0}->street_number; ?> <?php echo $data['order']{0}->street_name; ?><br>
            <?php echo $data['order']{0}->suburb; ?>, <?php echo $data['order']{0}->city; ?> <?php echo $data['order']{0}->postcode; ?><br>
        </address>
        <address>
            <strong><?php echo $data['order']{0}->user_name; ?></strong><br>
            <a href="mailto:#"><?php echo $data['order']{0}->email; ?></a>
        </address>
      </div>
    </div>
    <a href="<?php echo URLROOT; ?>/orders/index" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>