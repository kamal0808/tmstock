<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
if(isset($_GET['supplierid']))
{
    $supplierid=sanitizeString($_GET['supplierid']);
    if($_GET['func']=="view")
    {
        $query="Select * from suppliers where supplierid=$supplierid";
        $result=  queryMysql($query);
        $row=mysqli_fetch_array($result);
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Suppliers
            <small>Enter Supplier details</small>
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
                                          <label>Supplier Name</label>
                                          <?php
                                          echo $row['name'];
                                          ?>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Supplier Address</label>
                                          <?php
                                          echo $row['address'];
                                          ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Supplier Contact</label>
                                          <?php
                                          echo $row['contact'];
                                          ?>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Supplier City</label>
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
                             <a href="supplier.php?supplierid=$supplierid&func=edit">
                                  <button class="btn btn-block btn-primary focus">
                                     Edit Supplier Details
                                  </button>
                             </a>
_END;
                              ?>
                      </div>
<!--                      <div class="col-md-2">
                              <?php
//                              echo<<<_END
//                         <a href="supplier.php?supplierid=$supplierid&func=delete">
//                                  <button class="btn btn-block btn-warning">
//                             Delete Supplier
//                                  </button>
//                         </a>
//_END;
                              ?>

                      </div>-->
                  </div>
              </div>
          </div>
          <h3>
            Previous Purchases
            <small>Previous Purchases from this supplier</small>
          </h3>
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                      <div class="box-body">
                          
                          <table class="table table-bpurchaseed table-striped purchase-table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Purchase Id</th>
                                      <th>Purchase Date</th>
                                      <th>Supplier Name</th>
                                      <th>Manager</th>
                                      <th>View</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                      $query="Select purchases.*,suppliers.name as suppliername,suppliers.city as suppliercity,managers.name as managername from purchases join suppliers on purchases.supplierid=suppliers.supplierid join managers on purchases.managerid=managers.managerid where purchases.supplierid=$supplierid order by purchaseid desc";
                                  $result=queryMysql($query);
                                  $count=1;
                                  while($row=mysqli_fetch_array($result))
                                  {
                                      $id=id($row['purchaseid']);
                                      $id="PU-".$id;
                                      $purchasedate=dmyDate($row['purchasedate']);
                                      echo<<<_END
                                  <tr>
                                      <td>$count</td>
                                      <td>$id</td>
                                      <td>$purchasedate</td>
                                      <td>$row[suppliername], $row[suppliercity]</td>
                                      <td>$row[managername]</td>
                                      <td><a href="purchase.php?purchaseid=$row[purchaseid]&func=view">View</a></td>
_END;
//                                      if($row['invoice']==0)
//                                      {
//                                          echo<<<_END
//                                          <td><a href="purchase.php?purchaseid=$row[purchaseid]&func=invoice">Add Rates</a></td>
//                                      </tr>
//_END;
//                                      }
//                                      else
//                                      {
//                                          echo<<<_END
//                                          <td><a href="purchase.php?purchaseid=$row[purchaseid]&func=invoice">View Rates</a></td>
//                                      </tr>
//_END;
//
//                                      }
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
            <small>Previous Rentals from this supplier</small>
          </h3>
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                      <div class="box-body">
                          
                          <table class="table table-bPurchaseed table-striped Purchase-table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Rental Id</th>
                                      <th>Entry Date</th>
                                      <th>Supplier Name</th>
                                      <th>Manager</th>
                                      <th>Rental from</th>
                                      <th>Rental upto</th>
                                      <th>View</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                                  <?php
                                  $query="Select rentalsfrom.*,suppliers.name as suppliername,suppliers.city as suppliercity,managers.name as managername from rentalsfrom join suppliers on rentalsfrom.supplierid=suppliers.supplierid join managers on rentalsfrom.managerid=managers.managerid where rentalsfrom.supplierid=$supplierid order by rentalsfromid desc";
                                  $result=queryMysql($query);
                                  $count=1;
                                  while($row=mysqli_fetch_array($result))
                                  {
                                      $id=id($row['rentalsfromid']);
                                      $id="RF-".$id;
                                      $rentaldate=dmyDate($row['date']);
                                      $rentfrom=dmyDate($row['rentfrom']);
                                      $rentupto=dmyDate($row['rentupto']);
                                      echo<<<_END
                                  <tr>
                                      <td>$count</td>
                                      <td>$id</td>
                                      <td>$rentaldate</td>
                                      <td>$row[suppliername], $row[suppliercity]</td>
                                      <td>$row[managername]</td>
                                      <td>$rentfrom</td>
                                      <td>$rentupto</td>
                                      <td><a href="rentalfrom.php?rentalsfromid=$row[rentalsfromid]&func=view">View</a></td>
                                      
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
        if(isset($_POST['supplierid']))
        {
            $supplierid=sanitizeString($_POST['supplierid']);
            $name=sanitizeString($_POST['name']);
            $address=sanitizeString($_POST['address']);
            $city=sanitizeString($_POST['city']);
            $contact=sanitizeString($_POST['contact']);
            $query="Update suppliers set name='$name', address='$address', city='$city', contact='$contact' where supplierid=$supplierid";
            queryMysql($query);
            echo<<<_END
            <script type="text/javascript">
                window.location.replace("supplier.php?supplierid=$supplierid&func=view");
            </script>
_END;
        }
        else
        {
        $query="Select * from suppliers where supplierid=$supplierid";
        $result=  queryMysql($query);
        $row=mysqli_fetch_array($result);
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Suppliers
            <small>Enter Supplier details</small>
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
                      <form class="myform" action="supplier.php?supplierid=$supplierid&func=edit" method="post">
_END;
                      ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      
                                      <div class="form-group has-success">
                                          <label>Supplier Name</label>
                      <?php
                      echo<<<_END
                                          <input type="text" name="name" value="$row[name]" class="form-control mandatory" placeholder="Supplier Name"/>
                                          <input type="hidden" name="supplierid" value="$row[supplierid]" class="form-control"/>
_END;
                      ?>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Supplier Address</label>
                      <?php
                      echo<<<_END
                                          <input type="text" name="address" value="$row[address]" class="form-control" placeholder="Supplier Address"/>
_END;
                      ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Supplier Contact</label>
                      <?php
                      echo<<<_END
                              <input type="text" name="contact" value="$row[contact]" class="form-control" placeholder="Supplier Contact"/>
_END;
                      ?>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group has-success">
                                          <label>Supplier City</label>
                                          <div class="form-group">
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
                                          <button class="focusable btn btn-block btn-primary submit">Save Supplier Details</button>
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
    
}
      include_once 'footer.php';
?>

    </div><!-- ./wrapper -->
    
  </body>
  
</html>