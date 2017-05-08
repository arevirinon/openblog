<div class="jumbotron">
<?php foreach($query as $row): ?>
	<h2><?php echo $row->firstname . ' ' . $row->lastname; ?> <a href="#" id="showUpdateBtn" data-toggle="tooltip" title="Click to update your profile"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></h2>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><b></b></div>
  <div class="panel-body" id="alert-msg2">
    You have <span class="badge"><?php echo $my_blog_posts; ?> blog posts. </span> You are registered as <b><?php echo $row->role_desc; ?></b>
    
  </div>
  <div id="profile_edit_message"></div>

  <!-- List group -->
  <form action="<?php echo base_url() . 'admin/saveProfile'; ?>" method="POST" id="updateProfile">
    <ul class="list-group">
      <li class="list-group-item">
        <div class="input-group">
          <input type="hidden" name="author_id" id="author_id" value="<?php echo $row->author_id; ?>">
          <span class="input-group-addon" id="basic-addon3">First Name</span>
          <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="basic-addon3" value="<?php echo $row->firstname; ?>" id="firstname" readonly>
        </div>
      </li>
      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Last Name</span>
          <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="basic-addon3" value="<?php echo $row->lastname; ?>" readonly>
        </div>
      </li>
      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Username</span>
          <input type="text" class="form-control" name="username" id="username" aria-describedby="basic-addon3" value="<?php echo $row->username; ?>" readonly>
        </div>
      </li>
      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Email Address</span>
          <input type="text" class="form-control" name="email_address" id="email_address" aria-describedby="basic-addon3" value="<?php echo $row->email_address; ?>" readonly>
        </div>
      </li>
      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Website</span>
          <input type="text" class="form-control" name="website" id="website" aria-describedby="basic-addon3" value="<?php echo $row->website; ?>" readonly>
        </div>
      </li>
      <li class="list-group-item">
        <!-- <button class="btn btn-primary btn-lg" id="register" name="submit"><span class="glyphicon glyphicon-hand-right"></span> Register</button> -->
        <button class="btn btn-info btn-lg" id="saveBtn"  disabled="disabled"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</button>
      </li>
    </ul>
  </form>
</div>
<?php endforeach; ?>
</div>


<style type="text/css">

</style>
<script type="text/javascript">
$(document).ready(function(){
  $('#showUpdateBtn').click(function(){
    $('#saveBtn').removeAttr("disabled");
    $('#firstname').removeAttr("readonly");
    $('#lastname').removeAttr("readonly");
    $('#email_address').removeAttr("readonly");
    $('#website').removeAttr("readonly");
  });
});

$('#saveBtn').click(function(){
  var profileChange = $('#updateProfile').serialize();

  $.ajax({
    url: "<?php echo base_url() . 'admin/saveProfile'; ?>",
    type: "POST",
    data: profileChange,
    success: function(result){
      if(result == "UPDATED"){
        $('#profile_edit_message').html('<div class="alert alert-success">Your profile has been updated! Please wait...<i class="fa fa-spinner fa-spin fa-fw"></i></div>');
        window.location.reload();
      }
      else{
        $('#profile_edit_message').html('<div class="alert alert-danger">' + result + '</div>');
      }
    }
  });
  return false;
});

</script>