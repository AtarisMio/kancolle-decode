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
	background:#ffc;
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
.voiceSectionHead {
	width:560px;
	height:24px;
	font-size:18px;
	margin:20px auto 10px;
	border-bottom:1px solid #000;
}
</style>

<div id="ships">
	<?php foreach($allShips as $ship){ if($ship->id>500) continue; ?>
		<div class="ship">
			<div class="img">
				<img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/<?php echo $ship->id; ?>.png" />
			</div>
			<div class="shipname"><a href="<?php echo Yii::app()->createUrl('decodes/extra/voice', array('id'=>$ship->id)); ?>"><?php echo $ship->english; ?></a></div>
		
		</div>
	<?php } ?>
	
	<div style="clear:both;"></div>
</div>
<div id="voices">
	<div id="shipInfo">
		<div class="img"><img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/<?php echo $shipData->api_id; ?>.png" /></div>
		<div class="name"><?php echo $shipData->english; ?></div>
	</div>
	
	<div class="voiceSectionHead">Quotes</div>
	<div class="clear"></div>
	<div class="vline" data-num="1"><div class="name">Introduction</div><a download="Introduction.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>1)); ?>" id="file1" class="dl">▼</a></div>
	<div class="vline" data-num="25"><div class="name">Library Intro</div><a download="Library Intro.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>25)); ?>" id="file25" class="dl">▼</a></div>
	<div class="vline" data-num="2"><div class="name">Secretary(1)</div><a download="Secretary(1).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>2)); ?>" id="file2" class="dl">▼</a></div>
	<div class="vline" data-num="3"><div class="name">Secretary(2)</div><a download="Secretary(2).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>3)); ?>" id="file3" class="dl">▼</a></div>
	<div class="vline" data-num="4"><div class="name">Secretary(3)</div><a download="Secretary(3).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>4)); ?>" id="file4" class="dl">▼</a></div>
	<div class="vline" data-num="28"><div class="name">Secretary(married)</div><a download="Secretary(married).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>28)); ?>" id="file28" class="dl">▼</a></div>
	<div class="vline" data-num="24"><div class="name">Wedding</div><a download="Wedding.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>24)); ?>" id="file24" class="dl">▼</a></div>
	<div class="vline" data-num="8"><div class="name">Show player's score</div><a download="Show player's score.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>8)); ?>" id="file8" class="dl">▼</a></div>
	<div class="vline" data-num="13"><div class="name">Joining a fleet</div><a download="Joining a fleet.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>13)); ?>" id="file13" class="dl">▼</a></div>
	<div class="vline" data-num="9"><div class="name">Equipment(1)</div><a download="Equipment(1).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>9)); ?>" id="file9" class="dl">▼</a></div>
	<div class="vline" data-num="10"><div class="name">Equipment(2)</div><a download="Equipment(2).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>10)); ?>" id="file10" class="dl">▼</a></div>
	<div class="vline" data-num="26"><div class="name">Equipment(3)</div><a download="Equipment(3).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>26)); ?>" id="file26" class="dl">▼</a></div>
	<div class="vline" data-num="27"><div class="name">Supply</div><a download="Supply.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>27)); ?>" id="file27" class="dl">▼</a></div>
	<div class="vline" data-num="11"><div class="name">Docking = minor damage</div><a download="Docking = minor damage.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>11)); ?>" id="file11" class="dl">▼</a></div>
	<div class="vline" data-num="12"><div class="name">Docking = moderate damage</div><a download="Docking = moderate damage.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>12)); ?>" id="file12" class="dl">▼</a></div>
	<div class="vline" data-num="5"><div class="name">Ship construction</div><a download="Ship construction.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>5)); ?>" id="file5" class="dl">▼</a></div>
	<div class="vline" data-num="7"><div class="name">Return from sortie</div><a download="Return from sortie.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>7)); ?>" id="file7" class="dl">▼</a></div>
	<div class="vline" data-num="14"><div class="name">Start a sortie</div><a download="Start a sortie.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>14)); ?>" id="file14" class="dl">▼</a></div>
	<div class="vline" data-num="15"><div class="name">Battle start</div><a download="Battle start.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>15)); ?>" id="file15" class="dl">▼</a></div>
	<div class="vline" data-num="16"><div class="name">Attack</div><a download="Attack.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>16)); ?>" id="file16" class="dl">▼</a></div>
	<div class="vline" data-num="18"><div class="name">Night battle</div><a download="Night battle.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>18)); ?>" id="file18" class="dl">▼</a></div>
	<div class="vline" data-num="17"><div class="name">Night attack</div><a download="Night attack.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>17)); ?>" id="file17" class="dl">▼</a></div>
	<div class="vline" data-num="23"><div class="name">MVP</div><a download="MVP.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>23)); ?>" id="file23" class="dl">▼</a></div>
	<div class="vline" data-num="19"><div class="name">Minor damaged(1)</div><a download="Minor damaged(1).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>19)); ?>" id="file19" class="dl">▼</a></div>
	<div class="vline" data-num="20"><div class="name">Minor damaged(2)</div><a download="Minor damaged(2).mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>20)); ?>" id="file20" class="dl">▼</a></div>
	<div class="vline" data-num="21"><div class="name">=Moderately damaged</div><a download="=Moderately damaged.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>21)); ?>" id="file21" class="dl">▼</a></div>
	<div class="vline" data-num="22"><div class="name">Sunk</div><a download="Sunk.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>22)); ?>" id="file22" class="dl">▼</a></div>
	<div class="vline" data-num="29"><div class="name">Idle</div><a download="Idle.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>29)); ?>" id="file29" class="dl">▼</a></div>
	<div class="vline" data-num="6"><div class="name">Instant Repair?</div><a download="Instant Repair.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>6)); ?>" id="file6" class="dl">▼</a></div>
	
	<?php if($shipData->api_voicef>1){ ?>
	<div class="clear"></div>
	<div class="voiceSectionHead">Hourlies</div>
	<div class="clear"></div>
	<div class="vline" data-num="30"><div class="name">00:00</div><a download="00:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>30)); ?>" id="file30" class="dl">▼</a></div>
	<div class="vline" data-num="31"><div class="name">01:00</div><a download="01:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>31)); ?>" id="file31" class="dl">▼</a></div>
	<div class="vline" data-num="32"><div class="name">02:00</div><a download="02:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>32)); ?>" id="file32" class="dl">▼</a></div>
	<div class="vline" data-num="33"><div class="name">03:00</div><a download="03:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>33)); ?>" id="file33" class="dl">▼</a></div>
	<div class="vline" data-num="34"><div class="name">04:00</div><a download="04:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>34)); ?>" id="file34" class="dl">▼</a></div>
	<div class="vline" data-num="35"><div class="name">05:00</div><a download="05:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>35)); ?>" id="file35" class="dl">▼</a></div>
	<div class="vline" data-num="36"><div class="name">06:00</div><a download="06:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>36)); ?>" id="file36" class="dl">▼</a></div>
	<div class="vline" data-num="37"><div class="name">07:00</div><a download="07:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>37)); ?>" id="file37" class="dl">▼</a></div>
	<div class="vline" data-num="38"><div class="name">08:00</div><a download="08:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>38)); ?>" id="file38" class="dl">▼</a></div>
	<div class="vline" data-num="39"><div class="name">09:00</div><a download="09:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>39)); ?>" id="file39" class="dl">▼</a></div>
	<div class="vline" data-num="40"><div class="name">10:00</div><a download="10:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>40)); ?>" id="file40" class="dl">▼</a></div>
	<div class="vline" data-num="41"><div class="name">11:00</div><a download="11:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>41)); ?>" id="file41" class="dl">▼</a></div>
	<div class="vline" data-num="42"><div class="name">12:00</div><a download="12:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>42)); ?>" id="file42" class="dl">▼</a></div>
	<div class="vline" data-num="43"><div class="name">13:00</div><a download="13:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>43)); ?>" id="file43" class="dl">▼</a></div>
	<div class="vline" data-num="44"><div class="name">14:00</div><a download="14:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>44)); ?>" id="file44" class="dl">▼</a></div>
	<div class="vline" data-num="45"><div class="name">15:00</div><a download="15:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>45)); ?>" id="file45" class="dl">▼</a></div>
	<div class="vline" data-num="46"><div class="name">16:00</div><a download="16:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>46)); ?>" id="file46" class="dl">▼</a></div>
	<div class="vline" data-num="47"><div class="name">17:00</div><a download="17:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>47)); ?>" id="file47" class="dl">▼</a></div>
	<div class="vline" data-num="48"><div class="name">18:00</div><a download="18:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>48)); ?>" id="file48" class="dl">▼</a></div>
	<div class="vline" data-num="49"><div class="name">19:00</div><a download="19:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>49)); ?>" id="file49" class="dl">▼</a></div>
	<div class="vline" data-num="50"><div class="name">20:00</div><a download="20:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>50)); ?>" id="file50" class="dl">▼</a></div>
	<div class="vline" data-num="51"><div class="name">21:00</div><a download="21:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>51)); ?>" id="file51" class="dl">▼</a></div>
	<div class="vline" data-num="52"><div class="name">22:00</div><a download="22:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>52)); ?>" id="file52" class="dl">▼</a></div>
	<div class="vline" data-num="53"><div class="name">23:00</div><a download="23:00.mp3" href="<?php echo Yii::app()->createUrl('decodes/extra/DownloadVoice', array('id'=>$shipData->api_id,'num'=>53)); ?>" id="file53" class="dl">▼</a></div>
	<?php } ?>
	
	<div style="clear:both;"></div>
</div>

<script type="text/javascript">
var snd = false;
$(document).on("ready", function(){
	$(".name").on("click", function(){
		var lineNum = $(this).parent().data("num");
		if(snd) snd.pause();
		snd = new Audio("http://125.6.189.247/kcs/sound/kc<?php echo $filename; ?>/"+lineNum+".mp3");
		snd.play();
	});
});
</script>