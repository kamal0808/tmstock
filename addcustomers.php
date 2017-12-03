<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
$columns="";
$values="";
if(isset($_POST['name']))
{
      query('customers');
}

?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Customers
            <small>Enter Customer details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Items</li>
            <li class="active">Add</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                      <form class="myform" action="addcustomers.php" method="post">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer Name</label>
                                          <input type="text" name="name" class="form-control focus mandatory" placeholder="Customer Name"/>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Customer Address</label>
                                          <input type="text" name="address" class="form-control" placeholder="Customer Address"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer Contact</label>
                                          <input type="text" name="contact" class="form-control" placeholder="Customer Contact"/>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer City</label>
                                          <div class="form-group">
                                              <select name="city" class="form-control mandatory">
                                                <option value="">Select</option>
                                                <option>Bhopal</option>
                                                <option>Gwalior</option>
                                                <option>Indore</option>
                                              </select>
                                          </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="box-body">
                                      <div class="col-md-2">
                                          <button class="btn btn-block btn-primary submit">Save Customer</button>
                                      </div>
                                      <div class="col-md-2">
                                          <button class="btn btn-block btn-warning cancel">Cancel</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          TMStock - The Makers Stock
        </div>
        <!-- Default to the left --> 
        <strong>Copyright &copy; 2015 <a href="http://themakersweb.com">The Makers Web</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->
    
  </body>
  
</html>