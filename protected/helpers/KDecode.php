<?php

class KDecode {
	
	public static function parseGeneric($date, $masterName, $masterData){
		// if array, create file per record
		if(is_array($masterData)){
			foreach($masterData as $record){
				// check if api_name is blank or none
				if(isset($record->api_name)){
					if($record->api_name=='なし' || $record->api_name==''){
						continue;
					}
					$record->english = KTranslate::t($record->api_name, $masterName);
				}
				
				// determine filename
				if(isset($record->api_id)){
					$filename = $record->api_id;
				}else if(isset($record->api_name)){
					$filename = $record->api_name;
				}else if(isset($record->api_title)){
					$filename = $record->api_title;
				}else{
					$filename = uniqid();
				}
				
				// create record file
				file_put_contents('data/master/'.$date.'/'.$masterName.'/'.$filename.'.json', json_encode($record));
			}
		}
	}
	
	public static function parseSlotitem($date, $masterData){
		$_summary = array();
		foreach($masterData as $record){
			// check if api_name is blank or none
			if(isset($record->api_name)){
				if($record->api_name=='なし' || $record->api_name==''){
					continue;
				}
				$record->english = KTranslate::t($record->api_name, 'slotitem');
			}
			
			// add to summary file
			$_summary[$record->api_id] = array(
				'id' => $record->api_id,
				'name' => $record->api_name,
				'english' => $record->english,
			);
			
			// create record file
			file_put_contents('data/master/'.$date.'/slotitem/'.$record->api_id.'.json', json_encode($record));
		}
		file_put_contents('data/master/'.$date.'/slotitem/_summary.json', json_encode($_summary));
	}
	
