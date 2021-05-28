<?php
  require 'header.php';
  require 'config/config.php';

  if ($_POST) {
    if (empty($_POST['name']) || empty($_POST['description'])) {
      if (empty($_POST['name'])) {
        $nameError = "Name cannot be null";
      }

      if (empty($_POST['description'])) {
        $descriptionError = "Description cannot be null";
      }
    }else{
      $id =$_POST['id'];
      $name = $_POST['name'];
      $description = $_POST['description'];

      $stmt =$pdo->prepare("UPDATE catagories SET name ='$name',description='$description' WHERE id='$id'");
      $result =$stmt->execute();
      if ($result) {
        echo "<script> alert('Category is updating now');window.location.href='catlist.php'; </script>";
      }
    }
  }
   $stmt =$pdo->prepare("SELECT * FROM catagories WHERE id=".$_GET['id']);
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
                <h3 class="card-title">Editing Category</h3>
                <a href="catlist.php" type="button" class="btn btn-warning float-right">Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST">
                  < <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                  <input type="hidden" name="id" value="<?php echo escape($result[0]['id']); ?>">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <p class="text-danger"><?php echo empty($nameError)? '' : '*'.$nameError; ?></p>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo escape($result[0]['name']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <p class="text-danger"><?php echo empty($descriptionError) ? '' : '*'.$descriptionError; ?></p>
                    <textarea class="form-control" cols="10" rows="10" id="description" name="description"><?php echo escape($result[0]['description']); ?></textarea>
                  </div>
                  <div>
                    <input type="submit" value="Update" class="btn btn-success">

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
