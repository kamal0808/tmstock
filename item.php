<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
if(isset($_GET['itemid']))
{
    if(isset($_POST['itemid']))
    {
        $name=sanitizeString($_POST['name']);
        $itemtype=sanitizeString($_POST['itemtype']);
        $description=sanitizeString($_POST['description']);
        $godownid=sanitizeString($_POST['godownid']);
        $quantity=sanitizeString($_POST['quantity']);
        $itemid=sanitizeString($_POST['itemid']);
        $query="Update items set name='$name',itemtype='$itemtype',description='$description',godownid=$godownid,quantity=$quantity where itemid=$itemid";
        queryMysql($query);
        if($_FILES)
    {
        $name=$_FILES['itemimage']['name'];
        $result=queryMysql("SELECT itemid FROM items ORDER BY itemid DESC limit 1");
        $row=mysqli_fetch_array($result);
        $_FILES["itemimage"]["name"]=$row["itemid"].".jpg";
        $saveto="items/$row[itemid].jpg";
        $tempname=$_FILES["itemimage"]["tmp_name"];
        $type=$_FILES["itemimage"]["type"];
        uploadimage($tempname,$saveto,$type,600);
    }
        echo<<<_END
        <script type="text/javascript">
            window.location.replace("viewitems.php");
        </script>
_END;
    }
    else
    {
        $itemid=sanitizeString($_GET['itemid']);
        $query="Select * from items where itemid=$itemid";
        $result=  queryMysql($query);
        $row=  mysqli_fetch_array($result);
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Items
            <small>Enter item details</small>
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
                      <form class="myform" action="item.php?itemid=$itemid" method="post">
_END;
                      ?>
                          <div class="box-body">
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Item Id</label>
                                      <?php
                                      $itemid=id($row['itemid']+1);
                                      $itemid="IT-".$itemid;
                                      echo <<<_END
                                      <input type="text" value="$itemid" class="form-control mandatory" placeholder="Item Id"/>
                                      <input name="itemid"  value="$row[itemid]" type="hidden"/>
_END;
                                      ?>
                                  </div>
                              </div>
                              
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Item Name</label>
                                          <select name="name" class="form-control item-name focus mandatory">
                                              <option value="">Select</option>
                                              <?php
                                              $query1="Select name,itemid from items group by name";
                                              $result1=  queryMysql($query1);
                                              while($row1=  mysqli_fetch_array($result1))
                                              {
                                                  if($row1['itemid']==$row['itemid'])
                                                      echo "<option value='$row1[name]' selected='selected'>$row1[name]</option>";
                                                  else
                                                      echo "<option value='$row1[name]'>$row1[name]</option>";
                                              }
                                              ?>
                                              <option value="other">Other</option>
                                          </select>
                                      </div>
                                  </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label>Other</label>
                                              <input type="text" name="name" class="form-control other-item-name" disabled/>
                                          </div>
                                      </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Item Type</label>
                                          <select name="itemtype" class="form-control item-type mandatory">
                                              <?php
                                              echo "<option value='$row[itemtype]'>$row[itemtype]</option>";
                                              ?>
                                              <option value="other">Other</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group other">
                                          <label>Other</label>
                                          <input type="text" name="itemtype" class="form-control other-item-type" disabled/>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Item Description</label>
                                          <?php
                                          echo<<<_END
                                              <input type="text" name="description" value="$row[description]" class="form-control mandatory" placeholder="Item Description"/>
_END;
                                          ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Godown/Venue</label>
                                          <div class="form-group has-success">
                                              <select name="godownid" class="form-control mandatory">
                                                  <option value="">Select</option>
                                                <?php
                                            $query1="Select godownid,name from godowns";
                                            $result1=  queryMysql($query1);
                                            while($row1=mysqli_fetch_array($result1))
                                            {
                                                if($row1['godownid']==$row['godownid'])
                                                echo "<option value='$row1[godownid]' selected='selected'>$row1[name]</option>";
                                                else
                                                echo "<option value='$row1[godownid]'>$row1[name]</option>";
                                            }
                                            ?>
                                              </select>
                                          </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label>Stock In Hand</label>
                                          <?php
                                          echo<<<_END
                                          <input type="number" name="quantity" value="$row[quantity]" class="form-control mandatory"/>
_END;
                                          ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Item image:</label>
                                      <input type="file" name="itemimage"/>
                                  </div>
                                  </div>
                              </div>
                              <?php
                              $business=$_SESSION['business'];
                              echo<<<_END
                              <input type="hidden" name="business" value="$business"/>
_END;
                              ?>
                              <div class="row">
                                  <div class="box-body">
                                      <div class="col-md-2">
                                          <button class="focusable btn btn-block btn-primary submit">Save Item</button>
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
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
<?php
include_once 'footer.php';
    }
}
?>
    </div><!-- ./wrapper -->
  </body>
  
</html>