<div class="graphWrap">
	<div class="graphTitle">
		LSC Report Graph <?php echo ($german)?'WITH German Flagship':'with NON-German Flagship'; ?>
		(since <?php echo date('F j, Y', strtotime($date_start)); ?>)
	</div>
	<?php $shipList=array(); foreach($summary as $recipeName=>$recipeData){ ?>
		<div class="recipeRow">
			<div class="recipeName"><?php echo $recipeName; ?> (<?php echo $recipeData['count']; ?>)</div>
			<div class="recipeBar">
				<?php foreach($recipeData['ships'] as $ship){
					$shipList[$ship['name']] = $ship['color'];
					$width = ($ship['percent']/100)*(1300-(count($recipeData['ships'])));
				?>
					<div class="shipBar" style="width:<?php echo $width; ?>px; background:<?php echo $ship['color']; ?>;">
						<?php echo $ship['name']; ?> <?php echo round($ship['percent'],1); ?>%
					</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	<?php } ?>
	
	<div class="graphNames" style="">
		<?php foreach($shipList as $name=>$color){ ?>
			<div style="float:left; margin:0px 5px 5px 0px;">
				<div style="width:16px; height:16px; float:left; margin:0px 3px 0px 0px;background:<?php echo $color; ?>;"></div>
				<div style="font-size:12px; height:16px; line-height:16px; float:left;"><?php echo $name; ?></div>
				<div class="clear"></div>
			</div>
		<?php } ?>
		<div class="clear"></div>
	</div>
</div>