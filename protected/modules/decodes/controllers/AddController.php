<?php
class AddController extends KController {

	public function actionPurge($date){
		$files = glob('data/master/'.$date.'/*');
		foreach($files as $file){
			if(array_pop(explode('/', $file)) != 'raw.json'){
				if(is_dir($file)){
					KFile::rrmdir($file);
				}else if(is_file($file)){
					unlink($file);
				}
			}
		}
		$this->redirect(Yii::app()->createUrl('decodes'));
	}
	
	public function actionDownload(){
		$versions = KFile::getVersions();
		$latest = $versions[count($versions)-1];
		
		//203.104.209.39
		//125.6.189.71
		//2866df7b5d3dd749b1d6f2037e688a058df9d103
		
		set_time_limit(180);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://125.6.189.71/kcsapi/api_start2');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
			http_build_query(array(
				'api_verno' => 1,
				'api_token' => 'b0235f2600b8113702ac50c74cc3db430f563a90',
			))
		);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept-Language' => 'en-US,en;q=0.8',
			'Connection' => 'keep-alive',
		));
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36');

		$response = curl_exec($ch);
		curl_close ($ch);
		
		if(strpos($response,'svdata=')===0){
			$response = substr($response, 7);
		}
		
		$tmpDecode = json_decode($response);
		
		if($tmpDecode->api_result == 200 || $tmpDecode->api_result == 201){
			echo 'Error downloading api_start2 ('.$tmpDecode->api_result.')'; exit;
		}
		
		$date = date("Y-m-d_H-i");
		if(!file_exists('data/master/'.$date)){
			mkdir('data/master/'.$date);
		}
		
		
		
		file_put_contents('data/master/'.$date.'/raw.json', $response);
		
		if(KFile::isIdentical('data/master/'.$latest.'/raw.json', 'data/master/'.$date.'/raw.json')){
			KFile::rrmdir('data/master/'.$date);
			echo 'No changes from the latest recorded version.';
		}else{
			$this->redirect(Yii::app()->createUrl('decodes/view/index', array('date'=>$date)));
		}
	}
	
	public function actionCheck(){
		$versions = KFile::getVersions();
		$latest = $versions[count($versions)-1];
		
		set_time_limit(180);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://203.104.209.39/kcsapi/api_start2');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
			http_build_query(array(
				'api_verno' => 1,
				'api_token' => '5c2ca08999858ccabe0f4333998aef616af4b3e8',
			))
		);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept-Language' => 'en-US,en;q=0.8',
			'Connection' => 'keep-alive',
		));
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36');

		$response = curl_exec($ch);
		
		if(strpos($response,'svdata=')===0){
			$response = substr($response, 7);
		}
		
		$respobj = json_decode($response);
		if($respobj->api_result!=200){
			echo '<style type="text/css">body{ background:#00f }</style>';
		}else{
			echo '<style type="text/css">body{ background:#fcc }</style>';
		}
		
		echo '<div style="width:300px; word-wrap:break-word;">';
		echo $response;
		echo '</div><script type="text/javascript">setTimeout(function(){ window.location.reload(); },10000);</script>';
	}
	
	public function actionParse($date){
		$raw = KFile::readJSON('data/master/'.$date.'/raw.json');
		foreach($raw->api_data as $masterName => &$masterData){
			// strip master name from api variable name
			if(strpos($masterName, 'api_mst_')===0){ $masterName = substr($masterName, 8); }
			
			// create master directory if not exists
			if(!file_exists('data/master/'.$date.'/'.$masterName)){ mkdir('data/master/'.$date.'/'.$masterName); }
			
			// save per-master raw file
			file_put_contents('data/master/'.$date.'/'.$masterName.'/_raw.json', json_encode($masterData));
			
			// call specific parser
			$functionName = 'parse'.ucfirst($masterName);
			if(method_exists('KDecode', $functionName)){
				KDecode::$functionName($date, $masterData);
			}else{
				KDecode::parseGeneric($date, $masterName, $masterData);
			}
		}
		$this->redirect(Yii::app()->createUrl('decodes/view/index', array('date'=>$date)));
	}
	
	public function actionCompare($date){
		$changes = array();
		
		$newMasters = glob('data/master/'.$date.'/*');
		foreach($newMasters as $newMaster){
			if(is_dir($newMaster)){
				$masterDir = array_pop(explode('/', $newMaster));
				$functionName = 'scan'.ucfirst($masterDir);
				if(method_exists('KScan', $functionName)){
					$changes[$masterDir] = KScan::$functionName($date);
				}else{
					$changes[$masterDir] = KScan::scanGeneric($masterDir, $date);
				}
			}
		}
		
		file_put_contents('data/master/'.$date.'/changes.json', json_encode($changes));
		$this->redirect(Yii::app()->createUrl('decodes/view/index', array('date'=>$date)));
	}
	
	public function actionShips(){
		$versions = KFile::getVersions();
		$date = $versions[count($versions)-1];
		$ships = KFile::readJSON('data/master/'.$date.'/ship/_summary.json');
		foreach($ships as $ship){
			// if($ship->isBase && $ship->build>0){
			if($ship->build>0){
				$shipData = KFile::readJSON('data/master/'.$date.'/ship/'.$ship->id.'.json');
				// print_r($shipData);
				// if($ship->rarity<4 && $ship->stype==2){
				// echo '('.$ship->id.', "'.$ship->english.'",'.$ship->stype.'),<br />';
				// echo '"'.strtolower($ship->english).'":'.$ship->id.',<br />';
				// echo '('.$ship->id.', "'.$ship->english.'", '.$ship->stype.', '.$shipData->api_afterlv.', '.$shipData->api_aftershipid.'),<br />';//.'	'.$ship->english.'<br />';
				echo $ship->english.'<br />';
				// }
			}
			// }
		}
	}
	
}