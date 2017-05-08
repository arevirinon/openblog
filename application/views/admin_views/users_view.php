<h2 class="sub-header">Authors Registered <a href="" data-toggle="modal" data-target="#addUser" class="btn btn-warning">Add User</a></h2>
<div class="table-responsive">
<table id="tableView" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <td>First Name</td><td>Last Name</td><td>Website</td><td>Username</td><td>Email Address</td><td>Role</td><td>Status</td><td>&nbsp;</td><td>&nbsp;</td>
    </tr>
  </thead>
  <tbody>
<?php foreach($query as $row): ?>
    <tr>
      <td><?php echo $row->firstname; ?></td>
      <td><?php echo $row->lastname; ?></td>
      <td><a href="<?php echo $row->website; ?>" target="_blank"><?php echo $row->website; ?></a></td>
      <td><?php echo $row->username; ?></td>
      <td><?php echo $row->email_address; ?></td>
      <td><?php echo $row->role_desc; ?></td>
      <td><?php echo $row->status; ?></td>
      <td><a href="<?php echo base_url().'admin/view_user/'.$row->author_id; ?>" class="btn btn-primary">View/Edit</a></td>
      <td><a href="<?php echo base_url() . 'admin/delete_user/'.$row->author_id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<!-- add user modal form -->
<div id="addUser" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "contact_form", "id" => "contact_form");
            echo form_open("admin/new_user", $attributes);?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Contact Form</h4>
            </div>
            <div class="modal-body" id="myModalBody">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input class="form-control" id="firstname" name="firstname" placeholder="First Name" type="text" value="<?php echo set_value('firstname'); ?>" />
                </div>

                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input class="form-control" id="lastname" name="lastname" placeholder="Last Name" type="text" value="<?php echo set_value('lastname'); ?>" />
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" id="username" name="username" placeholder="Username" type="text" value="<?php echo set_value('username'); ?>" />
                </div>

                <div class="form-group">
                    <label for="password1">Password</label>
                    <input class="form-control" id="password1" name="password1" placeholder="Password" type="text" value="<?php echo set_value('password1'); ?>" />
                </div>


                <div class="form-group">
                    <label for="password2">Confirm Password</label>
                    <input class="form-control" id="password2" name="password2" placeholder="Confirm Password" type="text" value="<?php echo set_value('password2'); ?>" />
                </div>


                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input class="form-control" id="email_address" name="email_address" placeholder="Email Address" type="text" value="<?php echo set_value('email_address'); ?>" />
                </div>

                <div class="form-group">
                  <label for="email">Site Role</label>
                  <select name="role" class="btn btn-primary dropdown-toggle" id="role">
                    <option value="1">Public Author</option>
                    <option value="2">Registered Admin User</option>
                  </select>

                    <label for="email">Status</label>
                    <select name="status" class="btn btn-primary dropdown-toggle" id="status">
                      <option value="1">Active</option>
                      <option value="2">Inactive / Pending</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Website</label>
                    <input class="form-control" id="website" name="website" placeholder="This is optional" type="text" value="<?php echo set_value('website'); ?>" />
                </div>

                <div id="alert-msg"></div>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary" id="submit" name="submit" type="button" value="Add User" />
                <a href="<?php echo site_url('admin/users'); ?>" class="btn btn-default">Go back to Users Page</a>
            </div>
            <?php echo form_close(); ?>            
        </div>
    </div>
</div>

<!-- pagination -->
<div class="text-center"><?php echo $this->pagination->create_links(); ?></div>

<script type="text/javascript">
$('#submit').click(function(){
  var form_data = {
    firstname: $('#firstname').val(),
    lastname: $('#lastname').val(),
    email_address: $('#email_address').val(),
    username: $('#username').val(),
    password1: $('#password1').val(),
    password2: $('#password2').val(),
    website: $('#website').val(),
    role: $('#role').val(),
    status: $('#status').val(),
  };

  $.ajax({
    url: "<?php echo site_url('admin/add_user'); ?>",
    type: 'POST',
    data: form_data,
    success: function(msg) {
      if(msg == 'YES')
      {
        $('#alert-msg').html('<div class="alert alert-success text-center">New User has been successfully added!</div>');
        $('#firstname').attr("disabled", "disabled");
        $('#lastname').attr("disabled", "disabled"); 
        $('#email_address').attr("disabled", "disabled"); 
        $('#username').attr("disabled", "disabled"); 
        $('#password1').attr("disabled", "disabled"); 
        $('#password2').attr("disabled", "disabled"); 
        $('#website').attr("disabled", "disabled"); 
        $('#role').attr("disabled", "disabled"); 
        $('#status').attr("disabled", "disabled");  
        $('#submit').attr("disabled", "disabled"); 
      }     
      else if(msg == 'NO')
      {
        $('#alert-msg').html('<div class="alert alert-danger text-center">Error in adding new user!</div>');
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