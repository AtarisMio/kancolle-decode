<style type="text/css">
	tr:hover {
		background:#ccc;
	}
	td {
		padding:2px 0px;
		border:1px solid #ccc;
	}
</style>
<div style="font-size:14px; line-height:18px;">
	<table border="1" cellpadding="0" cellspacing="0">
		<tr>
			<td style="width:50px;">ID</td>
			<td style="width:50px;">Library</td>
			<td style="width:120px;">English</td>
			<td style="width:120px;">Japanese</td>
			<td style="width:80px;">Data</td>
			<td style="width:80px;">Graph</td>
			<td style="width:80px;">SWF</td>
		</tr>
		<?php foreach($ships as $ship){ ?>
			<tr>
				<td><?php echo $ship->id; ?></td>
				<td><?php echo $ship->sortno; ?></td>
				<td><?php echo $ship->english; ?></td>
				<td><?php echo $ship->name; ?></td>
				<td><a href="<?php echo Yii::app()->createUrl('decodes/record/index', array(
					'date' => $date,
					'master' => 'ship',
					'id' => $ship->id,
				)); ?>" target="_blank">
					Data
				</a></td>
				<td><a href="<?php echo Yii::app()->createUrl('decodes/record/index', array(
					'date' => $date,
					'master' => 'shipgraph',
					'id' => $ship->id,
				)); ?>" target="_blank">
					Graph
				</a></td>
				<td><a href="http://203.104.209.71/kcs/resources/swf/ships/<?php echo $graphs[$ship->id]; ?>.swf?VERSION=<?php echo time(); ?>" target="_blank">
					SWF
				</a></td>
			</tr>
		<?php } ?>
	</table>
	<hr />
	<table border="1" cellpadding="0" cellspacing="0">
		<tr>
			<td style="width:50px;">ID</td>
			<td style="width:120px;">English</td>
			<td style="width:120px;">Japanese</td>
			<td style="width:80px;">Data</td>
			<td style="width:100px;">Images</td>
		</tr>
		<?php foreach($items as $item){
			$paddedNo = str_pad($item->id, 3, '0', STR_PAD_LEFT);
			?>
			<tr>
				<td><?php echo $item->id; ?></td>
				<td><?php echo $item->english; ?></td>
				<td><?php echo $item->name; ?></td>
				<td><a href="<?php echo Yii::app()->createUrl('decodes/record/index', array(
					'date' => $date,
					'master' => 'slotitem',
					'id' => $item->id,
				)); ?>" target="_blank">
					Data
				</a></td>
				<td>
					[ <a target="_blank" href="http://203.104.209.71/kcs/resources/image/slotitem/card/<?php echo $paddedNo; ?>.png">1</a> ]
					[ <a target="_blank" href="http://203.104.209.71/kcs/resources/image/slotitem/item_character/<?php echo $paddedNo; ?>.png">2</a> ]
					[ <a target="_blank" href="http://203.104.209.71/kcs/resources/image/slotitem/item_on/<?php echo $paddedNo; ?>.png">3</a> ]
					[ <a target="_blank" href="http://203.104.209.71/kcs/resources/image/slotitem/item_up/<?php echo $paddedNo; ?>.png">4</a> ]
				</td>
			</tr>
		<?php } ?>
	</table>
</div>