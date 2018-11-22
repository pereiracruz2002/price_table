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
	echo __('Hi there!  I\'m just a plugin, not much I can do when called directly.', 'price_tables');
	exit();
}

//setup
define( 'PRICE_TABLES_PLUGIN_DIR',  __FILE__  );
define( 'URL_API_HOLIDAYS', 'https://api.calendario.com.br/?json=true&ano='.date('Y').'&estado=SP&cidade=SAO_PAULO&token=ZmxhdmlvQHd2dG9kb3ouY29tLmJyJmhhc2g9NTMzNTg1ODE' );


//includes
require_once( 'includes/activation.php' );
require_once( 'includes/admin/admin_init.php' );
require_once( 'includes/show_price_tables_init.php' );
require_once( 'includes/enqueue.php');
require_once( 'includes/search_date_ajax.php' );
require_once( 'includes/shortcodes/price_table_shortcodes.php');

//hooks
register_activation_hook( __FILE__, 'pw_activation' );

add_action( 'admin_menu', 'register_pw_price_table_settings_menu' );
add_action('admin_init', 'pw_price_table_admin_init');
add_action( 'admin_init', 'register_table_price_field_settings', 20 );
add_action( 'save_post', 'pw_save_meta_boxes_data', 10, 3 );
//add_action( 'init','pw_price_table_init');
add_action( 'wp_enqueue_scripts', 'pw_price_table_enqueue', 10, 1);
add_action( 'wp_ajax_pw_search_date', "pw_search_date" ); //user logged
add_action( 'wp_ajax_nopriv_pw_search_date', "pw_search_date" ); //user not logged


//shortcodes
add_shortcode( 'price_table_shortcode', 'pw_price_table_creator_shortcode' );