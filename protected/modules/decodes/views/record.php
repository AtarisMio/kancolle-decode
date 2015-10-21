<div class="recordName">
	<div class="nameID"><?php echo (isset($data->api_id))?$data->api_id:''; ?></div>
	<div class="nameEN"><?php echo (isset($data->english))?$data->english:''; ?></div>
	<div class="nameJP"><?php echo (isset($data->api_name))?$data->api_name:''; ?></div>
	<div class="clear"></div>
</div>
<table class="wikitable">
	<?php foreach((array)$data as $field=>$value){ ?>
	<tr>
		<td class="field_api"><?php echo $field; ?></td>
		<td class="field_en"><?php echo @$labels->{$field}; ?></td>
		<td class="value"><div style="width:500px; word-wrap:break-word;"><?php echo (is_array($value) || is_object($value))?'<pre>'.print_r($value,TRUE).'</pre>':$value; ?></div></td>
	</tr>
	<?php } ?>
</table>
&nbsp;

<style type="text/css">
	.recordName {
		width:940px;
		margin:0px auto 10px;
		height:40px;
		line-height:40px;
		font-size:20px;
		font-weight:bold;
		padding:10px 0px 0px 0px;
	}
	.recordName .nameID {
		width:70px;
		height:40px;
		float:left;
	}
	.recordName .nameEN {
		width:500px;
		height:40px;
		float:left;
	}
	.recordName .nameJP {
		width:370px;
		height:40px;
		float:left;
	}
	.wikitable {
		width:940px;
		margin:0px auto;
		font-size:14px;
	}
	.wikitable td {
		border:1px solid #ccc;
		padding:5px;
	}
	.wikitable td.field_api {
		width:200px;
		font-weight:bold;
	}
	.wikitable td.field_en {
		width:200px;
	}
	.wikitable td.value {
		
	}
</style>