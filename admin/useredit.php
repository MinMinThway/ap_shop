<?php
  require 'header.php';
  require 'config/config.php';
   
 ?>
 <?php
  if($_POST){
   
   if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || 
      empty($_POST['address']) || empty($_POST['phone']) || strlen($_POST['password']) < 4) {
     if (empty($_POST['name'])) {
          $nameError = "Name cannot be null";
        }
        if (empty($_POST['email'])) {
          $emailError = "Email cannot be null";
        }

        if (empty($_POST['password'])) {
          $passwordError = "Password cannot be null";
        }

        if (empty($_POST['address'])) {
          $addressError = "Address cannot be null";
        }

        if (empty($_POST['phone'])) {
          $phoneError = "Phone cannot be null";
        }
        if (strlen($_POST['password']) < 4) {
          $passwordError = "Password characters at least 5 characters";
        }
   }else{
     $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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
     if ($_POST['password']) {
      $stmt = $pdo->prepare("UPDATE user SET name='$name',email='$email',password='$password',address='$address',phone='$phone',role='$role' WHERE id = '$id'");
     }else{
      $stmt = $pdo->prepare("UPDATE user SET name='$name',email='$email',address='$address',phone='$phone',role='$role' WHERE id = '$id'");
     }
     $updateresult =$stmt->execute();
     if ($updateresult) {
       echo "<script> alert('User is updating now');window.location.href='userlist.php'; </script>";
     }
 }
   }

  }
  
     $stmt = $pdo->prepare("SELECT * FROM user WHERE id =".$_GET['id']);
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
             <h3 class="card-title">Editing Users</h3>
             <a href="userlist.php" type="button" class="btn btn-warning float-right">Back</a>
           </div>
           <!-- /.card-header -->

           <div class="card-body">
             <form action="" method="POST">
               <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
               <input type="hidden" name="id" value="<?php echo escape($result[0]['id']); ?>">
               <div class="form-group">
                 <label for="name">Name</label>
                <p class="text-danger"><?php echo empty($nameError)? '':'*'.$nameError; ?></p>

                 <input type="text" name="name" id="name" value="<?php echo escape($result[0]['name']); ?>" class="form-control">
               </div>

               <div class="form-group">
                 <label for="email">Email</label>
                 <p class="text-danger"><?php echo empty($emailError)? '':'*'.$emailError; ?></p>
                <input type="email" name="email" value="<?php echo escape($result[0]['email']); ?>" id="email" class="form-control">
               </div>

               <div class="form-group">
                 <label for="password">Password</label>
                 <p class="text-danger"><?php echo empty($passwordError)? '': '*'.$passwordError; ?></p>
                 <input type="password" name="password" value="<?php echo $result[0]['password']; ?>" id="password" class="form-control">
               </div>

               <div class="form-group">
                 <label for="address">Address</label>
                 <p class="text-danger"><?php echo empty($addressError)? '':'*'.$addressError; ?></p>
                 <textarea name="address" rows="8" cols="80" id="address" class="form-control">
                    <?php echo escape($result[0]['address']); ?>
                 </textarea>
               </div>

               <div class="form-group">
                 <label for="phone">Phone</label>
                 <p class="text-danger"><?php echo empty($phoneError)? '': '*'.$phoneError; ?></p>
                 <input type="text" name="phone" value="<?php echo escape($result[0]['phone']); ?>" id="phone" class="form-control">
               </div>

               <div class="form-group">
                 <label for="role">Role</label><br>
                 <input type="checkbox" name="role" id="role" value="<?php echo escape($result[0]['role']); ?>" class="form-check-label">
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
  require 'footer.php';
  ?>
