<?php
/**
 * Template Name: Grid Map Page 
 *
 * The Smoky Cabin
 */

get_header(); ?>

<!-- Thid code allows the user to style the grid-->
	<div id="grid" class="content-area">
		<main id="main" class="site-main" role="main">
		
<!-- The code below is for the contet area-->		
			<?php the_content (); ?> 
			

 			
		<?php 
		$args = array ('showposts'=>9,'order'=>'ASC','cat'=>1);
		$my_query = new WP_Query ($args);
	 if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?> 

<!-- This code allows the user to call the grid -->	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<div id="gridstyle"> 
		<?php the_post_thumbnail('thumbnail'); ?></a> 	
	 
		
		</div>
	</article>
	<?php endwhile; endif; ?>

<!-- the navigation to previous and next in the post category --> 			
	<div class="nav-previous"><?php next_posts_link(__( '&larr; GO OLDER', 'smokycabin' ) ); ?></div>
<div class="nav-next"><?php previous_posts_link( __( 'GO NEWER &rarr;', 'smokycabin' )  ); ?></div>
		

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
