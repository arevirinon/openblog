
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">OpenBlog | Admin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('/'); ?>" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> Public Site</a></li>
            <li><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a></li>
            <li><a href="<?php echo site_url('admin/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="<?php if(isset($active) && $active == 'menu1') echo 'active'; ?>">
              <a href="<?php echo site_url('admin/'); ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> Dashboard</a>
            </li>
            <li class="<?php if(isset($active) && $active == 'menu2') echo 'active'; ?>">
              <a href="<?php echo site_url('admin/blogs'); ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Blog Entries</a>
            </li>
            <li class="<?php if(isset($active) && $active == 'menu3') echo 'active'; ?>">
              <a href="<?php echo site_url('admin/users'); ?>"><i class="fa fa-users" aria-hidden="true"></i> Authors</a>
            </li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="<?php if(isset($active) && $active == 'menu5') echo 'active' ;?>">
              <a href="<?php echo base_url() .'admin/view_category'; ?>"><i class="fa fa-bars" aria-hidden="true"></i> Blog Categories</a>
            </li>
            <li class="<?php if(isset($active) && $active == 'menu6') echo 'active' ;?>">
              <a href="<?php echo base_url() .'admin/view_messages'; ?>"><i class="fa fa-comments" aria-hidden="true"></i> Messages</a>
            </li>
            <li class="<?php if(isset($active) && $active == 'menu4') echo 'active' ;?>">
              <a href="<?php echo base_url() .'admin/account/'.$this->session->userdata('username'); ?>"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
            </li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> 
