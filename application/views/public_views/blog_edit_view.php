
<script type="text/javascript" src="<?php echo site_url('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript">
	tinymce.init({
		selector: '#blog_content',  // change this value according to your HTML
		setup: function(editor){
			editor.on('change',function(){
				editor.save();
			});
		},
		skin: 'lightgray',
		height: '400px',
		plugins: 'link image code advlist colorpicker',
	}); 
</script>

<div class="col-md-12">
<blockquote><span class="glyphicon glyphicon-plus"></span>Edit Blog Entry</blockquote>
<div id="blog-alert-msg"></div>
<?php echo form_open('public_site/blog_updated','id="blog_form"'); ?>
	<?php foreach($query as $row): ?>
		<input type="hidden" name="blog_id" value="<?php echo $row->blog_id; ?>">
		<input type="hidden" name="author_id" value="<?php echo $row->author_id; ?>">
	  	<input type="text" class="form-control" value="<?php echo $row->title; ?>" name="blogtitle" id="blogtitle"><p>
	  	<!-- list of category -->
		<div class="form-group">
			<div class="input-group">
		        <span class="input-group-addon" id="basic-addon3">Posted under</span>
		        <?php
		          $category = array(
		                        '1' => 'Uncategorized',
		                        '2' => 'General',
		                        '3' => 'Tutorials and Resources',
		            );
		        ?>
		        <?php echo form_dropdown('category',$category,$row->category_id,'id="category"'); ?>
	      </div>
		</div>
	    <textarea id="blog_content" name="blog_content"><?php echo $row->content; ?></textarea>
	  	<input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date_of_publish" id="date_of_publish"/>
	  	<input type="button" class="btn btn-primary" value="Update Post" id="submitBlog"/>&nbsp;
	  	<a href="<?php echo site_url('public_site/blog/').'/'.$row->blog_id; ?>" class="btn btn-default" id="showMyBlogbtn" style="display:none;">Go to my blog list</a>
	<?php endforeach; ?>
<?php echo form_close(); ?>  
</div>


<script type="text/javascript">
$('#submitBlog').click(function(){
	var blogData = $('#blog_form').serialize();

	$.ajax({
		url: "<?php echo site_url('public_site/blog_updated'); ?>",
		type: 'POST',
		data: blogData,
		success: function(result){
			if(result == 'ADDED')
			{
				$('#blog-alert-msg').html('<div class="alert alert-success text-center">Blog post was updated!</div>');
				$('#title').attr("disabled","disabled");
				$('#blog_content').attr("disabled","disabled");
				$('#submitBlog').attr("disabled","disabled");
				$('#showMyBlogbtn').show();
			}
			else if(result == 'NO')
		    {
		        $('#blog-alert-msg').html('<div class="alert alert-danger text-center">Error in adding new user!</div>');
		    }
		    else
		    {
		        $('#blog-alert-msg').html('<div class="alert alert-danger">' + result + '</div>');
		    }
		}
	});
});
</script>