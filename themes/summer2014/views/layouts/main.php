<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="content-language" content="en">
		<meta name="google" value="notranslate" />
		<title><?php echo isset($this->pageTitle) ? $this->pageTitle : Yii::app()->name; ?></title>
		<link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/icon.png">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/reset.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/style.css" />
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/jquery.js"></script>
	</head>
	<body>
		<div id="wrapper">
			
			<!-- HEADER -->
			<div id="header">
				<div id="logo">
					<a href="<?php echo Yii::app()->getBaseUrl(true); ?>">
						<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/logo.png" />
					</a>
				</div>
				<div id="mainmenu">
					Other features on this site:
					&nbsp; &nbsp;
					[<a href="<?php echo Yii::app()->createUrl('decodes'); ?>">Game Data</a>]
					&nbsp; &nbsp;
					[<a href="<?php echo Yii::app()->createUrl('build'); ?>">LSC Graphs</a>]
					&nbsp; &nbsp;
					[<a href="<?php echo Yii::app()->createUrl('studies'); ?>">Case Studies</a>]
				</div>
				<div id="navigation">
					<a href="<?php echo Yii::app()->createUrl('event/home/index',
					array('world'=>'summer2014')); ?>">
					<div class="navItem">Home</div></a>
					
					<a href="<?php echo Yii::app()->createUrl('event/map/index',
					array('world'=>'summer2014', 'number'=>1)); ?>">
					<div class="navItem">AL-1</div></a>
					
					<a href="<?php echo Yii::app()->createUrl('event/map/index',
					array('world'=>'summer2014', 'number'=>2)); ?>">
					<div class="navItem">AL-2</div></a>
					
					<a href="<?php echo Yii::app()->createUrl('event/map/index',
					array('world'=>'summer2014', 'number'=>3)); ?>">
					<div class="navItem">MI-1</div></a>
					
					<a href="<?php echo Yii::app()->createUrl('event/map/index',
					array('world'=>'summer2014', 'number'=>4)); ?>">
					<div class="navItem">MI-2</div></a>
					
					<a href="<?php echo Yii::app()->createUrl('event/map/index',
					array('world'=>'summer2014', 'number'=>5)); ?>">
					<div class="navItem">MI-3</div></a>
				</div>
				<div class="clear"></div>
			</div>
			
			<!-- CONTENT AREA -->
			<div id="content">
				
				<?php echo $content; ?>
				
				<div class="clear"></div>
			</div>
			
		</div>
	</body>
</html> 