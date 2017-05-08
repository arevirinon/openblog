<h2 class="sub-header">Contact Form Messages</h2>
<p>Total of <strong><?php echo $msg_num; ?></strong> unread message(s)</p>
<table id="tableView" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Content</th>
			<th>Email Address</th>
			<th>Posted On</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>	
	</thead>
	<tbody>
	<?php foreach($query as $row): ?>	
	<?php if($row->status==1) :?>
		<tr class="warning">
	<?php else: ?>
		<tr>
	<?php endif; ?>
			<td><?php echo $row->contact_form_name; ?></td>
			<td><?php echo $row->contact_form_content; ?></td>
			<td><?php echo $row->contact_form_email; ?></td>
			<td><?php echo $row->contact_form_date_posted; ?></td>
			<td><a class="btn btn-primary" href="<?php echo base_url() . 'Admin/view_form_message/' .$row->contact_form_id; ?>">View</a></td>
			<td><a class="btn btn-danger" href="">Delete</a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>