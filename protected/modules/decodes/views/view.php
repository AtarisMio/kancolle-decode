<div class="sectionHead">Wikia Code</div>
<pre id="update_wikicode">
# '''[[Ship Class|New Ships]]'''
# '''New Remodels'''
# '''[[Enemy Vessel|New Enemy Vessels]]'''
# '''[[Equipment|New Equipment]]'''
# '''Voice and other Updates'''
</pre>

<?php if(count($changes->ship->ship->fresh)){ ?>
<div class="sectionHead">New Ships</div>
<div class="sectionBody">
	<?php foreach($changes->ship->ship->fresh as $ship){
		if(intval($ship->api_id)>900){ continue; }
		$firstName = explode(" ", $ship->english);
		$firstName = $firstName[0];
		$shipgraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$ship->api_id.'.json');
		$filename = 'http://125.6.184.15/kcs/resources/swf/ships/'.$shipgraph->api_filename.'.swf?VERSION=1';
		KFile::ensureCG($ship->api_id, $shipgraph->api_filename);
		$equips = array(
			(@$ship->api_defeq[0]>-1)?$slotitems->{@$ship->api_defeq[0]}:false,
			(@$ship->api_defeq[1]>-1)?$slotitems->{@$ship->api_defeq[1]}:false,
			(@$ship->api_defeq[2]>-1)?$slotitems->{@$ship->api_defeq[2]}:false,
			(@$ship->api_defeq[3]>-1)?$slotitems->{@$ship->api_defeq[3]}:false,
		);
		$MaxAircraft = $ship->api_maxeq[0]+$ship->api_maxeq[1]+$ship->api_maxeq[2]+$ship->api_maxeq[3];
	?>
	<div class="new_ship">
		<div class="ship_cg"><img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $ship->api_id; ?>.jpg" /></div>
		<div class="ship_title">
			<div class="ship_ID"><?php echo $ship->api_id; ?></div>
			<div class="ship_EN"><?php echo @$ship->english; ?></div>
			<div class="clear"></div>
		</div>
		<div class="ship_content">
			<div class="link">
				<a href="<?php echo Yii::app()->createUrl('decodes/extra/newship', array('id'=>$ship->api_id, 'remodel'=>$ship->api_aftershipid)); ?>">
					Share image
				</a>
			</div>
			<div class="link">
				<a href="<?php echo $filename; ?>" download="<?php echo $ship->api_id; ?>.swf">
					Download CG
				</a>
			</div>
			<div class="link">
				<a href="<?php echo Yii::app()->createUrl('decodes/extra/luasingle', array('id'=>$ship->api_id)); ?>">
					Generate Lua
				</a>
			</div>
			<div class="link">
				<a href="http://kancolle.wikia.com/wiki/<?php echo $firstName; ?>">
					Edit article
				</a>
				/
				<a href="http://kancolle.wikia.com/wiki/Module:<?php echo $firstName; ?>">
					Edit module
				</a>
			</div>
			<textarea>{{ShipInfoKai|<?php echo $firstName; ?>/|los=auto|los_max=auto|evasion=auto|evasion_max=auto|asw=auto|asw_max=auto}}</textarea>
		</div>
		<!-- <div class="ship_title">
			<div class="ship_ID"><a href="<?php echo Yii::app()->createUrl('decodes/extra/newship', array('id'=>$ship->api_id, 'remodel'=>$ship->api_aftershipid)); ?>"><?php echo $ship->api_id; ?></a></div>
			<div class="ship_JP" style="height:20px;overflow:hidden;"><?php echo $ship->api_name; ?></div>
			<div class="ship_EN" style="height:20px;overflow:hidden;"><?php echo @$ship->english; ?></div>
			<div class="ship_CG"><a href="<?php echo $filename; ?>" download="<?php echo $ship->api_id; ?>.swf">SWF</a></div>
			<div class="clear"></div>
		</div> -->
		<!-- <div class="ship_code">
			<textarea READONLY>==Info==
		{|
		|-
		|
		===Basic===
		{{shipinfo<?php echo ($MaxAircraft>0)?'2':''; ?> 
		|color = <?php echo $rarity[$ship->api_backs]; ?> 
		|name = <?php if(isset($ship->english)){ echo $ship->english; } ?> 
		|japanesename = <?php echo $ship->api_name; ?> 
		|image = [[File:<?php echo $ship->api_id; ?>_Card.jpg]]
		|id = <?php echo $ship->api_sortno; ?> 
		|class = ?
		|type = <?php echo $stypes->{$ship->api_stype}->EN; ?> 
		|hp = <?php echo $ship->api_taik[0]; ?> 
		|firepower = <?php echo $ship->api_houg[0]; ?> (<?php echo $ship->api_houg[1]; ?>)
		|armor = <?php echo $ship->api_souk[0]; ?> (<?php echo $ship->api_souk[1]; ?>)
		|torpedo = <?php echo $ship->api_raig[0]; ?> (<?php echo $ship->api_raig[1]; ?>)
		|evasion = ?
		|AA = <?php echo $ship->api_tyku[0]; ?> (<?php echo $ship->api_tyku[1]; ?>)
		|aircraft = <?php echo $MaxAircraft; ?> 
		|ASW = ?
		|LOS = ?
		|luck = <?php echo $ship->api_luck[0]; ?> (<?php echo $ship->api_luck[1]; ?>)
		|time = Unbuildable[?] <?php echo $ship->api_buildtime; ?>min[?]
		|speed = <?php echo $speeds[$ship->api_soku]; ?> 
		|range = <?php echo $ranges[$ship->api_leng]; ?> 
		|slot = <?php echo $ship->api_slot_num; ?> 
		|slot1=<?php if($ship->api_slot_num>=1){ ?><?php if($equips[0]){ ?>[[<?php echo @$equips[0]->english; ?>]]<?php }else{ ?> ?<?php } ?><?php }else{ ?> - Locked - <?php } ?> 
		|slot2=<?php if($ship->api_slot_num>=2){ ?><?php if($equips[1]){ ?>[[<?php echo @$equips[1]->english; ?>]]<?php }else{ ?> ?<?php } ?><?php }else{ ?> - Locked - <?php } ?> 
		|slot3=<?php if($ship->api_slot_num>=3){ ?><?php if($equips[2]){ ?>[[<?php echo @$equips[2]->english; ?>]]<?php }else{ ?> ?<?php } ?><?php }else{ ?> - Locked - <?php } ?> 
		|slot4=<?php if($ship->api_slot_num>=4){ ?><?php if($equips[3]){ ?>[[<?php echo @$equips[3]->english; ?>]]<?php }else{ ?> ?<?php } ?><?php }else{ ?> - Locked - <?php } ?> 
		|space1=<?php echo $ship->api_maxeq[0]; ?> 
		|space2=<?php echo $ship->api_maxeq[1]; ?> 
		|space3=<?php echo $ship->api_maxeq[2]; ?> 
		|space4=<?php echo $ship->api_maxeq[3]; ?> 
		}}
		
		|
		===Upgrade===
		{{shipinfo2
		|
		}}
		
		|-
		|
		|
		|}
		
		
		===Quotes===
		{{Template:Shipquote
		|自己紹介 = <?php echo $ship->api_getmes; ?> 
		|EN1 =
		|Note1 = 
		|Library = <?php echo @$ship->api_sinfo; ?> 
		|EN0 = 
		|Note0 = 
		}}
		
		==Trivia==
		
		==See Also==
		*[[{{PAGENAMEE}}/Gallery|View {{PAGENAME}} CG]]
		*[[Elite<?php echo $stypes->{$ship->api_stype}->code; ?>|List of <?php echo $stypes->{$ship->api_stype}->EN; ?>s]]
		{{Shiplist}}</textarea>
		</div> -->
	</div>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php } ?>


