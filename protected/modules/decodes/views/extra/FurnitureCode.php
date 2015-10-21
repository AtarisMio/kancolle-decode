<pre>
&lt;tabber>Floor=
==Floor==
<?php foreach($furnitures[0] as $furniture){
	if(isset($graph[$furniture->api_id])){
		$filename = $graph[$furniture->api_id]->api_filename;
	}else{
		$filename = str_pad(intval($furniture->api_no)+1, 3, '0', STR_PAD_LEFT);
	}
	$english = (isset($FurnNames->{$furniture->api_title}))?$FurnNames->{$furniture->api_title}:$furniture->api_title;
?>
===<?php echo $english; ?> ===
{{FurnitureInfo
|name=<?php echo $english; ?> 
|type=<?php echo $types[$furniture->api_type]; ?> 
|japanesename=<?php echo $furniture->api_title; ?> 
|image=File:<?php echo str_replace("[","",str_replace("]","",$english)); ?>.png 
|coin=<?php echo $furniture->api_price; ?> 
|fairy=0
|releasenote=
}}
<?php } ?>

|-|Wallpaper=
==Wallpaper==
<?php foreach($furnitures[1] as $furniture){
	if(isset($graph[$furniture->api_id])){
		$filename = $graph[$furniture->api_id]->api_filename;
	}else{
		$filename = str_pad(intval($furniture->api_no)+1, 3, '0', STR_PAD_LEFT);
	}
	$english = (isset($FurnNames->{$furniture->api_title}))?$FurnNames->{$furniture->api_title}:$furniture->api_title;
?>
===<?php echo $english; ?> ===
{{FurnitureInfo
|name=<?php echo $english; ?> 
|type=<?php echo $types[$furniture->api_type]; ?> 
|japanesename=<?php echo $furniture->api_title; ?> 
|image=File:<?php echo str_replace("[","",str_replace("]","",$english)); ?>.png 
|coin=<?php echo $furniture->api_price; ?> 
|fairy=0
|releasenote=
}}
<?php } ?>

|-|Window=
==Window==
<?php foreach($furnitures[2] as $furniture){
	if(isset($graph[$furniture->api_id])){
		$filename = $graph[$furniture->api_id]->api_filename;
	}else{
		$filename = str_pad(intval($furniture->api_no)+1, 3, '0', STR_PAD_LEFT);
	}
	$english = (isset($FurnNames->{$furniture->api_title}))?$FurnNames->{$furniture->api_title}:$furniture->api_title;
?>
===<?php echo $english; ?> ===
{{FurnitureInfo
|name=<?php echo $english; ?> 
|type=<?php echo $types[$furniture->api_type]; ?> 
|japanesename=<?php echo $furniture->api_title; ?> 
|image=File:<?php echo str_replace("[","",str_replace("]","",$english)); ?>.png 
|coin=<?php echo $furniture->api_price; ?> 
|fairy=0
|releasenote=
}}
<?php } ?>

|-|Object=
==Object==
<?php foreach($furnitures[3] as $furniture){
	if(isset($graph[$furniture->api_id])){
		$filename = $graph[$furniture->api_id]->api_filename;
	}else{
		$filename = str_pad(intval($furniture->api_no)+1, 3, '0', STR_PAD_LEFT);
	}
	$english = (isset($FurnNames->{$furniture->api_title}))?$FurnNames->{$furniture->api_title}:$furniture->api_title;
?>
===<?php echo $english; ?> ===
{{FurnitureInfo
|name=<?php echo $english; ?> 
|type=<?php echo $types[$furniture->api_type]; ?> 
|japanesename=<?php echo $furniture->api_title; ?> 
|image=File:<?php echo str_replace("[","",str_replace("]","",$english)); ?>.png 
|coin=<?php echo $furniture->api_price; ?> 
|fairy=0
|releasenote=
}}
<?php } ?>

|-|Chest=
==Chest==
<?php foreach($furnitures[4] as $furniture){
	if(isset($graph[$furniture->api_id])){
		$filename = $graph[$furniture->api_id]->api_filename;
	}else{
		$filename = str_pad(intval($furniture->api_no)+1, 3, '0', STR_PAD_LEFT);
	}
	$english = (isset($FurnNames->{$furniture->api_title}))?$FurnNames->{$furniture->api_title}:$furniture->api_title;
?>
===<?php echo $english; ?> ===
{{FurnitureInfo
|name=<?php echo $english; ?> 
|type=<?php echo $types[$furniture->api_type]; ?> 
|japanesename=<?php echo $furniture->api_title; ?> 
|image=File:<?php echo str_replace("[","",str_replace("]","",$english)); ?>.png 
|coin=<?php echo $furniture->api_price; ?> 
|fairy=0
|releasenote=
}}
<?php } ?>

|-|Desk=
==Desk==
<?php foreach($furnitures[5] as $furniture){
	if(isset($graph[$furniture->api_id])){
		$filename = $graph[$furniture->api_id]->api_filename;
	}else{
		$filename = str_pad(intval($furniture->api_no)+1, 3, '0', STR_PAD_LEFT);
	}
	$english = (isset($FurnNames->{$furniture->api_title}))?$FurnNames->{$furniture->api_title}:$furniture->api_title;
?>
===<?php echo $english; ?> ===
{{FurnitureInfo
|name=<?php echo $english; ?> 
|type=<?php echo $types[$furniture->api_type]; ?> 
|japanesename=<?php echo $furniture->api_title; ?> 
|image=File:<?php echo str_replace("[","",str_replace("]","",$english)); ?>.png 
|coin=<?php echo $furniture->api_price; ?> 
|fairy=0
|releasenote=
}}
<?php } ?>

&lt;/tabber>
</pre>