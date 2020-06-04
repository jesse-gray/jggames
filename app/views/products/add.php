<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="card card-body bg-light mt-5">
  <h2>Add Product</h2>
  <p>Create a product with this form</p>
  <form action="<?php echo URLROOT; ?>/products/add" method="post">
  <!-- NAME -->
    <div class="form-group">
      <label for="name">Name: <sup>*</sup></label>
      <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
      <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
    </div>
    <!-- DESCRIPTION -->
    <div class="form-group">
      <label for="description">description: <sup>*</sup></label>
      <textarea name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['description']; ?></textarea>
      <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
    </div>
    <!-- LONG DESCRIPTION -->
    <div class="form-group">
      <label for="long_description">long_description: <sup>*</sup></label>
      <textarea name="long_description" class="form-control form-control-lg <?php echo (!empty($data['long_description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['long_description']; ?></textarea>
      <span class="invalid-feedback"><?php echo $data['long_description_err']; ?></span>
    </div>
    <!-- IMAGE -->
    <div class="form-group">
      <label for="image_link">image_link: <sup>*</sup></label>
      <textarea name="image_link" class="form-control form-control-lg <?php echo (!empty($data['image_link_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['image_link']; ?></textarea>
      <span class="invalid-feedback"><?php echo $data['image_link_err']; ?></span>
    </div>
    <!-- QUANTITY -->
    <div class="form-group">
      <label for="quantity">Quantity: <sup>*</sup></label>
      <input type="number" name="quantity" class="form-control form-control-lg <?php echo (!empty($data['quantity_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['quantity']; ?>">
      <span class="invalid-feedback"><?php echo $data['quantity_err']; ?></span>
    </div>
    <!-- PRICE -->
    <div class="form-group">
      <label for="price">Price: <sup>*</sup></label>
      <input type="number" name="price" class="form-control form-control-lg <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
      <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
    </div>
    <!-- BRAND -->
    <div class="form-group">
      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Genre</label>
      </div>
      <select name="genre" class="custom-select form-control form-control-lg <?php echo (!empty($data['genre_err'])) ? 'is-invalid' : ''; ?>" id="inputGroupSelect01">
        <option <?php echo $data['genre'] === 'Choose...' ? 'selected' : '' ?>>Choose...</option>
        <?php foreach($data['genres'] as $genre) : ?>
        <option <?php echo $data['genre'] === $genre->name ? 'selected' : '' ?> value="<?php echo $genre->name ?>"><?php echo $genre->name ?></option>
        <?php endforeach; ?>
      </select>
      <span class="invalid-feedback"><?php echo $data['genre_err']; ?></span>
    </div>
    <!-- CATEGORY -->
    <div class="form-group">
      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Category</label>
      </div>
      <select name="category" class="custom-select form-control form-control-lg <?php echo (!empty($data['category_err'])) ? 'is-invalid' : ''; ?>" id="inputGroupSelect01">
        <option <?php echo $data['category'] === 'Choose...' ? 'selected' : '' ?>>Choose...</option>
        <?php foreach($data['categories'] as $category) : ?>
        <option <?php echo $data['category'] === $category->name ? 'selected' : '' ?> value="<?php echo $category->name ?>"><?php echo $category->name ?></option>
        <?php endforeach; ?>
      </select>
      <span class="invalid-feedback"><?php echo $data['category_err']; ?></span>
    </div>
    
    <input type="submit" class="btn btn-success" value="Submit">
  </form>
<a href="<?php echo URLROOT; ?>/products" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>


</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>