<?php if(count(@$changes->ship->ship->abyss)){ ?>
<div class="sectionHead">Enemy Vessels</div>
<div class="sectionBody">
	<?php foreach($changes->ship->ship->abyss as $ship){
		$shipgraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$ship->api_id.'.json');
		$filename = 'http://125.6.184.15/kcs/resources/swf/ships/'.$shipgraph->api_filename.'.swf?VERSION=1';
		$equips = array(
			(@$ship->api_defeq[0]>-1)?$slotitems->{@$ship->api_defeq[0]}:false,
			(@$ship->api_defeq[1]>-1)?$slotitems->{@$ship->api_defeq[1]}:false,
			(@$ship->api_defeq[2]>-1)?$slotitems->{@$ship->api_defeq[2]}:false,
			(@$ship->api_defeq[3]>-1)?$slotitems->{@$ship->api_defeq[3]}:false,
		);
		$MaxAircraft = @$ship->api_maxeq[0]+@$ship->api_maxeq[1]+@$ship->api_maxeq[2]+@$ship->api_maxeq[3];
	?>
	<div class="remodel_ship" style="background:#fcc;">
		<div class="ship_cg">
			<center>
				<br />
				[<a href="https://translate.google.com/#ja/en/<?php echo $ship->api_name; ?>" target="_blank">
					Translate
				</a>]
				<br /><br />
				[<a href="https://www.google.com.ph/webhp#q=japanese+ship+<?php echo $ship->api_name; ?>+site:wikipedia.org" target="_blank">
					Google
				</a>]
			</center>
		</div>
		<div class="ship_title">
			<div class="ship_ID"><?php echo $ship->api_id; ?></div>
			<div class="ship_EN"><?php echo @$ship->english; ?></div>
			<div class="ship_CG"><a href="<?php echo $filename; ?>" download="<?php echo $ship->api_id; ?>.swf">SWF</a></div>
			<div class="clear"></div>
		</div>
		<div class="ship_code">
			<a href="<?php echo Yii::app()->createUrl('decodes/extra/luasingle', array('id'=>$ship->api_id)); ?>">
				Generate Lua
			</a>
		</div>
	</div>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php } ?>


