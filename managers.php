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
    query('managers');
}

?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Managers
            <small>Enter Manager details</small>
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
                      <form class="myform" action="managers.php" method="post">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Manager Name</label>
                                          <input type="text" name="name" class="form-control focus mandatory" placeholder="Manager Name"/>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Manager Contact</label>
                                          <input type="text" name="contact" class="form-control" placeholder="Manager Contact"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="box-body">
                                      <div class="col-md-2">
                                          <button class="focusable btn btn-block btn-primary submit">Add Manager</button>
                                      </div>
                                      <div class="col-md-2">
                                          <button class="focusable btn btn-block btn-warning cancel">Cancel</button>
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
                        <th>Manager Name</th>
                        <th>Contact</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query="Select * from managers";
                        $result=  queryMysql($query);
                        while($row=  mysqli_fetch_array($result))
                        {
                            echo<<<_END
                            <tr>
                                <td>$row[managerid]</td>
                                <td>$row[name]</td>
                                <td>$row[contact]</td>
                                <td><a href="manager.php?managerid=$row[managerid]">Edit</a></td>
                            </tr>
_END;
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