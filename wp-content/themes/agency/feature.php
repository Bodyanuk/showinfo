

<div id="featured" >
		  <ul class="ui-tabs-nav">
	 			
		 	<?php 
			//CHANGE THIS VALUE TO YOUR CATEGORY
			$myCat = 'featured';
			
			$my_query = new WP_Query('category_name=' . $myCat . '&showposts=4'); 			
			?>
			<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
				   <li><a href="#fragment-<?php the_ID(); ?>"><?php echo short_title('...', 5);?></a></li>
			<?php endwhile; ?>
			
	      </ul>
			
			<?php rewind_posts(); ?>
			 
        	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?> 
			
			<div id="fragment-<?php the_ID(); ?>" class="ui-tabs-panel">
			<a href="<?php the_permalink();?>" >
			
			 
			
			<?php 
			//real dimension of the slideshow image is 516w x 248h
				if ( function_exists( 'add_theme_support' ) && has_post_thumbnail()){
				the_post_thumbnail(array(516,9999), array('class' => 'feature-large'));
				}
			?>
			
			</a>
			 <div class="info" >
				<h2><a href="<?php the_permalink();?>" ><?php echo feature_title();?></a></h2>				
				 </div>
			</div>
			
			
			<?php endwhile; ?>
				 
	    

	     

</div>
	
