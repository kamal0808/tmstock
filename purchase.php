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
if(isset($_GET['purchaseid']))
{
    $purchaseid=sanitizeString($_GET['purchaseid']);
    if($_GET['func']=="view")
    {
        $query="Select p.*,s.name as sname,s.city as scity,m.name as mname from purchases as p join managers as m on p.managerid=m.managerid join suppliers as s on  p.supplierid=s.supplierid where purchaseid=$purchaseid";
        $result=queryMysql($query);
        $row=mysqli_fetch_array($result);
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Purchases
            <small>Enter purchase details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Purchases</li>
            <li class="active">View</li>
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
                                  <div class="form-group">
                                      <label>Purchase Id</label>
                                      <?php
                                      $purchaseid1=id($row['purchaseid']);
                                      $purchaseid1="PU-".$purchaseid1;
                                      echo $purchaseid1;
                                      ?>
                                  </div>
                              </div>
                              <div class="col-md-3 col-md-offset-1">
                                  <div class="form-group">
                                <label>Purchase Date:</label>
                                <?php
                                echo dmyDate($row['purchasedate']);
                                ?>
                              </div>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Supplier Name</label>
                                          <?php
                                          echo $row['sname'];
                                          ?>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Supply Manager</label>
                                          <?php
                                          echo $row['mname'];
                                          ?>
                                      </div>
                                  </div>
                                  
                                  
                              </div>
                              <div class="row">
                                  <div class="box-body">
                                      <div class="col-md-2">
                                              <?php
                                              echo<<<_END
                                             <a href="purchase.php?purchaseid=$purchaseid&func=edit">
                                                  <button class="focusable btn btn-block btn-primary focus">
                                                     Edit Purchase
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
                                         <a href="purchase.php?purchaseid=$purchaseid&func=invoice">
                                              <button class="focusable btn btn-block btn-warning">
                                                     Add Rates
                                              </button>
                                             </a>
_END;
                                              }
                                              else
                                              {
                                                  echo<<<_END
                                             <a href="purchase.php?purchaseid=$purchaseid&func=invoice">
                                                  <button class="focusable btn btn-block btn-warning">
                                                         View Rates
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
                                         <a href="purchase.php?purchaseid=$purchaseid&func=delete">
                                                  <button class="focusable delete btn btn-block btn-danger">
                                             Delete Purchase
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
                $query="Select p.*,g.name as gname,i.name as iname,i.itemtype,i.itemid as itemid,i.description as idesc,i.quantity as iquantity from purchaseitems p join items i on p.itemid=i.itemid join godowns g on i.godownid=g.godownid where purchaseid=$purchaseid";
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
                          echo $row['iname'];
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['itemtype'];
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['idesc'];
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['gname'];
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
        if(isset($_POST['purchaseid']))
        {
            $_POST['purchasedate']=ymdDate($_POST['purchasedate']);
            $purchasedate=sanitizeString($_POST['purchasedate']);
            $supplierid=sanitizeString($_POST['supplierid']);
            $managerid=sanitizeString($_POST['managerid']);
            $query="Update purchases set purchasedate='$purchasedate', supplierid=$supplierid,managerid=$managerid where purchaseid=$purchaseid";
            queryMysql($query);
            $query="Delete from purchaseitems where purchaseid=$purchaseid";
            queryMysql($query);
            $index=0;
            foreach($_POST['itemid'] as $itemid)
            {
                $quantity=$_POST['quantity'][$index];
                if($_POST['price'][$index])
                    $price=$_POST['price'][$index];
                else
                    $price=0;
                $itemid=$_POST['itemid'][$index++];
                $query="Insert into purchaseitems(quantity,itemid,purchaseid,price) values($quantity,$itemid,$purchaseid,$price)";
                $result=queryMysql($query);
                echo<<<_END
                  <script type="text/javascript">
                      window.location.replace("purchase.php?purchaseid=$purchaseid&func=view");
              </script>
_END;
            }
        }
        else
        {
                $query="Select p.*,s.supplierid as sid,s.name as sname,s.city as scity,m.managerid as mid,m.name as mname from purchases as p join managers as m on p.managerid=m.managerid join suppliers as s on p.supplierid=s.supplierid where purchaseid=$purchaseid";
        $result=queryMysql($query);
        $row=mysqli_fetch_array($result);
        ?>
            <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Purchases
            <small>Enter purchase details</small>
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
                      <form class="myform" action="purchase.php?purchaseid=$purchaseid&func=edit" method="post">
_END;
                      ?>
                          <div class="box-body">
                          <div class="row">
                              
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Purchase Id</label>
                                      <?php
                                      $purchaseid1=id($row['purchaseid']);
                                      $purchaseid1="PU-".$purchaseid1;
                                      echo <<<_END
                                      <input type="text" value="$purchaseid1" class="form-control" placeholder="Item Id"/>
                                      <input type="hidden" value="$purchaseid" name="purchaseid" class="form-control" placeholder="Item Id"/>
_END;
                                      ?>
                                  </div>
                              </div>
                              <div class="col-md-3 col-md-offset-6">
                                  <div class="form-group">
                                <label>Purchase Date:</label>
                                <div class="input-group has-success">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                    <?php
                                    $purchasedate=dmyDate($row['purchasedate']);
                                      echo <<<_END
                                  <input type="text" name="purchasedate" value="$purchasedate" class="form-control focus mandatory" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
_END;
                                    ?>
                                </div><!-- /.input group -->
                              </div>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Supplier Name</label>
                                          <select name="supplierid" class="form-control supplier mandatory">
                                            <option value="">Select</option>
                                            <?php
                                            $query1="Select supplierid,name,city from suppliers";
                                            $result1=  queryMysql($query1);
                                            while($row1=mysqli_fetch_array($result1))
                                            {
                                                if($row1['supplierid']==$row['sid'])
                                                    echo "<option value='$row1[supplierid]' selected='selected'>$row1[name], $row1[city]</option>";
                                                else
                                                    echo "<option value='$row1[supplierid]'>$row1[name], $row1[city]</option>";
                                            }
                                            ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Supply Manager</label>
                                          <select class="form-control mandatory" name="managerid" id="order-manager">
                                            <option value="">Select</option>
                                            <?php
                                            $query1="Select managerid,name from managers";
                                            $result1=  queryMysql($query1);
                                            while($row1=mysqli_fetch_array($result1))
                                            {
                                                if($row1['managerid']==$row['mid'])
                                                    echo "<option value='$row1[managerid]' selected='selected'>$row1[name]</option>";
                                                else
                                                    echo "<option value='$row1[managerid]'>$row1[name]</option>";
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
                                $query="Select purchaseitems.quantity as pquantity,price,godowns.name as godownname,godowns.godownid as godownid,items.* from purchaseitems join items on purchaseitems.itemid=items.itemid join godowns on items.godownid=godowns.godownid where purchaseid=$purchaseid";
                    $result=  queryMysql($query);
                    $totalrows=mysqli_num_rows($result);
                    $count=1;
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
                              if(($count-1)==$totalrows)
                                  echo<<<_END
                                  <input type="number" value="$row[pquantity]" name="quantity[]" max=$row[quantity] class="form-control mandatory item-quantity new-order-row-edit"/>
_END;
                              else
                                  echo<<<_END
                                  <input type="number" value="$row[pquantity]" name="quantity[]" max=$row[quantity] class="form-control mandatory item-quantity"/>
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
                                          <button class="focusable btn btn-block btn-primary submit">Save Changes</button>
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
      </div>
        <?php
        }
    }
    
    elseif($_GET['func']=='delete')
    {
        $query="Delete from purchases where purchaseid=$purchaseid";
        queryMysql($query);
                    echo<<<_END
              <script type="text/javascript">
                  window.location.replace("viewpurchase.php");
          </script>
_END;
        
    }
    elseif($_GET['func']=='invoice'&&$_SESSION['privilege']=="admin")
    {
        if(isset($_POST['purchaseid']))
        {
            foreach($_POST['price'] as $key=>$value)
            {
               $key=sanitizeString($key);
               $value=sanitizeString($value);
               $purchaseitemid=sanitizeString($_POST['purchaseitemid'][$key]);
               $query="Update purchaseitems set price=$value where purchaseitemid=$purchaseitemid";
               $result=queryMysql($query);
            }
               $query="Update purchases set invoice=1 where purchaseid=$purchaseid";
               $result=queryMysql($query);
                    echo<<<_END
              <script type="text/javascript">
                  window.location.replace("purchase.php?purchaseid=$purchaseid&func=view");
          </script>
_END;
        }
        else
        {
            
        $query="Select p.*,s.name as sname,s.city as scity,m.name as mname from purchases as p join managers as m on p.managerid=m.managerid join suppliers as s on p.supplierid=s.supplierid where purchaseid=$purchaseid";
        $result=queryMysql($query);
        $row=mysqli_fetch_array($result);
        $invoice=$row['invoice'];
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Rates
            <small>Enter purchase details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Purchases</li>
            <li class="active">View</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
          <div class="row">
              <div class="col-md-10 col-md-offset-1">
                  <div class="box box-primary">
                          <div class="box-body">
                          <?php
                  echo<<<_END
                    <form class="myform" action="purchase.php?purchaseid=$purchaseid&func=invoice" method="post">
                        <input type="hidden" name="purchaseid" value="$purchaseid"/>
_END;
                  
                  ?>
                              
                              <div class="row">
                              
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Purchase Id</label>
                                      <?php
                                      $purchaseid1=id($row['purchaseid']);
                                      $purchaseid1="PU-".$purchaseid1;
                                      echo $purchaseid1;
                                      ?>
                                  </div>
                              </div>
                              <div class="col-md-3 col-md-offset-1">
                                  <div class="form-group">
                                <label>Purchase Date:</label>
                                <?php
                                echo "$row[purchasedate]";
                                ?>
                              </div>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Supplier Name</label>
                                          <?php
                                          echo $row['sname'];
                                          ?>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Supply Manager</label>
                                          <?php
                                          echo $row['mname'];
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
                $query="Select p.*,g.name as gname,i.name as iname,i.itemid as itemid,i.itemtype,i.description as idesc from purchaseitems p join items i on p.itemid=i.itemid join godowns g on i.godownid=g.godownid where purchaseid=$purchaseid";
                    $result=  queryMysql($query);
                    $count=1;
                    while($row=mysqli_fetch_array($result))
                    {
                    ?>
                    <tr>
                      <td>
                          <?php
                            echo $count++;
                          ?>
                      </td>
                      <td>
                          <?php
                          echo $row['iname'];
                          ?>
                      </td>
                      <td>
                          <?php
                          echo $row['itemtype'];
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['idesc'];
                          ?>
                          
                      </td>
                      <td>
                          <?php
                          echo $row['gname'];
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
                                    <input type="text" name="price[]" class="form-control price focus"/>
                                    <input type="hidden" name="purchaseitemid[]" value="$row[purchaseitemid]"/>
_END;
                                }
                                else
                                {
                                    echo<<<_END
                                    <input type="text" name="price[]" value="$row[price]" class="form-control price"/>
                                    <input type="hidden" name="purchaseitemid[]" value="$row[purchaseitemid]"/>
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
                                          <button class="btn btn-block btn-primary submit">Save Changes</button>
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