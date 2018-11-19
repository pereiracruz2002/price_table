<?php
function pw_price_tables_opcoes( $post ){

	$preco_data = get_post_meta($post->ID,'preco_data',true);
	var_dump($preco_data);
	//var_dump( $post );


?>
<table  class="table table-bordered table-price">
	<thead>
		<tr>
			<td>Dia</td>
			<td>Preço</td>
			<td>Hora Início</td>
			<td>Hora Final</td>
			<td></td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<select name="pw_dia[]">
					<option value="0">Domingo</option>
					<option value="1">Segunda</option>
					<option value="2">Terça-Feira</option>
					<option value="3">Quarta-Feira</option>
					<option value="4">Quinta-Feira</option>
					<option value="5">Sexta-Feira</option>
					<option value="6">Sábado</option>
					<option value="7">Feriados</option>
					<option value="8">Pré feriados</option>
				</select>
			</td>
			<td>
				<input class="form-control money" type="text" name="pw_price[]"  value=""></td>
			<td>
				<input class="form-control" type="time" name="pw_start_hour[]" value="">
			</td>
			<td>
				<input class="form-control" type="time" name="pw_finish_hour[]" value="">
			</td>
			<td>
				<button  type="submit" class="button tagadd add_row">+ Horários</button>
			</td>
		</tr>
	</tbody>
</table>

<?php	
}