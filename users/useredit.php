<?php
  require 'userheader.php';
  require '../config/config.php';
 ?>
 <?php
  if($_POST){
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

    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email AND id != :id");
    $stmt->execute(
      array(
        ':email' => $email,
        ':id' =>$id
      )
    );
   $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $newstmt = $pdo->prepare("SELECT * FROM user phone = :phone");
    $newstmt->bindValue(':phone', $phone);
    $stmt->execute();
    $rephone = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user) {
      echo "<script> alert('Email is duplicated!'); </script>";

    }elseif($rephone){
      echo "<script> alert('Phone number is duplicated!'); </script>";
   }else{
     $stmt = $pdo->prepare("UPDATE user SET name='$name',email='$email',password='$password',address='$address',phone='$phone',role='$role' WHERE id = '$id'");
     $updateresult =$stmt->execute();
     if ($updateresult) {
       echo "<script> alert('User is updating now');window.location.href='index.php'; </script>";
     }
 }

  }else{
     $stmt = $pdo->prepare("SELECT * FROM user WHERE id =".$_GET['id']);
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
             <h3 class="card-title">Editing Users</h3>
             <a href="index.php" type="button" class="btn btn-warning float-right">Back</a>
           </div>
           <!-- /.card-header -->

           <div class="card-body">
             <form action="" method="POST">
               <input type="text" name="id" value="<?php echo $result[0]['id']; ?>">
               <div class="form-group">
                 <label for="name">Name</label>
                 <input type="text" name="name" id="name" value="<?php echo $result[0]['name']; ?>" class="form-control">
               </div>

               <div class="form-group">
                 <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $result[0]['email']; ?>" id="email" class="form-control">
               </div>

               <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" name="password" value="<?php echo $result[0]['password']; ?>" id="password" class="form-control">
               </div>

               <div class="form-group">
                 <label for="address">Address</label>
                 <textarea name="address" rows="8" cols="80" id="address" class="form-control">
                    <?php echo $result[0]['address']; ?>
                 </textarea>
               </div>

               <div class="form-group">
                 <label for="phone">Phone</label>
                 <input type="text" name="phone" value="<?php echo $result[0]['phone']; ?>" id="phone" class="form-control">
               </div>

               <div class="form-group">
                 <label for="role">Role</label><br>
                 <input type="checkbox" name="role" id="role" value="<?php echo $result[0]['role']; ?>" class="form-check-label">
               </div>

               <div class="form-group">
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

 <?php
  require 'userfooter.php';
  ?>
