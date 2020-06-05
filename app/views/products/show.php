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
        <!--Check for logged in user-->
        <?php if (isset($_SESSION['user_id'])): ?>
          <form class="pull-right m-3" action="<?php echo URLROOT; ?>/cart/add/<?php echo $data['product']->id; ?>" method="post">
            <input type="submit" value="Add to Cart" class="btn btn-dark">
          </form>      
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['admin'])): ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/products/edit/<?php echo $data['product']->id; ?>" class="btn btn-dark">Edit</a>
  <button type="button" class="btn btn-primary btn-danger pull-right" data-toggle="modal" data-target="#confirm_delete">
      Delete
  </button>
  <br>
<?php endif; ?>
<div class="my-2">
<a href="<?php echo URLROOT; ?>/products" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="Confirm Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="confirm_delete_label">Confirm Delete Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <div class="modal-body">
            Are you sure you want to delete this product?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            <!-- Delete uses form as it is a product request, not a delete request -->
            <form action="<?php echo URLROOT; ?>/products/delete/<?php echo $data['product']->id; ?>" method="post">
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>