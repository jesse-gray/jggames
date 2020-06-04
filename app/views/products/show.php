<?php require APPROOT . '/views/inc/header.php'; ?>
<br>
<div class="card mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img class="card-img" src="<?php echo $data['product']->image_link; ?>" alt="altPic"/>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title"><?php echo $data['product']->name; ?></h1>
        <p class="card-text"><?php echo $data['product']->description; ?></p>
        <p class="card-text"><?php echo $data['product']->long_description; ?></p>
        <h3 class="card-text font-weight-bold text-danger "><?php echo "$" . $data['product']->price; ?></h3>

        <?php if(isset($_SESSION['user_id'])): ?>
          <form class="pull-right m-3" action="<?php echo URLROOT; ?>/cart/add/<?php echo $data['product']->id; ?>" method="post">
            <input type="submit" value="Add to Cart" class="btn btn-dark">
          </form>      
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<!--<?php if(isset($_SESSION['user_id'])): ?>
  <form class="pull-right" action="<?php echo URLROOT; ?>/cart/add/<?php echo $data['product']->id; ?>" method="post">
    <input type="submit" value="Add to Cart" class="btn btn-dark">
  </form>      
<?php endif; ?>-->

<?php if ($_SESSION['admin'] > 0) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/products/edit/<?php echo $data['product']->id; ?>" class="btn btn-dark">Edit</a>

<!-- Delete uses form as it is a product request, not a delete request -->
  <form class="pull-right" action="<?php echo URLROOT; ?>/products/delete/<?php echo $data['product']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
  <br>
<?php endif; ?>
<div class="my-2">
<a href="<?php echo URLROOT; ?>/products" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>