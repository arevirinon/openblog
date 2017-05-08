<script type="text/javascript">
$(document).ready(function(){
	$('#btnHello').click(function(){
		var fullname = $('#fullname').val();

		$.ajax({
			type: "POST",
			data: {fullname: fullname},
			url: "<?php echo site_url('test_purposes/ajaxtest'); ?>",
			success: function(result){
				$('#result1').html(result);
			}
		});
	});
});
</script>

<input type="text" id="fullname" name="fullname" />
<input type="button" id="btnHello" value="Submit" />
<div id="result1"></div>