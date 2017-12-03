<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue">
    <div class="wrapper">
      <!-- Main Header -->
<?php
include_once 'navigation.php';
include_once 'sidebar.php';
?>
      
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Home
            <small>Admin Panel Home</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
<!--            <li class="active">Here</li>-->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
<!--          <div class="row">
              <div class="col-md-12">
                  <div class="box">
                      <div class="box-header with-border">
                          <h3> Welcome to TMStock!</h3>
                          <p>You are logged in as <a href="#">Shrey Khandelwal</a>.</p>
                          <p>Your last login was on 18th April, 2015 at 4:42 PM.</p>
                          <p>Have a nice day at work! :)</p>
                      </div>
                  </div>
              </div>
          </div>-->
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">ORDERS</h3>
                    </div>
                    <div class="box-body">
                      <p><a tabindex="0" class="focus focusable" href="addorders.php">Add</a></p>
                      <p><a tabindex="0" class="focusable" href="vieworders.php">View/Edit</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">RENTAL ORDERS</h3>
                    </div>
                    <div class="box-body">
                      <p><a tabindex="0" class="focusable" href="addrentalsto.php">Add</a></p>
                      <p><a tabindex="0" class="focusable" href="viewrentalsto.php">View/Edit</a></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">CUSTOMERS</h3>
                    </div>
                    <div class="box-body">
                      <p><a href="addcustomers.php">Add</a></p>
                      <p><a href="viewcustomers.php">View/Edit</a></p>
                    </div>
                </div>
            </div>
              
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">PURCHASES</h3>
                    </div>
                    <div class="box-body">
                      <p><a href="addpurchase.php">Add</a></p>
                      <p><a href="viewpurchase.php">View/Edit</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">RENTAL PURCHASES</h3>
                    </div>
                    <div class="box-body">
                      <p><a href="addrentalsfrom.php">Add</a></p>
                      <p><a href="viewrentalsfrom.php">View/Edit</a></p>
                    </div>
                </div>
            </div>
              
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">SUPPLIERS</h3>
                    </div>
                    <div class="box-body">
                      <p><a href="addsuppliers.php">Add</a></p>
                      <p><a href="viewsuppliers.php">View/Edit</a></p>
                    </div>
                </div>
            </div>
              
          </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">ITEMS/STOCK</h3>
                        </div>
                        <div class="box-body">
                          <p><a href="additems.php">Add</a></p>
                          <p><a href="viewitems.php">View/Edit</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">GODOWNS/VENUES</h3>
                        </div>
                        <div class="box-body">
                          <p><a href="godowns.php">Godowns/Venues</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">MANAGERS</h3>
                        </div>
                        <div class="box-body">
                          <p><a href="managers.php">Managers</a></p>
                        </div>
                    </div>
                </div>
                
            </div>
          
          
<!--          <div class="row">
              <div class="col-md-12">
                  <div class="info-box">
                      <div class="box-header with-border">
                          <h3>Shortcut Keys</h3>
                          <div class="col-md-6">
                              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Bordered Table</h3>
                </div> /.box-header 
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Shortcut Keys</th>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Add Orders</td>
                      <td>Ctrl + O</td>
                      
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Add Items</td>
                      <td>Ctrl + I</td>
                      
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Add Customers</td>
                      <td>Ctrl + C</td>
                      
                    </tr>
                    
                  </table>
                </div> /.box-body 
                
              </div> /.box 
                          </div>
                      </div>
                  </div>
              </div>
          </div>-->

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

    <!-- REQUIRED JS SCRIPTS -->
    
    <!-- jQuery 2.1.3 -->
    
    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
  </body>
</html>