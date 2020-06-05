<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/genres" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['genre']->name; ?></h1>

<?php if ($_SESSION['admin'] > 0): ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/genres/edit/<?php echo $data['genre']->id; ?>" class="btn btn-dark">Edit</a>

  <!-- Delete uses form as it is a genre request, not a delete request -->
  <form class="pull-right" action="<?php echo URLROOT; ?>/genres/delete/<?php echo $data['genre']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
  <br>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>