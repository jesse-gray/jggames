<?php require APPROOT . '/views/inc/header.php'; ?>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p><?php echo $data['post']->body; ?></p>

<?php if ($data['post']->user_id == $_SESSION['user_id']): ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>
  <button type="button" class="btn btn-primary btn-danger pull-right" data-toggle="modal" data-target="#confirm_post_delete">
      Delete
  </button>
  <br>
<?php endif; ?>

<br>
<?php foreach ($data['comments'] as $comment): ?>
    <div class="container">
        <div class="card card-body mb-3">
            <p class="card-text"><?php echo $comment->commentBody; ?></p>
            <div class="bg-light p-2 mb-3">
                Written by <?php echo $comment->commentUserName; ?> on <?php echo $comment->commentCreated; ?>
            </div>
            <?php if ($comment->commentUserId == $_SESSION['user_id']): ?>
            <div class="container">
                <hr>
                <a href="<?php echo URLROOT; ?>/posts/editComment/<?php echo $comment->commentId; ?>" class="btn btn-dark">Edit</a>                
                <button type="button" class="btn btn-primary btn-danger pull-right" data-toggle="modal" data-target="#confirm_comment_delete">
                    Delete
                </button>
            </div>
        <?php endif; ?>
        </div>
    </div>        
    <br>
    <?php endforeach; ?>
    
    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/addComment/<?php echo $data['post']->id; ?>"  class="btn btn-primary pull-right">
          <i class="fa fa-pencil"></i> Add Comment
        </a>
      </div>
    <?php else: ?>
      <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-primary pull-right">
          <i class="fa fa-pencil"></i> Login to add comments
        </a>
      </div>
    <?php endif; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>



<!-- Modal -->
<div class="modal fade" id="confirm_post_delete" tabindex="-1" role="dialog" aria-labelledby="Confirm Post Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="confirm_post_delete_label">Confirm Delete Post</h5>
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
            <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
              <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm_comment_delete" tabindex="-1" role="dialog" aria-labelledby="Confirm Comment Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="confirm_comment_delete_label">Confirm Delete Comment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <div class="modal-body">
            Are you sure you want to delete this comment?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            <!-- Delete uses form as it is a post request, not a delete request -->
            <form class="pull-right" action="<?php echo URLROOT; ?>/posts/deleteComment/<?php echo $comment->commentId; ?>" method="post">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
        </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>