<pre><?php //print_r($graph); ?></pre>

<?php foreach($furnitures as $furniture){ ?>
	<div style="width:140px; height:190px; border:1px solid #aaa; margin:5px; float:left;">
		<div style="width:140px; height:20px; line-height:20px; text-align:center; font-weight:bold; font-size:12px; background:#ace;">
			<?php
			if(isset($graph[$furniture->api_id])){
				$filename = $graph[$furniture->api_id]->api_filename;
			}else{
				$filename = str_pad(intval($furniture->api_no)+1, 3, '0', STR_PAD_LEFT);
			}
			?>
			[<?php echo $furniture->api_id; ?>] <?php echo $furniture->api_title; ?>
		</div>
		<div style="width:140px; height:150px; line-height:150px; text-align:center;">
			<a href="http://125.6.189.247/kcs/resources/image/furniture/<?php echo $types[$furniture->api_type]; ?>/<?php echo $filename; ?>.png" target="_blank">
			<img src="http://125.6.189.247/kcs/resources/image/furniture/<?php echo $types[$furniture->api_type]; ?>/<?php echo $filename; ?>.png" style="max-width:140px; max-height:150px;" /></a>
			<embed style="width:140px; height:150px;" style="display:none;" />
		</div>
		<div style="width:140px; height:20px; line-height:20px; background:#def;">
			c<?php echo $furniture->api_price; ?> /
		</div>
	</div>
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
	/*$('img').error(function(){
		$("embed", $(this).parent()).attr("src", $(this).data("raw")+"swf"));
		$("embed", $(this).parent()).show();
		$(this).hide();
	});*/
});
</script>