<?php
$params = array(
	'baseurl' => Yii::app()->baseUrl,
	'tim' => time(),
	
	'varName' => (isset($_REQUEST['varName']))?$_REQUEST['varName']:$ship->english,
	'varClass' => (isset($_REQUEST['varClass']))?$_REQUEST['varClass']:$ship->ctype_name,
	'varDate' => (isset($_REQUEST['varDate']))?$_REQUEST['varDate']:'',
	'varID' => $ship->api_id,
	'varLevel' => 'Remodel Level '.$ship->api_afterlv,
	'varSteel' => $remodel->remodel_fuel,
	'varAmmo' => $remodel->remodel_ammo,
	'varRR' => $ship->api_backs,
	
	'basHP1' => $ship->api_taik[0],
	'basAR1' => $ship->api_souk[0],
	'basAR2' => $ship->api_souk[1],
	'basFP1' => $ship->api_houg[0],
	'basFP2' => $ship->api_houg[1],
	'basTP1' => $ship->api_raig[0],
	'basTP2' => $ship->api_raig[1],
	'basAA1' => $ship->api_tyku[0],
	'basAA2' => $ship->api_tyku[1],
	'basLK1' => $ship->api_luck[0],
	'basLK2' => $ship->api_luck[1],
	'basSP' => $ship->api_soku,
	'basRN' => $ship->api_leng,
	
	'varHP1' => $remodel->api_taik[0],
	'varAR1' => $remodel->api_souk[0],
	'varAR2' => $remodel->api_souk[1],
	'varFP1' => $remodel->api_houg[0],
	'varFP2' => $remodel->api_houg[1],
	'varTP1' => $remodel->api_raig[0],
	'varTP2' => $remodel->api_raig[1],
	'varAA1' => $remodel->api_tyku[0],
	'varAA2' => $remodel->api_tyku[1],
	'varLK1' => $remodel->api_luck[0],
	'varLK2' => $remodel->api_luck[1],
	'varSP' => $remodel->api_soku,
	'varRN' => $remodel->api_leng,
);
$flashVars = http_build_query($params);
?>
<div style="width:850px; height:750px; border:1px solid #000; background:#fff; margin:0px 0px 10px 0px;">
	<embed src="<?php echo Yii::app()->baseUrl; ?>/images/compare/newship2.swf?<?php echo $flashVars; ?>" style="width:850px; height:750px;" />
</div>
<div style="width:850px; border:1px solid #ccc; background:#fff;">
	<form action="?" method="GET" style="padding:10px;">
		ID <input type="text" name="id" value="<?php echo $ship->api_id; ?>" /><br />
		Remodel <input type="text" name="remodel" value="<?php echo $remodel->api_id; ?>" /><br />
		Name <input type="text" name="varName" value="<?php echo $params['varName']; ?>" /><br />
		Class <input type="text" name="varClass" value="<?php echo $params['varClass']; ?>" /><br />
		Date <input type="text" name="varDate" value="<?php echo $params['varDate']; ?>" /> (<?php echo date("jS F Y"); ?>)<br />
		<input type="submit" value="Update" />
	</form>
	
	<pre><?php print_r( $ship); ?></pre>
	<pre><?php print_r( $params); ?></pre>
</div>