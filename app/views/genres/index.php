<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Genres</h1>
    </div>
    <div class="col-md-6">
    <?php if ($_SESSION['admin'] > 0) : ?>
      <a href="<?php echo URLROOT; ?>/genres/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Genre
      </a>
      <?php endif; ?>
    </div>
  </div>
  <!-- loop through genres -->
  <?php foreach($data['genres'] as $genre) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $genre->name; ?></h4>
      <a href="<?php echo URLROOT; ?>/genres/show/<?php echo $genre->id; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>