	public static function parseShip($date, $masterData){
		$_notes = array();
		$_summary = array();
		$_ID = array();
		$_classes = array();
		$_cnameBlacklist = array();
		
		// echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
		
		// create array with ID indexes
		foreach($masterData as &$record){
			$_ID[$record->api_id] = &$record;
			if(@$record->api_aftershipid>0){
				$_cnameBlacklist[] = $record->api_aftershipid;
			}
		}
		
		// note-taking
		foreach($masterData as &$record){
			// if not "none", is not abyss, and is not SantaNaka
			if($record->api_name!='なし' && $record->api_name!='S那珂' && $record->api_name!=''){
				// initialize record entry if not exists
				if(!isset($_notes[$record->api_id])){ $_notes[$record->api_id] = array(); }
				
				// add english name
				$record->english = KTranslate::t($record->api_name);
				
				// note if i'm a name-ship, add my name to classes
				if(@$record->api_cnum==1 && !in_array($record->api_id, $_cnameBlacklist) && $record->api_buildtime>0){
					$_classes[@$record->api_ctype] = array(
						'id' => $record->api_ctype,
						'name' => $record->api_name,
						'english' => $record->english,
					);
				}
				
				// note I'm your before remodel
				if(@$record->api_aftershipid>0){
					$_notes[$record->api_aftershipid]['remodel_before'] = 1;
					$_notes[$record->api_aftershipid]['remodel_fuel'] = 1;
					$_notes[$record->api_aftershipid]['remodel_ammo'] = 1;
					$_notes[$record->api_aftershipid]['remodel_level'] = 1;
				}
				
				// set remodel num if not set
				if(!isset($_notes[$record->api_id]['remodel_stage'])){
					$_notes[$record->api_id]['remodel_stage'] = 1;
				}
				
				// tread remodel line
				/*$currentPlus = $_ID[$record->api_id];
				while(@$currentPlus->api_aftershipid>0){
					// increment remodel stage
					if(!isset($_notes[$currentPlus->api_aftershipid]['remodel_stage'])){
						$_notes[$currentPlus->api_aftershipid]['remodel_stage'] = 0;
					}
					$_notes[$currentPlus->api_aftershipid]['remodel_stage'] += 1;
					
					// set next-remodel as current to continue loop
					$currentPlus = $_ID[$currentPlus->api_aftershipid];
				}*/
			}
		}
		
		// record compilation
		foreach($masterData as &$record){
			// if not "none", and is not SantaNaka
			if($record->api_name!='なし' && $record->api_name!='S那珂' && $record->api_name!=''){
				
				// must not end with * = fleet of fog which can be removed anytime to not affect future decodes
				if(mb_substr($record->api_name,-1,1, "utf-8") != "*"){
				
					// add class name
					if(isset($_classes[@$record->api_ctype])){
						$record->ctype_name = $_classes[$record->api_ctype]['english'];
					}else{
						$record->ctype_name = '???';
					}
					
					// add base ship model identifiers
					if($_notes[$record->api_id]['remodel_stage']==0){
						// set base to self
						$_notes[$record->api_id]['base_id'] = $record->api_id;
						$_notes[$record->api_id]['base_JP'] = $record->api_name;
						$_notes[$record->api_id]['base_EN'] = $record->english;
						$_notes[$record->api_id]['base_stats'] = KFile::mapStats($record);
						
						// set base to remodels
						$currentPlus = $_ID[$record->api_id];
						while(@$currentPlus->api_aftershipid>0){
							$_notes[$currentPlus->api_aftershipid]['base_id'] = $record->api_id;
							$_notes[$currentPlus->api_aftershipid]['base_JP'] = $record->api_name;
							$_notes[$currentPlus->api_aftershipid]['base_EN'] = $record->english;
							$_notes[$currentPlus->api_aftershipid]['base_stats'] = KFile::mapStats($record);
							
							// set next-remodel as current to continue loop
							$currentPlus = $_ID[$currentPlus->api_aftershipid];
						}
					}
					
					// take highest remodel stats of the same card number
					$_notes[$record->api_id]['HKai_stats'] = KFile::mapStats($record);
					$curShip = $_ID[$record->api_id];
					/*while(@$curShip->api_aftershipid>0){
						$myRemodel = $_ID[$curShip->api_aftershipid];
						
						// must not be a library item
						if($myRemodel->api_sortno>300){
							$_notes[$record->api_id]['HKai_stats'] = KFile::mapStats($myRemodel);
						}
						
						// set next-remodel as current to continue loop
						$curShip = $_ID[$curShip->api_aftershipid];
					}*/
					
					// add to summary
					$_summary[] = array(
						'id' => $record->api_id,
						'sortno' => @$record->api_sortno,
						'name' => $record->api_name,
						'english' => $record->english,
						'rarity' => @$record->api_backs,
						'stype' => $record->api_stype,
						
						'isLib' => (@$record->api_sortno<300),
						'isBase' => (@$_notes[$record->api_id]['base_id']==$record->api_id),

						
						'fuel' => @$record->api_fuel_max,
						'ammo' => @$record->api_bull_max,
						'build' => @$record->api_buildtime,
					);
					
					
					$record->remodel_before = @$_notes[$record->api_id]['remodel_before'];
					$record->remodel_fuel = @$_notes[$record->api_id]['remodel_fuel'];
					$record->remodel_ammo = @$_notes[$record->api_id]['remodel_ammo'];
					$record->remodel_level = @$_notes[$record->api_id]['remodel_level'];
					$record->remodel_stage = @$_notes[$record->api_id]['remodel_stage'];
					
					// create record file
					file_put_contents('data/master/'.$date.'/ship/'.$record->api_id.'.json', json_encode($record));
				}
			}
		}
		
		// save _summary file
		file_put_contents('data/master/'.$date.'/ship/_summary.json', json_encode($_summary));
		
		// save ship classes
		file_put_contents('data/master/'.$date.'/ship/_classes.json', json_encode($_classes));
	}
	
	public static function parseStype($date, $masterData){
		$_summary = array();
		
		foreach($masterData as &$record){
			// add to summary
			$_summary[$record->api_id] = array(
				'id' => $record->api_id,
				'JP' => $record->api_name,
				'EN' => KTranslate::t($record->api_name),
				'code' => KTranslate::custom('shipTypeCode', $record->api_name),
			);
			
			// create record file
			file_put_contents('data/master/'.$date.'/stype/'.$record->api_id.'.json', json_encode($record));
		}
		
		// save _summary file
		file_put_contents('data/master/'.$date.'/stype/_summary.json', json_encode($_summary));
	}
	
}