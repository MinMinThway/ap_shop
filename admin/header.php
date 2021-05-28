<?php
  session_start();
   require 'config/common.php';
  if (empty( $_SESSION['user_id']) && empty($_SESSION['logged_in'])):
    header("location:login.php");
  endif;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Simple Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <?php
      $link = $_SERVER['PHP_SELF'];
      $link_array=explode('/', $link);
      $page = end($link_array);

    ?>
    <?php if ($page == 'index.php' || $page == 'catlist.php' || $page == 'userlist.php') { ?>
      <?php if($page != 'order_list.php') { ?>
         <form class="form-inline ml-3" method="POST" action="
          <?php 
            if($page==='index.php'):
              echo 'index.php';
            elseif($page==='catlist.php'):
              echo 'catlist.php';
            elseif($page==='userlist.php'):
              echo 'userlist.php';
            else:
              #
            endif; 

          ?>">
          <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
     </form>
      <?php } ?>
   <?php } ?>

     
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu bg-light dropdown-menu-right ">

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users "></i>
              <a href="logout.php">logout</a>
          </a>
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item ">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Products
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="catlist.php" class="nav-link">
                <i class="nav-icon fas fa-list-ol"></i>
                <p>
                  Categories
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="userlist.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="order_list.php" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Order_List
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Tables</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
