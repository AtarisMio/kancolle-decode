<div id="pagetitle">Construction</div>
<div id="intro">
	These are the graphical presentations of the compiled LSC results taken from <a href="http://wikiwiki.jp/kancolle/?%C2%E7%B7%BF%B4%CF%B7%FA%C2%A4">wikiwiki.jp</a>. Only reports since <strong>July 4, 2014</strong> are included. This is the time when Musashi became buildable, thus changing the overall percentage of ship outcomes.
</div>
<div id="graphButtons">
	
	<a  href="<?php echo Yii::app()->createUrl('build/graph/index', array('german'=>0)); ?>" target="_blank">
	<div class="graphButton">
		Graph with NON-German Flagship
	</div></a>
	
	<a href="<?php echo Yii::app()->createUrl('build/graph/index', array('german'=>1)); ?>" target="_blank">
	<div class="graphButton">
		Graph WITH German Flagship
	</div></a>
	
	<div class="clear"></div>
</div>
<div id="latest">
	<div class="sectionHeader">
		<div class="sectionTitle">Latest 25 Reports</div>
		<div class="sectionDesc">The system is reading reports from <a href="http://wikiwiki.jp/kancolle/?%C2%E7%B7%BF%B4%CF%B7%FA%C2%A4">wikiwiki.jp</a></div>
	</div>
	<div id="reports">
		<?php foreach($latest as $report){ ?>
			<div class="report">
				<div class="report_column resources">
					<div class="resource"><?php echo $report['res1']; ?></div>
					<div class="resource"><?php echo $report['res2']; ?></div>
					<div class="resource"><?php echo $report['res3']; ?></div>
					<div class="resource"><?php echo $report['res4']; ?></div>
					<div class="resource"><?php echo $report['devmats']; ?></div>
					<div class="clear"></div>
				</div>
				<div class="report_column docks">
					<div class="icon"><img src="<?php echo $this->module->getAssetsUrl(); ?>/img/anchor.png" /></div>
					<div class="count"><?php echo ($report['opendocks'])?$report['opendocks']:'?'; ?></div>
					<div class="clear"></div>
				</div>
				<div class="report_column hqlv">
					<?php if($report['admiral']>0){ ?>
						HQ <?php echo $report['admiral']; ?>
					<?php } ?>
				</div>
				<div class="report_column flagship">
					<?php if($report['flag_id']>0){ ?>
						<?php echo $shipNames->{$report['flag_id']}; ?>
						<?php if($report['flag_lv']>0){ ?>
							Lv.<?php echo $report['flag_lv']; ?>
						<?php } ?>
					<?php } ?>
				</div>
				<div class="report_column result">
					= <strong><?php echo $shipNames->{$report['result']}; ?></strong>
				</div>
				<div class="report_column details">
					<?php echo date("M j, Y - H:i",strtotime($report['created'])); ?>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>
	</div>
	<div class="clear"></div>
</div>