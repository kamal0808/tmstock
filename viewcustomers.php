<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View/Edit Customers
            <small>View and Edit Customer details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Items</li>
            <li class="active">View/Manage</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                      <div class="box-header">
                          <h3 class="box-title with-border">Filter By:</h3>
                      </div>
                      <div class="box-body">
                          <div class="row">
                              <form class="myform" action="viewcustomers.php" method="get">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>City</label>
                                          <select name="city" class="form-control focus mandatory">
                                            <option value="">Select</option>
                                            <option>Bhopal</option>
                                            <option>Gwalior</option>
                                            <option>Indore</option>
                                          </select>
                                      </div>
                                      <div class="col-md-6">
                                          <button class="btn btn-block btn-primary submit"><i class="fa fa-search"></i> Search</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                 <div class="box box-primary">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>City</th>
                        <th>View Details</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_GET['city']))
                        {
                            $city=sanitizeString($_GET['city']);
                            $query="Select * from customers where city='$city'";
                        }
                        else
                        {
                            $query="Select * from customers";
                        }
                        $result=  queryMysql($query);
                        while($row=  mysqli_fetch_array($result))
                        {
                            echo<<<_END
                            <tr>
                                <td>$row[customerid]</td>
                                <td>$row[name]</td>
                                <td>$row[city]</td>
                                <td><a href="customer.php?customerid=$row[customerid]&func=view">View Details</a></td>
                            </tr>
_END;
                        }
                        ?>
                        
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
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