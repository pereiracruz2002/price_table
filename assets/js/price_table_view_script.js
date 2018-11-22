jQuery('input[name="date_search"]').on('change',function(){

	var date = jQuery(this).val();
	var data_id = jQuery('input').attr('data-id');
	jQuery.ajax({
		type:'POST',
		url: ajax_object.ajax_url,
		dataType: 'html',
		data:{action: 'pw_search_date', day:date, id:data_id},
		success: function( data ){
			jQuery('#boxTabela').empty();
			jQuery('#boxTabela').append(data);
			jQuery('#boxTabela').show();
		},
		error: function( xhr ){
      		console.log(xhr.responseText);
  		} 
	})
	
})

jQuery('input[name="date_search"]').trigger("change");


