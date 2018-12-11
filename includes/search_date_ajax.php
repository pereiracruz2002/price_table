<?php
function pw_search_date(){
	$id = $_POST['id'];
	$day_of_week = date('w', strtotime($_POST['day'] ));
	$day_month_year = date('d/m/Y', strtotime( $_POST['day'] ) );
	$day_month_year_previous = $one_more_week = date('d/m/Y', strtotime( $_POST['day']. ' -1 day' ) );
	$info_table_price_serialize = get_post_meta( $id , 'info_table_price', true );
	$info_table_price = unserialize( $info_table_price_serialize );
	$return_date = array();
	$html = '';
	$is_holiday = false;
	$day_of_week_holiday = '';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, URL_API_HOLIDAYS);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	$holidays = trim(curl_exec($ch));
	curl_close($ch);
	$holidays_array = json_decode($holidays);


	foreach($holidays_array as $chave => $feriado){
		if($feriado->date == $day_month_year){
			$day_of_week_holiday = 7;
			$is_holiday = true;
		}

		if($feriado->date == $day_month_year_previous){
			$day_of_week_holiday = 8;
			$is_holiday = true;
		}
		
	}




	$week = array(
		0 => 'Domingo',
		1 => 'Segunda-Feira',
		2 => 'Terça-Feira',
		3 => 'Quarta-Feira',
		4 => 'Quinta-Feira',
		5 => 'Sexta-Feira',
		6 => 'Sábado',
		7 => 'Feriados',
		8 => 'Pré feriados'
	);


	foreach( $info_table_price as $key => $value ){
		$indice_array = explode("_", $key);
		$return_date[$indice_array[count($indice_array)-1]][$indice_array[1]] = $value;

	}

	foreach( $return_date as $indice => $array_valores ){
		foreach( $array_valores as $array_indice => $array_valores ){
			if($array_indice == "dia"){
				if( !$is_holiday ){
					if( $array_valores != $day_of_week ){
						unset($return_date[$indice]);
					}
				}else{
					if($array_valores != $day_of_week_holiday ){
						unset($return_date[$indice]);
					}
				}
				
			}
		}
	}


	if( !empty( $return_date ) ){

		$html.="<table class='table table-bordered'><thead><th>Dia</th><th>Valor</th><th>Das</th><th>Ás</th></thead><tbody>";

		$i = 0;
		foreach( $return_date as $label => $val ){
			if(($i%2)==0){
				$par_impar = "par";
			}else{
				$par_impar = "impar";
			}
			$html.="<tr class=' ".$par_impar."'><td>".$week[$day_of_week]."</td><td> R$ ".number_format($return_date[$label]['price'],2,',','.')."</td><td>".$return_date[$label]['start']."</td><td>".$return_date[$label]['finish']."</td></tr>";
			$i++;
		}

		$html.="</tbody></table>";
	}else{

		$html.= "<table><tr><td colspan='4'><p class='alert alert-danger'>Não há nenhum preço para ".$week[$day_of_week]."</p></td></tr></table>";

	}
	

	echo $html;
	wp_die();

	
}