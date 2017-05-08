<script type="text/javascript" src="<?php echo site_url('assets/jquery/jquery2.js'); ?>"></script>
<div class="container">
    
    <div class="row vertical-offset-100">
      <div class="col-md-4 col-md-offset-4">
      <div>
      <img src="<?php echo base_url() . 'assets/img/logo2.png'; ?>">
    </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">OpenBlog | Admin</h3>
        </div>
          <div class="panel-body">
            <form action="<?php echo site_url('admin/validate_login'); ?>">
             <fieldset>
                <div class="form-group">
                  <input class="form-control" placeholder="Username" name="username" type="text" id="username">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" type="password" id="password">
              </div>
              <div id="alert-msg"></div>
              <input class="btn btn-lg btn-primary btn-block" id="submit" type="button" value="Login">
            </fieldset>
              </form>
          </div>
      </div>
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
    url: "<?php echo site_url('admin/validate_login');?>",
    type: 'POST',
    data: form_data,
    success: function(msg){
      if(msg == 'YES')
      {
        $('#alert-msg').html('<div class="alert alert-default text-center">Logged in! Redirecting...<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
        window.setTimeout(function(){
          window.location.href = "<?php echo site_url('admin/'); ?>";
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
});

</script>