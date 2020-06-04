<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
<div class="col-3" style="width: 18rem;">
        <h4>Search</h4>
        <hr>
        <form action="<?php echo URLROOT; ?>/products/shop" method="post">
            <div class="form-group">
                <label for="formGroupExampleInput">Text Search</label>
                <input type="text" name="text_search" class="form-control" id="formGroupExampleInput" value="<?php echo $data['text_search']; ?>">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Min Price</label>
                <input type="number" name="min_price_search" class="form-control" id="formGroupExampleInput2" value="<?php echo $data['min_price_search']; ?>"  placeholder="Min price">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Max Price</label>
                <input type="number" name="max_price_search" class="form-control" id="formGroupExampleInput2" value="<?php echo $data['max_price_search']; ?>"  placeholder="Max Price">
            </div>
            <input type="submit" class="btn btn-success" value="Search">
        </form>
    </div>
  <div class="col">


    <div class="home-grid-area">
      <?php foreach ($data['products'] as $product) : ?>

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
    </div>

  </div>




  <?php require APPROOT . '/views/inc/footer.php'; ?>