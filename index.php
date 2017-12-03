<?php
include_once 'header.php';
include_once 'headerfiles.php';
$error="";
if(isset($_POST['username']))
{
    $username=sanitizeString($_POST['username']);
    $password=salt(sanitizeString($_POST['password']));
    $query="Select * from users where username='$username'";
    $result=queryMysql($query);
    $row=mysqli_fetch_array($result);
        if($row['password']==$password)
        {
        $_SESSION['userid']=$row['userid'];
        $_SESSION['password']=$row['password'];
        $_SESSION['username']=$row['username'];
        $_SESSION['privilege']=$row['privilege'];
        echo "<script type='text/javascript'>window.location.replace('business.php');</script>";
        }
        else
        {
            $error="<i class=\"fa fa-times-circle-o\"></i> Invalid Password";     
        }
}
?>
<script>
      $(function () {
        
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
<body class="login-page sidebar-collapse">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="login-box">
                  <div class="login-logo">
                      <b>Khandelwal Decorators</b>
                  </div><!-- /.login-logo -->
                  <div class="login-box-body">
            <!--        <p class="login-box-msg">Sign in to start your session</p>-->
                    <form class="simpleform" action="index.php" method="post">
                      <div class="form-group">
            <!--              <label>Username</label>-->
                          <select class="form-control focus mandatory" name="username">
                              <option value="">Select</option>
                            <?php
                                $query="Select * from users";
                                $result= queryMysql($query);
                                while($row=mysqli_fetch_array($result))
                                {
                                    echo "<option value='$row[username]'>$row[username]</option>";
                                }
                            ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="password">
                            <?php
                              echo $error;
                          ?>
                          </label>
                        <input type="password" name="password" id="password" class="form-control mandatory" placeholder="Password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      </div>
                      <div class="row">
                        <div class="col-xs-4 col-xs-offset-8">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                      </div>
                    </form>
                  </div><!-- /.login-box-body -->
                </div><!-- /.login-box -->
            </section>
        </div>
<?php
if($error!="")
{
    echo<<<_END
    <script type="text/javascript">
        $("#password").parent().addClass("has-error");
    </script>
_END;
}
include_once 'footer.php';
?>
    </div>
  </body>
</html>