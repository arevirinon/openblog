<style type="text/css">
textarea.form-control {
  width: 100%;
}
</style>

<?php foreach($query as $row): ?>
	<?php
		$loggedusername = $this->session->userdata('username');
		$postedBy = $row->username; 
	?>
  <div class="blog-post">
    <h2 class="blog-post-title">
    	<a href="<?php echo base_url() . 'public_site/blog/' . $row->blog_id;?>"><?php echo $row->title; ?></a>
    	<?php if($loggedusername === $postedBy): ?>
    		<a href="<?php echo base_url() . 'public_site/blog_edit/'.$row->blog_id; ?>" class="btn btn-default">Edit Post</a>
    	<?php endif; ?>
    </h2>
    <p class="blog-post-meta"><?php echo date('F d, Y',strtotime($row->date_of_publish));?> by <a href="#"><?php echo $row->firstname . ' ' . $row->lastname; ?></a></p>
      <blockquote><?php echo $row->content; ?></blockquote>
    <p class="blog-post-meta"> <i class="fa fa-newspaper-o" aria-hidden="true"></i> Posted under <b><a href="<?php echo base_url() . 'public_site/category/'.$row->category_id;?>"><?php echo $row->category_desc; ?></a></b> category</p>
  </div><!-- /.blog-post -->

<div class="well well-sm"><a href="#" id="show_comments">
	 Show <span class="badge"><?php echo $get_comment_num; ?></span> Comments</a> | <a href="#" id="show_comment_field">Add Comment</a>
</div>

<!-- comment form -->
<div id="comment_field" style="display:none;">
<div id="comment_alert_msg"></div>
<?php echo form_open('public_site/blog_comment_submit','id="blog_comment_form"'); ?>
	<input type="hidden" name="blog_id" id="blog_id" value="<?php echo $row->blog_id; ?>">
	  <?php  
	  // if logged in, name input will be session useranme
	  	if(isset($loggedusername)):
	  ?>
	<div class="input-group">
	  <span class="input-group-addon" id="basic-addon3">Logged in as: </span>
	  	<input type="text" class="form-control" id="comment_username" name="comment_username" aria-describedby="basic-addon3" readonly value="<?php echo $loggedusername; ?>">
	</div>
	<?php else: ?>
	<div class="input-group">
	  <span class="input-group-addon" id="basic-addon3">Your Name: </span>
	  	<input type="text" class="form-control" id="comment_username" name="comment_username" aria-describedby="basic-addon3">
	</div>
	<?php endif; ?>
	  <br>
	<textarea class="form-control" rows="8" placeholder="Your Comment Here" id="comment_text" name="comment_text"></textarea>
	<br>
	<input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="comment_date">
	<input type="button" class="btn btn-primary btn-lg" name="comment_form_btn" id="comment_form_btn" value="Post Comment" />
	<a href="<?php echo site_url('public_site/'); ?>" id="backtohomepage" class="btn btn-default btn-lg"style="display:none;">Go back to Home Page</a>
<?php echo form_close(); ?>
</div>

<?php endforeach; //blogpost ?>

<br>
<!-- comments tab -->
<div id="comments_tab" style="display:none;">
<?php foreach($comments as $comment): ?>
<div class="panel panel-default panel-sm">
  <div class="panel-heading"><b><?php echo $comment->comment_username; ?></b> on <?php echo date('M d, Y',strtotime($comment->comment_date)); ?></div>
  <div class="panel-body">
    <?php echo $comment->comment_text; ?>
  </div>
</div>
<?php endforeach; ?>
</div>

<script type="text/javascript">
$('#show_comments').click(function(){
	$('#comments_tab').toggle("slow");
});

$('#show_comment_field').click(function(){
	$('#comment_field').toggle("slow");
});

$('#comment_form_btn').click(function(){
	var comment_fields = $('#blog_comment_form').serialize();

	$.ajax({
		url: "<?php echo site_url('public_site/blog_comment_submit'); ?>",
		type: "POST",
		data: comment_fields,
		success: function(result)
		{
			if(result == 'COMMENTSUBMIT')
			{
				$('#comment_alert_msg').html('<div class="alert alert-success">Your comment was successfully posted!</div>');
				//$('#comments_tab').html();
				location.reload();
			}
			else
			{
				$('#comment_alert_msg').html('<div class="alert alert-danger">' + result + '</div>');
			}
		}
	});
});
</script>
