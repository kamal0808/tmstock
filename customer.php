<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
if(isset($_GET['customerid']))
{
    $customerid=sanitizeString($_GET['customerid']);
    if($_GET['func']=="view")
    {
        $query="Select * from customers where customerid=$customerid";
        $result=  queryMysql($query);
        $row=mysqli_fetch_array($result);
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Customers
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
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer Name</label>
                                          <?php
                                          echo $row['name'];
                                          ?>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Customer Address</label>
                                          <?php
                                          echo $row['address'];
                                          ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer Contact</label>
                                          <?php
                                          echo $row['contact'];
                                          ?>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer City</label>
                                          <?php
                                          echo $row['city'];
                                          ?>
                                    </div>
                                  </div>
                              </div>
                          </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="box-body">
                  <div class="box-body">
                      <div class="col-md-2">
                              <?php
                              echo<<<_END
                             <a href="customer.php?customerid=$customerid&func=edit">
                                  <button class="focusable btn btn-block btn-primary focus">
                                     Edit Customer Details
                                  </button>
                             </a>
_END;
                              ?>
                      </div>
<!--                      <div class="col-md-2">
                              <?php
//                              echo<<<_END
//                         <a href="customer.php?customerid=$customerid&func=delete">
//                                  <button class="focusable delete btn btn-block btn-danger">
//                             Delete Customer
//                                  </button>
//                         </a>
//_END;
                              ?>

                      </div>-->
                  </div>
              </div>
          </div>
          <h3>
            Previous Orders
            <small>Previous Orders from this customer</small>
          </h3>
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
                                      $query="select orders.*,customers.name as customername,customers.city as customercity,managers.name as managername,godowns.name as godownname from orders inner join customers on orders.customerid=customers.customerid inner join managers on orders.managerid=managers.managerid inner join godowns on orders.godownid=godowns.godownid where orders.customerid=$customerid order by orderid desc";
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
                                  <tr>
                                      <td>$count</td>
                                      <td>$id</td>
                                      <td>$orderdate</td>
                                      <td>$row[customername], $row[customercity]</td>
                                      <td>$row[godownname]</td>
                                      <td>$row[managername]</td>
                                      <td>$eventfrom</td>
                                      <td>$eventto</td>
                                      <td>$row[eventtype]</td>
                                      <td><a href="order.php?orderid=$row[orderid]&func=view">View</a></td>
_END;
                                      
                                  }
                                  ?>
                                  
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <h3>
              Previous Rentals
          <small>Previous rental orders from this customer</small>
          </h3>
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
                              $query="Select rentalsto.*, customers.name as customername,customers.city as customercity,managers.name as managername from rentalsto join customers on rentalsto.customerid=customers.customerid join managers on rentalsto.managerid=managers.managerid where rentalsto.customerid=$customerid order by rentalstoid desc";
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
<?php
    }
    elseif($_GET['func']=="edit")
    {
        if(isset($_POST['customerid']))
        {
            $customerid=sanitizeString($_POST['customerid']);
            $name=sanitizeString($_POST['name']);
            $address=sanitizeString($_POST['address']);
            $city=sanitizeString($_POST['city']);
            $contact=sanitizeString($_POST['contact']);
            $query="Update customers set name='$name', address='$address', city='$city', contact='$contact' where customerid=$customerid";
            queryMysql($query);
            echo<<<_END
            <script type="text/javascript">
                window.location.replace("customer.php?customerid=$customerid&func=view");
            </script>
_END;
        }
        else
        {
        $query="Select * from customers where customerid=$customerid";
        $result=  queryMysql($query);
        $row=mysqli_fetch_array($result);
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Customers
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
                      <?php
                      echo<<<_END
                      <form class="myform" action="customer.php?customerid=$customerid&func=edit" method="post">
_END;
                      ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      
                                      <div class="form-group has-success">
                                          <label>Customer Name</label>
                      <?php
                      echo<<<_END
                                          <input type="text" name="name" value="$row[name]" class="form-control mandatory" placeholder="Customer Name"/>
                                          <input type="hidden" name="customerid" value="$row[customerid]" class="form-control"/>
_END;
                      ?>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Customer Address</label>
                      <?php
                      echo<<<_END
                                          <input type="text" name="address" value="$row[address]" class="form-control" placeholder="Customer Address"/>
_END;
                      ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer Contact</label>
                      <?php
                      echo<<<_END
                              <input type="text" name="contact" value="$row[contact]" class="form-control" placeholder="Customer Contact"/>
_END;
                      ?>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Customer City</label>
                                          <div class="form-group has-success">
                                              <select name="city" class="form-control mandatory">
                                                <?php
                                                echo "<option value=\"$row[city]\">$row[city]</option>";
                                                ?>  
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
                                          <button class="focusable btn btn-block btn-primary submit">Save Customer Details</button>
                                      </div>
                                      <div class="col-md-2">
                                          <button class="focusable btn btn-block btn-warning cancel">Cancel</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      <?php
                      echo "</form>";
                      ?>
                  </div>
              </div>
          </div>
        </section><!-- /.content -->
      </div>
<?php
        }
    }
//    elseif($_GET['func']=="delete")
//    {
//        $query="Delete from customers where customerid=$customerid";
//        queryMysql($query);
//        echo<<<_END
//        <script type="text/javascript">
//            window.location.replace("viewcustomers.php");
//        </script>
//_END;
//    }
}
      include_once 'footer.php';
?>

    </div><!-- ./wrapper -->
   
  </body>
  
</html>