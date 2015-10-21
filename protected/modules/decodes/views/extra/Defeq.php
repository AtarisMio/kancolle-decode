<pre><?php
$idswithDefeq = array();
$defeqCounts = array();
foreach($ships as $ship){
	if($ship->api_id >= 500) continue;
	$defeq = 0;
	foreach($ship->api_defeq as $cde){
		if($cde > -1){ $defeq++; }
	}
	$defeqCounts['s'.$ship->api_id] = $defeq;
	array_push($idswithDefeq, $ship->api_id);
}


foreach($latestShips as $latestShip){
	if($latestShip->api_id >= 500) continue;
	if( !array_search( $latestShip->api_id, $idswithDefeq ) ){
		$defeqCounts['s'.$latestShip->api_id] = $latestShip->api_name;
	}
}

echo json_encode($defeqCounts, JSON_PRETTY_PRINT);
?></pre>