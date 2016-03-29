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
					'supports' => array(
					'title',
					'thumbnail',
					'editor'
				)
			)
		);
}

//this section is from the example given in class. this activates the widget domain
class smokycabin_widget extends WP_Widget {

	function __construct() {
		parent::__construct('smokycabin_widget', __('smokycabin Widget', 'smokycabin_widget_domain'), array( 'description' => __( 'smokycabin widget', 'smokycabin_widget_domain' ), )
		);
	}

// This creates the widget front end
	public function widget( $args, $instance ) {
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		
// the echos the argument of the widget and displays the queries of the image titles and descriptions
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
// This echoes the post on Smoky cabin with image title and descriptions
		echo "smokycabin ";
			$args = array('post_type'=>'post');
			$query = new WP_Query($args);
			if ($query ->have_posts() ) {
				echo '<ul class="smokycabin_widget">';
				while($query->have_posts()) {
					$query->the_post();
					$smokycabin = '<li>' . $image;
					$smokycabin .= '<a href="' . get_permalink() . '">';
					$smokycabin .= get_the_title() . '</a>';
					$smokycabin .= '<span>' . get_the_excerpt() . '';
					$smokycabin .= '</span></li>';
					echo $smokycabin;
				}
			echo '</ul>';
			wp_reset_postdata();
		}
			}

// This was taken from the example code given in class; this is the argument for the title of the form
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'smokycabin_widget_domain' );
		}

// This was from the example code given in class; it displays the form for the backend
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); 	?></label>
	<input class="smoky" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<?php
	}


//This was taken from an example code given in class; this is what saves and submits the widget
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} 

// This was taken from an example code given in class; this registers and load the widget
function smokycabin_load_widget() {
    register_widget( 'smokycabin_widget' );
}

add_action( 'widgets_init', 'smokycabin_load_widget' );


?>
