<?php
function pw_price_table_creator_shortcode(){
	global $typenow;
	global $post;


	$content ='';
	$today = date('Y-m-d');
	//$today_feriado = date('Y-m-d', strtotime( $today. ' - 7 day' ) );
	$one_more_week = date('Y-m-d', strtotime( $today. ' + 7 day' ) );

	// if( $typenow != "post" || $typenow !="page" )
	// 	return;

	$settings = get_option( 'price_tables_info_settings' );
	$enabled  = array();

	


	if( is_single() || is_page()){
		// $content= "<div id='boxCalendario'><p>Valores válidos para <b>hoje: </b><input name='date_search' class='price_table' data-id='".$post->ID."' min='".$today."' max='".$one_more_week."' type='date' value='".$today."' ><span id='calendar' class='dashicons dashicons-calendar-alt'></p></div>
		// <div id='boxTabela'></div>";

	

		$content = '<div id="boxCalendario"><p>Valores válidos para <b>o dia: </b><div class="input-container"><i class="icon dashicons dashicons-calendar-alt"></i><input class="input-field" type="text" name="date_search"  class="form-control price_table" data-toggle="datepicker" data-max="'.$one_more_week.'" data-min="'.$today.'" data-id="'.$post->ID.'"></div></div><div id="boxTabela"></div>';
	}

	return $content;
}