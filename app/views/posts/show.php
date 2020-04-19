<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p><?php echo $data['post']->body; ?></p>

<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>

<!-- Delete uses form as it is a post request, not a delete request -->
  <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
  <br>
<?php endif; ?>

<br>
<?php foreach($data['comments'] as $comment) : ?>
    <div class="container">
        <div class="card card-body mb-3">
            <p class="card-text"><?php echo $comment->commentBody; ?></p>
            <div class="bg-light p-2 mb-3">
                Written by <?php echo $comment->commentUserName; ?> on <?php echo $comment->commentCreated; ?>
            </div>
            <?php if($comment->commentUserId == $_SESSION['user_id']) : ?>
            <div class="container">
                <hr>
                <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>

                <!-- Delete uses form as it is a post request, not a delete request -->
                <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
           
        <?php endif; ?>
        </div>

    </div>
        
    <br>
    <?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>