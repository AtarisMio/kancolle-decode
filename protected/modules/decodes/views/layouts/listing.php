<?php $this->beginContent(); ?>
<div id="decodes_container">
	<div id="decodes_wrapper">
		<div id="decodes_masters">
			<a href="<?php echo Yii::app()->createUrl('decodes'); ?>">
			<div class="master master_ver highlink"><div>Home</div></div></a>
			
			<a href="<?php echo Yii::app()->createUrl('decodes/extra/resources'); ?>">
			<div class="master highlink"><div>Resources</div></div></a>
			
			<a href="<?php echo Yii::app()->createUrl('decodes/extra/art'); ?>">
			<div class="master highlink"><div>CG Watchlist</div></div></a>
			
			<a href="<?php echo Yii::app()->createUrl('decodes/extra/map', array('id'=>29)); ?>">
			<div class="master highlink"><div>Event Map</div></div></a>
			
			<!-- <a href="<?php echo Yii::app()->createUrl('decodes/extra/voice'); ?>">
			<div class="master highlink"><div>Voices</div></div></a> -->
			
			<a href="<?php echo Yii::app()->createUrl('decodes/extra/lua'); ?>">
			<div class="master highlink"><div>Lua Generator</div></div></a>
			
			<a href="<?php echo Yii::app()->createUrl('decodes/extra/browse'); ?>">
			<div class="master highlink"><div>Browse</div></div></a>
			
			<a href="<?php echo Yii::app()->createUrl('decodes/extra/voicecheck'); ?>">
			<div class="master highlink"><div>Voice Check</div></div></a>
			
			<div class="master_separator"></div>
				
			<?php if(!file_exists('data/master/'.date("Y-m-d_H-i").'/raw.json') && isset($_REQUEST['SHOWDL'])){ ?>
			<a href="<?php echo Yii::app()->createUrl('decodes/add/download'); ?>">
			<div class="master master_add"><div>+ Add new version</div></div></a>
			
			<div class="master_separator"></div>
			<?php } ?>
			
			<?php foreach(array_reverse(KFile::getVersions()) as $master){ ?>
				<a href="<?php echo Yii::app()->createUrl('decodes/view/index', array('date'=>$master)); ?>">
				<div class="master master_ver<?php if(Yii::app()->params['activeVersion']==$master){ echo ' master_active'; } ?>"><div>
					<?php echo $master; ?>
				</div></div></a>
			<?php } ?>
			
			<div class="clear"></div>
		</div>
		<div id="decodes_content">
			<div id="decode_padding">
				<?php echo $content; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php $this->endContent(); ?>