<?php
	
	require 'header.php';
	require 'config/config.php';
	require 'config/common.php';

  if (!empty($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  }else{
    $pageno = 1;
  }
  $numRecs = 2;
  $offset = ($pageno - 1)/$numRecs;

	$stmt = $pdo->prepare("SELECT * FROM sale_orders ORDER BY id DESC");
	$stmt->execute();
	$Rawresult = $stmt->fetchAll();
  $total_pages=ceil(count($Rawresult)/$numRecs);

  $stmt = $pdo->prepare("SELECT * FROM sale_orders ORDER BY id DESC LIMIT $offset,$numRecs");
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
                <h3 class="card-title">Order Table</h3>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>User</th>
                      <th>Total_Price</th>
                      <th>Order_date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php
                  	$i =1;
                  	 foreach ($result as $value) { ?>
                  	 	<?php
                  	 		 $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ".$value['user_id']);
                  	 		 $stmt->execute();
                  	 		 $userResult = $stmt->fetchAll();

                  	 	?>
                  		<tr>
                  			<td><?php echo $i++; ?></td>
                  			<td><?php echo $userResult['0']['name']; ?></td>
                  			<td><?php echo escape($value['total_price']); ?></td>
                  			<td><?php echo escape(date("Y-m-d",strtotime($value['order_date']))); ?></td>
                  			<td><a href="order_detail.php" class="btn btn-warning">Detail</a></td>
                  		</tr>
                  	<?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            <!-- /.card -->

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