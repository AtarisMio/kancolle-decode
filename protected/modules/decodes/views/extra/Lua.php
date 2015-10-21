<style type="text/css">
.vline {
	width:130px;
	height:24px;
	line-height:24px;
	font-size:12px;
	background:#369;
	border:1px solid #000;
	float:left;
	margin:5px;
	font-weight:bold;
	color:#fff;
	cursor:hand;
	cursor:pointer;
}
.name {
	width:95px;
	height:24px;
	float:left;
	overflow:hidden;
	margin:0px 5px;
}
.dl {
	width:24px;
	height:24px;
	float:right;
	background:#fff;
	color:#000 !important;;
	text-align:center;
}
#notice {
	width:500px;
	height:50px;
	line-height:50px;
	text-align:center;
	background:#fff;
	border:1px solid #ccc;
	font-size:14px;
	margin:20px auto 10px;
}
#ships {
	width:180px;
	background:#dfd;
	float:left;
	height:675px;
	overflow-y:scroll;
	overflow-x:hidden;
	font-size:14px;
}
.ship {
	width:150px;
	height:20px;
	line-height:20px;
	margin:0px 0px 3px 5px;
}
.ship .img {
	width:20px;
	height:20px;
	line-height:20px;
	margin:0px 5px 0px 0px;
	float:left;
}
.ship img {
	width:20px;
	height:20px;
}
.ship .shipname {
	width:120px;
	height:20px;
	float:left;
	white-space: nowrap;
}
#voices {
	width:580px;
	height:500px;
	float:right;
}
#shipInfo {
	width:560px;
	margin:5px auto 10px;
	background:#fff;
	border:1px solid #ccc;
	height:50px;
	padding:5px;
}
#shipInfo .img {
	width:50px;
	height:50px;
	float:left;
	margin:0px 20px 0px 0px;
}
#shipInfo .img img {
	width:50px;
	height:50px;
}
#shipInfo .name {
	width:480px;
	height:50px;
	font-size:20px;
	line-height:50px;
	float:left;
}
#luacode {
	width:560px;
}
#luacode textarea {
	width:560px;
	height:600px;
	background:#ffc;
}
</style>

<div id="ships">
	<?php foreach($allShips as $ship){
		if($ship->id>500) continue;
		if(!$ship->isBase) continue;
	?>
		<div class="ship">
			<div class="img">
				<img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/<?php echo $ship->id; ?>.png" />
			</div>
			<div class="shipname"><a href="<?php echo Yii::app()->createUrl('decodes/extra/lua', array('id'=>$ship->id)); ?>"><?php echo $ship->english; ?></a></div>
		
		</div>
	<?php } ?>
	
	<div style="clear:both;"></div>
</div>
<div id="voices">
	<div id="shipInfo">
		<div class="img"><img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/<?php echo $shipData->api_id; ?>.png" /></div>
		<div class="name"><?php echo $shipData->english; ?></div>
	</div>
	<div id="luacode">
<textarea>
local <?php echo $english; ?> = {
<?php
$ctr = 0;
$BaseForm = $shipData;
do{
	$this->renderPartial('decodes.views.extra.LuaPart', array(
		'model' => $models[$ctr],
		'shipData' => $shipData,
		'allItems' => $allItems,
	));
	if($shipData->api_aftershipid>0){
		if(file_exists('data/master/'.$date.'/ship/'.$shipData->api_aftershipid.'.json')){
			$shipData = KFile::readJSON('data/master/'.$date.'/ship/'.$shipData->api_aftershipid.'.json');
		}else{
			$shipData = KFile::readJSON('data/master/'.$mdate.'/ship/'.$shipData->api_aftershipid.'.json');
		}
	}else{
		$shipData = false;
	}
	$ctr++;
}while($shipData);
?>
	class = {
		_name = "<?php echo $this->cond($BaseForm->ctype_name,'?'); ?>",
		_class = <?php echo ($this->cond($BaseForm->api_cnum,'0',true) == 1)?'true':'false'; ?>,
		_base_type = <?php echo $stype; ?>,
	},
}
 
return <?php echo $english; ?></textarea>
<pre><?php //print_r($BaseForm); ?></pre>
	</div>
	<div style="clear:both;"></div>
</div>