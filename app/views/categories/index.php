<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Categories</h1>
    </div>
    <div class="col-md-6">
    <?php if ($_SESSION['admin'] > 0): ?>
      <a href="<?php echo URLROOT; ?>/categories/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Category
      </a>
      <?php endif; ?>
    </div>
  </div>
  
  <!-- loop through categories -->
  <?php foreach ($data['categories'] as $category): ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $category->name; ?></h4>
      <a href="<?php echo URLROOT; ?>/categories/show/<?php echo $category->id; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>