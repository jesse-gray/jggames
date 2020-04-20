<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Brands</h1>
    </div>
    <div class="col-md-6">
    <?php if ($_SESSION['admin'] > 0) : ?>
      <a href="<?php echo URLROOT; ?>/brands/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Brand
      </a>
      <?php endif; ?>
    </div>
  </div>
  <!-- loop through brands -->
  <?php foreach($data['brands'] as $brand) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $brand->name; ?></h4>
      <a href="<?php echo URLROOT; ?>/brands/show/<?php echo $brand->id; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>