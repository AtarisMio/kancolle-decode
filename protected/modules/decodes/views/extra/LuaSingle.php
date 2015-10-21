<textarea style="width:680px; height:700px;">{
		_name = "<?php echo $firstName; ?>",
		_suffix = "", --add suffix here
		_rarity = <?php echo @$shipData->api_backs; ?>,
		_api_id = <?php echo $shipData->api_id; ?>,
		_id = <?php echo @$shipData->api_sortno; ?>,
		_true_id = false, --recheck if same ID as sortno
		_japanese_name = "<?php echo $shipData->api_name; ?>",
		_reading = "<?php echo $shipData->api_yomi; ?>",
		_class = "Unknown", --add real class name
		_class_number = 0,
		_type = <?php echo $shipData->api_stype; ?>,
		_hp = <?php echo @$shipData->api_taik[0]; ?>,
		_hp_max = <?php echo @$shipData->api_taik[1]; ?>,
		_firepower = <?php echo @$shipData->api_houg[0]; ?>,
		_firepower_max = <?php echo @$shipData->api_houg[1]; ?>,
		_firepower_mod = <?php echo @$shipData->api_powup[0]; ?>,
		_armor = <?php echo @$shipData->api_souk[0]; ?>,
		_armor_max = <?php echo @$shipData->api_souk[1]; ?>,
		_armor_mod = <?php echo @$shipData->api_powup[3]; ?>,
		_torpedo = <?php echo $shipData->api_raig[0]; ?>,
		_torpedo_max = <?php echo $shipData->api_raig[1]; ?>,
		_torpedo_mod = <?php echo $shipData->api_powup[1]; ?>,
		_evasion = <?php echo $this->cond(@$shipData->api_kaih[0], "\"?\""); ?>,
		_evasion_max = <?php echo $this->cond(@$shipData->api_kaih[1], "\"?\""); ?>,
		_aa = <?php echo $shipData->api_tyku[0]; ?>,
		_aa_max = <?php echo $shipData->api_tyku[1]; ?>,
		_aa_mod = <?php echo $shipData->api_powup[2]; ?>,
		_asw = <?php echo $this->cond(@$shipData->api_tais[0], "\"?\""); ?>,
		_asw_max = <?php echo $this->cond(@$shipData->api_tais[1], "\"?\""); ?>,
		_speed = <?php echo $shipData->api_soku; ?>,
		_los = <?php echo $this->cond(@$shipData->api_saku[0], "\"?\""); ?>,
		_los_max = <?php echo $this->cond(@$shipData->api_saku[1], "\"?\""); ?>,
		_range = <?php echo $shipData->api_leng; ?>,
		_luck = <?php echo $shipData->api_luck[0]; ?>,
		_luck_max = <?php echo $shipData->api_luck[1]; ?>,
		_luck_mod = false,
<?php if($shipData->remodel_stage>0){ ?>
		_remodel_level = <?php echo $shipData->remodel_level; ?>,
		_remodel_ammo = <?php echo $shipData->remodel_ammo; ?>,
		_remodel_steel = <?php echo $shipData->remodel_fuel; ?>,
		_remodel_blueprint = false,
		_remodel_from = "", --specify if applicable
		_remodel_to = false, --specify as string if applicable
<?php }else{ ?>
		_buildable = false,
		_buildable_lsc = false,
		_build_time = <?php echo $shipData->api_buildtime; ?>,
		_remodel_level = false,
		_remodel_to = "", --specify the kai
<?php } ?>
		_fuel = <?php echo $shipData->api_fuel_max; ?>,
		_ammo = <?php echo $shipData->api_bull_max; ?>,
		_scrap_fuel = <?php echo ($shipData->api_broken[0])?$shipData->api_broken[0]:"false"; ?>,
		_scrap_ammo = <?php echo ($shipData->api_broken[1])?$shipData->api_broken[1]:"false"; ?>,
		_scrap_steel = <?php echo ($shipData->api_broken[2])?$shipData->api_broken[2]:"false"; ?>,
		_scrap_baux = <?php echo ($shipData->api_broken[3])?$shipData->api_broken[3]:"false"; ?>,
		_equipment = {<?php for($ec=0; $ec<$shipData->api_slot_num; $ec++){ ?><?php if(isset($shipData->api_defeq) && $shipData->api_defeq[$ec]>-1){ ?> 
			{ equipment = "<?php echo $allItems->{$shipData->api_defeq[$ec]}->english; ?>", size = <?php echo $shipData->api_maxeq[$ec]; ?> },<?php }else{ ?> 
			{ equipment = "", size = <?php echo $shipData->api_maxeq[$ec]; ?> },<?php } ?><?php } ?> 
		},
	},</textarea>