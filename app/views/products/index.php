<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Products</h1>
    </div>
    <div class="col-md-6">
    <?php if ($_SESSION['admin'] > 0) : ?>
      <a href="<?php echo URLROOT; ?>/products/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Product
      </a>
      <?php endif; ?>
    </div>
  </div>
  <!-- loop through products -->
  <?php foreach($data['products'] as $product) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $product->name; ?></h4>
      <p class="card-text"><?php echo $product->description; ?></p>
      <small class="text-muted mb-3">Quantity Remaining: <?php echo $product->quantity; ?></small>
      <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>