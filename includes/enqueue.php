<?php
function pw_price_table_enqueue(){
	wp_register_style( 'price_table_view_style', plugins_url( 'assets/css/price_table_view_style.css' ,PRICE_TABLES_PLUGIN_DIR) );

	wp_register_script('price_table_view_script',  plugins_url( 'assets/js/price_table_view_script.js', PRICE_TABLES_PLUGIN_DIR ), array( 'jquery'),'0.1', true);

	// wp_register_script( 'ajaxHandle', plugins_url('assets/js/price_table_ajax.js', PRICE_TABLES_PLUGIN_DIR), array( 'jquery'), '0.1' , true );

	wp_localize_script( 'price_table_view_script', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

 	wp_enqueue_style( 'price_table_view_style' );
	wp_enqueue_script( 'price_table_view_script' );

	
}