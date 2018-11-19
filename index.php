<?php
/*
Plugin Name: Price Tables
Author: WV TODOZ
Author URI: http://www.wvtodoz.com.br
Version: 0.0.1
Description: Simple price tables
Text Location: price_tables
*/

if( !function_exists( 'add_action' ) ){
	echo __('Hi there!  I\'m just a plugin, not much I can do when called directly.');
	exit();
}

//setup
define( 'PRICE_TABLES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

//includes
require_once( PRICE_TABLES_PLUGIN_DIR.'/includes/activation.php' );
require_once( PRICE_TABLES_PLUGIN_DIR.'/includes/admin/price_tables_admin_init.php' );


//hooks
register_activation_hook( __FILE__, 'pw_activation' );

add_action('admin_init', 'pw_price_table_admin_init');
add_action( 'save_post', 'pw_save_meta_boxes_data' );

//shortcodes