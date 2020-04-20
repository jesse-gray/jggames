<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/brands" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['brand']->name; ?></h1>


<?php if ($_SESSION['admin'] > 0) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/brands/edit/<?php echo $data['brand']->id; ?>" class="btn btn-dark">Edit</a>

<!-- Delete uses form as it is a brand request, not a delete request -->
  <form class="pull-right" action="<?php echo URLROOT; ?>/brands/delete/<?php echo $data['brand']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
  <br>
<?php endif; ?>



<?php require APPROOT . '/views/inc/footer.php'; ?>