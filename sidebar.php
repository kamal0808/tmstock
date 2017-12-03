<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
<!--            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>-->
            <div class="pull-left info">
              <p>Khandelwal Decorators</p>
              <!-- Status -->
<!--              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
          </div>

          <!-- search form (Optional) -->
<!--          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header"><?php echo $_SESSION['application']?></li>
            <!-- Optionally, you can add icons to the links -->
            <li><a tabindex="0" class="focusable business-menu sidebar-menu" href="business.php"><span>Business Menu</span></a></li>
            <li><a tabindex="0" class="focusable sidebar-menu" href="home.php"><span>Home</span></a></li>
<!--            <li class="treeview">
              <a tabindex="0" class="sidebar-menu" href="#"><span>Shortcuts</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a tabindex="0" class="focusable sidebar-menu" href="#">Add Orders - Ctrl + O</a></li>
                <li><a tabindex="0" class="focusable sidebar-menu" href="#">View/Edit Orders - Ctrl + V</a></li>
                
              </ul>
            </li>-->
<!--            <li class="treeview">
              <a class="sidebar-menu" href="#"><span>Account Managers</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="focusable sidebar-menu" href="#">Manage Accounts</a></li>
                <li><a class="focusable sidebar-menu" href="#">Manage Passwords</a></li>
              </ul>
            </li>
            -->
            <?php
            if($_SESSION['privilege']=="admin")
            {
                
            echo<<<_END
                <li><a class="focusable sidebar-menu" href="settings.php"><span>Settings</span></a></li>
_END;
            }
            ?>
<!--            <li><a href="#"><span>Another Link</span></a></li>-->
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>