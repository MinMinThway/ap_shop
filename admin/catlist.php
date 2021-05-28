<?php

  if(!empty($_POST['search']))
  {
    setcookie('search',$_POST['search'], time() + (86400 * 30), "/"); 
  }
  else
  {
    if (empty($_GET['pageno'])) {
      unset($_COOKIE['search']); 
      setcookie('search', null, -1, '/'); 
    }
  }
  require 'header.php';
  require 'config/config.php';

   ?>

  <?php 

  if (!empty($_GET['pageno'])) {
    $pageno = $_GET['pageno'];

  }else {
    $pageno = 1;
  }
  $nunRecs =1;
  $offset = ($pageno - 1) * $nunRecs;
 if(empty($_POST['search']) && empty($_COOKIE['search'])){
   $stmt =$pdo->prepare("SELECT * FROM catagories ORDER BY id DESC");
  $stmt->execute();
  $Rawresult = $stmt->fetchAll();
  $total_pages = ceil(count($Rawresult)/ $nunRecs);

  $stmt =$pdo->prepare("SELECT * FROM catagories ORDER BY id DESC LIMIT $offset,$nunRecs");
  $stmt->execute();
  $result = $stmt->fetchAll();
}else{
  $searchKey=!empty ($_POST['search']) ? $_POST['search'] :$_COOKIE['search'];
  $stmt =$pdo->prepare("SELECT * FROM catagories WHERE name LIKE '%$searchKey%' ORDER BY id DESC");
  $stmt->execute();
  $Rawresult = $stmt->fetchAll();
  $total_pages = ceil(count($Rawresult)/ $nunRecs);

  $stmt =$pdo->prepare("SELECT * FROM catagories WHERE name LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$nunRecs");
  $stmt->execute();
  $result = $stmt->fetchAll();
}

?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
                <a href="catadd.php" type="button" class="btn btn-success float-right">New Category</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Created_at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php
                  		$i =1;
                  		foreach ($result as $value):
                  	?>
                  		<tr>
                  			<td><?php echo $i++; ?></td>
                  			<td><?php echo escape($value['name']); ?></td>
                  			<td><?=escape($value['description']); ?></td>
                  			<td><?=escape(date('Y-m-d', strtotime($value['created_at']))); ?></td>
                  			<td>
                  				<a href="catedit.php?id=<?=$value['id']; ?>" type="button" class="btn btn-secondary">Edit</a>
                  				<a href="catdel.php?id=<?=$value['id']; ?>" type="button" class="btn btn-danger">Delete</a>
                  			</td>
                  		</tr>


                 	<?php endforeach; ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="?pageno=1"> First </a></li>
                  <li class="page-item" <?php if($pageno <= 1) { echo "disabled"; } ?>>
                    <a class="page-link" href="<?php if($pageno <= 1) {echo "#"; } else { echo "?pageno=".($pageno-1); } ?>">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                  <li class="page-item" <?php if($pageno >= $total_pages) { echo "disabled"; } ?>>
                    <a class="page-link" href="<?php if($pageno >= $total_pages) { echo "#"; } else { echo "?pageno=".($pageno+1); } ?>">Next</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="<?php echo "?pageno=".$total_pages; ?>"> Last </a></li>
                </ul>
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
