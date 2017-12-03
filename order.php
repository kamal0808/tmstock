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
if(isset($_GET['orderid']))
{
    
    if($_GET['func']=="view")
    {
    $orderid=sanitizeString($_GET['orderid']);
        $query="select orders.*,customers.name as customername,customers.city as customercity,managers.name as managername,godowns.name as godownname from orders inner join customers on orders.customerid=customers.customerid inner join managers on orders.managerid=managers.managerid inner join godowns on orders.godownid=godowns.godownid where orderid=$orderid";
$result=  queryMysql($query);
$row=  mysqli_fetch_array($result);
?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Order
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
              <div class="col-md-10 col-xs-12 col-md-offset-1">
                  <div class="box box-primary">
                      <div class="box-body">
                          <div class="row">
                              <div class="col-md-3 col-xs-3">
                                  <label>Order Id</label>
                                  <?php
                                  $orderid1=id($orderid);
                                  $orderid1="OR-".$orderid1;
                                  echo "<p>$orderid1</p>";
                                  ?>
                              </div>
                              <div class="col-md-3 col-md-offset-4 col-xs-3 col-xs-offset-4">
                                <label>Order Date</label>
                                  <?php
                                    $orderdate=  dmyDate($row['orderdate']);
                                    echo "<p>$orderdate</p>";
                                  ?>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-md-4 col-xs-4">
                                      <label>Customer Name</label>
                                      <?php 
                                      echo "<p>$row[customername], $row[customercity]</p>";
                                      ?>
                                  </div>
                                  <div class="col-md-3 col-xs-3">
                                      <label>Order Manager</label>
                                      <?php 
                                      echo "<p>$row[managername]</p>";
                                      ?>
                                      
                                  </div>
                                  <div class="col-md-4 col-xs-4">
                                        <label>Event from:</label>
                                         <?php
                                         $eventto=dmyDate($row['eventfrom']);
                                      echo "<p>$eventto</p>";
                                      ?> 
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 col-xs-4">
                                      <label>Event Type</label>
                                      <?php 
                                      echo "<p>$row[eventtype]</p>";
                                      ?>
                                  </div>
                                  <div class="col-md-3 col-xs-3">
                                      <label>Venue for supply</label>
                                      <?php 
                                      echo "<p>$row[godownname]</p>";
                                      ?>
                                  </div>
                                  <div class="col-md-4 col-xs-4">
                                        <label>Event to:</label>
                                          <?php
                                          $eventto=dmyDate($row['eventto']);
                                      echo "<p>$eventto</p>";
                                      ?>
                                  </div>
                              </div>
                              <div class="row no-print">
                                  <div class="box-body">
                                      <div class="col-md-2">
                                              <?php
                                              echo<<<_END
                                             <a href="order.php?orderid=$orderid&func=edit">
                                                  <button class="focusable btn btn-block btn-primary focus">
                                                     Edit Order
                                                  </button>
                                             </a>
_END;
                                              ?>
                                      </div>
                                      <div class="col-md-2">
                                              <?php
                                              if($_SESSION['privilege']=="admin")
                                              {
                                              if($row['invoice']==0)
                                              {
                                              echo<<<_END
                                         <a href="order.php?orderid=$orderid&func=invoice">
                                              <button class=" focusable btn btn-block btn-warning">
                                                     Make Invoice
                                              </button>
                                             </a>
_END;
                                              }
                                              else
                                              {
                                                  echo<<<_END
                                             <a href="order.php?orderid=$orderid&func=invoice">
                                                  <button class="focusable btn btn-block btn-warning">
                                                         View Invoice
                                                  </button>
                                                 </a>
_END;
                                              }
                                                  
                                              }
                                                  
                                              ?>
                                      </div>
                                      <div class="col-md-2">
                                              <?php
                                              echo<<<_END
                                         <a href="order.php?orderid=$orderid&func=delete">
                                                  <button class="delete focusable btn btn-block btn-danger">
                                             Delete Order
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
                    $query="Select orderitems.quantity as oquantity,godowns.name as godownname,items.* from orderitems join items on orderitems.itemid=items.itemid join godowns on items.godownid=godowns.godownid where orderid=$orderid";
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
                          echo $row['name'];
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
                          echo $row['oquantity'];
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
        $orderid=sanitizeString($_GET['orderid']);
        if(isset($_POST['orderdate']))
        {
            $_POST['orderdate']=ymdDate($_POST['orderdate']);
            $_POST['eventfrom']=ymdDate($_POST['eventfrom']);
            $_POST['eventto']=ymdDate($_POST['eventto']);
//            $query="Delete from orders where orderid=$orderid";
            $orderdate=$_POST['orderdate'];
            $customerid=$_POST['customerid'];
            $managerid=$_POST['managerid'];
            $eventfrom=$_POST['eventfrom'];
            $eventto=$_POST['eventto'];
            $eventtype=$_POST['eventtype'];
            $godownid=$_POST['godownid'];
            $query="Update orders set orderdate='$orderdate',customerid=$customerid, managerid=$managerid, eventfrom='$eventfrom',eventto='$eventto',eventtype='$eventtype',godownid=$godownid where orderid=$orderid";
            $result=queryMysql($query);
//            $query="Select quantity,itemid from orderitems where orderid=$orderid";
//            $result=queryMysql($query);
//            while($row=  mysqli_fetch_array($result))
//            {
//                $query="Update items set quantity=quantity+$row[quantity] where itemid=$row[itemid]";
//                queryMysql($query);
//            }
            $query="Delete from orderitems where orderid=$orderid";
            $result=queryMysql($query);
            $orderid=$_POST['orderid'];
            $index=0;
            foreach($_POST['itemid'] as $itemid)
            {
                $quantity=$_POST['quantity'][$index];
                if($_POST['price'][$index])
                    $price=$_POST['price'][$index];
                else
                    $price=0;
                $itemid=$_POST['itemid'][$index++];
                $query="Insert into orderitems(quantity,itemid,orderid,price) values($quantity,$itemid,$orderid,$price)";
                $result=queryMysql($query);
//                $query="Update items set quantity=quantity-$quantity where itemid=$itemid";
//                $result=queryMysql($query);
            }
            echo<<<_END
      <script type="text/javascript">
          window.location.replace("order.php?orderid=$orderid&func=view");
  </script>
_END;
        }
        else
        {
        $query="select orders.*,customers.name as customername,customers.city as customercity,managers.name as managername,godowns.name as godownname from orders inner join customers on orders.customerid=customers.customerid inner join managers on orders.managerid=managers.managerid inner join godowns on orders.godownid=godowns.godownid where orderid=$orderid";
        $result=  queryMysql($query);
        $row=  mysqli_fetch_array($result);
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Orders
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
                      <form action="order.php?orderid=$orderid&func=edit" class="myform" method="post">
_END;
                      ?>
                          <div class="box-body">
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Order Id</label>
                                      <?php
                                      $orderid1=id($row['orderid']);
                                      $orderid1="OR-".$orderid1;
                                      echo "<p>$orderid1</p>";
                                      echo<<<_END
                                      <input type="hidden" name="orderid" value="$orderid"/>
_END;
                                      ?>
                                  </div>
                              </div>
                              <div class="col-md-3 col-md-offset-6">
                                  <div class="form-group">
                                <label>Order Date:</label>
                                <div class="input-group has-success">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                    <?php
                                    $orderdate=dmyDate($row['orderdate']);
                                    echo<<<_END
                                  <input type="text" name="orderdate" value="$orderdate" class="form-control focus mandatory" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
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
                                          <select name="customerid" class="form-control mandatory">
                                              <option value="">Select</option>
                                            <?php
                                            $query1="Select customerid,name from customers";
                                            $result1=  queryMysql($query1);
                                            while($row1=mysqli_fetch_array($result1))
                                            {
                                                if($row1['customerid']==$row['customerid'])
                                                    echo "<option value='$row1[customerid]' selected='selected'>$row1[name]</option>";
                                                else
                                                    echo "<option value='$row1[customerid]'>$row1[name]</option>";
                                                    
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
                                            <label>Event from:</label>
                                            <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                                <?php
                                                $eventfrom=dmyDate($row['eventfrom']);
                                                echo<<<_END
                                              <input type="text" value='$eventfrom' name="eventfrom" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
_END;
                                                ?>
                                                
                                            </div><!-- /.input group -->
                                          </div>
                                      </div>
                                      <div class="col-md-5" style="width:48%">
                                          <div class="form-group">
                                            <label>Event to:</label>
                                            <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                                <?php
                                                $eventto=dmyDate($row['eventto']);
                                                echo<<<_END
                                              <input type="text" value='$eventto' name="eventto" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
_END;
                                                ?>
                                                
                                            </div><!-- /.input group -->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Event Type</label>
                                          <?php
                                          echo<<<_END
                                          <input type="text" value='$row[eventtype]' name="eventtype" class="form-control" placeholder="Event type"/>
_END;
                                          ?>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Venue for supply</label>
                                          <select class="form-control mandatory" name="godownid" id="supply-venue">
                                            <option value="">Select</option>
                                            <?php
                                            $query1="Select godownid,name from godowns";
                                            $result1=  queryMysql($query1);
                                            while($row1=mysqli_fetch_array($result1))
                                            {
                                                if($row['godownid']==$row1['godownid'])
                                                    echo "<option value='$row1[godownid]' selected='selected'>$row1[name]</option>";
                                                else
                                                    echo "<option value='$row1[godownid]'>$row1[name]</option>";
                                            }
                                            ?>
                                          </select>
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
    $query="Select orderitems.quantity as oquantity,price,godowns.name as godownname,items.* from orderitems join items on orderitems.itemid=items.itemid join godowns on items.godownid=godowns.godownid where orderid=$orderid";                        
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
                                    if($row["name"]==$row1["name"])
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
                                echo "<option value=$row[itemid]>$row[godownname] - $row[quantity]</option>";
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
                              $max=$row['quantity']+$row['oquantity'];
                              if(($count-1)==$totalrows)
                                  echo<<<_END
                                  <input type="number" value="$row[oquantity]" name="quantity[]" max=$max class="form-control item-quantity new-order-row-edit mandatory"/>
_END;
                              else
                                  echo<<<_END
                                  <input type="number" value="$row[oquantity]" name="quantity[]" max=$max class="form-control item-quantity mandatory"/>
_END;
                         echo<<<_END
                              <input name="price[]" value="$row[price]" type="hidden"/>
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
                                          <button class="btn btn-block btn-primary submit">Submit Order</button>
                                      </div>
                                      <div class="col-md-2">
                                          <button class="btn btn-block btn-warning cancel">Reset</button>
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
        $orderid=sanitizeString($_GET['orderid']);
        $query="Delete from orders where orderid=$orderid";
        $result=queryMysql($query);
//        $query="Delete from orderitems where orderid=$orderid";
//        $result=queryMysql($query);
        echo<<<_END
      <script type="text/javascript">
          window.location.replace("vieworders.php");
  </script>
_END;
    }
   elseif($_GET['func']=="invoice"&&$_SESSION['privilege']=="admin")
   {
        $orderid=sanitizeString($_GET['orderid']);
   if(isset($_POST['orderid']))
   {
       foreach($_POST['price'] as $key=>$value)
       {
           $key=sanitizeString($key);
           $value=sanitizeString($value);
           $orderitemid=sanitizeString($_POST['orderitemid'][$key]);
           $query="Update orderitems set price=$value where orderitemid=$orderitemid";
           $result=queryMysql($query);
           
       }
       $query="Update orders set invoice=1 where orderid=$orderid";
       $result=queryMysql($query);
            echo<<<_END
          <script type="text/javascript">
              window.location.replace("order.php?orderid=$orderid&func=view");
      </script>
_END;
   }   
   else
   {
        $query="select orders.*,customers.name as customername,customers.city as customercity,managers.name as managername,godowns.name as godownname from orders inner join customers on orders.customerid=customers.customerid inner join managers on orders.managerid=managers.managerid inner join godowns on orders.godownid=godowns.godownid where orderid=$orderid";
$result=  queryMysql($query);
$row=  mysqli_fetch_array($result);
$invoice=$row['invoice'];
?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Make Invoice
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
                      <div class="box-body">
                <?php
                  echo<<<_END
                    <form class="myform" action="order.php?orderid=$orderid&func=invoice" method="post">
                        <input type="hidden" name="orderid" value="$orderid"/>
_END;
                  
                  ?>                          <div class="row">
                              <div class="col-md-3">
                                  <label>Order Id</label>
                                  <?php
                                  $orderid1=id($orderid);
                                  $orderid1="OR-".$orderid1;
                                  echo "<p>$orderid1</p>";
                                  ?>
                              </div>
                              <div class="col-md-3 col-md-offset-4">
                                <label>Order Date</label>
                                  <?php
                                    $orderdate=  dmyDate($row['orderdate']);
                                    echo "<p>$orderdate</p>";
                                  ?>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <label>Customer Name</label>
                                      <?php 
                                      echo "<p>$row[customername], $row[customercity]</p>";
                                      ?>
                                  </div>
                                  <div class="col-md-3">
                                      <label>Order Manager</label>
                                      <?php 
                                      echo "<p>$row[managername]</p>";
                                      ?>
                                      
                                  </div>
                                  <div class="col-md-4">
                                        <label>Event from:</label>
                                         <?php
                                         $eventto=dmyDate($row['eventfrom']);
                                      echo "<p>$eventto</p>";
                                      ?> 
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <label>Event Type</label>
                                      <?php 
                                      echo "<p>$row[eventtype]</p>";
                                      ?>
                                  </div>
                                  <div class="col-md-3">
                                      <label>Venue for supply</label>
                                      <?php 
                                      echo "<p>$row[godownname]</p>";
                                      ?>
                                  </div>
                                  <div class="col-md-4">
                                        <label>Event to:</label>
                                          <?php
                                          $eventto=dmyDate($row['eventto']);
                                      echo "<p>$eventto</p>";
                                      ?>
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
                      <th class="col-md-1">Item Name</th>
                      <th class="col-md-1">Item Type</th>
                      <th class="col-md-2">Item Description</th>
                      <th class="col-md-2">Godown/Venue</th>
                      <th class="col-md-1">Item ID</th>
                      <th class="col-md-1">Quantity</th>
                      <th class="col-md-2">Price</th>
                      <th class="col-md-2">Amount</th>
                    </tr>
                    <?php
                        $query="Select orderitems.*,godowns.name as godownname,items.name as itemname,items.itemtype as itemtype,items.itemid as itemid,items.description from orderitems join items on orderitems.itemid=items.itemid join godowns on items.godownid=godowns.godownid where orderid=$orderid";
                    $result=  queryMysql($query);
                    $count=1;
                    
                    while($row=mysqli_fetch_array($result))
                    {
                        $orderitemid=$row['orderitemid'];
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
                      <td class="quantity">
                          <?php
                          echo $row['quantity'];
                          ?>
                      </td>
                      <td>
                          <div class="input-group">
                            <span class="input-group-addon">Rs.</span>
                                <?php
                                if($invoice==0)
                                {
                                    echo<<<_END
                                    <input type="text" name="price[]" class="form-control price focus mandatory"/>
                                    <input type="hidden" name="orderitemid[]" value="$orderitemid"/>
_END;
                                }
                                else
                                {
                                    echo<<<_END
                                    <input type="text" name="price[]" value="$row[price]" class="form-control price mandatory"/>
                                    <input type="hidden" name="orderitemid[]" value="$orderitemid"/>
_END;
                                    
                                }
                                ?>
                          </div>
                      </td>
                      <td class="amount">
                          0
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Sub-Total</th> 
                        <th class="sub-total">0</th> 
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Round-off</th> 
                        <th class="round-off">0</th> 
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total</th> 
                        <th class="total">0</th> 
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
                                          <button class="btn btn-block btn-primary submit">Submit Invoice</button>
                                      </div>
                                      <div class="col-md-2">
                                          <button class="btn btn-block btn-warning cancel">Cancel</button>
                                      </div>
                                  </div>
                              </div>
                    <?php
                    echo "</form>";
                    ?>
                          </div>
                  </div>
              </div>
          </div>
          
          
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
<?php
   }
   }
}
include_once 'footer.php';
?>
    </div><!-- ./wrapper -->
    
  </body>
</html>