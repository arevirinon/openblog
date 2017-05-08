
<!-- Split button -->
<div class="btn-group btn-group-justified">
  <button type="button" style="width:100%;" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown">
    List of all the blog posts per category <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" id="catlist">
  <?php foreach($categoryList as $category): ?>
    <li class="btn-group-justified" id="catcatcat" value="<?php echo $category->category_id;?>"><a href="#">Posted under: <b><?php echo $category->category_desc; ?></b></a></li>
  <?php endforeach; ?>
  </ul>
</div>
<br>
<div id="displayPosts">

</div>
<script type="text/javascript">
$('#catlist li').on('click',function(event){
	var my_var = $(this).attr('value');
	event.preventDefault();

	$.ajax({
		url: "<?php echo site_url('public_site/category/');?>"+"/"+my_var,
		type: "POST",
		dataType: 'html',
		data: my_var,
		success: function(getBlogs){
			$('#displayPosts').html(getBlogs);
		}
	});
});
</script>

