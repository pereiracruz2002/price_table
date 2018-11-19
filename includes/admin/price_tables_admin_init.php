<?php
require_once('options_metabox.php');

function pw_price_table_admin_init(){
	add_action( 'add_meta_boxes', 'tw_price_tables_add_custom_box' );
	add_action( 'admin_enqueue_scripts', 'load_price_tables_scripts', 10, 1 );


}

function load_price_tables_scripts(){
	

	// wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all');
	// wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), null, true );

	wp_enqueue_script( 'mask-input', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js', array( 'jquery' ), '1.14.15', 'true' );

	wp_register_script('price_table_script',  plugins_url( 'price_table/assets/js/price_table_script.js' ), array( 'jquery','mask-input' ),'0.1', true);
 
	wp_enqueue_script('price_table_script');
}



function tw_price_tables_add_custom_box(){
	$screens = ['post', 'page'];
	add_meta_box( 
		'tw_features_meta_box',
		__( 'Price Configuration ', 'price_tables' ), 
		'tw_features_meta_box',
		$screens, 
		'normal' 
	);

}

function pw_save_meta_boxes_data(){

	global $post;

	$customFields = array('pw_dia','pw_price','pw_start_hour','pw_finish_hour');
	foreach( $customFields as $field ){
		if( array_key_exists($field, $_POST) ){
			foreach($_POST[$field] as $metabox_chave => $metabox_value){
				update_post_meta($post->ID, $field."_".$metabox_chave, $metabox_value);
			}
		}
	}
}

