<form action="<?php echo base_url() . 'Admin/update_form_message'; ?>" method="POST">
  <?php foreach($query as $row): ?>
  <input type="hidden" name="contact_form_id" value="<?php echo $row->contact_form_id; ?>">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Submitted by <?php echo $row->contact_form_name; ?> on <?php echo $row->contact_form_date_posted; ?> </h3>
      <p><strong><i><?php echo $row->contact_form_email; ?></i></strong></p>
    </div>
    <div class="panel-body">
      <?php echo $row->contact_form_content; ?>
      <hr>
      <div>    
        <div class="pull-left">
            <?php
              $role_list = array(
                            '1' => 'Unchecked',
                            '2' => 'Checked'
                );
            ?>
            <?php if($row->status==1): ?>
              <?php echo form_dropdown('status',$role_list,$row->status,'id="status"'); ?>
              <button class="btn btn-primary">Update</button>
            <?php else: ?>
              <?php echo form_dropdown('status',$role_list,$row->status,'id="status", disabled="disabled"'); ?>
            <?php endif; ?>
        </div>
      </div>    
        <div class="pull-right">
          <a href="mailto:<?php echo $row->contact_form_email; ?>" class="btn btn-info">Send Email Message</a>
          <a href="<?php echo base_url() . 'admin/view_messages'; ?>" class="btn btn-default">Go Back</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>  
</form>