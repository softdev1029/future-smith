<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">

      <!-- search -->
      <li class="sidebar-search">
        <div class="input-group custom-search-form">
          <input type="text" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <i class="fa fa-search"></i>
          </button>
        </span>
        </div>
      </li>

      <!-- dashboard -->
      <li>
        <a href='{{ route('admin.dashboard') }}'><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
      </li>

      <!-- users -->
      <li>
        <a href='{{ route('admin.user.list') }}'><i class="fa fa-bar-chart-o fa-fw"></i> Users</a>
      </li>

      <!-- tribes -->
      <li>
        <a href='{{ route('admin.tribe.list') }}'><i class="fa fa-table fa-fw"></i> Tribes</a>
      </li>

      <!-- projects -->
      <li>
        <a href='{{ route('admin.project.list') }}'><i class="fa fa-tasks fa-fw"></i> Projects</a>
      </li>

      <!-- discussions -->
      <li>
        <a href='{{ route('admin.discussion.list') }}'><i class="fa fa-discuss fa-fw"></i> Discussions</a>
      </li>

      <!-- messages -->
      <li>
        <a href='{{ route('admin.dashboard') }}'><i class="fa fa-envelope fa-fw"></i> Messages</a>
      </li>

      <!-- notifications -->
      <li>
        <a href='{{ route('admin.notification.list') }}'><i class="fa fa-bell fa-fw"></i> Notifications</a>
      </li>

      <!-- payment transactions -->
      <li>
        <a href='{{ route('admin.dashboard') }}'><i class="fa fa-edit fa-fw"></i> Payment Transactions</a>
      </li>

      <!-- settings -->
      <li>
        <a href='{{ route('admin.dashboard') }}'><i class="fa fa-edit fa-fw"></i> Settings</a>
      </li>
    </ul>
  </div>
  <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
