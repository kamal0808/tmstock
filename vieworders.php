<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>

<body class="skin-blue sidebar-collapse">
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
            View Orders
            <small>View Orders</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Orders</li>
            <li class="active">View</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                      <div class="box-header">
                          <h3 class="box-title with-border">Filter By:</h3>
                      </div>
                      <div class="box-body">
                          <div class="row">
                              <form class="myform" action="vieworders.php" method="GET">
                                  <div class="col-md-4">
                                          <div class="form-group">
                                            <label>Event Date:</label>
                                            <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" name="date" class="form-control focus mandatory" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                            </div><!-- /.input group -->
                                          </div>
                                      <div class="col-md-6">
                                          <button class="btn btn-block btn-primary submit"><i class="fa fa-search"></i> Search</button>
                                      </div>
                                  </div>
                              </form>
                              <form class="myform" action="vieworders.php" method="GET">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Customer Name</label>
                                          <select name="customerid" class="form-control mandatory">
                                            <option value="">Select</option>
                                            <?php
                                                $query="Select customerid,name,city from customers";
                                                $result=  queryMysql($query);
                                                while($row=mysqli_fetch_array($result))
                                                {
                                                    echo "<option value='$row[customerid]'>$row[name], $row[city]</option>";
                                                }
                                                ?>
                                          </select>
                                      </div>
                                      <div class="col-md-6">
                                          <button class="btn btn-block btn-primary submit"><i class="fa fa-search"></i> Search</button>
                                      </div>
                                  </div>
                              </form>
                              <form class="myform" action="vieworders.php" method="GET">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Order Manager</label>
                                          <select name="managerid" class="form-control mandatory">
                                            <option value="">Select</option>
                                            <?php
                                                $query="Select managerid,name from managers";
                                                $result=  queryMysql($query);
                                                while($row=mysqli_fetch_array($result))
                                                {
                                                    echo "<option value='$row[managerid]'>$row[name]</option>";
                                                }
                                                ?>
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
                          
                          <table class="table table-bordered table-striped order-table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Order Id</th>
                                      <th>Order Date</th>
                                      <th>Customer Name</th>
                                      <th>Venue</th>
                                      <th>Manager</th>
                                      <th>Event from</th>
                                      <th>Event upto</th>
                                      <th>Event Type</th>
                                      <th>View</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  if(isset($_GET['date']))
                                  {
                                      $date=sanitizeString($_GET['date']);
                                      $date=ymdDate($date);
                                      $query="select orders.*,customers.name as customername,customers.city as customercity,managers.name as managername,godowns.name as godownname 
    from orders inner join customers on orders.customerid=customers.customerid inner join managers on orders.managerid=managers.managerid inner join godowns on orders.godownid=godowns.godownid order by orderid desc where orders.eventfrom<='$date' and orders.eventto>='$date' order by orderid desc";
                                  }
                                  elseif(isset($_GET['customerid']))
                                  {
                                      $customerid=sanitizeString($_GET['customerid']);
                                      $query="select orders.*,customers.name as customername,customers.city as customercity,managers.name as managername,godowns.name as godownname 
    from orders inner join customers on orders.customerid=customers.customerid inner join managers on orders.managerid=managers.managerid inner join godowns on orders.godownid=godowns.godownid order by orderid desc where orders.customerid=$customerid order by orderid desc";
                                  }
                                  elseif(isset($_GET['managerid']))
                                  {
                                      $managerid=sanitizeString($_GET['managerid']);
                                      $query="select orders.*,customers.name as customername,customers.city as customercity,managers.name as managername,godowns.name as godownname 
    from orders inner join customers on orders.customerid=customers.customerid inner join managers on orders.managerid=managers.managerid inner join godowns on orders.godownid=godowns.godownid order by orderid desc where orders.managerid=$managerid order by orderid desc";
                                  }
                                  else
                                  {
                                  $query="select orders.*,customers.name as customername,customers.city as customercity,managers.name as managername,godowns.name as godownname 
    from orders inner join customers on orders.customerid=customers.customerid inner join managers on orders.managerid=managers.managerid inner join godowns on orders.godownid=godowns.godownid order by orderid desc";
                                  }
                                  $result=queryMysql($query);
                                  $count=1;
                                  while($row=mysqli_fetch_array($result))
                                  {
                                      $id=id($row['orderid']);
                                      $id="OR-".$id;
                                      $orderdate=dmyDate($row['orderdate']);
                                      $eventfrom=dmyDate($row['eventfrom']);
                                      $eventto=dmyDate($row['eventto']);
                                      echo<<<_END
                                  <tr class="order-view-row">
                                      <td class="order-view-count">$count</td>
                                      <td>$id</td>
                                      <td>$orderdate</td>
                                      <td>$row[customername], $row[customercity]</td>
                                      <td>$row[godownname]</td>
                                      <td>$row[managername]</td>
                                      <td>$eventfrom</td>
                                      <td>$eventto</td>
                                      <td>$row[eventtype]</td>
                                      <td><a class="view" href="order.php?orderid=$row[orderid]&func=view">View</a> </td>
                                  </tr>
_END;
                                      $count++;
                                  }
                                  ?>
                                  
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

    
  </body>
  
</html>