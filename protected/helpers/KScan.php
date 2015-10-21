<?php

class KScan {
	
	public static function scanGeneric($master, $date){
		foreach(array_reverse(KFile::getVersions()) as $version){
			if($date!=$version){
				$current = $version;
				break;
			}
		}
		
		$changes = array(
			'fresh' => array(),
			'updated' => array(),
		);
		
		$newRecords = glob('data/master/'.$date.'/'.$master.'/*');
		foreach($newRecords as $newRecord){
			$recfn = explode('/', $newRecord);
			$recfn = array_pop($recfn);
			if($recfn != '_raw.json' && $recfn != '_sort.json' && $recfn != '_line.json' && $recfn != '_summary.json'){
				$oldRecord = 'data/master/'.$current.'/'.$master.'/'.$recfn;
				if(file_exists($oldRecord)){
					if(md5_file($newRecord) != md5_file($oldRecord)){
						$newContents = KFile::readJSON($newRecord);
						$oldContents = KFile::readJSON($oldRecord);
						$changes['updated'][] = self::compareRecords($newContents, $oldContents);
					}
				}else{
					$newContents = KFile::readJSON($newRecord);
					
					if(isset($newContents->english)){
						$name = $newContents->english;
					}else if(isset($newContents->api_name)){
						$name = $newContents->api_name;
					}else if(isset($newContents->api_title)){
						$name = $newContents->api_title;
					}
					
					$changes['fresh'][] = $newContents;
				}
			}
		}
		return $changes;
	}
	
	public static function scanShip($date){
		foreach(array_reverse(KFile::getVersions()) as $version){
			if($date!=$version){
				$current = $version;
				break;
			}
		}
		
		$allShip = KFile::readJSON('data/master/'.$date.'/ship/_raw.json');
		$remodelPointers = array();
		foreach($allShip as $oneShip){
			$remodelPointers[@$oneShip->api_aftershipid] = true;
		}
		
		$_fresh = array();
		$_remodel = array();
		$_updated = array();
		$_abyss = array();
		
		$records = glob('data/master/'.$date.'/ship/*');
		foreach($records as $recordFile){
			$jsonFile = array_pop(explode('/', $recordFile));
			if(!in_array($jsonFile, array('_raw.json','_summary.json','_classes.json'))){
				$oldCounterpart = 'data/master/'.$current.'/ship/'.$jsonFile;
				if(file_exists($oldCounterpart)){
					if(md5_file($recordFile) != md5_file($oldCounterpart)){
						$newContents = KFile::readJSON($recordFile);
						$oldContents = KFile::readJSON($oldCounterpart);
						$_updated[] = self::compareRecords($newContents, $oldContents);
					}
				}else{
					$thisData = KFile::readJSON($recordFile);
					if(isset($remodelPointers[$thisData->api_id])){
						$_remodel[] = $thisData;
					}else{
						if(@$thisData->api_buildtime>0){
							$_fresh[] = $thisData;
						}else{
							$_abyss[] = $thisData;
						}
						
					}
				}
			}
		}
		
		return array(
			'ship' => array(
				'fresh' => $_fresh,
				'remodel' => $_remodel,
				'updated' => $_updated,
				'abyss' => $_abyss,
			)
		);
	}
	
	public static function compareRecords($newContents, $oldContents){
		$recordUpdates = array();
		foreach($newContents as $fieldName=>$fieldValue){
			if(@$oldContents->{$fieldName} != $fieldValue){
				$recordUpdates[$fieldName] = array(
					'api' => $fieldName,
					'lbl' => KTranslate::custom('fieldNames', $fieldName),
					'old' => @$oldContents->{$fieldName},
					'new' => $fieldValue,
				);
			}
		}
		if(isset($newContents->english)){
			$name = $newContents->english;
		}else{
			if(isset($newContents->api_name)){
				$name = $newContents->api_name;
			}else if(isset($newContents->api_title)){
				$name = $newContents->api_title;
			}else{
				$name = "NONAME[".@$newContents->api_id."]";
			}
		}
		return array(
			'id' => @$newContents->api_id,
			'name' => $name,
			'changes' => $recordUpdates,
		);
	}
	
}