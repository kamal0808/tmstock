<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
if(isset($_GET['godownid']))
{
    $godownid=sanitizeString($_GET['godownid']);
    if($_GET['func']=="view")
    {
        $query="Select godowns.*,managers.name as managername from godowns join managers on godowns.managerid=managers.managerid where godownid=$godownid";
        $result=  queryMysql($query);
        $row=mysqli_fetch_array($result);
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Stock
            <small>View stock-in-hand</small>
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
                                  <div class="col-md-3 col-xs-3">
                                      <div class="form-group">
                                          <label>Godown Name</label>
                                          <?php
                                          echo $row['name'];
                                          ?>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4 col-xs-3">
                                      <div class="form-group">
                                          <label>Godown Address</label>
                                          <?php
                                          echo $row['address'];
                                          ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3 col-xs-3">
                                      <div class="form-group">
                                          <label>Godown Manager</label>
                                          <?php
                                          echo $row['managername'];
                                          ?>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-xs-3">
                                      <div class="form-group">
                                          <label>Godown City</label>
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
          <div class="row no-print">
              <div class="box-body">
                  <div class="box-body">
                      <div class="col-md-2">
                              <?php
                              echo<<<_END
                             <a href="godown.php?godownid=$godownid&func=edit">
                                  <button class="focusable btn btn-block btn-primary focus">
                                     Edit Godown Details
                                  </button>
                             </a>
_END;
                              ?>
                      </div>
                      <div class="col-md-2">
                              <?php
                              echo<<<_END
                                  <button class="focusable btn btn-block btn-success" onclick="window.print()">
                                     Print
                                  </button>
_END;
                              ?>
                      </div>
<!--                      <div class="col-md-2">
                              <?php
//                              echo<<<_END
//                         <a href="Godown.php?godownid=$godownid&func=delete">
//                                  <button class="focusable delete btn btn-block btn-warning">
//                             Delete Godown
//                                  </button>
//                         </a>
//_END;
                              ?>

                      </div>-->
                  </div>
              </div>
          </div>
          <h3>
            Godown Stock
            <small>Stock-in-Hand</small>
          </h3>
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                      <div class="box-body">
                          
                          <table id="example1" class="table table-bordered table-striped order-table">
                              <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Item Type</th>
                                    <th>Item Description</th>
                                    <th>Godown/Venue</th>
                                    <th>Business</th>
                                    <th>Stock In Hand</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
//                                      $godownid=sanitizeString($_POST['godownid']);
                            $query="Select items.*, godowns.name as godownname from items join godowns on items.godownid=godowns.godownid where items.godownid=$godownid";
                            $result=queryMysql($query);
                            $count=1;
                                  while($row=mysqli_fetch_array($result))
                                  {
                                      $id=id($row['itemid']);
                                      $id="IT-".$id;
                                      echo<<<_END
                                  <tr>
                                      <td>$count</td>
                                      <td>$id</td>
                                      <td>$row[name]</td>
                                    <td>$row[itemtype]</td>
                                    <td>$row[description]</td>
                                    <td>$row[godownname]</td>
                                    <td>$row[business]</td>
                                    <td>$row[quantity]</td>
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
<?php
    }
    elseif($_GET['func']=="edit")
    {
        if(isset($_POST['godownid']))
        {
            $godownid=sanitizeString($_POST['godownid']);
            $name=sanitizeString($_POST['name']);
            $address=sanitizeString($_POST['address']);
            $city=sanitizeString($_POST['city']);
            $managerid=sanitizeString($_POST['managerid']);
            $query="Update godowns set name='$name', address='$address', city='$city', managerid='$managerid' where godownid=$godownid";
            queryMysql($query);
            echo<<<_END
            <script type="text/javascript">
                window.location.replace("Godown.php?godownid=$godownid&func=view");
            </script>
_END;
        }
        else
        {
        $query="Select * from godowns where godownid=$godownid";
        $result=  queryMysql($query);
        $row=mysqli_fetch_array($result);
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit godowns
            <small>Enter Godown details</small>
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
                      <form class="myform" action="Godown.php?godownid=$godownid&func=edit" method="post">
_END;
                      ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      
                                      <div class="form-group has-success">
                                          <label>Godown Name</label>
                      <?php
                      echo<<<_END
                                          <input type="text" name="name" value="$row[name]" class="form-control focus mandatory" placeholder="Godown Name"/>
                                          <input type="hidden" name="godownid" value="$row[godownid]" class="form-control"/>
_END;
                      ?>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Godown Address</label>
                      <?php
                      echo<<<_END
                                          <input type="text" name="address" value="$row[address]" class="form-control" placeholder="Godown Address"/>
_END;
                      ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group has-success">
                                          <label>Godown Manager</label>
                              <select class="form-control mandatory" name="managerid" id="order-manager">
                                            <option value="">Select</option>
                      <?php
                                            $query1="Select managerid,name from managers";
                                            $result1=  queryMysql($query1);
                                            while($row1=mysqli_fetch_array($result1))
                                            {
                                                if($row1['managerid']==$row['managerid'])
                                                    echo "<option value='$row1[managerid]' selected='selected'>$row1[name]</option>";
                                                else
                                                    echo "<option value='$row1[managerid]'>$row1[name]</option>";
                                            }
                      ?>
                                      </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group has-success">
                                      <label>Godown City</label>
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
                              <div class="row">
                                  <div class="box-body">
                                      <div class="col-md-2">
                                          <button class="focusable btn btn-block btn-primary submit">Save Godown Details</button>
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