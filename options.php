<?php
/* * Plugin Name: Options Page 
* Plugin URI: https://phoenix.sheridanc.on.ca/~ccit3429/
* Description: Allows user to edit or add additional content that will appear on the main website
* Author:Smoky Cabin
* Version: 1.0 
* Author URI: https://phoenix.sheridanc.on.ca/~ccit3429/ 
*/
function smokycabin_submenu() { /* This creates a new submenu in wordpress dashboard */
	add_submenu_page( 'options-general.php', 'Submenu', 'Submenu', 'manage_options', 'my-sub-menu', 'smokycabin_display_submenu_options');
	}
	add_action( 'admin_menu', 'smokycabin_submenu' );

function smokycabin_admin_menu(){ /* This code should add a submenu to wordpress dashboard */
	add_menu_page( 'My Options Page', 'My Options Page', 'manage_options', 'smoky_cabin_options_page', 'smoky_cabin_options_page', 'dashicons-hammer', 66 );
	}
	add_action( 'admin_menu', 'smokycabin_admin_menu' );
	
function smokycabin_setting(){ /* This should register submenu to dashboard */
	register_setting('theme_options', 'options_settings');
	add_settings_section( 'options_page',
	 __( 'Your section description', 
	 'smoky-cabin' ), 
	 'options_page_callback', 
	 'theme_options');
	function options_page_callback() { /* Adds items below options page form */
		echo __( 'A description and detail about the section.','smoky-cabin' );
		}
	add_settings_field( 'smokycabin_text', __('Enter the title for your options page: ', 'smoky-cabin'), 'smokycabin_text_render', 'theme_options', 'options_page');/* Sign up a textbox in options page */
	add_settings_field( 'smokycabin_checkbox', __( 'Check your preference', 'smoky-cabin' ), 'smokycabin_checkbox_render', 'theme_options', 'options_page');/* Sign up a checkbox in  Options Page */
	add_settings_field( 'smokycabin_textarea', __( 'Enter sponsors that you might have:', 'smoky-cabin' ), 'smokycabin_textarea_render', 'theme_options', 'options_page');/* Sign up a text area in Options Page */
	function smokycabin_text_render() {/* Create a text box in Options Page */
		$options=get_option( 'options_settings' );
		?>
		<input type="text" name="options_settings[smokycabin_text]" value="<?php if (isset($options['smokycabin_text'])) 
		echo $options['smokycabin_text']; ?>">
		<?php
	}
	function smokycabin_checkbox_render() { /* Create a checkbox in Options Page */
		$options=get_option( 'options_settings' );
		?>
		<input type="checkbox"name="options_settings[smokycabin_checkbox]"
		<?php if (isset($options['smokycabin_checkbox'])) checked( $options['smokycabin_checkbox'], 1); ?>value="1">
		<?php
	}
	function smokycabin_textarea_render() { /* Create a text area in Options Page */
		$options=get_option( 'options_settings' );
		?>
		<textarea cols="40"rows="5"name="options_settings[smokycabin_textarea]">
		<?php if (isset($options['smokycabin_textarea'])) echo$options['smokycabin_textarea']; ?></textarea>
		<?php
		}
}
function smoky_cabin_options_page(){ /* This allows users to input customizations to the page */
?>
	<form action="options.php"method="post"><h2>Options Page</h2>
	<?php
	settings_fields( 'theme_options' );do_settings_sections( 'theme_options' );submit_button();
	?>
	</form>
	<?php
}

add_action( 'admin_init', 'smokycabin_setting' );

?>
