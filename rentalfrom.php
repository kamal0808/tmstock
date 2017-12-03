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
if(isset($_GET['rentalsfromid']))
{
    
    if($_GET['func']=="view")
    {
    $rentalsfromid=sanitizeString($_GET['rentalsfromid']);
        $query="select rentalsfrom.*,suppliers.name as suppliername,suppliers.city as suppliercity,managers.name as managername from rentalsfrom inner join suppliers on rentalsfrom.supplierid=suppliers.supplierid inner join managers on rentalsfrom.managerid=managers.managerid where rentalsfromid=$rentalsfromid";
$result=  queryMysql($query);
$row=  mysqli_fetch_array($result);
?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Rentals Given
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
              <div class="col-md-10 col-md-offset-1">
                  <div class="box box-primary">
                      <div class="box-body">
                          <div class="row">
                              <div class="col-md-3">
                                  <label>Rental Id</label>
                                  <?php
                                  $rentalsfromid1=id($rentalsfromid);
                                  $rentalsfromid1="RT-".$rentalsfromid1;
                                  echo "<p>$rentalsfromid1</p>";
                                  ?>
                              </div>
                              <div class="col-md-3 col-md-offset-1">
                                <label>Date</label>
                                  <?php
                                    $date=  dmyDate($row['date']);
                                    echo "<p>$date</p>";
                                  ?>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <label>Supplier Name</label>
                                      <?php 
                                      echo "<p>$row[suppliername], $row[suppliercity]</p>";
                                      ?>
                                  </div>
                                  <div class="col-md-3">
                                      <label>Supply Manager</label>
                                      <?php 
                                      echo "<p>$row[managername]</p>";
                                      ?>
                                      
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                        <label>Rent from:</label>
                                         <?php
                                         $rentfrom=dmyDate($row['rentfrom']);
                                      echo "<p>$rentfrom</p>";
                                      ?> 
                                  </div>
                                  <div class="col-md-4">
                                        <label>Rent to:</label>
                                          <?php
                                          $rentto=dmyDate($row['rentupto']);
                                      echo "<p>$rentto</p>";
                                      ?>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="box-body">
                                      <div class="col-md-2">
                                              <?php
                                              echo<<<_END
                                             <a href="rentalfrom.php?rentalsfromid=$rentalsfromid&func=edit">
                                                  <button class="focusable btn btn-block btn-primary focus">
                                                     Edit Rent Order
                                                  </button>
                                             </a>
_END;
                                              ?>
                                      </div>
                                      <div class="col-md-2">
                                              <?php
                                              echo<<<_END
                                         <a href="rentalfrom.php?rentalsfromid=$rentalsfromid&func=delete">
                                                  <button class="focusable delete btn btn-block btn-danger">
                                             Delete Rent Order
                                                  </button>
                                         </a>
_END;
                                              ?>
                                          
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
                    </tr>
                    <?php
                    $query="Select rentalsfromitems.*,godowns.name as godownname,items.name as itemname,items.itemid as itemid,items.itemtype,items.description from rentalsfromitems join items on rentalsfromitems.itemid=items.itemid join godowns on items.godownid=godowns.godownid where rentalsfromid=$rentalsfromid";
                    $result=  queryMysql($query);
                    $count=1;
                    while($row=mysqli_fetch_array($result))
                    {
                        
                    ?>
                    <tr class="order-row">
                      <td>
                          <?php
                          echo $count++;
                          ?>
                      </td>
                      <td>
                          <?php
                          echo $row['itemname'];
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['itemtype'];
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['description'];
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['godownname'];
                          ?>
                      </td>
                      <td>
                          <?php
                          $itemid=id($row['itemid']);
                          $itemid="IT-".$itemid;
                          echo $itemid;
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['quantity'];
                          ?>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                    
                   
                    
                  </table>
<!--                                          <a href="#">
                    <span class="glyphicon glyphicon-plus"></span>
                    Add More Items</a>-->
                                      </div>
                                      </div>
                              </div>
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
        $rentalsfromid=sanitizeString($_GET['rentalsfromid']);
        if(isset($_POST['date']))
        {
            $date=ymdDate($_POST['date']);
            $rentfrom=ymdDate($_POST['rentfrom']);
            $rentupto=ymdDate($_POST['rentupto']);
//            $query="Delete from orders where orderid=$orderid";
            $supplierid=$_POST['supplierid'];
            $managerid=$_POST['managerid'];
            $query="Update rentalsfrom set date='$date',supplierid=$supplierid, managerid=$managerid ,rentfrom='$rentfrom',rentupto='$rentupto' where rentalsfromid=$rentalsfromid";
            $result=queryMysql($query);
            $query="Delete from rentalsfromitems where rentalsfromid=$rentalsfromid";
            $result=queryMysql($query);
//            $columns=columns($_POST);
//            $values=values($_POST);
//            query($_POST, "orders");
            $rentalsfromid=$_POST['rentalsfromid'];
            $index=0;
            foreach($_POST['itemid'] as $itemid)
            {
                $quantity=$_POST['quantity'][$index];
                $itemid=$_POST['itemid'][$index++];
                $query="Insert into rentalsfromitems(quantity,itemid,rentalsfromid) values($quantity,$itemid,$rentalsfromid)";
                $result=queryMysql($query);
            }
            echo<<<_END
      <script type="text/javascript">
          window.location.replace("rentalfrom.php?rentalsfromid=$rentalsfromid&func=view");
  </script>
_END;
        }
        else
        {
        $query="select rentalsfrom.*,suppliers.name as suppliername,suppliers.city as suppliercity,managers.name as managername from rentalsfrom inner join suppliers on rentalsfrom.supplierid=suppliers.supplierid inner join managers on rentalsfrom.managerid=managers.managerid where rentalsfromid=$rentalsfromid";
        $result=  queryMysql($query);
        $row=  mysqli_fetch_array($result);
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Rental Order
            <small>Enter order details</small>
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
                      <?php
                      echo<<<_END
                      <form class="myform" action="rentalfrom.php?rentalsfromid=$rentalsfromid&func=edit" method="post">
_END;
                      ?>
                          <div class="box-body">
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Rental Id</label>
                                      <?php
                                      $rentalsfromid1=id($row['rentalsfromid']);
                                      $rentalsfromid1="RT-".$rentalsfromid1;
                                      echo "<p>$rentalsfromid1</p>";
                                      echo<<<_END
                                      <input type="hidden" name="rentalsfromid" value="$rentalsfromid"/>
_END;
                                      ?>
                                  </div>
                              </div>
                              <div class="col-md-3 col-md-offset-6">
                                  <div class="form-group">
                                <label>Date:</label>
                                <div class="input-group has-success">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                    <?php
                                    $date=dmyDate($row['date']);
                                    echo<<<_END
                                  <input type="text" name="date" value="$date" class="form-control mandatory focus" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
_END;
                                    ?>
                                </div><!-- /.input group -->
                              </div>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Customer Name</label>
                                          <select name="supplierid" class="form-control mandatory">
                                              <option value="">Select</option>
                                            <?php
                                            $query1="Select supplierid,name from suppliers";
                                            $result1=  queryMysql($query1);
                                            while($row1=mysqli_fetch_array($result1))
                                            {
                                                if($row1['supplierid']==$row['supplierid'])
                                                    echo "<option value='$row1[supplierid]' selected='selected'>$row1[name]</option>";
                                                else
                                                    echo "<option value='$row1[supplierid]'>$row1[name]</option>";
                                                    
                                            }
                                            ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Order Manager</label>
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
                                  <div class="col-md-4">
                                      <div class="col-md-5" style="width:48%">
                                          <div class="form-group">
                                            <label>Rent from:</label>
                                            <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                                <?php
                                                echo<<<_END
                                              <input type="text" value='$row[rentfrom]' name="rentfrom" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
_END;
                                                ?>
                                                
                                            </div><!-- /.input group -->
                                          </div>
                                      </div>
                                      <div class="col-md-5" style="width:48%">
                                          <div class="form-group">
                                            <label>Rent upto:</label>
                                            <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                                <?php
                                                echo<<<_END
                                              <input type="text" value='$row[rentupto]' name="rentupto" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
_END;
                                                ?>
                                                
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
                    <?php
$query="Select rentalsfromitems.*,godowns.name as godownname,items.name as itemname,items.itemtype,items.itemid as itemid,items.quantity as itemquantity,items.description from rentalsfromitems join items on rentalsfromitems.itemid=items.itemid join godowns on items.godownid=godowns.godownid where rentalsfromid=$rentalsfromid";                        
                    $result=  queryMysql($query);
                    $count=1;
                    $totalrows=mysqli_num_rows($result);
                    while($row=  mysqli_fetch_array($result))
                    {
                    ?>
                    <tr class="order-row-edit">
                      <td class="orderid">
                          <?php
                          echo $count++;
                          ?>
                      </td>
                      <td>
                          <div class="form-group has-success">
                              <select class="form-control mandatory item item-name item-name-edit">
                                <option value="">Select</option>
                                <?php
                                $query1="Select distinct name from items order by name";
                                $result1=  queryMysql($query1);
                                while($row1=mysqli_fetch_array($result1))
                                {
                                    if($row["itemname"]==$row1["name"])
                                        echo "<option value='$row1[name]' selected='selected'>$row1[name]</option>";
                                    else
                                        echo "<option value='$row1[name]'>$row1[name]</option>";
                                }
                                ?>
                              </select>
                            </div>
                      </td>
                      <td>
                          <div class="form-group has-success">
                              <select class="form-control mandatory item-type">
                                  <?php
                                  echo "<option value='$row[itemtype]'>$row[itemtype]</option>";
                                  ?>
                              </select>
                            </div>
                      </td>
                      <td>
                          <div class="form-group has-success">
                              <select class="form-control mandatory item-description">
                                  <?php
                                  echo "<option value='$row[description]'>$row[description]</option>";
                                  ?>
                              </select>
                            </div>
                      </td>
<!--                      <td>
                          <div class="form-group">
                              <select name="itemid[]" class="form-control mandatory item-godown">
                                  <?php
//                                    $itemid=id($row['itemid']);
//                                    $itemid="IT-".$itemid;
//                                    echo "<option value='$itemid>$itemid</option>'";
                                  ?>
                              </select>
                            </div>
                      </td>-->
<!--                      <td>
                          <div class="form-group">
                              <select name="itemid[]" class="form-control item">
                                <option>Select</option>
                                <?php
//                                $query1="Select name,itemid,description from items order by name";
//                                $result1=  queryMysql($query1);
//                                while($row1=mysqli_fetch_array($result1))
//                                {
//                                    if($row['itemid']==$row1['itemid'])
//                                        echo "<option value='$row1[itemid]' selected='selected'>$row1[name] | $row1[description]</option>";
//                                    else
//                                        echo "<option value='$row1[itemid]'>$row1[name] | $row1[description]</option>";
//                                }
                                ?>
                              </select>
                            </div>
                      </td>-->

                      
                      <td>
                          <div class="form-group has-success">
                              <select name="itemid[]" class="form-control item-godown mandatory">
                                <?php
//                                $query1="Select name,godownid from godowns order by name";
//                                $result1=  queryMysql($query1);
//                                while($row1=mysqli_fetch_array($result1))
//                                {
//                                    if($row['godownid']==$row1['godownid'])
//                                        echo "<option value=$row1[godownid] selected='selected'>$row1[name]</option>";
//                                    else
//                                        echo "<option value=$row1[godownid]>$row1[name]</option>";
//                                }
                                echo "<option value=$row[itemid]>$row[godownname] - $row[itemquantity]</option>";
                                ?>
                              </select>
                            </div>
                      </td>
                      <td>
                          <?php
                            $itemid=id($row['itemid']);
                            $itemid="IT-".$itemid;
                            echo<<<_END
                          <input type="text" value="$itemid" class="form-control itemid" placeholder="Item ID"/>
                              <input type="hidden" class="item-id" value="$row[itemid]"/>
_END;
                          ?>
                      </td>
                      <td class="order-quantity">
                          <div class="form-group has-success">
                              <?php
                              $max=$row['itemquantity']+$row['quantity'];
                              if(($count-1)==$totalrows)
                                  echo<<<_END
                                  <input type="number" value="$row[quantity]" name="quantity[]" max=$max class="form-control mandatory item-quantity new-order-row-edit"/>
_END;
                              else
                                  echo<<<_END
                                  <input type="number" value="$row[quantity]" name="quantity[]" max=$max class="form-control mandatory item-quantity"/>
_END;
                         
                              ?>
                          </div>
                      </td>
                      <td class="visible-sm-block">
                          <a class="delete-row" href="javascript:void(0)">Delete</a>
                      </td>
                    </tr>
                    <?php
                    }
                    
                    ?>
                    
                    
                   
                    
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
                                          <button class="focusable btn btn-block btn-primary submit">Submit Rent Order</button>
                                      </div>
                                      <div class="col-md-2">
                                          <button class="focusable btn btn-block btn-warning cancel">Reset</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      <?php
                      echo "</form>";
                      ?>
                      <table style="display: none">
                          <tr class="order-row-edit">
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
                          <input type="hidden" class="item-id" value="0"/>
                      </td>
                      <td class="order-quantity">
                          <div class="form-group">
                              <input type="number" name="quantity[]" min="1" class="form-control mandatory new-order-row-edit item-quantity"/>
                          </div>
                      </td>
                    <td class="visible-sm-block">
                          <a class="delete-row" href="javascript:void(0)">Delete</a>
                  </td>
                    </tr>
                      </table>
                  </div>
              </div>
          </div>
          
          
          

        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
        
        
        
        
<?php
    }
}
    elseif($_GET['func']=="delete")
    {
        $rentalsfromid=sanitizeString($_GET['rentalsfromid']);
        $query="Delete from rentalsfrom where rentalsfromid=$rentalsfromid";
        $result=queryMysql($query);
//        $query="Delete from rentalsfromitems where rentalsfromid=$rentalsfromid";
//        $result=queryMysql($query);
        echo<<<_END
      <script type="text/javascript">
          window.location.replace("viewrentalsfrom.php");
  </script>
_END;
    }
   
}
include_once 'footer.php';
?>
    </div><!-- ./wrapper -->
    
  </body>
</html>