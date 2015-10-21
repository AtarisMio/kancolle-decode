<?php foreach($maps as $index=>$map){ ?>
	<a href="http://203.104.209.71/kcs/resources/swf/map/<?php echo $MapID; ?>_<?php echo str_pad($index+1, 2, '0', STR_PAD_LEFT); ?>.swf">
		<img src="<?php echo Yii::app()->baseUrl.'/'.$map; ?>" style="width:300px; float:left; margin:10px;" />
	</a>
<?php } ?>