<?php
	
/*
* Plugin Name: Smoky Cabin Widget
* Description: Displays posts.
* Plugin URI: http://phoenix.sheridanc.on.ca/~ccit3429
* Author: Cheng Yap 
* Author URI: http://phoenix.sheridanc.on.ca/~ccit3429
* Version: v1.0
*/
/*
*registers posts for the website.
*/


	
// Creating the widget front end
class smokycabin_widget extends WP_Widget {
	function __construct() {
		parent::__construct('smokycabin_widget', __('smokycabin Widget', 'smokycabin_widget_domain'), array( 'description' => __( 'smokycabin widget', 'smokycabin_widget_domain' ), )
		);
	}
?>

<?php 
	register_post_type( $post_type, $args ); 
	
// Tells WordPress that this widget has been created and that it should display in the list of available widgets. This was taken form Codex

function smokycabin_custom_init() {
    $args = array(
    'name'               => ('Shisha'), 
	'add_new'            => 'Add New',
	'add_new_item'       => 'Add New Item',
	'new_item'           => 'New Item',
	'edit_item'          => 'Edit Item', 
	'view_item'          => 'View Item', 
	'all_items'          => 'All Items', 
	'search_items'       => 'Search Items',
	'parent_item_colon'  => 'Parent Items:', 
	'not_found'          => 'No items found.',
	'not_found_in_trash' => 'No items found in Trash.', 
    );
    register_post_type( 'book', $args );
}
add_action( 'init', 'smokycabin_custom_init' );	
	

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
