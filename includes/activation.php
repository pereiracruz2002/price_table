<?php
function pw_activation(){
	if( version_compare( get_bloginfo('version'), '4.5' , '<' ) ){
		wp_die( __('Update your wordpress') );
	}
}
