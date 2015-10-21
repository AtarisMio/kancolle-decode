<?php
$params = array(
	'baseurl' => Yii::app()->baseUrl,
	'tim' => time(),
	
	'varName' => (isset($_REQUEST['varName']))?$_REQUEST['varName']:$ship->english,
	'varClass' => (isset($_REQUEST['varClass']))?$_REQUEST['varClass']:$ship->ctype_name,
	'varDate' => (isset($_REQUEST['varDate']))?$_REQUEST['varDate']:'',
	'varID' => $ship->api_id,
	'varLevel' => 'Remodel Level '.$ship->remodel_level,
	'varSteel' => $ship->remodel_fuel,
	'varAmmo' => $ship->remodel_ammo,
	'varHP1' => $ship->api_taik[0],
	'varAR1' => $ship->api_souk[0],
	'varAR2' => $ship->api_souk[1],
	'varFP1' => $ship->api_houg[0],
	'varFP2' => $ship->api_houg[1],
	'varTP1' => $ship->api_raig[0],
	'varTP2' => $ship->api_raig[1],
	'varAA1' => $ship->api_tyku[0],
	'varAA2' => $ship->api_tyku[1],
	'varLK1' => $ship->api_luck[0],
	'varRR' => $ship->api_backs,
	'varSP' => $ship->api_soku,
	'varRN' => $ship->api_leng,
);
$flashVars = http_build_query($params);
?>
<div style="width:800px; height:700px; border:1px solid #000; background:#fff; margin:0px 0px 10px 0px;">
	<embed src="<?php echo Yii::app()->baseUrl; ?>/images/compare/remodel3.swf?<?php echo $flashVars; ?>" style="width:800px; height:700px;" />
</div>
<div style="width:800px; border:1px solid #ccc; background:#fff;">
	<form action="?" method="GET" style="padding:10px;">
		Change Ship <input type="text" name="id" value="<?php echo $ship->api_id; ?>" />
		<input type="submit" value="Update" />
	</form>
	
	<form action="?" method="GET" style="padding:10px;">
		ID <input type="text" name="id" value="<?php echo $ship->api_id; ?>" /><br />
		Name <input type="text" name="varName" value="<?php echo $params['varName']; ?>" /><br />
		Class <input type="text" name="varClass" value="<?php echo $params['varClass']; ?>" /><br />
		Date <input type="text" name="varDate" value="<?php echo $params['varDate']; ?>" /> (<?php echo date("jS F Y"); ?>)<br />
		<input type="submit" value="Update" />
	</form>
	
	<pre><?php print_r( $ship); ?></pre>
</div>