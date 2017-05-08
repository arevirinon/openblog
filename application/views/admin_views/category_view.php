<div class="table-responsive">
<a href="" data-toggle="modal" data-target="#addCategory" class="btn btn-default">Add New Category</a>
<table class="table table-striped">
  <thead>
    <tr>
    	<th>Category Name</th>
    	<th colspan="2"></th>
    </tr>
   </thead>
   	<?php foreach($query as $row): ?>
   	<tbody>
   	<tr>
   		<td><?php echo $row->category_desc; ?></td>
   		<td>update</td>
   		<td>Delete</td>
   	</tr>
   </tbody>
   <?php endforeach; ?>
</table>

<!-- add category modal form -->
<div id="addCategory" class="modal fade" role="dialog">
<?php echo form_open('admin/add_category','id="addCategoryForm"'); ?>	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div id="alert-msg"></div>
            </div>
           <div class="modal-body" id="myModalBody">
                <div class="form-group">
                    <span class="input-group-addon" id="basic-addon3">Category Name</span>
  <input type="text" class="form-control" id="categoryDesc" name="categoryDesc" aria-describedby="basic-addon3">
                </div>
         	</div>
         	<div class="modal-footer">
         		<input type="button" class="btn btn-primary" id="addCategoryBtn" value="Add Category">
         		<a href="<?php echo site_url('admin/view_category'); ?>" id="backtoList" class="btn btn-default" style="display:none;">Back to Category list</a>
         </div>
    </div>
<?php echo form_close(); ?>
</div>

<script type="text/javascript">
$('#addCategoryBtn').click(function(){
	$.ajax({
		url: "<?php echo site_url('admin/add_category'); ?>",
		type: 'POST',
		data: $('#addCategoryForm').serialize(),
		success: function(msg){
			if(msg == 'YES')
			{
				$('#alert-msg').html('<div class="alert alert-success text-center">Category Added!</div>');
				$('#addCategoryBtn').attr("disabled","disabled");
				$('#backtoList').show();
			}
			else if(msg == 'NO')
			{
				$('#alert-msg').html('<div class="alert alert-danger text-center">Error in adding category!</div>');
			}
			else
			{
				$('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
			}
		}
	});
});
</script>