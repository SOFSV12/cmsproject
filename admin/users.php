<?php include "./includes/adminheader.php"?>


    <div id="wrapper">

        <!-- Navigation -->

        <?php include "./includes/adminnavigation.php"?>
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">
Welcome, Admin
<small>Subheading</small>
</h1>

<?php 
if(isset($_GET['source'])){
$source = $_GET['source'];
}else{
    $source = '';  
}

switch($source){
    case 'add_user':
        include "./includes/adduser.php";
    break;

    case 'edit_user':
        include "./includes/edituser.php";
    break;

    case '3':
    echo 'nice';
    break;

    default:
     include "./includes/viewallusers.php";
     break;
} 


?>
 </div>
  </div>
  <!-- /.row -->

 </div>
 <!-- /.container-fluid -->

 </div>
            <!-- /#page-wrapper -->

        <?php include "./includes/adminfooter.php"?>