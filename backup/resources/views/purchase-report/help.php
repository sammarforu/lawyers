@include("include.config")
<?php	
	$que="select * from general_settings";
	$run=@mysql_query($que);

	$row=@mysql_fetch_array($run);
	$system_title = $row['system_title'];
	$system_name = $row['system_name'];
	$footer_line = $row['footer_line'];
	$session = $row['session'];
	$company_name = $row['company_name'];
?>

<!DOCTYPE html>
<html>
  <head>
  @yield("head")
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <title><?php echo $system_name ?></title>
    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo $system_title ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" id="sidebar-toggle" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        <!-------------Session------------------>
            <ul class="nav navbar-nav">
				<li class="dropdown messages-menu">
					<a href="#">
					  <span style="font-size: 16px;color: azure;font-family: serif;margin-left: 30px;"><b>Running Session : <?php echo $session; ?></b></span>
					</a>
				  </li>
            </ul>
         
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
			  
			  
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="upload/users/{{ Auth::user()->image }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">
				  @if (!empty(Auth::user()->name))
					{{ Auth::user()->name }}
				  @else
					return Redirect('/login');
				  @endif
				  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="upload/users/{{ Auth::user()->image }}" class="img-circle" alt="User Image">
                    <p>
                       {{ Auth::user()->name }}
                      <small>{{ Auth::user()->email }}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="settings/{{ Auth::user()->id }}/edit" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div>
              <img src="dist/img/logo.png" id="logo" alt="User Image" style="width:133px;height: 60px;">
            </div>
		</div>


          <ul class="sidebar-menu">
            <!--<li class="header"><a href="">Dashboard</a></li>---->
			
			<li><a href="dashboard"><i class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span></a></li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Students</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="students/create"><i class="fa fa-circle-o"></i> Admit Student</a></li>
                <li>
                  <a href="students"><i class="fa fa-circle-o"></i> Student Information <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
				  <?php
					$que="select * from classes order by numeric_name ASC";
					$run=@mysql_query($que);

					while ($row=@mysql_fetch_array($run)) {
					$id = $row['id'];
					$class_name = $row['class_name'];
				  ?>
                    <li><a href="students/student-index/<?php echo $id; ?>"><i class="fa fa-circle-o"></i> <?php echo $class_name; ?></a></li>
                   <?php }?>
				  </ul>
                </li>
              </ul>
            </li>
			<li><a href="teachers"><i class="fa fa-user-plus"></i> <span>Teacher</span></a></li>
			<li><a href="parents"><i class="glyphicon glyphicon-user"></i> <span>Parents</span></a></li>
			<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-duplicate"></i> <span>Class</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="classes"><i class="fa fa-circle-o"></i> Manage Classes</a></li>
                <li><a href="syllabus"><i class="fa fa-circle-o"></i> Academic Syllabus</a></li>
              </ul>
            </li>
			<!--<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-book"></i><span>Subject</span>
				<i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				  <?php
					$que="select * from classes order by numeric_name ASC";
					$run=@mysql_query($que);

					while ($row=@mysql_fetch_array($run)) {
					$id = $row['id'];
					$class_name = $row['class_name'];
				  ?>
					<li><a href="/subjects/<?php echo $id; ?>"><i class="fa fa-circle-o"></i> <?php echo $class_name; ?></a></li>
				  <?php }?>
			 </ul>
            </li>--->
			<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-book"></i> <span>Subjects</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="subjects/create"><i class="fa fa-circle-o"></i> Add Subject</a></li>
                <li>
                  <a href="subjects"><i class="fa fa-circle-o"></i> Subjects Information <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
				   <?php
					$que="select * from classes order by numeric_name ASC";
					$run=@mysql_query($que);

					while ($row=@mysql_fetch_array($run)) {
					$id = $row['id'];
					$class_name = $row['class_name'];
				  ?>
					<li><a href="subjects/<?php echo $id; ?>"><i class="fa fa-circle-o"></i> <?php echo $class_name; ?></a></li>
				  <?php }?>
				  </ul>
                </li>
              </ul>
            </li>
						<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-remove-circle"></i> <span>Class Routine</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="routine/create"><i class="fa fa-circle-o"></i> Add Routine</a></li>
                <li>
                  <a href="routine"><i class="fa fa-circle-o"></i> Routine Information <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
				  <?php
					$que="select * from classes order by numeric_name ASC";
					$run=@mysql_query($que);

					while ($row=@mysql_fetch_array($run)) {
					$id = $row['id'];
					$class_name = $row['class_name'];
				  ?>
					<li><a href="routine/<?php echo $id; ?>"><i class="fa fa-circle-o"></i> <?php echo $class_name; ?></a></li>
				  <?php }?>
				  </ul>
                </li>
              </ul>
            </li>
			<!--<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-remove-circle"></i><span>Class Routine</span>
				<i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				  <?php
					$que="select * from classes order by id ASC";
					$run=@mysql_query($que);

					while ($row=@mysql_fetch_array($run)) {
					$id = $row['id'];
					$class_name = $row['class_name'];
				  ?>
					<li><a href="/routine/<?php echo $id; ?>"><i class="fa fa-circle-o"></i> <?php echo $class_name; ?></a></li>
				  <?php }?>
			 </ul>
            </li>--->
			<li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Attendance</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="attendance/create"><i class="fa fa-circle-o"></i> Daily Attendance</a></li>
				<li><a href="students/create"><i class="fa fa-circle-o"></i> Attendance Report</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-education"></i> <span>Exam</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="exam-lists"><i class="fa fa-circle-o"></i> Exam List</a></li>
                <li><a href="grades"><i class="fa fa-circle-o"></i> Exam Grades</a></li>
				<li><a href="exam-list"><i class="fa fa-circle-o"></i> Manage Marks</a></li>
                <li><a href="syllabus"><i class="fa fa-circle-o"></i> Send Marks By SMS</a></li>
				<li><a href="exam-list"><i class="fa fa-circle-o"></i> Tabulation Sheet</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-list-alt"></i> <span>Accounting</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="single-invoice"><i class="fa fa-circle-o"></i> Single Fee</a></li>
                <li><a href="mass-invoice/create"><i class="fa fa-circle-o"></i> Mass Fee</a></li>
				<li><a href="expense"><i class="fa fa-circle-o"></i> Expense</a></li>
                <li><a href="expense-catagory"><i class="fa fa-circle-o"></i> Expense Catagory</a></li>
              </ul>
            </li>
            <li><a href="dashboard"><i class="fa fa-calendar"></i> <span>Calendar</span> </a></li>
			<li><a href="library"><i class="fa fa-book"></i> <span>Library</span></a></li>
			<li><a href="noticeboard"><i class="glyphicon glyphicon-list-alt"></i> <span>Notice Board</span></a></li>
			<li><a href="transport"><i class="fa fa-bus"></i> <span>Transport</span></a></li>
			<li><a href="dormitory"><i class="glyphicon glyphicon-home"></i> <span>Dormitory</span></a></li>
			<li><a href="settings/{{ Auth::user()->id }}/edit"><i class="glyphicon glyphicon-wrench"></i> <span>Account Settings</span></a></li>
			<li><a href="general-settings/1/edit"><i class="glyphicon glyphicon-lock"></i> <span>General Settings</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

		<!-------Content Section----------->
		@yield("contents")
		
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b> Latest Version</b>
        </div>
        <strong>Developed By<a href="http://www.stechsofts.com/"> Stech Softs</a>.</strong>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div>
            </form>
          </div>
        </div>
      </aside>
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
	 </body>
</html> 
	@yield("scripts")    
	 <script src="/dist/js/app.min.js"></script>
	<script type="text/javascript">
		function checkDelete(id, resource, redirectUrl) {
		//resource = "http://localhost:8000" + resource;
		if (confirm('Are you sure you want to delete this record?')) {
		   var deleteToken = $("#hrefDelete").attr("data-token");
		   $.ajax({
			  type: "GET",
			  //data: {price_range: "100", _method: "DELETE", _token: "" + deleteToken + ""},
			  //data: {price_range: "100", _method: "DELETE", _token: "" + deleteToken + ""},
			  url: resource,
			  success: function(result) {
				alert(result);
				window.location.href = redirectUrl;
			  },
				error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			  }
			});
		  }
		}		

	$(document).ready(function(){
		$("#sidebar-toggle").click(function(){
		$("#logo").toggle();
	});
	});

</script>
