<div class="process_head">Data <strong><?php echo $date; ?></strong> is unprocessed.</div>
<div class="process_list">

	<?php if(!file_exists('data/master/'.$date.'/raw.json')){ ?>
	<div class="process_item">
		<div class="process_icon process_red"></div>
		<div class="process_text">
			There is no master file!
		</div>
		<div class="clear"></div>
	</div>
	<?php }else{ ?>
	<div class="process_item">
		<div class="process_icon process_green"></div>
		<div class="process_text">Master file is OK!</div>
		<div class="clear"></div>
	</div>
	<?php } ?>

	<?php if(!file_exists('data/master/'.$date.'/stype/_summary.json')){ ?>
	<div class="process_item">
		<div class="process_icon process_red"></div>
		<div class="process_text">
			<a href="<?php echo Yii::app()->createUrl('decodes/add/parse', array('date'=>$date)); ?>">
			Decode master file</a>
		</div>
		<div class="clear"></div>
	</div>
	<?php }else{ ?>
	<div class="process_item">
		<div class="process_icon process_green"></div>
		<div class="process_text">Master file is decoded!</div>
		<div class="clear"></div>
	</div>
	<?php } ?>
	
	<?php if(!file_exists('data/master/'.$date.'/changes.json')){ ?>
	<div class="process_item">
		<div class="process_icon process_red"></div>
		<div class="process_text">
			<a href="<?php echo Yii::app()->createUrl('decodes/add/compare', array('date'=>$date)); ?>">
			Compare changes with latest</a>
		</div>
		<div class="clear"></div>
	</div>
	<?php }else{ ?>
	<div class="process_item">
		<div class="process_icon process_green"></div>
		<div class="process_text">Versions had been compared!</div>
		<div class="clear"></div>
	</div>
	<?php } ?>
	
</div>