<?php get_header();?><?php get_sidebar('left');?><div id="main-container"><?php if(have_posts()):?><?php while(have_posts()):the_post();?>	<div class="post-row">	<?php 	if ( function_exists( 'add_theme_support' ) && has_post_thumbnail()){	 	the_post_thumbnail(array(170, 80));	}	?>	<div class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div> 	<div class="post-content excerpt">	<?php the_excerpt();?>	</div><!--post-content-->	</div><!--post-row-->		<?php endwhile;?><?php posts_nav_link();?><?php endif;?></div><!--main-container--><?php get_sidebar('right'); ?><?php get_footer();?>