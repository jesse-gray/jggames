<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="card card-body bg-light mt-5">
    <h2>Edit User</h2>
    <form action="<?php echo URLROOT; ?>/users/edit/<?php echo $data['id'] ?>" method="post">
        <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
        </div>
        <?php if ($_SESSION['admin'] > 0) : ?>
            <!-- <div class="container">
            <div class="form-check-inline">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="true"> Admin
            </label>
            </div> 
            </div>-->
           
            
        <?php endif; ?>
        
        <br>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>