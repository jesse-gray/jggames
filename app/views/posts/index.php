<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Posts</h1>
    </div>    
    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
          <i class="fa fa-pencil"></i> Add Post
        </a>
      </div>
    <?php else: ?>
      <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-primary pull-right">
          <i class="fa fa-pencil"></i> Login to add posts
        </a>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- loop through posts -->
  <?php foreach ($data['posts'] as $post): ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $post->title; ?></h4>
      <div class="bg-light p-2 mb-3">
        Written by <?php echo $post->name; ?> on <?php echo $post->postCreated; ?>
      </div>
      <p class="card-text"><?php echo $post->postBody; ?></p>
      <small class="text-muted my-2"><?php echo $post->replyCount; ?> repl<?php echo ($post->replyCount = 1) ? 'y' : 'ies'; ?> to this post</small>
      <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>