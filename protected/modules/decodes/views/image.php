<?php
$queryArray = array();
$queryArray['t'] = time();

$currentShip = 1;
$newRemodels = array();
foreach($changes->ship->ship->fresh as $ship){
	$shipgraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$ship->api_id.'.json');
	
	if(!file_exists('CG/'.$ship->api_id.'.swf')){
		@file_put_contents(
			'CG/'.$ship->api_id.'.swf',
			@file_get_contents("http://203.104.105.167/kcs/resources/swf/ships/".$shipgraph->api_filename.".swf?VERSION=1")
		);
	}
	$queryArray['CG_'.$currentShip] = Yii::app()->getBaseUrl(true).'/CG/'.$ship->api_id.'.swf';
	$queryArray['name_'.$currentShip] = $ship->english;
	$queryArray['type_'.$currentShip] = $ship->ctype_name."-class ".$stypes->{$ship->api_stype}->EN;
	$queryArray['what_'.$currentShip] = 'new';
	$newRemodels[] = $ship->api_aftershipid;
	$currentShip++;
}

foreach($changes->ship->ship->remodel as $ship){
	$newRemodels[] = $ship->api_aftershipid;
	if(!in_array( $ship->api_id, $newRemodels)){
		$shipgraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$ship->api_id.'.json');
		
		if(!file_exists('CG/'.$ship->api_id.'.swf')){
			file_put_contents(
				'CG/'.$ship->api_id.'.swf',
				file_get_contents("http://203.104.105.167/kcs/resources/swf/ships/".$shipgraph->api_filename.".swf?VERSION=1")
			);
		}
		$queryArray['CG_'.$currentShip] = Yii::app()->getBaseUrl(true).'/CG/'.$ship->api_id.'.swf';
		$queryArray['name_'.$currentShip] = $ship->english;
		$queryArray['type_'.$currentShip] = $ship->ctype_name."-class ".$stypes->{$ship->api_stype}->EN;
		$queryArray['what_'.$currentShip] = 'remodel';
		$currentShip++;
	}
}

$currentItem = 1;
foreach($changes->slotitem->fresh as $item){
	if($item->api_sortno<501){
		$sortno = str_pad($item->api_sortno, 3, '0', STR_PAD_LEFT);
		$queryArray['item_'.$currentItem] = 'http://125.6.189.71/kcs/resources/image/slotitem/card/'.$sortno.'.png';
		$currentItem++;
	}
}

$flashQuery = http_build_query($queryArray);
?>
<div style="width:960px; height:850px; background:#333;">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="960" height="850">
		<param name="movie" value="<?php echo $this->module->getAssetsUrl(); ?>/compilation.swf?<?php echo $flashQuery; ?>" />
		<param name="quality" value="best" />
		<param name="bgcolor" value="#ffffff" />
		<param name="play" value="true" />
		<param name="loop" value="false" />
		<param name="wmode" value="window" />
		<param name="scale" value="showall" />
		<param name="menu" value="true" />
		<param name="devicefont" value="false" />
		<param name="salign" value="" />
		<param name="allowScriptAccess" value="always" />
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="<?php echo $this->module->getAssetsUrl(); ?>/compilation.swf?<?php echo $flashQuery; ?>" width="960" height="850">
			<param name="movie" value="<?php echo $this->module->getAssetsUrl(); ?>/compilation.swf?<?php echo $flashQuery; ?>" />
			<param name="quality" value="best" />
			<param name="bgcolor" value="#ffffff" />
			<param name="play" value="true" />
			<param name="loop" value="false" />
			<param name="wmode" value="window" />
			<param name="scale" value="showall" />
			<param name="menu" value="true" />
			<param name="devicefont" value="false" />
			<param name="salign" value="" />
			<param name="allowScriptAccess" value="always" />
		<!--<![endif]-->
			<a href="http://www.adobe.com/go/getflash">
				<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
			</a>
		<!--[if !IE]>-->
		</object>
		<!--<![endif]-->
	</object>
</div>


<?php
$queryArray2 = array();
$queryArray2['t'] = time();

$currentShip2 = 1;
if(isset($changes->ship->ship->abyss)){
	foreach(@$changes->ship->ship->abyss as $ship){
		$shipgraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$ship->api_id.'.json');
		
		if(!file_exists('CG/'.$ship->api_id.'.swf')){
			file_put_contents(
				'CG/'.$ship->api_id.'.swf',
				file_get_contents("http://203.104.105.167/kcs/resources/swf/ships/".$shipgraph->api_filename.".swf?VERSION=1")
			);
		}
		$queryArray2['CG_'.$currentShip2] = Yii::app()->getBaseUrl(true).'/CG/'.$ship->api_id.'.swf';
		$queryArray2['name_'.$currentShip2] = $ship->english;
		$currentShip2++;
	}
}

$flashQuery2 = http_build_query($queryArray2);
?>
<div style="width:960px; height:850px; background:#333; margin:20px 0px 10px 0px;">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="960" height="850">
		<param name="movie" value="<?php echo $this->module->getAssetsUrl(); ?>/compilation2.swf?<?php echo $flashQuery2; ?>" />
		<param name="quality" value="best" />
		<param name="bgcolor" value="#ffffff" />
		<param name="play" value="true" />
		<param name="loop" value="false" />
		<param name="wmode" value="window" />
		<param name="scale" value="showall" />
		<param name="menu" value="true" />
		<param name="devicefont" value="false" />
		<param name="salign" value="" />
		<param name="allowScriptAccess" value="always" />
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="<?php echo $this->module->getAssetsUrl(); ?>/compilation2.swf?<?php echo $flashQuery2; ?>" width="960" height="850">
			<param name="movie" value="<?php echo $this->module->getAssetsUrl(); ?>/compilation2.swf?<?php echo $flashQuery2; ?>" />
			<param name="quality" value="best" />
			<param name="bgcolor" value="#ffffff" />
			<param name="play" value="true" />
			<param name="loop" value="false" />
			<param name="wmode" value="window" />
			<param name="scale" value="showall" />
			<param name="menu" value="true" />
			<param name="devicefont" value="false" />
			<param name="salign" value="" />
			<param name="allowScriptAccess" value="always" />
		<!--<![endif]-->
			<a href="http://www.adobe.com/go/getflash">
				<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
			</a>
		<!--[if !IE]>-->
		</object>
		<!--<![endif]-->
	</object>
</div>

&nbsp;