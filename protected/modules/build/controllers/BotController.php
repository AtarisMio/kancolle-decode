<?php

class BotController extends KController {
	
	public function actionIndex($url=''){
		if($url!=''){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$html = curl_exec($ch);
			curl_close($ch);
			
			if(!file_exists('data/wikibot/'.date("Y-m-d"))){
				mkdir('data/wikibot/'.date("Y-m-d"));
			}
			
			file_put_contents('data/wikibot/'.date("Y-m-d").'/'.date("His").'.html', $html);
			
			echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
			
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-JP');
			
			// preg_match_all('/([0-9]+)\/([0-9]+)\/([0-9]+)\/([0-9]+)(.*)--\s+[^0-9]+([-0-9]+)\s+.*\s+([:0-9]+)\s?.*/', $html, $detects);
			preg_match_all('/([0-9]+)\/([0-9]+)\/([0-9]+)\/([0-9]+)(.*)--\s*[^0-9]*([-0-9]+)\s+.*\s+([:0-9]+)\s*.*/', $html, $detects);
			
			
			
			$db = Yii::app()->db;
			
			$MD5 = array();
			foreach($detects[0] as $index=>$detect){
				$raw = $detects[1][$index].'/'.$detects[2][$index].'/'.$detects[3][$index].'/'.$detects[4][$index].' '.$detects[5][$index].' ('.$detects[6][$index].' '.$detects[7][$index].')';
				$MD5[$index] = md5($raw);
			}
			
			$existingScans = $db->createCommand("SELECT md5 FROM bot_scans WHERE md5 IN ('".implode("','", $MD5)."')")->queryColumn();
			
			$ignored = 0;
			$newscans = 0;
			$failed = 0;
			$passed = 0;
			$scanrecord = 0;
			
			$newReports = array();
			
			foreach($detects[0] as $index=>$detect){
				if(in_array($MD5[$index], $existingScans)){
					$ignored++;
				}else{
					$newscans++;
					
					$initialData = array(
						'fuel' => $detects[1][$index],
						'ammo' => $detects[2][$index],
						'stee' => $detects[3][$index],
						'baux' => $detects[4][$index],
						'date' => $detects[6][$index].' '.$detects[7][$index],
					);
					
					$interpretation = $this->interpret($initialData, $detects[5][$index]);
					if(isset($interpretation['error'])){
						$failed++;
						$status = 0;
					}else{	
						$passed++;
						$status = 1;
					}
					
					$added = $this->addScan($MD5[$index], $detect, $interpretation, $status);
					if($added){
						$scanrecord++;
						if($status==1){
							$newReports[] = array(
								'user' => 2,
								'res1' => $interpretation['fuel'],
								'res2' => $interpretation['ammo'],
								'res3' => $interpretation['stee'],
								'res4' => $interpretation['baux'],
								'devmats' => $interpretation['devm'],
								'opendocks' => $interpretation['opdk'],
								'admiral' => $interpretation['hqlv'],
								'flag_id' => $interpretation['flid'],
								'flag_lv' => $interpretation['fllv'],
								'result' => $interpretation['resu'],
								'cutoff' => 2,
								'created' => $interpretation['date'],
							);
						}
					}else{
						
					}
				}
			}
			
			try {
				$builder = Yii::app()->db->schema->commandBuilder;
				$command = $builder->createMultipleInsertCommand('report_build', $newReports);
				$command->execute();
				$reportsOK = TRUE;
			}catch(Exception $e){
				$reportsOK = FALSE;
			}
		}
		
		$this->render('build.views.bot', array(
			'detected' => count(@$detects[0]),
			'ignored' => @$ignored,
			'newscans' => @$newscans,
			'failed' => @$failed,
			'passed' => @$passed,
			'scanrecord' => @$scanrecord,
			'url' => @$url,
			'reportsOK' => @$reportsOK,
		));
	}
	
