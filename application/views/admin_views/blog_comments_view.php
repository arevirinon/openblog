<?php if($query): ?>
<div id="comments_tab">
<?php foreach($query as $comment): ?>
<div class="panel panel-default">
  <div class="panel-heading"><b><?php echo $comment->comment_username; ?></b> on <?php echo date('M d, Y',strtotime($comment->comment_date)); ?></div>
  <div class="panel-body">
    <?php echo $comment->comment_text; ?>
  </div>
  <div class="panel-footer">
  	<a href="#" class="btn btn-default">Edit</a> <a href="<?php echo base_url().'admin/delete_blog_comment/'.$comment->comment_id;?>" class="btn btn-danger" id="delete">Delete</a>
  </div>
</div>
<?php endforeach; ?>
<a href="<?php echo site_url('admin/blogs'); ?>" class="btn btn-default">Go back</a>
</div>
<?php else: ?>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  This blog entry does not have any comments. <a href="<?php echo site_url('admin/blogs'); ?>" class="btn btn-default">Go back</a>
</div>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){

     $("#delete").click(function(e){
       alert("Delete this comment?");
         event.preventDefault(); 
         var href = $(this).attr("href");

        $.ajax({
          type: "GET",
          url: href,
          success: function(response) {

          if (response == "Success")
          {
             alert("Comment Deleted!");
             location.reload();
          }
          else
          {
            alert("Sorry, there seems to be a problem.");
          }

       }
    });

   });
  });
</script>