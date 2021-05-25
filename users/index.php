<?php
  require 'userheader.php';
  require '../config/config.php';

  $stmt = $pdo->prepare("SELECT * FROM user ORDER BY id DESC");
  $stmt->execute();
  $userlist =$stmt->fetchAll();
 ?>

 <!-- Main content -->
 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-md-12">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">Users Table</h3>
             <a href="useradd.php" type="button" class="btn btn-success float-right">New Users</a>
           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <table class="table table-bordered">
               <thead>
                 <tr>
                   <th style="width: 10px">#</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Address</th>
                   <th>Role</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $i = 1;
                  foreach ($userlist as $value) {
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?=$value['address']; ?></td>
                    <td><?=$value['role']==1? "Admin" :  "Normal User"; ?></td>
                    <td>
                      <a href="useredit.php?id=<?php echo $value['id']; ?>" type="button" class="btn btn-warning">Edit</a>
                      <a href="userdel.php?id=<?php echo $value['id']; ?>" type="button" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>

                  <?php }?>
               </tbody>
             </table>
           </div>
           <!-- /.card-body -->
           <div class="card-footer clearfix">
             <ul class="pagination pagination-sm m-0 float-right">
               <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
               <li class="page-item"><a class="page-link" href="#">1</a></li>
               <li class="page-item"><a class="page-link" href="#">2</a></li>
               <li class="page-item"><a class="page-link" href="#">3</a></li>
               <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
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

</div>
<!-- /.content-wrapper -->


 <?php
  require 'userfooter.php';
  ?>
