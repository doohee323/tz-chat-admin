<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html>
<head>
<title>Tz Chat Admin</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Font Awesome -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<!-- build:css(.) styles/vendor.css -->
<!-- bower:css -->
<!-- endbower -->
<!-- endbuild -->
<!-- build:css(.tmp) styles/main.css -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
<link rel="stylesheet" href="styles/sweet-alert.css">
<!-- endbuild -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">

	<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/main" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Tz</b>Chat</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Tz-Chat</b> Admin</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <!-- The message -->
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{main}}" onerror='onImgError(this);' class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{nickname}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{main}}" onerror='onImgError(this);' class="img-circle" alt="User Image">

                <p>
                  {{nickname}} - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
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

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{main}}" onerror='onImgError(this);' class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{nickname}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Admin Page</li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Chatting Manage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a ui-sref="sht.chatlist({status: 'all'})">Chatting List</a></li>
            <li><a ui-sref="sht.chatlist({status: 'request'})">Chatting Request List</a></li>
            <li><a ui-sref="aaaa">신고List</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Manager Page</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a ui-sref="aaaa">Manager Manage</a></li>
            <li><a ui-sref="sht.userlist">User Manage</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Pay Manage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a ui-sref="sht.paystats">Pay Stats</a></li>
            <li><a ui-sref="sht.paylist">Pay List</a></li>
          </ul>
        </li>        
        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>StatsManage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a ui-sref="aaaa">Daily Access Stats</a></li>
            <li><a ui-sref="aaaa">Access Path Analysis</a></li>
            <li><a ui-sref="aaaa">Point log</a></li>
          </ul>
        </li>                   
        
        <li class="active"><a ui-sref="sht.chatlist({status: 'all'})"><i class="fa fa-link"></i> <span>Chat List</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tz-Chat Admin
        <small>Tools</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
			<!-- ?php include_once(APPPATH.'views/cm/app/includes/notifications.php'); ?-->

			<!-- BEGIN MAIN CONTENT -->
		  <?php echo $content; ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
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
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
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
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID -->
	<script>
    !function(A, n, g, u, l, a, r) {
      A.GoogleAnalyticsObject = l, A[l] = A[l] || function() {
        (A[l].q = A[l].q || []).push(arguments)
      }, A[l].l = +new Date, a = n.createElement(g), r = n
          .getElementsByTagName(g)[0], a.src = u, r.parentNode.insertBefore(a,
          r)
    }(window, document, 'script',
        'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');
  </script>

	<script type="text/javascript">
//     var socketUrl = document.location.protocol + '//'
//         + document.location.hostname + ':3002' + '/socket.io/socket.io.js';
//     document.write('\x3Cscript src="' + socketUrl + '">\x3C/script>');
  </script>

	<!-- build:js(.) scripts/vendor.js -->
	<!-- bower:js -->
	<script src="bower_components/jquery/dist/jquery.js"></script>
	<script src="bower_components/underscore/underscore.js"></script>
	<script src="bower_components/moment/moment.js"></script>
	<script src="bower_components/lz-string/libs/lz-string.min.js"></script>
	<!-- endbower -->
	<!-- endbuild -->

<!-- 	<script src="bootstrap/js/bootstrap.min.js"></script> -->
	<script src="scripts/libs/underscore.js"></script>
	<!--     <script src="scripts/libs/moment.js"></script> -->
	<script src="scripts/libs/sweet-alert.min.js"></script>
	<script src="scripts/libs/moment-with-locales.min.js"></script>

	<!-- build:js({.tmp,app}) scripts/scripts.js -->
<!-- 	<script src="scripts/utils/utils.js"></script> -->
<!-- 	<script src="scripts/app.js"></script> -->
<!-- 	<script src="scripts/utils/storage.js"></script> -->
<!-- 	<script src="scripts/utils/commcd.js"></script> -->
<!-- 	<script src="scripts/utils/page.js"></script> -->
<!-- 	<script src="scripts/services/socket_service.js"></script> -->
<!-- 	<script src="scripts/controllers/base.js"></script> -->
<!-- 	<script src="scripts/controllers/main.js"></script> -->
<!-- 	<script src="scripts/controllers/login.js"></script> -->
	<script src="dist/js/app.js"></script>
	
<!-- 	<script src="scripts/controllers/chatlist.js"></script> -->
<!-- 	<script src="scripts/controllers/userlist.js"></script> -->
<!-- 	<script src="scripts/controllers/paylist.js"></script> -->
	
	<!-- endbuild -->

</body>
</html>


