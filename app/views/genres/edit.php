<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="card card-body bg-light mt-5">
    <h2>Add Genre</h2>
    <p>Create a genre with this form</p>
    <form action="<?php echo URLROOT; ?>/genres/edit/<?php echo $data['id']; ?>" method="post">
      <div class="form-group">
        <label for="name">Name: <sup>*</sup></label>
        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
      </div>      
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<a href="<?php echo URLROOT; ?>/genres/manage" class="btn btn-dark m-3"><i class="fa fa-backward"></i> Back</a>
<?php require APPROOT . '/views/inc/footer.php'; ?>