<script type="text/javascript" src="<?php echo site_url('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript">
	tinymce.init({
		selector: '#contactContent',  // change this value according to your HTML
		setup: function(editor){
			editor.on('change',function(){
				editor.save();
			});
		},
		skin: 'lightgray',
		height: '150px',
	}); 
</script>
<div class="blog-post-title">We'd like to hear from you!</div>
<div id="contact_alert_msg"></div>
<?php echo form_open('public_site/contact_submit','id="contact_us_form"'); ?>
	<div class="input-group">
	  <span class="input-group-addon" id="basic-addon3">Your Name</span>
	  <input type="text" class="form-control" id="contactName" name="contactName" aria-describedby="basic-addon3">
	</div>
	<br>
	<div class="input-group">
	  <span class="input-group-addon" id="basic-addon3">Your Email Address</span>
	  <input type="text" class="form-control" id="contactEmail" name="contactEmail" aria-describedby="basic-addon3">
	  <span class="input-group-addon" id="basic-addon2">email@example.com</span>
	</div>
	<br>
	<textarea id="contactContent" placeholder="Content here" name="contactContent"></textarea>
	<br>
	<input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="contact_form_date_posted">
	<input type="button" class="btn btn-primary btn-lg" name="contact_form_btn" id="contact_form_btn" value="Submit" />
	<a href="<?php echo site_url('public_site/'); ?>" id="backtohomepage" class="btn btn-default btn-lg"style="display:none;">Go back to Home Page</a>
<?php echo form_close(); ?>
<br><p>
<script type="text/javascript">
$('#contact_form_btn').click(function(){
	var contactData = $('#contact_us_form').serialize();
	
	$.ajax({
		url: "<?php echo site_url('public_site/contact_submit'); ?>",
		type: "POST",
		data: contactData,
		success: function(result){
			if(result == 'CONTACTSUBMIT')
			{
				$('#contact_alert_msg').html('<div class="alert alert-success">Your message has been successfully sent! Thank you for your query.</div>');
				$('#contactName').attr("disabled","disabled");
				$('#contactEmail').attr("disabled","disabled");
				$('#contactContent').attr("disabled","disabled");
				$('#contact_form_btn').attr("disabled","disabled");
				$('#backtohomepage').show();
			}
			else
			{
				$('#contact_alert_msg').html('<div class="alert alert-danger">' + result + '</div>');
			}
		}
	});
	return false;
});
</script>