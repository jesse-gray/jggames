<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Shopping Cart</h1>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <!-- loop through products -->
  <?php foreach($data['products'] as $products) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $products->name; ?></h4>
      <p class="card-text"><?php echo $products->description; ?></p>
      <p class="card-text"><?php echo $products->quantity; ?></p>
      <a href="<?php echo URLROOT; ?>/products/show/<?php echo $products->id; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>