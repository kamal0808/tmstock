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
    query('godowns');
}
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Godowns/Venues
            <small>Enter Godown/Venue details</small>
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
                      <form class="myform" action="godowns.php" method="post">
                          <div class="box-body">
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Godown/Venue</label>
                                      <div class="form-group">
                                          <select name="type" class="form-control focus mandatory">
                                            <option value="">Select</option>
                                            <option value="Godown">Godown</option>
                                            <option value="Venue">Venue</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Godown Name</label>
                                          <input type="text" name="name" class="form-control mandatory" placeholder="Godown Name"/>
                                      </div>
                                  </div>
                          </div>
                              <div class="row">
                                  
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Godown Address</label>
                                          <input type="text" name="address" class="form-control" placeholder="Godown Address"/>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>City</label>
                                          <div class="form-group">
                                              <select name="city" class="form-control mandatory">
                                                <option value="">Select</option>
                                                <option>Bhopal</option>
                                                <option>Gwalior</option>
                                                <option>Indore</option>
                                              </select>
                                          </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Godown Manager</label>
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
                                  <div class="box-body">
                                      <div class="col-md-2">
                                          <button class="btn btn-block btn-primary submit">Save Godown</button>
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
          <div class="row">
              <div class="col-md-12">
                 <div class="box box-primary">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>View Stock</th>
                        <th>Address</th>
                        <th>Manager</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query="Select * from godowns";
                        $result=  queryMysql($query);
                            $count=1;
                        while($row=  mysqli_fetch_array($result))
                        {
                            $query1="Select name from managers where managerid=$row[managerid]";
                            $result1=queryMysql($query1);
                            $row1=mysqli_fetch_array($result1);
                            echo<<<_END
                            <tr>
                                <td>$count</td>
                                <td>$row[type]</td>
                                <td>$row[name]</td>
                                <td><a href="godown.php?godownid=$row[godownid]&func=view">View Stock</a></td>
                                <td>$row[address]</td>
                                <td>$row1[name]</td>
                                <td><a href="godown.php?godownid=$row[godownid]&func=edit">Edit</a></td>
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