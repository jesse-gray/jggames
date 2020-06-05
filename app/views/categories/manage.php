<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
  <div>
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- loop through categories -->
        <?php foreach ($data['categories'] as $category): ?>
          <tr>
            <td scope="row"><?php echo $category->name ?></td>
            <td class="pull-right">            
            <button type="button" class="btn btn-primary btn-danger pull-right" data-toggle="modal" data-target="#confirm_delete">
                Delete
            </button>
            </td>
            <td class="pull-right">
              <a href="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->id; ?>" class="btn btn-primary ">Edit</a>              
            </td>            
          </tr>
        <?php endforeach; ?>        
      </tbody>
    </table>
  </div>
</div>
<a href="<?php echo URLROOT; ?>/pages/dashboard" class="btn btn-dark m-3"><i class="fa fa-backward"></i> Back</a>

<!-- Modal -->
<div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="Confirm Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="confirm_delete_label">Confirm Delete Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <div class="modal-body">
            Are you sure you want to delete this category?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            <!-- Delete uses form as it is a post request, not a delete request -->
            <form class="pull-right" action="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->id; ?>" method="post">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
        </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>