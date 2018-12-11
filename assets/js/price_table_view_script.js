
jQuery('[data-toggle="datepicker"]').on('change',function(){

	var date = jQuery(this).val();
	var d = date.split("/");
	var data_final = d[2]+"-"+d[1]+"-"+d[0];

	var data_id = jQuery('[data-toggle="datepicker"]').attr('data-id');
	jQuery.ajax({
		type:'POST',
		url: ajax_object.ajax_url,
		dataType: 'html',
		data:{action: 'pw_search_date', day:data_final, id:data_id},
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

jQuery('[data-toggle="datepicker"]').datepicker(
	{ autoHide: true, 
	  autoPick:true, 
	  format: 'dd/mm/yyyy', 
	  language: 'pt-BR',
	  daysShort:['Dom','Seg','Ter','Qua','Qui','Sex','Sáb']
	}
);


