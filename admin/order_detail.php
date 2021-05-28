<?php
	
	require 'header.php';
	require 'config/config.php';
	

	$stmt = $pdo->prepare("SELECT * FROM sale_order_detail ORDER BY id DESC");
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
                <h3 class="card-title">Order Detail Table</h3>
                <a href="order_list.php" class="btn btn-warning float-right">Back</a>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Order_date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i =1;
                      foreach ($result as $value) { ?>
                        <?php
                          $stmt = $pdo->prepare("SELECT * FROM products WHERE id =". $value['product_id']);
                          $stmt->execute();
                          $pResult = $stmt->fetchAll();
                        ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $pResult['0']['name']; ?></td>
                          <td><?php echo $value['quantity']; ?></td>
                          <td><?php echo escape(date("Y-m-d",strtotime($value['order_date']))); ?></td>
                        </tr>
                    <?php  } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
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