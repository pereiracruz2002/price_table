
function add_maskMoney(){
	jQuery(".money").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
}

add_maskMoney();

jQuery( document ).on( 'click', '.add_row', function( e ){
	e.preventDefault();
	var row= "<tr>"+jQuery( this ).parent().parent().parent().children().html();
	row+="<td><button  type='submit' class='button tagadd remove_row'>Remover</button></td></tr>";
	jQuery( '.table-price tbody' ).append( row );
	add_maskMoney();
});

jQuery( document ).on( 'click', '.remove_row', function( e ){
	e.preventDefault();
	jQuery( this ).parent().parent().remove();
});

