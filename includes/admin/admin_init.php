<?php
require_once('options_metabox.php');

function pw_price_table_admin_init(){
	add_action( 'add_meta_boxes', 'pw_price_tables_metaboxes' );
	add_action( 'admin_enqueue_scripts', 'load_price_tables_scripts', 10, 1 );
}

function register_pw_price_table_settings_menu(){
	add_menu_page( __('Price Tables','price_tables'), __('Price Tables','price_tables'), 'manage_options', 'price-tables-plugin', 'table_price_init' );
}

function register_table_price_field_settings() {
	register_setting( 'pt_price_field','price_tables_info_settings' );
}

function default_table_price_field_settings() {
	return array( 'enabled' => array( 'al_product' ), 'show' => array( '' ) );
}

function get_table_price_field_settings() {
	$settings = wp_parse_args( get_option( 'price_tables_info_settings' ), default_table_price_field_settings() );
	return $settings;
}


function table_price_init(){
	$post_types= get_post_types( array( 'publicly_queryable' => true ), 'objects' );
	unset( $post_types[ 'attachment' ] );
	echo '<h2>' . __( 'Settings', 'price_tables' ) . ' - Price Tables</h2>';
	echo '<h3>' . __( 'General Price Field Settings', 'price_tables' ) . '</h3>';
	echo '<form method="post" action="options.php">';
	settings_fields( 'pt_price_field' );
	$table_price_field_settings	 = get_table_price_field_settings();
	echo '<h4>' . __( 'Enable Price Tables for', 'price_tables' ) . ':</h4>';
	$checked = in_array( 'page', $table_price_field_settings[ 'enabled' ] ) ? 'checked' : '';
	echo '<input ' . $checked . ' type="checkbox" name="price_tables_info_settings[enabled][]" value="page"> ' . __( 'Pages', 'price_tables' ) . '<br>';

	foreach ( $post_types as $type_key => $type_obj ) {
		if ( strpos( $type_key, 'al_product' ) !== 0 ) {
			$checked = in_array( $type_key, $table_price_field_settings[ 'enabled' ] ) ? 'checked' : '';
			echo '<input ' . $checked . ' type="checkbox" name="price_tables_info_settings[enabled][]" value="' . $type_key . '"> ' . $type_obj->labels->name . '<br>';
		}
	}

	echo '<div class="al-box" style="margin-top: 10px;">' . __( 'You can also display price with', 'price_tables' ) . ': <ol><li>' . sprintf( __( '%s shortcode placed in content.', 'price_tables' ), '<code>' . esc_html( '[price_table_shortcode]' ) . '</code>' ) . '</li></ol></div>';

	echo '<p class="submit"><input type="submit" class="button-primary" value="' . __( 'Save changes', 'price_tables' ) . '"/></p>';
	echo '</form>';
}

function load_price_tables_scripts(){

	wp_enqueue_script( 'mask-input', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js', array( 'jquery' ), '1.14.15', 'true' );

	wp_register_script('price_table_script',  plugins_url( 'assets/js/price_table_script.js', PRICE_TABLES_PLUGIN_DIR ), array( 'jquery','mask-input' ),'0.1', true);
 
	wp_enqueue_script('price_table_script');
}


function add_price_tables_field_metaboxes() {

	$settings = get_option( 'price_tables_info_settings' );
	$enabled  = array();

	if( !empty( $settings ) ){
		foreach ($settings['enabled'] as $key => $tipo) {
			$enabled[] = $tipo;
		}
	}

	return $enabled;
}


function pw_price_tables_metaboxes(){
	$types = array();
	$screens_array = add_price_tables_field_metaboxes();
	if( empty( $screens_array ) ){
		$screens_array[] = 'post';
	}
	

	//$screens = ['post', 'page'];
	add_meta_box( 
		'pw_price_tables_opcoes',
		__( 'Price Configuration ', 'price_tables' ), 
		'pw_price_tables_opcoes',
		$screens_array, 
		'normal',
		'high'
	);

}

function pw_save_meta_boxes_data( $post_id, $post, $update){

	if( !$update ){
		return;
	}


	$customFields = array('pw_dia','pw_price','pw_start_hour','pw_finish_hour');
	$array_info = array();

	foreach( $customFields as $field ){
		if( array_key_exists( $field, $_POST ) ){
			foreach( $_POST[$field] as $metabox_chave => $metabox_value ){
				$array_info[$field."_".$metabox_chave] = $metabox_value;
			}
		}
	}

	update_post_meta( $post->ID,"info_table_price", serialize( $array_info ) );
}