<?php if(count($changes->ship->ship->remodel)){ ?>
<div class="sectionHead">Remodels</div>
<div class="sectionBody">
	<?php foreach($changes->ship->ship->remodel as $ship){
		$firstName = explode(" ", $ship->english);
		$firstName = $firstName[0];
		$shipgraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$ship->api_id.'.json');
		$filename = 'http://125.6.184.15/kcs/resources/swf/ships/'.$shipgraph->api_filename.'.swf?VERSION=1';
		KFile::ensureCG($ship->api_id, $shipgraph->api_filename);
		$equips = array(
			(@$ship->api_defeq[0]>-1)?$slotitems->{@$ship->api_defeq[0]}:false,
			(@$ship->api_defeq[1]>-1)?$slotitems->{@$ship->api_defeq[1]}:false,
			(@$ship->api_defeq[2]>-1)?$slotitems->{@$ship->api_defeq[2]}:false,
			(@$ship->api_defeq[3]>-1)?$slotitems->{@$ship->api_defeq[3]}:false,
		);
		$MaxAircraft = $ship->api_maxeq[0]+$ship->api_maxeq[1]+$ship->api_maxeq[2]+$ship->api_maxeq[3];
	?>
	<div class="remodel_ship">
		<div class="ship_cg"><img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $ship->api_id; ?>.jpg" /></div>
		<div class="ship_title">
			<div class="ship_ID"><?php echo $ship->api_id; ?></div>
			<div class="ship_EN"><?php echo @$ship->english; ?></div>
			<div class="clear"></div>
		</div>
		<div class="ship_content">
			<div class="link">
				<a href="<?php echo Yii::app()->createUrl('decodes/extra/remodel', array('id'=>$ship->api_id)); ?>">
					Share image
				</a>
			</div>
			<div class="link">
				<a href="<?php echo $filename; ?>" download="<?php echo $ship->api_id; ?>.swf">
					Download CG
				</a>
			</div>
			<div class="link">
				<a href="<?php echo Yii::app()->createUrl('decodes/extra/luasingle', array('id'=>$ship->api_id)); ?>">
					Generate Lua
				</a>
			</div>
			<div class="link">
				<a href="http://kancolle.wikia.com/wiki/<?php echo $firstName; ?>">
					Edit article
				</a>
				/
				<a href="http://kancolle.wikia.com/wiki/Module:<?php echo $firstName; ?>">
					Edit module
				</a>
			</div>
			<textarea>{{ShipInfoKai|<?php echo $firstName; ?>/|los=auto|los_max=auto|evasion=auto|evasion_max=auto|asw=auto|asw_max=auto}}</textarea>
			<!-- <textarea READONLY>{{shipinfo<?php echo ($MaxAircraft>0)?'2':''; ?> 
			|color = <?php echo $rarity[$ship->api_backs]; ?> 
			|name = <?php if(isset($ship->english)){ echo $ship->english; } ?> 
			|japanesename = <?php echo $ship->api_name; ?> 
			|image = [[File:<?php echo $ship->api_id; ?>_Card.jpg]]
			|id = <?php echo $ship->api_sortno; ?> 
			|class = ?
			|type = <?php echo $stypes->{$ship->api_stype}->EN; ?> 
			|hp = <?php echo $ship->api_taik[0]; ?> 
			|firepower = <?php echo $ship->api_houg[0]; ?> (<?php echo $ship->api_houg[1]; ?>)
			|armor = <?php echo $ship->api_souk[0]; ?> (<?php echo $ship->api_souk[1]; ?>)
			|torpedo = <?php echo $ship->api_raig[0]; ?> (<?php echo $ship->api_raig[1]; ?>)
			|evasion = ?
			|AA = <?php echo $ship->api_tyku[0]; ?> (<?php echo $ship->api_tyku[1]; ?>)
			|aircraft = ?
			|ASW = ?
			|LOS = ?
			|luck = <?php echo $ship->api_luck[0]; ?> (<?php echo $ship->api_luck[1]; ?>)
			|time = Lv<?php echo $ship->remodel_level; ?> Remodel
			|speed = <?php echo $speeds[$ship->api_soku]; ?> 
			|range = <?php echo $ranges[$ship->api_leng]; ?> 
			|slot = <?php echo $ship->api_slot_num; ?> 
			|slot1=<?php if($ship->api_slot_num>=1){ ?><?php if($equips[0]){ ?>[[<?php echo @$equips[0]->english; ?>]]<?php }else{ ?> ?<?php } ?><?php }else{ ?> - Locked - <?php } ?> 
			|slot2=<?php if($ship->api_slot_num>=2){ ?><?php if($equips[1]){ ?>[[<?php echo @$equips[1]->english; ?>]]<?php }else{ ?> ?<?php } ?><?php }else{ ?> - Locked - <?php } ?> 
			|slot3=<?php if($ship->api_slot_num>=3){ ?><?php if($equips[2]){ ?>[[<?php echo @$equips[2]->english; ?>]]<?php }else{ ?> ?<?php } ?><?php }else{ ?> - Locked - <?php } ?> 
			|slot4=<?php if($ship->api_slot_num>=4){ ?><?php if($equips[3]){ ?>[[<?php echo @$equips[3]->english; ?>]]<?php }else{ ?> ?<?php } ?><?php }else{ ?> - Locked - <?php } ?> 
			|space1=<?php echo $ship->api_maxeq[0]; ?> 
			|space2=<?php echo $ship->api_maxeq[1]; ?> 
			|space3=<?php echo $ship->api_maxeq[2]; ?> 
			|space4=<?php echo $ship->api_maxeq[3]; ?> 
			}}</textarea> -->
		</div>
	</div>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php } ?>


