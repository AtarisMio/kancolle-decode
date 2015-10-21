<?php

$params = array(
	'title' => (isset($_REQUEST['title']))?$_REQUEST['title']:'',
	'ids' => implode(',', $ids),
	'baseurl' => Yii::app()->baseUrl,
	'tim' => time(),
);
$flashVars = http_build_query($params);

?>
<div style="width:960px; height:700px; border:1px solid #000; background:#fff; margin:0px 0px 10px 0px;">
	<embed src="<?php echo Yii::app()->baseUrl; ?>/images/compare/compile.swf?<?php echo $flashVars; ?>" style="width:960px; height:700px;" />
</div>
<div style="width:960px; height:100px; border:1px solid #ccc; background:#fff;">
	<form action="?" method="POST" style="padding:10px;">
		Title <input type="text" name="title" value="<?php echo $params['title']; ?>" />
		IDs <input type="text" name="ids" value="<?php echo $params['ids']; ?>" />
		<input type="submit" value="Update" />
		<hr />
		Christmas 2014 Art Update
	</form>
</div>