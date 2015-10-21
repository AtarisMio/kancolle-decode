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
			<div id="content">
				<?php echo $content; ?>
				<div class="clear"></div>
			</div>
		</div>
	</body>
</html> 