<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
$columns="";
$values="";
if(isset($_POST['name']))
{
    query('items');
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
}

?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Items
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
                      <form class="myform" action="additems.php" method="post" enctype="multipart/form-data">
                          <div class="box-body">
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Item Id</label>
                                      <?php
                                      $query="Select itemid from items order by itemid desc limit 1";
                                      $result=  queryMysql($query);
                                      $row=mysqli_fetch_array($result);
                                      $itemid=id($row['itemid']+1);
                                      $itemid="IT-".$itemid;
                                      echo <<<_END
                                      <input type="text" value="$itemid" class="form-control mandatory" placeholder="Item Id"/>
_END;
                                      ?>
                                  </div>
                              </div>
                              
                          </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Item Name</label>
                                          <select name="name" class="form-control item-name focus mandatory">
                                              <option value="">Select</option>
                                              <?php
                                              $query1="Select distinct name from items";
                                              $result1=  queryMysql($query1);
                                              while($row1=  mysqli_fetch_array($result1))
                                              {
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
                                      <div class="form-group">
                                          <label>Item Type</label>
                                          <select name="itemtype" class="form-control item-type mandatory">
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
                                      <div class="form-group">
                                          <label>Item Description</label>
                                          <input type="text" name="description" class="form-control mandatory" placeholder="Item Description"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Godown/Venue</label>
                                          <div class="form-group">
                                              <select name="godownid" class="form-control mandatory">
                                                  <option value="">Select</option>
                                                <?php
                                            $query="Select godownid,name from godowns";
                                            $result=  queryMysql($query);
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                echo "<option value='$row[godownid]'>$row[name]</option>";
                                            }
                                            ?>
                                              </select>
                                          </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Stock In Hand</label>
                                          <input type="number" name="quantity" class="form-control mandatory"/>
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
                                          <button class="btn btn-block btn-primary submit">Save Item</button>
                                      </div>
                                      <div class="col-md-2">
                                          <button class="btn btn-block btn-warning cancel">Cancel</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          
          
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
<?php
include_once 'footer.php';
?>
    </div><!-- ./wrapper -->
  </body>
  
</html>