	private function addScan($md5, $original, $interpretation, $status){
		$db = Yii::app()->db;
		$cmd = $db->createCommand("INSERT INTO bot_scans VALUES(:md5h,:orig,:proc,:stat,:crtd,:updt)");
		$cmd->bindParam(":md5h", $md5, PDO::PARAM_STR);
		$cmd->bindParam(":orig", $original, PDO::PARAM_STR);
		$cmd->bindParam(":proc", json_encode($interpretation), PDO::PARAM_STR);
		$cmd->bindParam(":stat", $status, PDO::PARAM_INT);
		$cmd->bindParam(":crtd", date("Y-m-d H:i:s"), PDO::PARAM_STR);
		$cmd->bindParam(":updt", date("Y-m-d H:i:s"), PDO::PARAM_STR);
		try {
			$cmd->execute();
			return true;
		}catch(Exception $e){
			return false;
		}
	}
	
	private function interpret($initialData, $descText){
		preg_match('/[\/]?\s+開発資材\s*[：:；;]?\s*([0-9０-９]+)\s+.*\s*[：:；;]?\s*([0-9０-９]+)\s+[司指令]+\s?[：:；;]?\s*([0-9０-９]+)\s+秘書\s*[：:；;]?\s*(.*)\s*結果[：:；;]?(.*)\s+/u', $descText, $descValues);
		
		if(count($descValues)==0){
			return array('error' => '"'.$descText.'" did not match interpretation pattern');
		}
		
		$replacements = array(
			'/([zZＺｚ][1１])/u' => 'レーベレヒト・マース',
			'/([zZＺｚ][3３])/u' => 'マックス・シュルツ',
			
			'/[\pZ\pC]+|[\pZ\pC]+/u' => '',
			'/( 　|　| )/' => '',
			
			'/([伊Ii]\-?[1１][6６][8８])/u' => 'IMUYA',
			'/([伊Ii]\-?[8８])/u' => 'HACHI',
			'/([伊Ii]\-?[5５][8８])/u' => 'GOYA',
			'/([伊Ii]\-?[1１][9９])/u' => 'IKU',
			'/([伊Ii]\-?[4４][0０][1１])/u' => 'SHIOI',
			
			'/(\(|\)|Lv\.?|lv\.?|LV\.?|lV\.?|キラ$|\(キラ\)|（キラ）)/u' => '',
			
			'/１/u' => '1',
			'/２/u' => '2',
			'/３/u' => '3',
			'/４/u' => '4',
			'/５/u' => '5',
			'/６/u' => '6',
			'/７/u' => '7',
			'/８/u' => '8',
			'/９/u' => '9',
			'/０/u' => '0',
		);
		
		$flagship = preg_replace(array_keys($replacements), array_values($replacements), $descValues[4]);
		$resultName = preg_replace(array_keys($replacements), array_values($replacements), $descValues[5]);
		
		preg_match('/([^0-9０-９]+)/u', $flagship, $flagName);
		preg_match('/([0-9０-９]+)/u', $flagship, $flagLevel);
		
		if(count($flagName)!=0){
			$flag_id = KTL::getShipID($flagName[1]);
			if(!$flag_id){
				// echo ' [UNKNOWN FLAG]';
			}
		}else{
			$flag_id = 0;
			// echo ' [NO DETECTED FLAG]';
		}
		
		if(count($flagLevel)!=0){
			$flag_lv = $flagLevel[1];
		}else{
			$flag_lv = 0;
			// echo ' [NO DETECTED LEVEL]';
		}
		
		$result = KTL::getShipID($resultName);
		if(!$result){
			return array('error' => 'Unknown result ship: "'.$resultName.'"');
		}
		
		$initialData['devm'] = $descValues[1];
		$initialData['opdk'] = $descValues[2];
		$initialData['hqlv'] = $descValues[3];
		$initialData['flid'] = $flag_id;
		$initialData['fllv'] = $flag_lv;
		$initialData['resu'] = $result;
		
		return $initialData;
	}
	
}