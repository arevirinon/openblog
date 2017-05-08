<?php
$blogtitle = '&copy OpenBlog';
$blogdesc = 'An open source blogging platform for everybody.';
?>
  <body>

    <div class="blog-masthead navbar-fixed-top">
    <div class="container-fluid">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item <?php if(isset($active) && $active == 'menu1') echo 'active'; ?>" href="<?php echo site_url('public_site/'); ?>">Home</a>
          <a class="blog-nav-item <?php if(isset($active) && $active == 'menu5') echo 'active'; ?>" href="<?php echo site_url('public_site/blogs'); ?>">Blogs</a>
          <a class="blog-nav-item <?php if(isset($active) && $active == 'menu2') echo 'active'; ?>" href="<?php echo site_url('public_site/archives');?>">Archives</a>
          <a class="blog-nav-item <?php if(isset($active) && $active == 'menu3') echo 'active'; ?>" href="<?php echo site_url('public_site/about');?>">About</a>
          <a class="blog-nav-item <?php if(isset($active) && $active == 'menu4') echo 'active'; ?>" href="<?php echo site_url('public_site/contact');?>">Contact</a>
       
          <?php if($this->session->userdata('is_logged_in') == 1 || $this->session->userdata('is_logged_in_admin') == 1): ?>
          <div class="btn-group">
            <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Welcome, <?php echo $this->session->userdata('username'); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('public_site/authors'); ?>">Go to my Page</a></li>
              <li><a href="<?php echo site_url('public_site/logout'); ?>">Logout</a></li>
            </ul>
          </div>
          <?php else: ?>
          <a class="blog-nav-item" href="#" data-toggle="modal" data-target="#addUser">Author's Panel</a>
          <?php endif; ?>
          <?php //if($this->session->userdata('is_logged_in_admin') == 1): ?>
          <!--  <a class="blog-nav-item <?php if(isset($active) && $active == 'menu4') echo 'active'; ?>" href="<?php echo site_url('admin/');?>">cPanel</a> -->
          <?php //endif; ?>
        </nav>
      </div>
    </div>
    </div>
    <br>
    <div class="container">

      <div class="blog-header">
        <!-- <h1 class="blog-title"><?php echo $blogtitle; ?></h1> -->
        <h1 class="blog-title"><img id="bannerImg" src="<?php echo base_url() . 'assets/img/logo2.png';?>" alt="OpenBlog" /></h1>
        <!-- <p class="lead blog-description"><?php echo $blogdesc; ?></p> -->
      </div>
      <hr class="style-seven">
      <div class="row">

        <div class="col-sm-8 blog-main">

          <!-- login modal form -->
          <div id="addUser" class="modal fade" aria-hidden="true" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <?php $attributes = array("name" => "contact_form", "id" => "contact_form");
                      echo form_open("public_site/validate_login", $attributes);?>

                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title">Welcome to OpenBlog</h4>
                      </div>
                      <div class="modal-body" id="myModalBody">
                      <div id="alert-msg"></div>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus><br>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

                          
                      </div>
                      <div class="modal-footer">
                          <button class="btn btn-primary btn-lg" id="submit" name="submit"><span class="glyphicon glyphicon-ok"></span> Log in</button>
                          <button class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                      </div>
                      <div class="modal-footer">
                          Want to be part of OpenBlog Authors?
                          <a href="<?php echo site_url('public_site/register'); ?>" class="btn btn-success btn-md">
                            <span class="glyphicon glyphicon-hand-right"></span> Register for an account 
                          </a>
                      </div>
                      <?php echo form_close(); ?>            
                  </div>
              </div>
          </div>

<script type="text/javascript">
$('#submit').click(function(){
  var form_data = {
    username: $('#username').val(),
    password: $('#password').val()
  };

  $.ajax({
    url: "<?php echo site_url('public_site/validate_login'); ?>",
    type: 'POST',
    data: form_data,
    success: function(msg){
      if(msg == 'YES')
      {
        //$('#alert-msg').html('<div class="alert alert-default text-center">You are now logged in. Redirecting..</div>');
        $('#alert-msg').html('<div class="alert alert-default text-center">You are now logged in. Redirecting..<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span></div>');
        window.setTimeout(function(){
          window.location.href = "<?php echo site_url('public_site'); ?>";
        }, 3000);
      }
      else if(msg == 'NO')
      {
        $('#alert-msg').html('<div class="alert alert-danger text-center">Cannot login at the moment.</div>');
      }
      else
      {
        $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
      }
    }
  });
  return false;
});
</script>

