<?php
function pw_price_table_init(){

	add_filter('the_content','load_html_price_table');
	add_action( 'wp_enqueue_scripts', 'load_view_price_tables_scripts', 10, 1 );
}

function load_view_price_tables_scripts(){

	wp_enqueue_style( 'datepicker',  plugins_url( 'price_table/assets/js/datepicker/datepicker.min.css' ), array(), null, 'all');

	wp_enqueue_script( 'datepicker', plugins_url( 'price_table/assets/js/datepicker/datepicker.min.js' ), array( 'jquery' ), false, false );

	wp_register_script('price_table_view_script',  plugins_url( 'price_table/assets/js/price_table_view_script.js' ), array(),'0.1', true);

	wp_enqueue_script('price_table_view_script');
}

function load_html_price_table( $content ){

	global $typenow;

	// if( $typenow != "post" || $typenow !="page" )
	// 	return;

	$content.= "<div id='boxCalendario'>
	<p>Valores válidos para<span id='dtCalendarioPeriodo' class='hasDatepicker'></p>
	</div><input data-toggle='datepicker'>
<div data-toggle='datepicker'></div>";

	return $content;

}