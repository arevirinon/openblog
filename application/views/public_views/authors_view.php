
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">My Profile</a></li>
  <li><a data-toggle="tab" href="#menu1">My Blog Posts</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <hr>
    Logged in as <strong><?php echo $this->session->userdata('username'); ?></strong> <a class="pull-right" href="#" data-toggle="tooltip" title="Click to edit your profile"><span class="glyphicon glyphicon-edit" id="editProfile"></span></a>
    <div id="profile_edit_message"></div>
    <!-- <form action="<?php echo base_url() . 'public_site/updateProfile'; ?>" method="POST" id="profileEditForm"> -->
    <?php echo form_open('public_site/updateProfile','id="profileEditForm"'); ?>
    <?php foreach($profile as $row): ?>   
    <input type="hidden" name="author_id" value="<?php echo $row->author_id; ?>">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">First Name</span>
        <input type="text" class="form-control" value="<?php echo $row->firstname; ?>" aria-describedby="basic-addon1" name="firstname" readonly>
        <span class="input-group-addon" id="basic-addon1">Last Name</span>
        <input type="text" class="form-control" value="<?php echo $row->lastname; ?>" aria-describedby="basic-addon1" name="lastname" readonly>
      </div>
      <p>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Website</span>
        <input type="text" class="form-control" value="<?php echo $row->website; ?>" aria-describedby="basic-addon1" name="website" readonly>
      </div>
      <p>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Email Address</span>
        <input type="text" class="form-control" value="<?php echo $row->email_address; ?>" aria-describedby="basic-addon1" name="email_address" readonly>
      </div>
      <?php endforeach; ?> 
      <p>
      <div class="input-group">
        <input type="button" name="submitProf" id="submitProf" class="btn btn-block btn-primary" value="Update Profile" disabled="disabled"> 
      </div>
<?php echo form_close(); ?>


  </div>
  <div id="menu1" class="tab-pane fade">
<!--- ************************************** POPULATE BLOG POSTS ************************************************ -->
    <hr>
    <div class="blog-post">
    <a href="<?php echo site_url('public_site/add_entry'); ?>" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus"></span>New Blog Post</a>
    <p></p>
    <?php if(!$query): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      Hello there! It seems like you haven't added a blog entry yet.
    </div>    
    <?php else: ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      Hello there! You have posted <strong><?php echo $get_blog_num; ?></strong> blog entries so far.
    </div>  

      <!--- table for blog posts -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Title</th>
            <th>Posted On</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($query as $row): ?>
          <tr>
            <td><a href="<?php echo base_url().'public_site/blog/'.$row->blog_id;?>" data-toggle="tooltip" title="<?php echo $row->title; ?>"><?php echo $row->title; ?></a></td>
            <td><?php echo date('M d, Y',strtotime($row->date_of_publish)); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    </div>    
  </div>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

$(document).ready(function()
{
   $('#editProfile').click(function()
   {
     $("input[name='firstname']").removeAttr("readonly");  
     $("input[name='lastname']").removeAttr("readonly");  
     $("input[name='username']").removeAttr("readonly");  
     $("input[name='website']").removeAttr("readonly");  
     $("input[name='email_address']").removeAttr("readonly");  
     $("input[name='submitProf']").removeAttr("disabled");
   });
 });


$('#submitProf').click(function(){
  var profileData = $('#profileEditForm').serialize();

  $.ajax({
    url: "<?php echo site_url('public_site/updateProfile'); ?>",
    type: "POST",
    data: profileData,
    success: function(result){
      if(result == 'UPDATED')
      {
        $('#profile_edit_message').html('<div class="alert alert-success">Your profile has been updated!</div>');
      }
      else
      {
        $('#profile_edit_message').html('<div class="alert alert-danger">'+ result + '</div>');
      }
    }
  });
  return false;
});
</script>