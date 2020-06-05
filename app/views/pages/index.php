<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
  <div class="col">
    <div class="jumbotron jumbotron-flud text-center">
      <div class="container">
        <h1 class="display-3"><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description']; ?></p>
      </div>
    </div>

    <!-- <div class="home-grid-area">
      <?php foreach ($data['products'] as $product): ?>

        <div class="card">
        <img class="card-img-top" src="<?php echo $product->image_link; ?>" alt="altPic"/>
          <div class="card-body">
            <h5 class="card-title"><?php echo $product->name; ?></h5>
            <p class="card-text"><?php echo $product->description; ?></p>
            <h4 class="card-text font-weight-bold text-danger "><?php echo "$" . $product->price; ?></h4>
            <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>" class="btn btn-primary btn-block">View More Details</a>
          </div>
        </div>

        
      <?php endforeach; ?>

  <?php require APPROOT . '/views/inc/footer.php'; ?>