
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
<blockquote><span class="glyphicon glyphicon-plus"></span>Add New Blog Entry</blockquote>
<div id="blog-alert-msg"></div>
  	<?php echo form_open('public_site/blog_added','id="blog_form"'); ?>
  	<input type="text" class="form-control" placeholder="Title" name="title" id="title"><p>
  	<!-- list of category -->
	<div class="form-group">
		Post under Category: <select id="category_id" name="category_id">
			<?php foreach($categoryList as $cat):?>
			<option value="<?php echo $cat->category_id; ?>"><?php echo $cat->category_desc; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
    <textarea id="blog_content" placeholder="Content here" name="blog_content"></textarea>
    <?php foreach($query as $row): ?>
    	<input type="hidden" name="author_id" value="<?php echo $row->author_id; ?>" />
  		<input type="text" class="form-control" readonly placeholder="Posted by: <?php echo $row->firstname . ' ' . $row->lastname; ?>"><p>
  	<?php endforeach; ?>
  	<input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date_of_publish" id="date_of_publish"/>
  	<input type="button" class="btn btn-primary" value="Submit Post" id="submitBlog"/>&nbsp;
  	<input type="reset" class="btn btn-warning" value="Reset Entry"/>
  	<a href="<?php echo site_url('public_site/authors'); ?>" class="btn btn-default" id="showMyBlogbtn" style="display:none;">Go to my blog list</a>
	<?php echo form_close(); ?>  
</div>
<script type="text/javascript">
$('#submitBlog').click(function(){
	var blogData = $('#blog_form').serialize();

	$.ajax({
		url: "<?php echo site_url('public_site/blog_added'); ?>",
		type: 'POST',
		data: blogData,
		success: function(result){
			if(result == 'ADDED')
			{
				$('#blog-alert-msg').html('<div class="alert alert-success text-center">Blog post was added!</div>');
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