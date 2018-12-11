<?php
function pw_price_table_enqueue(){
	wp_register_style( 'price_table_view_style', plugins_url( 'assets/css/price_table_view_style.css' ,PRICE_TABLES_PLUGIN_DIR) );

	wp_register_style( 'datepicker', plugins_url( 'assets/css/datepicker/datepicker.min.css' ,PRICE_TABLES_PLUGIN_DIR) );

	wp_register_script('datepicker',  plugins_url( 'assets/js/datepicker/datepicker.min.js', PRICE_TABLES_PLUGIN_DIR ), array( 'jquery'),'0.1', true);

	wp_register_script('datepicker_br',  plugins_url( 'assets/js/datepicker/datepicker.pt-BR.js', PRICE_TABLES_PLUGIN_DIR ), array( 'jquery'),'0.1', true);

	wp_register_script('price_table_view_script',  plugins_url( 'assets/js/price_table_view_script.js', PRICE_TABLES_PLUGIN_DIR ), array( 'jquery'),'0.1', true);

	// wp_register_script( 'ajaxHandle', plugins_url('assets/js/price_table_ajax.js', PRICE_TABLES_PLUGIN_DIR), array( 'jquery'), '0.1' , true );

	wp_localize_script( 'price_table_view_script', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

 	wp_enqueue_style( array('price_table_view_style','datepicker') );
	wp_enqueue_script( array('datepicker','datepicker_br','price_table_view_script') );

	
}