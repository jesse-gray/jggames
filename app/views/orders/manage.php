<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
  <div>
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Placed by</th>
          <th scope="col">Total</th>
          <th scope="col">Placed Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- loop through orders -->
        <?php foreach ($data['orders'] as $order): ?>
          <tr>
            <td scope="row"><?php echo $order->username ?></td>
            <td>$<?php echo $order->order_total ?></td>
            <td><?php echo $order->order_placed_date ?></td>
            <td class="pull-right">
            </td>
            <td class="pull-right">
              <a href="<?php echo URLROOT; ?>/orders/show/<?php echo $order->order_id; ?>" class="btn btn-primary ">View</a>              
            </td>            
          </tr>
        <?php endforeach; ?>        
      </tbody>
    </table>
  </div>
</div>
<a href="<?php echo URLROOT; ?>/pages/dashboard" class="btn btn-dark m-3"><i class="fa fa-backward"></i> Back</a>

<?php require APPROOT . '/views/inc/footer.php'; ?>