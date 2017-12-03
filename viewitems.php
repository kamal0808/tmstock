<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View/Edit Items
            <small>View and Modify Stock in Hand</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Items</li>
            <li class="active">View/Manage</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                      <div class="box-header">
                          <h3 class="box-title with-border">Filter By:</h3>
                      </div>
                      <div class="box-body">
                          <div class="row">
                              <form class="myform" action="viewitems.php" method="GET">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Godown/Venue</label>
                                          <select name="godownid" class="focus form-control mandatory">
                                              <option value="">Select</option>
                                            <?php
                                    $query="Select name,godownid from godowns order by name";
                                    $result=  queryMysql($query);
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        echo "<option value=$row[godownid]>$row[name]</option>";
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
                  <table id="example1" class="table table-bordered table-striped">
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
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_GET['godownid']))
                        {
                            $godownid=sanitizeString($_GET['godownid']);
                            $query="Select items.*, godowns.name as godownname from items join godowns on items.godownid=godowns.godownid where items.godownid=$godownid";
                        }
                        else
                        {
                            $query="Select items.*, godowns.name as godownname from items join godowns on items.godownid=godowns.godownid";
                        }
                        $result=  queryMysql($query);
                        $count=1;
                        while($row=  mysqli_fetch_array($result))
                        {
                            $itemid=id($row['itemid']);
                            $itemid="IT-".$itemid;
                            echo<<<_END
                            <tr>
                                <td>$count</td>
                                <td>$itemid</td>
                                <td>$row[name]</td>
                                <td>$row[itemtype]</td>
                                <td>$row[description]</td>
                                <td>$row[godownname]</td>
                                <td>$row[business]</td>
                                <td>$row[quantity]</td>
                                <td><a href="item.php?itemid=$row[itemid]">Edit</a></td>
                            </tr>
_END;
                            $count++;
                        }
                        ?>
                        
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
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