<h2 class="sub-header">Blog Entries</h2>
<div class="table-responsive">
<table id="tableView" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>Title</th>
      <th>Content</th>
      <th>Date of Publish</th>
      <th>Author</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($query as $row): ?>
    <tr>
      <td><?php echo $row->title; ?></td>
      <?php
      $string = strip_tags($row->content);
      if(strlen($string) > 100):
        $stringCut = substr($string, 0, 99);
        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'<b>....</b>';
      ?>
      <td><?php echo $string; ?></td>
      <?php else: ?>
      <td><?php echo $string; ?></td>
      <?php endif; ?>
      <td><?php echo $row->date_of_publish; ?></td>
      <td><?php echo $row->firstname . ' ' .$row->lastname; ?></td>
      <td><a href="<?php echo base_url() . 'public_site/blog/' . $row->blog_id; ?>" class="btn btn-primary" target="_blank">View</td>
      <td><a href="<?php echo base_url() . 'admin/blogcomments/' . $row->blog_id; ?>" class="btn btn-warning">Comments</td>
      <td><a href="<?php echo base_url() . 'admin/delete_blog/'. $row->blog_id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
</div>