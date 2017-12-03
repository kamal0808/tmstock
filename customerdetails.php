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
            Customer Details
            <small>Address and Previous Orders</small>
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
                      <form action="" method="post">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer Name : </label>
                                          The Makers Web
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Customer Address : </label>
                                          149-2A, Saket Nagar
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer Contact : </label>
                                          +918962125228
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer City : </label>
                                          Bhopal
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                      <div class="box-header with-border">
                          <h3 class="box-title">
                              Previous Orders
                          </h3>
                      </div>
                      <div class="box-body">
                          
                          <table class="table table-bordered table-striped order-table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Order Id</th>
                                      <th>Order Date</th>
                                      <th>Venue</th>
                                      <th>Manager</th>
                                      <th>Event Date</th>
                                      <th>Event Type</th>
                                      <th>View | Edit</th>
                                      <th>Make Invoice</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                                  <tr>
                                      <td>1</td>
                                      <td>EV-102</td>
                                      <td>23/12/2015</td>
                                      <td>Nakshatra Garden</td>
                                      <td>Ram Sahu</td>
                                      <td>23/12/2015</td>
                                      <td>Office Inauguration</td>
                                      <td><a href="">View</a> | <a href="">Edit</a></td>
                                      <td><a href="">Make Invoice</a></td>
                                  </tr>
                                  <tr>
                                      <td>1</td>
                                      <td>EV-102</td>
                                      <td>23/12/2015</td>
                                      <td>Nakshatra Garden</td>
                                      <td>Ram Sahu</td>
                                      <td>23/12/2015</td>
                                      <td>Office Inauguration</td>
                                      <td><a href="">View</a> | <a href="">Edit</a></td>
                                      <td><a href="">Make Invoice</a></td>
                                  </tr>
                                  <tr>
                                      <td>1</td>
                                      <td>EV-102</td>
                                      <td>23/12/2015</td>
                                      <td>Nakshatra Garden</td>
                                      <td>Ram Sahu</td>
                                      <td>23/12/2015</td>
                                      <td>Office Inauguration</td>
                                      <td><a href="">View</a> | <a href="">Edit</a></td>
                                      <td><a href="">Make Invoice</a></td>
                                  </tr>
                                  <tr>
                                      <td>1</td>
                                      <td>EV-102</td>
                                      <td>23/12/2015</td>
                                      <td>Nakshatra Garden</td>
                                      <td>Ram Sahu</td>
                                      <td>23/12/2015</td>
                                      <td>Office Inauguration</td>
                                      <td><a href="">View</a> | <a href="">Edit</a></td>
                                      <td><a href="">Make Invoice</a></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
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
    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      });
        </script>
  </body>
  
</html>