<?php
function pw_price_table_init(){

	add_filter('the_content','load_html_price_table');

}


function load_html_price_table( $content ){

	global $typenow;
	global $post;

	$today = date('Y-m-d');
	$one_more_week = date('Y-m-d', strtotime( $today. ' + 7 day' ) );

	// if( $typenow != "post" || $typenow !="page" )
	// 	return;

	$content.= "<div id='boxCalendario'><p>Valores válidos para <b>hoje: </b><input name='date_search' class='price_table' data-id='".$post->ID."' min='".$today."' max='".$one_more_week."' type='date' value='".$today."' ><span id='calendar' class='dashicons dashicons-calendar-alt'></p></div>
	<div id='boxTabela'></div>";

	return $content;
}


