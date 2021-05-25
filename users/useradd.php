<?php
  require 'userheader.php';
  require '../config/config.php';
 ?>
 <?php
  if ($_POST) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    if(empty($_POST['role'])):
      $role = 1;
    else:
      $role = 0;
    endif;

    $stmt =$pdo->prepare("SELECT * FROM user WHERE email =:email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $newstmt = $pdo->prepare("SELECT * FROM user WHERE phone = :phone");
    $newstmt->bindValue(':phone', $phone);
    $newstmt->execute();
    $phone = $newstmt->fetch(PDO::FETCH_ASSOC);
    if ($user):
      echo "<script> alert('Email is duplicated !');  </script>";
    elseif($phone):
      echo "<script> alert('Phone number is duplicated !');  </script>";
    else:
      $stmt = $pdo->prepare("INSERT INTO user(name, email, password, address, phone, role)
              VALUES(:name, :email, :password, :address, :phone, :role)");
      $result = $stmt->execute(
        array(
          ':name' => $name, ':email' => $email, ':password' => $password, ':address' => $address, ':phone' => $phone,':role' => $role
        )
      );

      if ($result) {
        echo "<script> alert('New user is adding now');window.location.href='index.php'; </script>";
      }
    endif;

  }

  ?>
 <!-- Main content -->
 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-md-12">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">Creating Users</h3>
             <a href="index.php" type="button" class="btn btn-warning float-right">Back</a>
           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <form action="useradd.php" method="POST">
               <div class="form-group">
                 <label for="name">Name</label>
                 <input type="text" name="name" id="name" class="form-control">
               </div>

               <div class="form-group">
                 <label for="email">Email</label>
                <input type="email" name="email" value="" id="email" class="form-control">
               </div>

               <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" name="password" value="" id="password" class="form-control">
               </div>

               <div class="form-group">
                 <label for="address">Address</label>
                 <textarea name="address" rows="8" cols="80" id="address" class="form-control"></textarea>
               </div>

               <div class="form-group">
                 <label for="phone">Phone</label>
                 <input type="text" name="phone" value="" id="phone" class="form-control">
               </div>

               <div class="form-group">
                 <label for="role">Role</label><br>
                 <input type="checkbox" name="role" id="role" value="1" class="form-check-label">
               </div>

               <div class="form-group">
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

 <?php
  require 'userfooter.php';
  ?>
