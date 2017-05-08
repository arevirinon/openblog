<style type="text/css">
#role, #status{
       border: 0 !important;             /*Removes border*/
      -webkit-appearance: none;            /*Removes default chrome and safari style*/
      -moz-appearance: none;             /* Removes Default Firefox style*/
      width: 70%;                /*Width of select dropdown to give space for arrow image*/
      text-indent: 0.01px;          /* Removes default arrow from firefox*/
      text-overflow: "";               /*Removes default arrow from firefox*/
}
</style>
<?php
foreach($query as $row):
?>
<?php echo form_open('admin/update_user','id="update_form"'); ?>

<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><b>Account Details for <b><u><?php echo $row->firstname . ' ' . $row->lastname; ?></u></b></div>
  <div class="panel-body" id="alert-msg2">
    
  </div>
  <!-- List group -->
  <ul class="list-group">
    <li class="list-group-item">
      <div class="input-group">
        <input type="hidden" name="author_id" id="author_id" value="<?php echo $row->author_id; ?>">
        <span class="input-group-addon" id="basic-addon3">First Name</span>
        <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="basic-addon3" value="<?php echo $row->firstname; ?>">
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Last Name</span>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="basic-addon3" value="<?php echo $row->lastname; ?>">
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Username</span>
        <input type="text" class="form-control" name="username" id="username" aria-describedby="basic-addon3" value="<?php echo $row->username; ?>">
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Email Address</span>
        <input type="text" class="form-control" name="email_address" id="email_address" aria-describedby="basic-addon3" value="<?php echo $row->email_address; ?>">
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Website</span>
        <input type="text" class="form-control" name="website" id="website" aria-describedby="basic-addon3" value="<?php echo $row->website; ?>">
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Role&nbsp;&nbsp;</span>
        <?php
          $role_list = array(
                        '1' => 'Public Author',
                        '2' => 'Administrator'
            );
        ?>
        <?php echo form_dropdown('role',$role_list,$row->role,'id="role"'); ?>
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Status</span>
        <?php
          $status_list = array(
                        '1' => 'Confirmation Pending / Inactive',
                        '2' => 'Active User Account'
            );
        ?>
        <?php echo form_dropdown('status',$status_list,$row->status,'id="status"'); ?>
      </div>
    </li>
    <li class="list-group-item">
      <!-- <button class="btn btn-primary btn-lg" id="register" name="submit"><span class="glyphicon glyphicon-hand-right"></span> Register</button> -->
      <input class="btn btn-primary" id="update_user" name="submit" type="button" value="Update User" />
      <a href="<?php echo site_url('admin/users');?>" class="btn btn-default">Go back to list</a>
    </li>
  </ul>
</div>
<?php echo form_close(); ?>
<?php endforeach; ?>

<script type="text/javascript">
$('#update_user').click(function(){
  var form_data = $('#update_form').serialize();
  console.log(form_data);

  $.ajax({
    url: "<?php echo site_url('admin/update_user'); ?>",
    type: "POST",
    data: form_data,
    success: function(msg){
      if(msg == "YES")
      {
          $('#alert-msg2').html('<div class="alert alert-success text-center">User updated!</div>');
          $('#firstname').attr("disabled", "disabled");
          $('#lastname').attr("disabled", "disabled"); 
          $('#email_address').attr("disabled", "disabled"); 
          $('#username').attr("disabled", "disabled"); 
          $('#password1').attr("disabled", "disabled"); 
          $('#password2').attr("disabled", "disabled"); 
          $('#update_user').attr("disabled", "disabled");
          $('#website').attr("disabled", "disabled");
          $('#role').attr("disabled", "disabled");
          $('#status').attr("disabled", "disabled");      
      }
      else if(msg == 'NO')
      {
        $('#alert-msg2').html('<div class="alert alert-danger text-center">Error in updating user!</div>');
      }
      else
      {
        $('#alert-msg2').html(msg);
      }
    }
  });
});
</script>