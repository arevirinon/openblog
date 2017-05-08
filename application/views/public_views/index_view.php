<?php foreach($query as $row): ?>
  <div class="blog-post">
    <h2 class="blog-post-title"><a href="<?php echo base_url() . 'public_site/blog/' . $row->blog_id;?>"><?php echo $row->title; ?></a></h2>
    <p class="blog-post-meta"><?php echo date('F d, Y',strtotime($row->date_of_publish));?> <b><?php if(isset($row->firstname) && isset($row->lastname)) echo 'by '.$row->firstname . ' ' . $row->lastname; ?></b></p>
    <p>
      <?php
      // for truncating long content
      $string = strip_tags($row->content);

      if (strlen($string) > 20) {

        // truncate string
        $stringCut = substr($string, 0, 200);

        // make sure it ends with a proper, full word
        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.base_url() . 'public_site/blog/' . $row->blog_id.'" class="btn btn-default">Read More</a>'; 
      }

      ?>
      <blockquote><?php  echo $string;; ?></blockquote>
    </p>
  </div><!-- /.blog-post -->
<?php endforeach; ?>
<div class="row">
	<div class="text-center">
		<div class="row"><?php echo $this->pagination->create_links(); ?></div> 
	</div>
</div>



