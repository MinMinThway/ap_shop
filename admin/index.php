<?php
  require 'header.php'; 
  require 'config/config.php';
  require 'config/common.php';
  
  if (!empty($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  }else{
    $pageno = 1;
  }

  $numRecs = 1;
  $offset = ($pageno - 1)/$numRecs;

  if (empty($_POST['search'])) {
    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC");
    $stmt->execute();
    $Rawresult =$stmt->fetchAll();
    $total_pages = ceil(count($Rawresult)/$numRecs);

    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT $offset,$numRecs");
    $stmt->execute();
    $result =$stmt->fetchAll();
  }else{
    $searchKey = $_POST['search'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id DESC");
    $stmt->execute();
    $Rawresult =$stmt->fetchAll();
    $total_pages = ceil(count($Rawresult)/$numRecs);

    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numRecs");
    $stmt->execute();
    $result =$stmt->fetchAll();
  }
?>



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products Table</h3>
                <a href="product_add.php" class="btn btn-success float-right">Create New Product</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>In Stock</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i = 1;
                    foreach ($result as $value) { ?>
                      <?php
                      $catstmt = $pdo->prepare("SELECT * FROM catagories WHERE id = ".$value['category_id']);
                      $catstmt->execute();
                      $catResult = $catstmt->fetchAll();
                    ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo escape($value['name']); ?></td>
                        <td><?php echo escape($value['description']); ?></td>
                        <td><?php echo escape($catResult[0]['name']); ?></td>
                        <td><?php echo escape($value['quantity']); ?></td>
                        <td><?php echo escape($value['price']); ?></td>
                        <td>
                          <a href="product_edit.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">Edit</a>
                          <a href="product_delete.php?id=<?php echo $value['id'] ?>"  onclick="return confirm('Are you sure you want to delete this item')" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
               <div class="card-footer clearfix">
             <ul class="pagination pagination-sm m-0 float-right">
               <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
               <li class="page-item" <?php if($pageno <=1) { echo "disabled"; } ?>>
                 <a class="page-link" href="<?php if($pageno <= 1) { echo "#"; } else { echo "?pageno=".($pageno-1); } ?>">Previous</a>
               </li>
               <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
               <li class="page-item" <?php if($pageno >= $total_pages) { echo "disabled"; } ?>>
                 <a class="page-link" href="<?php if($pageno >= $total_pages) { echo "#"; } else { echo "?pageno=".($pageno+1); } ?>">Next</a>
               </li>
               <li class="page-item"><a class="page-link" href="<?php echo "?pageno=".$total_pages; ?>">Last</a></li>
             </ul>
           </div>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php
  require 'footer.php'; 
?>
