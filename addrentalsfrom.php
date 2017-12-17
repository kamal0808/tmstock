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
if(isset($_POST['date']))
{
    $_POST['date']=ymdDate($_POST['date']);
    $_POST['rentfrom']=ymdDate($_POST['rentfrom']);
    $_POST['rentupto']=ymdDate($_POST['rentupto']);
    query('rentalsfrom');
    $query="Select rentalsfromid from rentalsfrom order by rentalsfromid desc limit 1";
    $result=queryMysql($query);
    $row=mysqli_fetch_array($result);
    $rentalsfromid=$row['rentalsfromid'];
    $index=0;
    foreach($_POST['itemid'] as $itemid)
    {
        $quantity=$_POST['quantity'][$index];
        $itemid=$_POST['itemid'][$index++];
        $query="Insert into rentalsfromitems(quantity,itemid,rentalsfromid) values($quantity,$itemid,$rentalsfromid)";
        $result=queryMysql($query);
        $query="Update items set quantity=quantity+$quantity where itemid=$itemid";
        $result=queryMysql($query);
    }
}
?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Rentals from
            <small>Enter rental details</small>
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
                      <form class="myform" action="addrentalsfrom.php" method="post">
                          <div class="box-body">
                          <div class="row">
                              
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Rental Id</label>
                                      <?php
                                      $query="Select rentalsfromid from rentalsfrom order by rentalsfromid desc limit 1";
                                      $result=  queryMysql($query);
                                      $row=mysqli_fetch_array($result);
                                      $rentalsfromid=id($row['rentalsfromid']+1);
                                      $rentalsfromid="RF-".$rentalsfromid;
                                      echo <<<_END
                                      <input type="text" value="$rentalsfromid" class="form-control" placeholder="Item Id"/>
_END;
                                      ?>
                                  </div>
                              </div>
                              <div class="col-md-3 col-md-offset-6">
                                  <div class="form-group">
                                <label>Date:</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                    <?php
                                   $date=dmyDate(date("Y-m-d"));
                                   echo<<<_END
                                  <input tabindex="0" type="text" name="date"  value="$date" class="form-control mandatory focus" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
_END;
                                   ?>
                                </div><!-- /.input group -->
                              </div>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Supplier Name</label>
                                          <select class="form-control mandatory" name="supplierid">
                                            <option value="">Select</option>
                                            <?php
                                            $query="Select supplierid,name,city from suppliers";
                                            $result=  queryMysql($query);
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                echo "<option value='$row[supplierid]'>$row[name], $row[city]</option>";
                                            }
                                            ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Supply Manager</label>
                                          <select class="form-control mandatory" id="order-manager" name="managerid">
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
                                  </div>
                                  
                                  
                              </div>
                              <div class="row">
                                  <div class="col-md-5">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Rent from:</label>
                                            <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" name="rentfrom" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                            </div><!-- /.input group -->
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Rent upto:</label>
                                            <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" name="rentupto" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                            </div><!-- /.input group -->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="box-header with-border">
                                      <h3 class="box-title">Item Details</h3>
                                  </div>
                                  <div class="box-body">
                                      <div class="col-md-12">
                                          <table class="table table-bordered table-striped order-table">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th class="col-md-2">Item Name</th>
                      <th class="col-md-2">Item Type</th>
                      <th class="col-md-3">Item Description</th>
                      <th class="col-md-3">Godown/Venue</th>
                      <th class="col-md-1">Item ID</th>
                      <th class="col-md-1">Quantity</th>
                      <th class="visible-sm-block">Delete</th>
                    </tr>
                    <tr class="order-row">
                      <td class="orderid">1</td>
                      <td>
                          <div class="form-group">
                              <select class="form-control mandatory item item-name">
                                <option value="">Select</option>
                                <?php
                                $query="Select distinct name from items order by name";
                                $result=  queryMysql($query);
                                while($row=mysqli_fetch_array($result))
                                {
                                    echo "<option value='$row[name]'>$row[name]</option>";
                                }
                                ?>
                              </select>
                            </div>
                      </td>
                      <td>
                          <div class="form-group">
                              <select class="form-control mandatory item-type">
                              </select>
                            </div>
                      </td>
                      <td>
                          <div class="form-group">
                              <select class="form-control mandatory item-description">
                              </select>
                            </div>
                      </td>
                      <td>
                          <div class="form-group">
                              <select name="itemid[]" class="form-control mandatory item-godown">
                              </select>
                            </div>
                      </td>

                      <td>
                          <input type="text" class="form-control itemid mandatory" placeholder="Item ID"/>
                          <input type="hidden" class="item-id" />
                      </td>
                      <td class="order-quantity">
                          <div class="form-group">
                              <input type="number" name="quantity[]" min="1" class="form-control mandatory new-order-row item-quantity"/>
                          </div>
                      </td>
                    <td class="visible-sm-block">
                          <a class="delete-row" href="javascript:void(0)">Delete</a>
                  </td>
                    </tr>
                    
                   
                    
                  </table>
<!--                                          <a href="#">
                    <span class="glyphicon glyphicon-plus"></span>
                    Add More Items</a>-->
                                      </div>
                                      </div>
                              </div>
                              <div class="row">
                                  <div class="box-body">
                                      <div class="col-md-2">
                                          <button class="btn btn-block btn-primary submit">Save</button>
                                      </div>
                                      <div class="col-md-2">
                                          <button class="btn btn-block btn-warning cancel">Cancel</button>
                                      </div>
                                  </div>
                              </div>
                              <div id="myModal" class="modal fade" role="dialog" tabindex="-1">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Image</h4>
                                      </div>
                                      <div class="modal-body">

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                            </div>
                          </div>
                          <?php
                          $business=$_SESSION['business'];
                              echo<<<_END
                              <input type="hidden" name="business" value="$business"/>
_END;
                              ?>
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