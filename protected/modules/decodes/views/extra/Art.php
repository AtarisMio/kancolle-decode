<div style="width:780px;">
	
	<?php for($i=0; $i<9; $i++){ ?>
	<?php if(intval($ids[$i])>0){ ?>
	<div style="width:175px; height:230px; float:left; margin:5px; border:1px solid #ccc; padding:2px;">
		<div style="width:175px; height:20px; line-height:20px; font-size:12px; font-weight:bold; margin:0px 0px 3px 0px; text-align:center; background:#def;">
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo $filenames[$i]; ?>.swf?VERSION=<?php echo time(); ?>">
			[<?php echo $ids[$i]; ?>] <?php echo $ships[$ids[$i]]->api_name; ?></a>
		</div>
		<div style="width:175px; height:200px; text-align:center;">
			<img src="<?php echo Yii::app()->baseUrl; ?>/images/compare/new/<?php echo $ids[$i]; ?>.jpg?v=<?php echo time(); ?>" style="max-width:175px; max-height:200px; margin:0px 2px;" />
		</div>
		<div class="clear"></div>
	</div>
	<?php } ?>
	<?php } ?>
	
	<div class="clear"></div>
	<?php if(isset($_REQUEST['OPTIONZ'])){ ?>
	<div style="width:780px; text-align:center; margin:20px 0px 20px 0px;">
		<form method="POST">
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[0])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[0]); ?></a> - 
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[1])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[1]); ?></a> - 
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[2])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[2]); ?></a> - 
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[3])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[3]); ?></a> - 
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[4])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[4]); ?></a> - 
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[5])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[5]); ?></a> - 
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[6])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[6]); ?></a> - 
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[7])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[7]); ?></a> - 
			<a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo @$cgs[intval(@$ids[8])]->api_filename; ?>.swf?VERSION=<?php echo time(); ?>"><?php echo intval($ids[8]); ?></a>
			
			<hr />
			<div style="margin:0px 0px 5px 0px;">
				<input type="text" name="ids[0]" value="<?php echo intval($ids[0]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
				<input type="text" name="ids[1]" value="<?php echo intval($ids[1]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
				<input type="text" name="ids[2]" value="<?php echo intval($ids[2]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
			</div>
			<div style="margin:0px 0px 5px 0px;">
				<input type="text" name="ids[3]" value="<?php echo intval($ids[3]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
				<input type="text" name="ids[4]" value="<?php echo intval($ids[4]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
				<input type="text" name="ids[5]" value="<?php echo intval($ids[5]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
			</div>
			<div style="margin:0px 0px 15px 0px;">
				<input type="text" name="ids[6]" value="<?php echo intval($ids[6]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
				<input type="text" name="ids[7]" value="<?php echo intval($ids[7]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
				<input type="text" name="ids[8]" value="<?php echo intval($ids[8]); ?>" style="width:100px; height:22px; background:#ffc; border:1px solid #ccc; text-align:center;" />
			</div>
			<input type="submit" name="old" value="Re-Download and Set as the old art" style="width:250px; height:24px;" /> - or -
			<input type="submit" name="new" value="Fetch now and Check if new version" style="width:250px; height:24px;" /> - then -
			<input type="submit" name="compile" value="Compile CGs" style="width:150px; height:24px;" />
		</form>
	</div>
	<?php } ?>
</div>