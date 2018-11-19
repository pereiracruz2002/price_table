<?php
require_once('options_metabox.php');

function pw_price_table_admin_init(){
	add_action( 'add_meta_boxes', 'pw_price_tables_metaboxes' );
	add_action( 'admin_enqueue_scripts', 'load_price_tables_scripts', 10, 1 );
}

function load_price_tables_scripts(){

	wp_enqueue_script( 'mask-input', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js', array( 'jquery' ), '1.14.15', 'true' );

	wp_register_script('price_table_script',  plugins_url( 'price_table/assets/js/price_table_script.js' ), array( 'jquery','mask-input' ),'0.1', true);
 
	wp_enqueue_script('price_table_script');
}



function pw_price_tables_metaboxes(){
	$screens = ['post', 'page'];
	add_meta_box( 
		'pw_price_tables_opcoes',
		__( 'Price Configuration ', 'price_tables' ), 
		'pw_price_tables_opcoes',
		$screens, 
		'normal',
		'high'
	);

}

function pw_save_meta_boxes_data( $post_id, $post, $update){

	if( !$update ){
		return;
	}


	$customFields = array('pw_dia','pw_price','pw_start_hour','pw_finish_hour');
	foreach( $customFields as $field ){
		if( array_key_exists( $field, $_POST ) ){
			foreach( $_POST[$field] as $metabox_chave => $metabox_value ){
				update_post_meta( $post->ID, $field."_".$metabox_chave, $metabox_value);
			}
		}
	}
}

