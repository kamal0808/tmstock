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
            <small>View, Edit, Print or Delete Orders</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Orders</li>
            <li class="active">Add</li>
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
                              <form class="myform" action="viewrentalsto.php" method="GET">
                              <div class="col-md-4">
                                      <div class="form-group col-md-6">
                                        <label>Return Date From:</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                                          <input name="datefrom" type="text" class="focus form-control mandatory" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                        </div><!-- /.input group -->
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label>To</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                                          <input name="dateto" type="text" class="form-control mandatory" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                        </div><!-- /.input group -->
                                      </div>
                                          <div class="col-md-6">
                                              <button class="btn btn-block btn-primary submit"><i class="fa fa-search"></i> Search</button>
                                          </div>
                              </div>
                              </form>
                              <form class="myform" action="viewrentalsto.php" method="GET">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Customer Name</label>
                                          <select name="customerid" class="form-control mandatory">
                                            <option value="">Select</option>
                                            <?php
                                                $query="Select customerid,name, city from customers";
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
                              <form class="myform" action="viewrentalsto.php" method="GET">
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
                                            echo<<<_END
                                            <option value="$row[managerid]">$row[name]</option>
_END;
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
                                      <th>Rental Id</th>
                                      <th>Rental Date</th>
                                      <th>Customer Name</th>
                                      <th>Manager</th>
                                      <th>Rent from</th>
                                      <th>Rent upto</th>
                                      <th>View</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  if(isset($_GET['datefrom']))
                                  {
                                      $datefrom=ymdDate($_GET['datefrom']);
                                      $dateto=ymdDate($_GET['dateto']);
                              $query="Select rentalsto.*, customers.name as customername,customers.city as customercity,managers.name as managername from rentalsto join customers on rentalsto.customerid=customers.customerid join managers on rentalsto.managerid=managers.managerid order by rentalstoid desc where rentupto>='$datefrom' and rentupto<='$dateto'";
                                  }
                                  elseif(isset($_GET['customerid']))
                                  {
                                      $customerid=sanitizeString($_GET['customerid']);
                              $query="Select rentalsto.*, customers.name as customername,customers.city as customercity,managers.name as managername from rentalsto join customers on rentalsto.customerid=customers.customerid join managers on rentalsto.managerid=managers.managerid order by rentalstoid desc where rentalsto.customerid=$customerid";
                                  }
                                  elseif(isset($_GET['managerid']))
                                  {
                                      $managerid=$_GET['managerid'];
                              $query="Select rentalsto.*, customers.name as customername,customers.city as customercity,managers.name as managername from rentalsto join customers on rentalsto.customerid=customers.customerid join managers on rentalsto.managerid=managers.managerid order by rentalstoid desc where rentalsto.managerid=$managerid";
                                  }
                                  else
                                  {
                              $query="Select rentalsto.*, customers.name as customername,customers.city as customercity,managers.name as managername from rentalsto join customers on rentalsto.customerid=customers.customerid join managers on rentalsto.managerid=managers.managerid order by rentalstoid desc";
                                  }
                                  $result=queryMysql($query);
                                  $count=1;
                                  while($row=mysqli_fetch_array($result))
                                  {
                                      $id=id($row['rentalstoid']);
                                      $id="RT-".$id;
                                      $query1="Select name,city from customers where customerid=$row[customerid]";
                                      $result1=queryMysql($query1);
                                      $row1=mysqli_fetch_array($result1);
                                      $query2="Select name from managers where managerid=$row[managerid]";
                                      $result2=queryMysql($query2);
                                      $row2=mysqli_fetch_array($result2);
                                      $rentaldate=dmyDate($row['date']);
                                      $rentfrom=dmyDate($row['rentfrom']);
                                      $rentupto=dmyDate($row['rentupto']);
                                      echo<<<_END
                                  <tr>
                                      <td>$count</td>
                                      <td>$id</td>
                                      <td>$rentaldate</td>
                                      <td>$row1[name], $row1[city]</td>
                                      <td>$row2[name]</td>
                                      <td>$rentfrom</td>
                                      <td>$rentupto</td>
                                      <td><a href="rentalto.php?rentalstoid=$row[rentalstoid]&func=view">View</a></td>
                                      
                                  </tr>
_END;
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