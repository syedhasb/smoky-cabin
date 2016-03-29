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

// Tells WordPress that this widget has been created and
//that it should display in the list of available widgets.

add_action( 'widgets_init', 'register_SCpost' ); 
function register_SCpost(){
	register_post_type ('Shisha', 
		array (
		'labels' = array(
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
	));
	
// Creating the widget front end
class smokycabin_widget extends WP_Widget {

	function __construct() {
		parent::__construct('smokycabin_widget', __('smokycabin Widget', 'smokycabin_widget_domain'), array( 'description' => __( 'smokycabin widget', 'smokycabin_widget_domain' ), )
		);
	}
	
	
//creating the front end form
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
	<ul>
		<?php
		wp_get_archives( apply_filters( 'widget_archives_args',
				array(
					'type' => 'yearly',
					'show_post_count' => $c
		) ) );
		?>
	</ul>
<?php
		
		echo $args['after_widget'];
}

// This is to dislay the posts for the front end
echo "smokycabin";
	$arg array ( 'post_type' => 'post')
	
// This is to create a backend form
public function form( $instance ) {
	$instance = wp_parse_args( (array) $instance,
array( 'title' => '', 'count' => 0, 'dropdown' => '') );
	$title = strip_tags($instance['title']);
	$count = $instance['count'] ? 'checked="checked"' : '';
	$dropdown = $instance['dropdown'] ?
'checked="checked"' : '';

//admin form for styling on the backend

//register the wordpress widget
function SC_widget(){
	register_widget('smokycabin_widget' );
	add_action( 'widgets_init', 'smokycabin_widget' );
?>
	
