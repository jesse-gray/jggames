<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Checkout</h1>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <!-- loop through products -->


  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col-8">Name</th>
      <th scope="col-2">Qty</th>
      <th scope="col-2">Price</th>
    </tr>
  </thead>
  <tbody>  
    <?php foreach($data['products'] as $products) : ?>
        <tr>
          <td><?php echo $products->name; ?></td>
          <td><?php echo $products->quantity; ?></td>
          <td><?php echo "$" . $products->price;?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td></td>
        <td><span style="font-weight: bold;">Total</span></td>
        <td><?php echo "$" . number_format(array_sum(array_column($data['products'], 'price')), 2);?></td>
    </tr>
  </tbody>
  </table>
  
  <!--Address form-->
  <form action="<?php echo URLROOT; ?>/checkout/placeOrder/<?php echo $products->product_id; ?>" method="post">
  <div class="form-row">
      <div class="form-group col-md-2">
        <label for="inputStreetNumber">Street Number</label>
        <input type="text" class="form-control <?php echo (!empty($data['street_number_err'])) ? 'is-invalid' : ''; ?>" id="inputStreetNumber" name="inputStreetNumber" placeholder="10">
      <span class="invalid-feedback"><?php echo $data['street_number_err']; ?></span>
      </div>
      <div class="form-group col-md-10">
        <label for="inputStreetName">Street Name</label>
        <input type="text" class="form-control <?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>" id="inputStreetName" name="inputStreetName" placeholder="Main Street">
      <span class="invalid-feedback"><?php echo $data['street_name_err']; ?></span>
      </div>
  </div>
  <div class="form-group">
    <label for="inputSuburb">Suburb</label>
    <input type="text" class="form-control" id="inputSuburb" name="inputSuburb" placeholder="Taradale, Ahuriri, Meeanee">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''; ?>" id="inputCity" name="inputCity" placeholder="Napier">
      <span class="invalid-feedback"><?php echo $data['city_err']; ?></span>
    </div>
    <div class="form-group col-md-4">
      <label for="inputRegion">Region</label>
      <select id="inputRegion" name="inputRegion" class="form-control <?php echo (!empty($data['region_err'])) ? 'is-invalid' : ''; ?>">
      <span class="invalid-feedback"><?php echo $data['region_err']; ?></span>
        <option selected disabled hidden>Choose...</option>
        <option>Northland</option>
        <option>Auckland</option>
        <option>Waikato</option>
        <option>Bay of Plenty</option>
        <option>Gisborne</option>
        <option>Hawke's Bay</option>
        <option>Taranaki</option>
        <option>Manawatū-Whanganui</option>
        <option>Wellington</option>
        <option>Tasman</option>
        <option>Nelson</option>
        <option>Marlborough</option>
        <option>West Coast</option>
        <option>Canterbury</option>
        <option>Otago</option>
        <option>Southland</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputPostcode">Postcode</label>
      <input type="text" class="form-control <?php echo (!empty($data['postcode_err'])) ? 'is-invalid' : ''; ?>" id="inputPostcode" name="inputPostcode">
      <span class="invalid-feedback"><?php echo $data['postcode_err']; ?></span>
    </div>
  </div>
  <button type="submit" class="btn btn-dark pull-right">Confirm Order</button>
  </form>
<?php require APPROOT . '/views/inc/footer.php'; ?>