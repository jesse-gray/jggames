<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
  <div>
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Written by</th>
          <th scope="col">Body</th>
          <th scope="col">Date written</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- loop through products -->
        <?php foreach ($data['posts'] as $post): ?>
          <tr>
            <td scope="row"><?php echo $post->name ?></td>
            <td><?php echo $post->postBody ?></td>
            <td><?php echo $post->postCreated ?></td>
            <td class="pull-right">            
            <button type="button" class="btn btn-primary btn-danger pull-right" data-toggle="modal" data-target="#confirm_delete">
                Delete
            </button>
            </td>
            <td class="pull-right">
              <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->id; ?>" class="btn btn-primary ">View</a>              
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
              <h5 class="modal-title" id="confirm_delete_label">Confirm Delete Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <div class="modal-body">
            Are you sure you want to delete this post?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            <!-- Delete uses form as it is a post request, not a delete request -->
            <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->id; ?>" method="post">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
        </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>