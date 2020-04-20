<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
  <div class="col">
    <h4>Categories</h4>

    <hr>
    <?php foreach ($data['categories'] as $category) : ?>


      <a href="#"><?php echo $category->name; ?></a>
      <hr>

    <?php endforeach; ?>
    <h4>Brands</h4>
    <hr>
    <?php foreach ($data['brands'] as $brand) : ?>


      <a href="#"><?php echo $brand->name; ?></a>
      <hr>

    <?php endforeach; ?>
  </div>
  <div class="col-6">
    <div class="jumbotron jumbotron-flud text-center">
      <div class="container">
        <h1 class="display-3"><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description']; ?></p>
      </div>
    </div>
  </div>
  <div class="col">
    Side bar
  </div>
</div>




<?php require APPROOT . '/views/inc/footer.php'; ?>