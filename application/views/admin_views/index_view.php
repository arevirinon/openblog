
<!-- <h1 class="page-header">Dashboard</h1> -->
<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Welcome to OpenBlog Admin Panel. You are logged in as  <strong><?php echo $this->session->userdata('username'); ?></strong> 
</div>

<div class="row">
	<div class="col-md-6">
		<div style="background: #ffd480 !important" class="jumbotron">
			<h2><i class="fa fa-users" aria-hidden="true"></i> Registered Authors</h2>
			<p>There are <span class="badge"><?php echo $active_user_num; ?></span> authors who have registered.</p>
			<a href="<?php echo site_url('admin/users'); ?>" class="btn btn-lg btn-default pull"><i class="fa fa-hand-o-right" aria-hidden="true"></i> View Authors</a>
		</div>
	</div>
	<div class="col-md-6">
		<div style="background: #f0b3ff !important" class="jumbotron">
			<h2><i class="fa fa-newspaper-o" aria-hidden="true"></i> Blog Entries</h2>
			<p>There are <span class="badge"><?php echo $blog_num; ?></span> blog entries submitted.</p>
			<a href="<?php echo site_url('admin/blogs'); ?>" class="btn btn-lg btn-default"><i class="fa fa-hand-o-right" aria-hidden="true"></i> View Blog Posts</a>
		</div>
	</div>
	<div class="col-md-6">
		<div style="background: #b3ffec !important" class="jumbotron">
			<h2><i class="fa fa-comments" aria-hidden="true"></i> Contact Form Messages</h2>
			<p>There are <span class="badge"><?php echo $msg_num; ?></span> unread messages.</p>
			<a href="<?php echo site_url('admin/view_messages'); ?>" class="btn btn-lg btn-default"><i class="fa fa-hand-o-right" aria-hidden="true"></i> View Messages</a>
		</div>
	</div>
	<div class="col-md-6">
		<div style="background: #ff9999 !important" class="jumbotron">
			<h2><i class="fa fa-question-circle" aria-hidden="true"></i> Knowledge Base</h2>
			<p>Brief walkthrough about the cPanel</p>
			<a href="" data-toggle="modal" data-target="#knowledgeBase" class="btn btn-lg btn-default"><i class="fa fa-hand-o-right" aria-hidden="true"></i> View Tutorial</a>
		</div>
	</div>
</div>

<!--- *********************** KNOWLEDGE BASE MODAL ***************************************************************** -->
<div id="knowledgeBase" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">OpenBlog Knowledge Base</h4>
            </div>
            <div class="modal-body" id="myModalBody">
                <?php $this->load->view('admin_views/knowledge_base'); ?>
            </div>
            <div class="modal-footer">
               <strong>OpenBlog &copy; 2017</strong> | An open source blogging platform for everybody.
            </div>      
        </div>
    </div>
</div>



