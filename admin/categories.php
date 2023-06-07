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
<div class="col-xs-6">
    <?php 
        insertCategory();
    ?>
    <!-- form for creating  category -->
    <form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Add Category</label>
            <input type="text" name="cat_title" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
        </div>
    </form>
    
<?php 

updateCategories();

?>
</div> 
<div class="col-xs-6">

    <table class="table table-bordered table-hover" >
        <thead>
            <tr>
                <th>Id</th>
                <th>Category Title</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
              findAllCategories();
              ?>
                <?php
                // delete operation
                deleteCategories();
                ?>
            </tr>
        </tbody>
    </table>

</div>   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "./includes/adminfooter.php"?>