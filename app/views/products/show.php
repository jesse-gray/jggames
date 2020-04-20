<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/products" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['product']->name; ?></h1>

<p><?php echo $data['product']->description; ?></p>

<?php if ($_SESSION['admin'] > 0) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/products/edit/<?php echo $data['product']->id; ?>" class="btn btn-dark">Edit</a>

<!-- Delete uses form as it is a product request, not a delete request -->
  <form class="pull-right" action="<?php echo URLROOT; ?>/products/delete/<?php echo $data['product']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
  <br>
<?php endif; ?>



<?php require APPROOT . '/views/inc/footer.php'; ?>