<?php
  require 'header.php';
  require 'config/config.php';
   
  if ($_POST) {
    if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['category']) || empty($_POST['quantity']) || empty($_POST['price']) || empty($_FILES['image'])) {
      if (empty($_POST['name'])) {
        $nameError = "Name cannot be null";
      }

      if (empty($_POST['description'])) {
        $descriptionError= "Description cannot be null";
      }

      if (empty($_POST['category'])) {
        $categoryError= "Category cannot be null";
      }
      
      if (empty($_POST['quantity'])) {
        $qtyError= "Quantity cannot be null";
      }elseif (is_numeric($_POST['quantity']) != 1) {
        $qtyError ="Quantity should be a number";
      }
      
      if (empty($_POST['price'])) {
        $priceError= "Price cannot be null";
      }elseif (is_numeric($_POST['price']) != 1) {
        $priceError = "Price should be a number";
      }
      
      if (empty($_FILES['image'])) {
        $imageError= "Image cannot be null";
      }
      
      
    }else{

      if ($_FILES['image']['name'] != null) {
        $file = 'images/'.($_FILES['image']['name']);
        $imageType = pathinfo($file,PATHINFO_EXTENSION);
        if ($imageType != 'jpg' && $imageType != 'jpgeg' && $imageType != 'png') {
          echo "<script> alert('Image type should be jpg,jpeg,png');</script>";
        }else{
          $name = $_POST['name'];      
          $description = $_POST['description'];
          $category = $_POST['category'];
          $quantity = $_POST['quantity'];
          $price = $_POST['price'];
          $id =$_POST['id'];
          $image = $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], $file);

          $stmt = $pdo->prepare("UPDATE products SET name = :name, description = :description, category_id= :category, quantity = :quantity, price = :price, image = :image WHERE id = :id");
          $result = $stmt->execute(
            array(
              ':name' =>$name,
              ':description' =>$description,
              ':category'=> $category,
              ':quantity' => $quantity,
              ':price' => $price,
              ':image' => $image, 
              ':id' => $id,
            )
          );
          if ($result) {
            echo "<script> alert('Category is updated');window.location.href='index.php'; </script>";
          }
        }

      }else{
         $name = $_POST['name'];      
          $description = $_POST['description'];
          $category = $_POST['category'];
          $quantity = $_POST['quantity'];
          $price = $_POST['price'];
          $id = $_POST['id'];


        $stmt = $pdo->prepare("UPDATE products SET name = :name, description = :description, category_id= :category, quantity = :quantity, price = :price WHERE id = :id");
          $result = $stmt->execute(
            array(
              ':name' =>$name,
              ':description' =>$description,
              ':category'=> $category,
              ':quantity' => $quantity,
              ':price' => $price,
              
              ':id' => $id,
            )
          );
          if ($result) {
            echo "<script> alert('Category is updated');window.location.href='index.php'; </script>";
          }
      }
      
   }

  }


  $stmt = $pdo->prepare("SELECT * FROM products WHERE id =".$_GET['id']);
  $stmt->execute();
  $result = $stmt->fetchAll();


?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Creating Category</h3>
                <a href="index.php" type="button" class="btn btn-warning float-right">Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                  <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                  <input type="hidden" name="id" value="<?php echo escape($result['0']['id']); ?>">
                  <div class="form-group">
                    <label for="name">Name</label>
                     <p class="text-danger"><?php echo empty($nameError)? '' : '*'.$nameError; ?></p>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo escape($result['0']['name']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <p class="text-danger"><?php echo empty($descriptionError) ? '' : '*'.$descriptionError; ?></p>
                    <textarea class="form-control" cols="5" rows="5" id="description" name="description"><?php echo 
                    escape($result['0']['description']); ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="category">Category</label>
                    <p class="text-danger"><?php echo empty($categoryError) ? '' : '*'.$categoryError; ?></p>
                   <?php
                      $catstmt = $pdo->prepare("SELECT * FROM catagories");
                      $catstmt->execute();
                      $catResult = $catstmt->fetchAll();
                    ?>
                    <select name="category" class="form-control">
                      <option value="">Slelct</option>
                      <?php foreach ($catResult as $value) { ?>
                        <?php  if($value['id']===$result['0']['category_id']): ?>
                          <option value="<?php echo $value['id'] ?>" selected><?php echo $value['name']; ?></option>
                        <?php else: ?>
                          <option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
                        <?php endif; ?>
                      <?php } ?>
                      
                      
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <p class="text-danger"><?php echo empty($qtyError) ? '' : '*'.$qtyError; ?></p>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo escape($result[0]['quantity']); ?>">
                  </div>

                  <div class="form-group">
                    <label for="price">Price</label>
                    <p class="text-danger"><?php echo empty($priceError) ? '' : '*'.$priceError; ?></p>
                    <input type="number" name="price" id="name" class="form-control" value="<?php echo escape($result[0]['price']); ?>">
                  </div>


                  <div class="form-group">
                    <label for="image">Image</label>
                    <p class="text-danger"><?php echo empty($imageError) ? '' : '*'.$imageError; ?></p>
                    <img src="images/<?php echo escape($result[0]['image'])?>" alt="" width="150" height="150"><br>
                    <input type="file" name="image" id="image">
                  </div>

                  <div>
                    <input type="submit" value="Submit" class="btn btn-success">

                  </div>
                </form>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  </div>
  <!-- /.content-wrapper -->
<?php
  require 'footer.php';
?>
