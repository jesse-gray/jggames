<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
  <div>
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Created</th>
          <th scope="col">Admin</th>

          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- loop through users -->
      <?php foreach($data['users'] as $user) : ?>
          <tr>
            <td scope="row"><?php echo $user->name ?></td>
            <td><?php echo $user->email ?></td>
            <td><?php echo $user->created_at ?></td>
            <td><?php echo $user->admin > 0 ? 'true' : 'false' ?></td>

            <td class="pull-right"><a href="<?php echo URLROOT; ?>/users/edit/<?php echo $user->id; ?>" class="btn btn-primary">Edit</a> <a href="#" class="btn btn-danger">Delete</a></td>
          </tr>
      <?php endforeach; ?>
        
      </tbody>
    </table>
  </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>

