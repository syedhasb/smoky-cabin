<?php
	
/*
* Plugin Name: Smokycabin Post Widget 
* Description: It displays a widget
* Plugin URI: http://phoenix.sheridanc.on.ca/~ccit3429
* Author: Yap Cheng Siew, Syed Hasban, Alistair D'Cruz
* Author URI: http://phoenix.sheridanc.on.ca/~ccit3429
* Version: v1.0
*/

/*
*registers posts for the website.
*/

// Tells WordPress that this widget has been created and that it should display in the list of available widgets. This was taken form Codex
add_action('init','register_my_post');
function register_my_post() {
	register_post_type('shisha',
		array(
			'labels' => array(
				'name' => ('shisha'),
				'add_new' => 'Add New post',
				'add_new_item' => 'Post',
				'edit_item' => 'Edit',
				'new_item' => 'New',
				'all_items' => 'All',
				'view_items' => 'View',
				'search_items' => 'Search',
				'not_found' => 'Not found',
				'not_found_in_trash' => 'None',
				'parent_item_colon' => '',
				),
					'public' => true,
					'exclude_from_search' => true,
					'supports' => array(
					'title',
					'thumbnail',
					'editor'
				)
			)
		);

	// Creating widget front-end
	public function widget( $args, $instance ) {
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		// Display Post
		echo "smokeycabin ";
			$args = array('post_type'=>'post');
			$query = new WP_Query($args);
			if ($query ->have_posts() ) {
				echo '<ul class="smokeycabin_widget">';
				while($query->have_posts()) {
					// Will concatenate the variables and output the 'eventItem' string.
					$query->the_post();
					$smokeycabin = '<li>' . $image;
					$smokeycabin .= '<a href="' . get_permalink() . '">';
					$smokeycabin .= get_the_title() . '</a>';
					$smokeycabin .= '<span>' . get_the_excerpt() . '';
					$smokeycabin .= '</span></li>';
					echo $smokeycabin;
				}
			echo '</ul>';
			wp_reset_postdata();
		}
			}
?>
<!-- This creates the widget admin form -->
<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'smokycabin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
<?php
	}
// this displays the titles for the posts
// this is the backend form

	
//register the wordpress widget
function SC_widget(){
	register_widget('smokycabin_widget' );
	add_action( 'widgets_init', 'smokycabin_widget' );
?>
