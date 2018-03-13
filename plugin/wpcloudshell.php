<?php
/**
 * Plugin Name: Azure Cloud Shell Link Generator
 * Plugin URI: http://samcogan.com
 * Version: 1.0
 * Author: Sam Cogan
 * Author URI: http://samcogan.com
 * Description: Generate a button in your blog posts to  proivde a way open Auzre Cloud Shell right next to your code samples
 * License: MIT
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class WPCloudShell_Class {
     
     /**
     * Constructor. Called when the plugin is initialised.
     */
     function __construct() {

        if ( is_admin() ) {
            add_action( 'init', array(  $this, 'setup_wpcloudshell_plugin' ) );
        }
     }

     /**
* Check if the current user can edit Posts or Pages, and is using the Visual Editor
* If so, add some filters so we can register our plugin
*/
function setup_wpcloudshell_plugin() {
 
// Check if the logged in WordPress User can edit Posts or Pages
// If not, don't register our TinyMCE plugin
     
if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
}
 
// Check if the logged in WordPress User has the Visual Editor enabled
// If not, don't register our TinyMCE plugin
if ( get_user_option( 'rich_editing' ) !== 'true' ) {
return;
}
 
// Setup some filters
add_filter( 'tiny_mce_before_init', function ( $init ) {
    $img = 'a[*]';
    if ( isset( $init['extended_valid_elements'] ) ) {
        $init['extended_valid_elements'] .= ',' . $img;
    } else {
        $init['extended_valid_elements'] = $img;
    }
    return $init;
});
add_filter( 'mce_external_plugins', array( &$this, 'add_wpcloudshell_plugin' ) );
add_filter( 'mce_buttons', array( &$this, 'add_tinymce_toolbar_button' ) );


         
    }

function add_wpcloudshell_plugin( $plugin_array ) {
 
 $plugin_array['wpcloudshell_class'] = plugin_dir_url( __FILE__ ) . 'wpcloudshell.js';
 return $plugin_array;
  
 }

 function add_tinymce_toolbar_button( $buttons ) {
 
 array_push( $buttons, '|', 'wpcloudshell_class' );
 return $buttons;
 }
  
 }
  
 $WPCloudShell_Class = new WPCloudShell_Class;

 ?>