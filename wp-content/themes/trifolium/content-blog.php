<?php
$blog_post_id =get_option('page_for_posts');   
?>
<?php 
if ( have_posts() ) :  
	while ( have_posts() ) : 
	the_post();  ?>						

    <h4>Is content-blog.php</h4>
<?php
	endwhile;
endif;
?>	
<?php
the_posts_pagination( array('prev_text'  => '<i class="fal fa-angle-left"></i>','next_text'  => '<i class="fal fa-angle-right"></i>','before_page_number' => '','screen_reader_text' =>''));
?>