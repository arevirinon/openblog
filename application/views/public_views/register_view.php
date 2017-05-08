<?php echo form_open('public_site/register_submit','id="reg_form"'); ?>

<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><b>Register for an account</b> <i class="fa fa-user-plus" aria-hidden="true"></i></div>
  <div class="panel-body" id="alert-msg2">
    <span class="glyphicon glyphicon-info-sign"></span>&nbsp;Fields marked with * are required
  </div>
  <!-- List group -->
  <ul class="list-group">
    <li class="list-group-item">
      <input type="text" class="form-control" placeholder="First Name *" name="rfirstname" id="rfirstname">
    </li>
    <li class="list-group-item">
      <input type="text" class="form-control" placeholder="Last Name *" name="rlastname" id="rlastname">
    </li>
    <li class="list-group-item">
      <input type="text" class="form-control" placeholder="Email Address *" name="remail_address" id="remail_address">
    </li>
    <li class="list-group-item">
      <input type="text" class="form-control" placeholder="Username *" name="rusername" id="rusername">
    </li>
    <li class="list-group-item">
      <input type="text" class="form-control" placeholder="Password *" name="rpassword1" id="rpassword1">
    </li>
    <li class="list-group-item">
      <input type="text" class="form-control" placeholder="Confirm Password *" name="rpassword2" id="rpassword2">
    </li>
    <li class="list-group-item">
      Your Website <div class="input-group">
                  <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
                  <input type="text" class="form-control" name="rwebsite" id="rwebsite" aria-describedby="basic-addon3">
                  <input type="hidden" name="rrole" id="rrole" value="1">
                  <input type="hidden" name="rstatus" id="rstatus" value="1">
                </div>
    </li>
    <li class="list-group-item">
      <!-- <button class="btn btn-primary btn-lg" id="register" name="submit"><span class="glyphicon glyphicon-hand-right"></span> Register</button> -->
      <!-- <input class="btn btn-primary btn-block" id="register" name="submit" type="post" value="Sign me up" /> -->
      <button class="btn btn-primary btn-block" id="register" name="submit"><i class="fa fa-users" aria-hidden="true"></i> Sign me up</button>
    </li>
  </ul>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
$('#register').click(function(){

  var form_data = $('#reg_form').serialize();

  $.ajax({
    url: "<?php echo site_url('public_site/register_submit'); ?>",
    type: 'POST',
    data: form_data,
    success: function(msg) {
      if(msg == 'YES')
      {
        $('#alert-msg2').html('<div class="alert alert-success text-center">You have successfully registered. Please wait for an email message from the Administrator regarding your account status.</div>');
        $('#rfirstname').attr("disabled", "disabled");
        $('#rlastname').attr("disabled", "disabled"); 
        $('#remail_address').attr("disabled", "disabled"); 
        $('#rusername').attr("disabled", "disabled"); 
        $('#rpassword1').attr("disabled", "disabled"); 
        $('#rpassword2').attr("disabled", "disabled"); 
        $('#rwebsite').attr("disabled", "disabled"); 
        $('#register').attr("disabled", "disabled"); 
      }     
      else if(msg == 'NO')
      {
        $('#alert-msg2').html('<div class="alert alert-danger text-center">Error in adding new user!</div>');
      }
      else
      {
        $('#alert-msg2').html('<div class="alert alert-danger">' + msg + '</div>');
      }
    }
  });
  return false;
});
</script>