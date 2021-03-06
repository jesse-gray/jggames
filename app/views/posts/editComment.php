<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="card card-body bg-light mt-5">
    <h2>Edit Comment</h2>    
    <form action="<?php echo URLROOT; ?>/posts/editComment/<?php echo $data['id']; ?>" method="post">
      <div class="form-group">
        <label for="body">Body: <sup>*</sup></label>
        <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
        <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
      </div>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>  
  <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $data['id']; ?>" class="btn btn-dark m-3"><i class="fa fa-backward"></i> Back</a>
<?php require APPROOT . '/views/inc/footer.php'; ?>