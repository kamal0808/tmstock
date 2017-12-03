
<header class="main-header">

        <!-- Logo -->
        <a href="home.php" class="logo"><b>TMStock</b></a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
<!--              <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
              -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle menu-focus" data-toggle="dropdown">Orders<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li role="menuitem"><a href="addorders.php">Add Orders</a></li>
                  <li role="menuitem"><a href="vieworders.php">View/Edit Orders</a></li>
                  <li role="menuitem" class="divider"></li>
                  <li role="menuitem"><a href="addrentalsto.php">Add Rentals</a></li>
                  <li role="menuitem"><a href="viewrentalsto.php">View Rentals</a></li>
<!--                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>-->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle menu-focus" data-toggle="dropdown">Items/Stocks<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="additems.php">Add Items</a></li>
                  <li><a href="viewitems.php">View/Manage Items</a></li>
                  <li><a href="#">Delete Items</a></li>
<!--                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>-->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle menu-focus" data-toggle="dropdown">Customers<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="addcustomers.php">Add Customers</a></li>
                  <li><a href="viewcustomers.php">View/Edit Customers</a></li>
                  <li><a href="#">Delete Customers</a></li>
<!--                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>-->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle menu-focus" data-toggle="dropdown">Purchases<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li role="menuitem"><a href="addpurchase.php">Add Purchase</a></li>
                  <li role="menuitem"><a href="viewpurchase.php">View/Edit Purchases</a></li>
                  <li role="menuitem" class="divider"></li>
                  <li role="menuitem"><a href="addrentalsfrom.php">Add Rentals</a></li>
                  <li role="menuitem"><a href="viewrentalsfrom.php">View Rentals</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle menu-focus" data-toggle="dropdown">Suppliers<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li role="menuitem"><a href="addsuppliers.php">Add Suppliers</a></li>
                  <li role="menuitem"><a href="viewsuppliers.php">View/Edit Suppliers</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle menu-focus" data-toggle="dropdown">Godowns/Venues<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="godowns.php">Manage Godowns/Venues</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle menu-focus" data-toggle="dropdown">Managers<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="managers.php">Managers</a></li>
                </ul>
              </li>
              
            </ul>
<!--            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
              </div>
            </form>-->
            <ul class="nav navbar-nav navbar-right">
<!--              <li><a href="#">Settings</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account Managers<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Manage Accounts</a></li>
                  <li><a href="#">Manage Passwords</a></li>
                  <li class="divider"></li>
<!--                  <li><a href="#">Logout</a></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>-->
              <li><a class="logout-menu" href="logout.php">Logout</a></li>
            </ul>
          </div>
          
          <!-- Navbar Right Menu -->
<!--          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               Messages: style can be found in dropdown.less
              <li class="dropdown messages-menu">
                 Menu toggle button 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                     inner menu: contains the messages 
                    <ul class="menu">
                      <li> start message 
                        <a href="#">
                          <div class="pull-left">
                             User Image 
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                           Message title and timestamp 
                          <h4>                            
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                           The message 
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li> end message                       
                    </ul> /.menu 
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> /.messages-menu 

               Notifications Menu 
              <li class="dropdown notifications-menu">
                 Menu toggle button 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                     Inner Menu: contains the notifications 
                    <ul class="menu">
                      <li> start notification 
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li> end notification                       
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
               Tasks Menu 
              <li class="dropdown tasks-menu">
                 Menu Toggle Button 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                     Inner menu: contains the tasks 
                    <ul class="menu">
                      <li> Task item 
                        <a href="#">
                           Task title and progress text 
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                           The progress bar 
                          <div class="progress xs">
                             Change the css width attribute to simulate progress 
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li> end task item                       
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
               User Account Menu 
              <li class="dropdown user user-menu">
                 Menu Toggle Button 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                   The user image in the navbar
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                   hidden-xs hides the username on small devices so only the image appears. 
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu">
                   The user image in the menu 
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                   Menu Body 
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                   Menu Footer
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>-->
        </nav>
      </header>