<?php if(count($changes->slotitem->fresh)){ ?>
<div class="sectionHead">New Equipment</div>
<div class="sectionBody">
	<?php foreach($changes->slotitem->fresh as $record){ ?>
		<?php $paddedNo = str_pad($record->api_sortno, 3, '0', STR_PAD_LEFT); ?>
		<div class="new_item">
			<div class="itemInfo">
				<div class="itemID"><?php echo $paddedNo; ?></div>
				<div class="itemJP"><?php echo $record->api_name; ?></div>
				<div class="itemEN"><?php echo $record->english; ?></div>
				<div class="clear"></div>
			</div>
			<div class="itemCode">
			<!-- {{EquipmentInfoKai|name=<?php echo @$record->english; ?>}} -->
				<textarea READONLY>
{{Template:Equipmentinfo
|name = <?php echo @$record->english; ?> 
|id = <?php echo $record->api_sortno; ?> 
|japanesename = <?php echo $record->api_name; ?> 
|icon = 
|type = 
|effect = <?php echo ($record->api_taik!=0)?'{{HP}}+'.$record->api_taik.' ':''; ?>
<?php echo ($record->api_souk!=0)?'{{Armor}}+'.$record->api_souk.' ':''; ?>
<?php echo ($record->api_houg!=0)?'{{Firepower}}+'.$record->api_houg.' ':''; ?>
<?php echo ($record->api_raig!=0)?'{{Torpedo}}+'.$record->api_raig.' ':''; ?>
<?php echo ($record->api_soku!=0)?'{{Speed}}+'.$record->api_soku.' ':''; ?>
<?php echo ($record->api_baku!=0)?'{{Dive}}+'.$record->api_baku.' ':''; ?>
<?php echo ($record->api_tyku!=0)?'{{AA}}+'.$record->api_tyku.' ':''; ?>
<?php echo ($record->api_tais!=0)?'{{ASW}}+'.$record->api_tais.' ':''; ?>
<?php echo ($record->api_houm!=0)?'{{Hit}}+'.$record->api_houm.' ':''; ?>
<?php echo ($record->api_houk!=0)?'{{Evasion}}+'.$record->api_houk.' ':''; ?>
<?php echo ($record->api_saku!=0)?'{{LOS}}+'.$record->api_saku.' ':''; ?>
<?php echo ($record->api_luck!=0)?'{{Luck}}+'.$record->api_luck.' ':''; ?>
<?php echo ($record->api_leng!=0)?'{{Range}}+'.$record->api_leng.' ':''; ?>

|scrap = <?php echo ($record->api_broken[0]>0)?'{{Fuel}}'.$record->api_broken[0].' ':''; ?>
<?php echo ($record->api_broken[1]>0)?'{{Ammo}}'.$record->api_broken[1].' ':''; ?>
<?php echo ($record->api_broken[2]>0)?'{{Steel}}'.$record->api_broken[2].' ':''; ?>
<?php echo ($record->api_broken[3]>0)?'{{Bauxite}}'.$record->api_broken[3].' ':''; ?>

|image = <gallery type="slideshow" widths="360px" position="center" hideaddbutton="true">
Equipment<?php echo $record->api_sortno; ?>-1.png
Equipment<?php echo $record->api_sortno; ?>-2.png
Equipment<?php echo $record->api_sortno; ?>-3.png
Equipment<?php echo $record->api_sortno; ?>-4.png
</gallery>
}}

==Introduction==
<?php echo $record->api_info; ?> 

==Notes==
*
*

==Gallery==
<gallery>
Equipment<?php echo $record->api_sortno; ?>-2.png|Fairy
Equipment<?php echo $record->api_sortno; ?>-3.png|Equipment with Fairy
Equipment<?php echo $record->api_sortno; ?>-4.png|Equipment
</gallery>

==See also==
{{Equipmentlist}}</textarea>
			</div>
			<div class="itemImages">
				<div class="itemCard">
					<img src="http://125.6.189.71/kcs/resources/image/slotitem/card/<?php echo $paddedNo; ?>.png" />
				</div>
				<div class="itemCG">
					<img src="http://125.6.189.71/kcs/resources/image/slotitem/item_character/<?php echo $paddedNo; ?>.png" />
					<img src="http://125.6.189.71/kcs/resources/image/slotitem/item_on/<?php echo $paddedNo; ?>.png" />
					<img src="http://125.6.189.71/kcs/resources/image/slotitem/item_up/<?php echo $paddedNo; ?>.png" />
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php } ?>


<div class="sectionHead">Complete List</div>
<?php foreach($changes as $masterName=>$masterData){ ?>
	<?php if($masterName=='ship'){ $masterData=$masterData->ship; } ?>
	<?php if((count($masterData->fresh)+count($masterData->updated)) >0){ ?>
		<div style="width:760px; font-size:17px; font-weight:bold; margin:0px 0px 10px;">
			<a href="<?php echo Yii::app()->createUrl('decodes/record/master', array('date'=>$date,'master'=>$masterName)); ?>" target="_blank"><?php echo $masterName; ?></a>
		</div>
	<?php } ?>
	<?php foreach($masterData->fresh as $record){ ?>
		<div class="collapsible">
			<div class="collapsible-toggle hover">
				<strong style="color:#f00;">NEW</strong> [<?php echo (isset($record->id))?@$record->id:@$record->api_id; ?>] <?php echo @$record->name; ?>
				<div style="float:right;"><a href="<?php echo Yii::app()->createUrl('decodes/record/index', array('date'=>$date,'master'=>$masterName,'id'=>(isset($record->id))?@$record->id:@$record->api_id)); ?>" target="_blank">View full details</a></div>
			</div>
			<div class="collapsible-content">
				<pre><?php print_r($record); ?></pre>
			</div>
		</div>
	<?php } ?>
	<?php if($masterName=='ship'){ foreach($masterData->remodel as $record){ ?>
		<div class="collapsible">
			<div class="collapsible-toggle hover">
				<strong style="color:#f00;">Remodel</strong> [<?php echo (isset($record->id))?@$record->id:@$record->api_id; ?>] <?php echo @$record->name; ?>
				<div style="float:right;"><a href="<?php echo Yii::app()->createUrl('decodes/record/index', array('date'=>$date,'master'=>$masterName,'id'=>(isset($record->id))?@$record->id:@$record->api_id)); ?>" target="_blank">View full details</a></div>
			</div>
			<div class="collapsible-content">
				<pre><?php print_r($record); ?></pre>
			</div>
		</div>
	<?php }} ?>
	<?php foreach($masterData->updated as $record){ ?>
		<div class="collapsible">
			<div class="collapsible-toggle hover">
				<strong style="color:#00f;">Updated</strong> [<?php echo $record->id; ?>] <?php echo $record->name; ?>
				<div style="float:right;"><a href="<?php echo Yii::app()->createUrl('decodes/record/index', array('date'=>$date,'master'=>$masterName,'id'=>(isset($record->id))?@$record->id:@$record->api_id)); ?>" target="_blank">View full details</a></div>
			</div>
			<div class="collapsible-content">
				<strong>[<?php echo $record->id; ?>] <?php echo $record->name; ?></strong>
				<table border="1" style="width:420px;">
				<?php foreach($record->changes as $field){ ?>
					<tr>
						<td style="width:100px;"><?php echo @$field->api; ?></td>
						<td style="width:100px;"><?php echo $field->lbl; ?></td>
						<td style="width:10px;">&nbsp;</td>
						<td style="width:150px; background:#fee; word-break:break-all;">
							<?php if(is_array($field->old) || is_object($field->old)){ ?>
								<?php foreach($field->old as $index=>$fieldItem){ ?>
									<strong>[<?php echo $index; ?>]</strong> <?php echo $fieldItem; ?><br />
								<?php } ?>
							<?php }else{ ?>
								<?php echo $field->old; ?>
							<?php } ?>
						</td>
						<td style="width:10px;">&nbsp;</td>
						<td style="width:150px; background:#efe; word-break:break-all;">
							<?php if(is_array($field->new) || is_object($field->new)){ ?>
								<?php foreach($field->new as $index=>$fieldItem){ ?>
									<strong>[<?php echo $index; ?>]</strong> <?php echo $fieldItem; ?><br />
								<?php } ?>
							<?php }else{ ?>
								<?php echo $field->new; ?>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td colspan="5" style="height:5px;"></td>
					</tr>
				<?php } ?>
				</table>
				<pre><?php //print_r($record); ?></pre>
			</div>
		</div>
	<?php } ?>
<?php } ?>