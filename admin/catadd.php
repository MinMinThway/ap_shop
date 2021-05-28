<?php
  require 'header.php';
  require 'config/config.php';
   
  if ($_POST) {
    if (empty($_POST['name']) || empty($_POST['description'])) {
      if (empty($_POST['name'])) {
        $nameError = "Name cannot be null";
      }

      if (empty($_POST['description'])) {
        $descriptionError= "Description cannot be null";
      }
      
    }else{
      $name = $_POST['name'];
      $description = $_POST['description'];

      $stmt =$pdo->prepare("INSERT INTO catagories(name, description) VALUES(:name, :description)");
      $result = $stmt->execute(
        array(
          ':name' =>$name,
          ':description' =>$description
        )
      );
      if ($result) {
        echo "<script> alert('New category is added');window.location.href='catlist.php'; </script>";
      }
  }

  }




?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Creating Category</h3>
                <a href="catlist.php" type="button" class="btn btn-warning float-right">Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="catadd.php" method="POST">
                  <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                  <div class="form-group">
                    <label for="name">Name</label>
                     <p class="text-danger"><?php echo empty($nameError)? '' : '*'.$nameError; ?></p>
                    <input type="text" name="name" id="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <p class="text-danger"><?php echo empty($descriptionError) ? '' : '*'.$descriptionError; ?></p>
                    <textarea class="form-control" cols="10" rows="10" id="description" name="description"></textarea>
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
