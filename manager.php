<?php
include_once 'header.php';
include_once 'headerfiles.php';
?>
<body class="skin-blue sidebar-collapse">
    <div class="wrapper">
<?php 
include_once 'navigation.php';
include_once 'sidebar.php';
if(isset($_POST['managerid']))
{
    $managerid=sanitizeString($_POST['managerid']);
    $name=sanitizeString($_POST['name']);
    $contact=sanitizeString($_POST['contact']);
    $query="Update managers set name='$name',contact='$contact' where managerid=$managerid";
    echo $query;
    queryMysql($query);
    echo<<<_END
            <script type="text/javascript">
                window.location.replace("managers.php");
            </script>
_END;
}
if(isset($_GET['managerid']))
{
    $managerid=sanitizeString($_GET['managerid']);
    $query="Select * from managers where managerid=$managerid";
    $result=queryMysql($query);
    $row=mysqli_fetch_array($result);

?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Manager
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
                      <form class="myform" action="manager.php" method="post">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group has-success">
                                          <label>Manager Name</label>
                                          <?php
                                          echo<<<_END
                                          <input type="text" name="name" value="$row[name]" class="form-control focus mandatory" placeholder="Manager Name"/>
                                          <input type="hidden" name="managerid" value="$row[managerid]"/>
_END;
                                          ?>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Manager Contact</label>
                                          <?php
                                          echo<<<_END
                                          <input type="text" value="$row[contact]" name="contact" class="form-control" placeholder="Manager Contact"/>
_END;
                                          ?>
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
          
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
}
?>
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