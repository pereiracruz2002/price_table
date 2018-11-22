<?php
function pw_price_tables_opcoes( $post ){

	$info_table_price = get_post_meta( $post->ID,'info_table_price',true );
	$info_table_edit = false;

	if( !empty( $info_table_price ) ){
		$info_table_edit = true;
		$info_table_price_array_unserialize = unserialize( $info_table_price );
		$info_table_price_array = array();
		$j = 0;

		foreach( $info_table_price_array_unserialize as $key => $value ){
			$indice = explode( "_", $key );
			$info_table_price_array[$indice[count($indice)-1]][$indice[1]] = $value;
			$j++;
		}

	}
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
		<?php if( !$info_table_edit ):?>
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
		<?php else:?>
			<?php
				$i = 0;
				foreach ( $info_table_price_array as $key => $value ):?>
				<tr>
					<td>
						<select name="pw_dia[]">
							<option value="0" <?php echo( $value['dia'] == "0" ? ' selected="selected"' : ''); ?>>Domingo</option>
							<option value="1" <?php echo( $value['dia'] == "1" ? ' selected="selected"' : ''); ?>>Segunda</option>
							<option value="2" <?php echo( $value['dia'] == "2" ? ' selected="selected"' : ''); ?>>Terça-Feira</option>
							
							<option value="3" <?php echo( $value['dia'] == "3" ? ' selected="selected"' : ''); ?>>Quarta-Feira</option>

							<option value="4" <?php echo( $value['dia'] == "4" ? ' selected="selected"' : ''); ?>>Quinta-Feira</option>

							<option value="5" <?php echo( $value['dia'] == "5" ? ' selected="selected"' : ''); ?>>Sexta-Feira</option>

							<option value="6" <?php echo( $value['dia'] == "6" ? ' selected="selected"' : ''); ?>>Sábado</option>

							<option value="7" <?php echo( $value['dia'] == "7" ? ' selected="selected"' : ''); ?>>Feriados</option>

							<option value="8" <?php echo( $value['dia'] == "8" ? ' selected="selected"' : ''); ?>>Pré feriados</option>
						</select>
					</td>
					<td>
						<input class="form-control money" type="text" name="pw_price[]"  value="<?php echo $value['price']; ?>"></td>
					<td>
						<input class="form-control" type="time" name="pw_start_hour[]" value="<?php echo $value['start']; ?>">
					</td>
					<td>
						<input class="form-control" type="time" name="pw_finish_hour[]" value="<?php echo $value['finish']; ?>">
					</td>
					<td>
						<button  type="submit" class="button tagadd add_row">+ Horários</button>
					</td>
					<td><button  type='submit' class='button tagadd remove_row'>Remover</button></td>
				</tr>
				<?php $i++;?>
			<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>

<?php	
}