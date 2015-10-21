<?php
class ExtraController extends KController {
	
	public function actionFurniture(){
		$masters = array_reverse(glob('data/master/*/raw.json'));
		$latest = KFile::readJSON($masters[0]);
		$AllFurniture = $latest->api_data->api_mst_furniture;
		
		$FurnGraph = $latest->api_data->api_mst_furnituregraph;
		$graph = array();
		foreach($FurnGraph as $FurnGraphItem){
			$graph[$FurnGraphItem->api_id] = $FurnGraphItem;
		}
		
		
		$this->render('decodes.views.extra.Furniture', array(
			'furnitures' => $AllFurniture,
			'graph' => $graph,
			'types' => array("floor","wall","window","object","chest","desk"),
		));
	}
	
	public function actionFurnitureCode(){
		$FurnNames = KFile::readJSON('data/translations/furniture.json');
		// print_r($FurnNames); exit;
		$masters = array_reverse(glob('data/master/*/raw.json'));
		$latest = KFile::readJSON($masters[0]);
		$AllFurniture = $latest->api_data->api_mst_furniture;
		
		$FurnGraph = $latest->api_data->api_mst_furnituregraph;
		// echo '<pre>'; print_r($FurnGraph); exit;
		$graph = array();
		foreach($FurnGraph as $FurnGraphItem){
			$graph[$FurnGraphItem->api_id] = $FurnGraphItem;
		}
		
		$FurnGroups = array(array(), array(), array(), array(), array(), array());
		foreach($AllFurniture as $FurnitureItem){
			$FurnGroups[$FurnitureItem->api_type][] = $FurnitureItem;
		}
		
		$this->render('decodes.views.extra.FurnitureCode', array(
			'FurnNames' => $FurnNames,
			'furnitures' => $FurnGroups,
			'graph' => $graph,
			'types' => array("floor","wall","window","object","chest","desk"),
		));
	}
	
	public function actionFurnitureTL(){
		$raw = file_get_contents('data/other/wiki_furn.txt');
		$lines = explode(chr(13), $raw);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
		$translations = array();
		foreach($lines as $lineNum=>$lineTxt){
			if($lineNum%6==2){
				$jp = trim(str_replace("|","",$lineTxt));
			}
			if($lineNum%6==3){
				$translations[$jp] = trim(str_replace("|","",$lineTxt));
			}
		}
		// header("Content-type: text/plain");
		echo '{<br />';
		foreach($translations as $jp=>$en){
			echo '	"'.$jp.'":"'.$en.'",<br />';
		}
		echo '}';
		exit;
	}
	
	public function actionArt2(){
		// use original SWF classes
		$s = new SWFextractImages();
		$a = @file_get_contents('http://203.104.209.71/kcs/resources/swf/ships/hpfcwdqxgyvl.swf?VERSION='.time());
		if($a){ $s->doExtractImages($a); }
		unset($s);
	}
	
	public function actionArt3(){
		/*$headers = get_headers('http://203.104.209.71/kcs/resources/swf/ships/'.$_REQUEST['graph'].'.swf?VERSION='.time());
		
		if(strpos($headers[3], "Last-Modified") === false){
			foreach($headers as $header){
				if(strpos($header, "Last-Modified") !== false){
					echo $this->processDate(substr($header, 14)); return true;
				}
			}
		}else{
			echo $this->processDate(substr($headers[3], 14));
		}
		echo @file_get_contents('http:///kcs/resources/swf/ships/dyupugfxshtd.swf?VERSION='.time());*/
		$this->render('decodes.views.extra.ArtNotif', array(
			'filename' => $_REQUEST['filename'],
		));
	}
	
	public function actionArt(){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$masters = array_reverse(glob('data/master/*/raw.json'));
		$latest = KFile::readJSON($masters[0]);
		$AllShips = $latest->api_data->api_mst_ship;
		$AllShipsGraph = $latest->api_data->api_mst_shipgraph;
		
		$ShipList = array();
		foreach($AllShips as $AllShipsItem){
			$ShipList[$AllShipsItem->api_id] = $AllShipsItem;
		}
		
		$CGList = array();
		foreach($AllShipsGraph as $AllShipsGraphItem){
			$CGList[$AllShipsGraphItem->api_id] = $AllShipsGraphItem;
		}
		
		if(isset($_REQUEST['old'])){
			foreach(glob('images/compare/old/*') as $file) { unlink($file); }
			foreach(glob('images/compare/new/*') as $file) { unlink($file); }
			$cid = intval($_REQUEST['ids'][0]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][1]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][2]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][3]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][4]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][5]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][6]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][7]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][8]); if($cid > 0){ KFile::setAsCompareCG('old', $cid, $CGList[$cid]->api_filename); }
			$this->refresh();
		}
		
		if(isset($_REQUEST['new'])){
			foreach(glob('images/compare/new/*') as $file) { unlink($file); }
			$cid = intval($_REQUEST['ids'][0]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][1]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][2]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][3]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][4]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][5]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][6]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][7]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
			$cid = intval($_REQUEST['ids'][8]); if($cid > 0){ KFile::setAsCompareCG('new', $cid, $CGList[$cid]->api_filename); }
		}
		
		if(isset($_REQUEST['compile'])){
			$this->redirect(Yii::app()->createUrl('decodes/extra/compile', array(
				'ids' => implode(',', $_REQUEST['ids']),
			)));
		}
		
		$OldVers = glob('images/compare/old/*');
		$ids = array(0,0,0,0,0,0,0,0,0);
		$filenames = array();
		foreach($OldVers as $index=>$OldVer){
			$temp = explode('.', array_pop(explode('/', $OldVer)));
			$ids[$index] = $temp[0];
			$filenames[$index] = $CGList[$temp[0]]->api_filename;
		}
		
		$this->render('decodes.views.extra.Art', array(
			'ids' => $ids,
			'filenames' => $filenames,
			'ships' => $ShipList,
			'cgs' => $CGList,
		));
	}
	
	public function actionMap(){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$id = intval($_REQUEST['id']);
		$id = str_pad($id, 2, '0', STR_PAD_LEFT);
		
		if(!file_exists('images/maps/'.$id)){
			KFile::ripMapImages($id, '01');
			KFile::ripMapImages($id, '02');
			KFile::ripMapImages($id, '03');
			KFile::ripMapImages($id, '04');
			KFile::ripMapImages($id, '05');
			KFile::ripMapImages($id, '06');
		}
		
		$existMaps = glob('images/maps/'.$id.'/*');
		
		$this->render('decodes.views.extra.Maps', array(
			'MapID' => $id,
			'maps' => $existMaps,
		));
	}
	
	public function actionResources(){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		$this->render('decodes.views.extra.Resources');
	}
	
	public function actionBrowse(){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$versions = KFile::getVersions();
		$mdate = $versions[count($versions)-1];
		
		$allShips = KFile::readJSON('data/master/'.$mdate.'/ship/_summary.json');
		$allGraphs = KFile::readJSON('data/master/'.$mdate.'/shipgraph/_raw.json');
		$allItems = KFile::readJSON('data/master/'.$mdate.'/slotitem/_summary.json');
		
		$graphIndexed = array();
		foreach($allGraphs as $allGraph){
			$graphIndexed[ $allGraph->api_id ] = $allGraph->api_filename;
		}
		
		$this->render('decodes.views.extra.Browse', array(
			'date' => $mdate,
			'ships' => $allShips,
			'items' => $allItems,
			'graphs' => $graphIndexed,
		));
	}
	
	public function actionDefeq(){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$mdate = '2014-10-10_02-49';
		$allShips = KFile::readJSON('data/master/'.$mdate.'/ship/_raw.json');
		$latestShips = KFile::readJSON('data/master/2015-07-21_09-46/ship/_raw.json');
		
		$this->render('decodes.views.extra.Defeq', array(
			'ships' => $allShips,
			'latestShips' => $latestShips,
		));
	}
	
	public function actionCompile(){
		$masters = array_reverse(glob('data/master/*/raw.json'));
		$latest = KFile::readJSON($masters[0]);
		$AllShips = $latest->api_data->api_mst_ship;
		$AllShipsGraph = $latest->api_data->api_mst_shipgraph;
		
		$ShipList = array();
		foreach($AllShips as $AllShipsItem){
			$ShipList[$AllShipsItem->api_id] = $AllShipsItem;
		}
		
		$CGList = array();
		foreach($AllShipsGraph as $AllShipsGraphItem){
			$CGList[$AllShipsGraphItem->api_id] = $AllShipsGraphItem;
		}
		
		foreach(glob('images/compare/swf/*') as $file) { unlink($file); }
		
		$ids = explode(',', $_REQUEST['ids']);
		$FinalIDs = array();
		foreach($ids as $id){
			if(intval($id) > 0){
				$FinalIDs[] = $id;
				KFile::ensureSWF($id, $CGList[$id]->api_filename);
			}
		}
		
		$this->render('decodes.views.extra.Compile', array(
			'ids' => $FinalIDs,
			'ships' => $ShipList,
			'graphs' => $CGList,
		));
	}
	
	public function actionRemodel($id=1){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$versions = KFile::getVersions();
		$date = $versions[count($versions)-1];
		
		$shipData = KFile::readJSON('data/master/'.$date.'/ship/'.$id.'.json');
		$shipGraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$id.'.json');
		
		KFile::ensureSWF($shipData->api_id, $shipGraph->api_filename);
		
		$this->render('decodes.views.extra.Remodel', array(
			'ship' => $shipData,
		));
	}
	
	public function actionNewShip($id=1, $remodel=1){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$versions = KFile::getVersions();
		$date = $versions[count($versions)-1];
		
		$shipData = KFile::readJSON('data/master/'.$date.'/ship/'.$id.'.json');
		$remodelData = KFile::readJSON('data/master/'.$date.'/ship/'.$remodel.'.json');
		$shipGraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$id.'.json');
		
		KFile::ensureSWF($shipData->api_id, $shipGraph->api_filename);
		
		$this->render('decodes.views.extra.NewShip', array(
			'ship' => $shipData,
			'remodel' => $remodelData,
		));
	}
	
	public function actionQuests(){
		$xml = simplexml_load_file('data/other/quests.xml');
		$allquests = array();
		// echo '<pre>';
		foreach($xml->Quest as $quest){
			$quest = json_decode(json_encode($quest));
			$allquests[$quest->ID] = array(
				'name' => $quest->{'TR-Name'},
				'desc' => $quest->{'TR-Detail'},
			);
			// print_r($quest);
		}
		// print_r($allquests);
		// echo '</pre>';
		header("Content-type: application/json");
		echo json_encode($allquests, JSON_PRETTY_PRINT);
	}
	
	public function actionEquipment(){
		$xml = simplexml_load_file('data/other/equipment.xml');
		$allquests = array();
		// echo '<pre>';
		foreach($xml->Item as $item){
			$item = json_decode(json_encode($item));
			$allquests[$item->{'JP-Name'}] = $item->{'TR-Name'};
			// print_r($quest);
		}
		// print_r($allquests);
		// echo '</pre>';
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($allquests, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	}
	
	public function actionVoice($id=1){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$versions = KFile::getVersions();
		$date = $versions[count($versions)-1];
		
		$allShips = KFile::readJSON('data/master/'.$date.'/ship/_summary.json');
		$shipData = KFile::readJSON('data/master/'.$date.'/ship/'.$id.'.json');
		$shipGraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$id.'.json');
		
		$this->pageTitle = 'KanColle Data Center: '.$shipData->english.' Voices';
		
		$this->render('decodes.views.extra.Voice', array(
			'allShips' => $allShips,
			'shipData' => $shipData,
			'filename' => $shipGraph->api_filename,
		));
	}
	
	public function actionDownloadVoice($id=1, $num=1){
		$versions = KFile::getVersions();
		$date = $versions[count($versions)-1];
		
		$shipData = KFile::readJSON('data/master/'.$date.'/ship/'.$id.'.json');
		$shipGraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$id.'.json');
		
		$voiceNames = array(
			1 => 'Introduction',
			25 => 'Library Intro',
			2 => 'Secretary(1)',
			3 => 'Secretary(2)',
			4 => 'Secretary(3)',
			28 => 'Secretary(married)',
			24 => 'Wedding',
			8 => 'Show player\'s score',
			13 => 'Joining a fleet',
			9 => 'Equipment(1)',
			10 => 'Equipment(2)',
			26 => 'Equipment(3)',
			27 => 'Supply',
			11 => 'Docking = minor damage',
			12 => 'Docking = moderate damage',
			5 => 'Ship construction',
			7 => 'Return from sortie',
			14 => 'Start a sortie',
			15 => 'Battle start',
			16 => 'Attack',
			18 => 'Night battle',
			17 => 'Night attack',
			23 => 'MVP',
			19 => 'Minor damaged(1)',
			20 => 'Minor damaged(2)',
			21 => '=Moderately damaged',
			22 => 'Sunk',
			30 => '00:00',
			31 => '01:00',
			32 => '02:00',
			33 => '03:00',
			34 => '04:00',
			35 => '05:00',
			36 => '06:00',
			37 => '07:00',
			38 => '08:00',
			39 => '09:00',
			40 => '10:00',
			41 => '11:00',
			42 => '12:00',
			43 => '13:00',
			44 => '14:00',
			45 => '15:00',
			46 => '16:00',
			47 => '17:00',
			48 => '18:00',
			49 => '19:00',
			50 => '20:00',
			51 => '21:00',
			52 => '22:00',
			53 => '23:00',
			29 => 'Idle',
			6 => 'Instant Repair',
		);
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$shipData->english.'-'.$voiceNames[$num].'.mp3'); 
		header('Content-Transfer-Encoding: binary');
		header('Connection: Keep-Alive');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		
		// header('Content-Type: application/octet-stream');
		// header('Content-Transfer-Encoding: Binary'); 
		// header('Content-disposition: attachment; filename='.$shipData->english.'-'.$voiceNames[$num].'.mp3'); 

		echo file_get_contents("http://203.104.209.71/kcs/sound/kc".$shipGraph->api_filename."/".$num.".mp3");
	}
	
	public function actionLua($id=1){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$versions = KFile::getVersions();
		$date = $versions[count($versions)-1];
		
		$versions = KFile::getVersions();
		$mdate = $versions[count($versions)-1];
		// $date = '2014-10-10_02-49'; // local
		$date = '2014-09-26'; // live
		
		$allShips = KFile::readJSON('data/master/'.$mdate.'/ship/_summary.json');
		if(file_exists('data/master/'.$date.'/ship/'.$id.'.json')){
			$shipData = KFile::readJSON('data/master/'.$date.'/ship/'.$id.'.json');
			$shipGraph = KFile::readJSON('data/master/'.$date.'/shipgraph/'.$id.'.json');
		}else{
			$shipData = KFile::readJSON('data/master/'.$mdate.'/ship/'.$id.'.json');
			$shipGraph = KFile::readJSON('data/master/'.$mdate.'/shipgraph/'.$id.'.json');
		}
		
		$allItems = KFile::readJSON('data/master/'.$mdate.'/slotitem/_summary.json');
		
		$this->pageTitle = 'KanColle Data Center: '.$shipData->english.' Voices';
		
		$this->render('decodes.views.extra.Lua', array(
			'date' => $date,
			'mdate' => $mdate,
			'allShips' => $allShips,
			'shipData' => $shipData,
			'allItems' => $allItems,
			'english' => $shipData->english,
			'stype' => $shipData->api_stype,
			'models' => array('','Kai','Kai Ni','Drei'),
		));
		echo 2;
	}
	
	public function actionLuaSingle($id=1){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$versions = KFile::getVersions();
		$mdate = $versions[count($versions)-1];
		
		$shipData = KFile::readJSON('data/master/'.$mdate.'/ship/'.$id.'.json');
		$shipGraph = KFile::readJSON('data/master/'.$mdate.'/shipgraph/'.$id.'.json');
		
		$firstName = explode(" ", $shipData->english);
		$firstName = $firstName[0];
		
		$this->pageTitle = 'KanColle Data Center: '.$shipData->english.' Voices';
		$this->render('decodes.views.extra.LuaSingle', array(
			'mdate' => $mdate,
			'shipData' => $shipData,
			'shipGraph' => $shipGraph,
			'firstName' => $firstName,
		));
	}
	
	public function cond($val, $def, $return=FALSE){
		if($return){
			return (isset($val))?$val:$def;
		}else{
			echo (isset($val))?$val:$def;
		}
	}
	
	public function actionNames($id=1){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$ids1 = [1,2,9,10,11,12,13,14,15,16,19,20,23,26,27,28,31,32,33,42,43,44,45,46,47,50,51,52,54,55,56,62,69,70,71,72,73,74,78,80,81,83,84,87,88,93,94,99,100,101,110,111,112,113,114,144,145,146,147,149,158,159,160,164,165,182,186,187,188,189,195,201,202,203,204,205,206,207,208,209,213,214,215,216,217,220,222,223,224,227,228,229,230,231,232,233,242,243,244,245,246,247,254,255,256,261,265,272,273,274,275,276,277,278,282,286,287,288,289,290,308,309,319,322,407,411,412,420,426,427,436];
		
		$ids = [1,2,9,10,11,12,13,14,15,16,17,18,19,20,23,24,26,27,28,29,31,32,33,42,43,44,45,46,47,50,51,52,54,55,56,57,59,60,62,63,64,69,70,71,72,73,74,78,80,81,83,84,87,88,93,94,99,100,101,110,111,112,113,114,115,118,122,124,125,129,130,144,145,146,147,149,154,158,159,160,164,165,182,186,187,188,189,190,192,193,195,201,202,203,204,205,206,207,208,209,213,214,215,216,217,220,222,223,224,225,226,227,228,229,230,231,232,233,242,243,244,245,246,247,254,255,256,257,261,262,263,265,266,267,272,273,274,275,276,277,278,282,286,287,288,289,290,293,294,300,308,309,319,322,343,407,411,412,416,420,426,427,436];
		
		// $ids = array_diff($ids2, $ids1);
		
		$versions = KFile::getVersions();
		$mdate = $versions[count($versions)-1];
		
		$allShips = KFile::readJSON('data/master/'.$mdate.'/ship/_summary.json');
		
		$indexedShips = [];
		foreach($allShips as $allShip){
			$indexedShips[ $allShip->id ] = $allShip->english;
		}
		
		/*foreach($ids as $id){
			echo "<div style='font-family:Arial; font-size:12px; width:140px; height:30px; line-height:30px; margin:3px; float:left; background:#fff; border-radius:7px;'>
				<div style='width:30px; height:30px; float:left; margin:0px 5px 0px 0px'><img src='../../images/rounds/".$id.".png' style='width:26px; height:26px; margin:2px;' /></div>
				<div style='width:105px; height:30px; float:left;'>".$indexedShips[$id]."</div>
				<div style='clear:both;'></div>
			</div><style type='text/css'>body{background:#def;}</style>";
		}*/
		
		foreach($ids as $id){
			echo "".$indexedShips[$id].", ";
		}
		
	}
	
	public function actionCgcheck(){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$versions = KFile::getVersions();
		$mdate = $versions[count($versions)-1];
		
		$allGraphs = KFile::readJSON('data/master/'.$mdate.'/shipgraph/_raw.json');
		$graphIndexed = array();
		foreach($allGraphs as $allGraph){
			$graphIndexed[ $allGraph->api_id ] = $allGraph->api_filename;
		}
		
		if(isset($_REQUEST['checkdate'])){
			$checkdate = $_REQUEST['checkdate'];
		}else{
			$tz = new DateTimeZone('Asia/Tokyo');
			$date = new DateTime();
			$date->setTimezone($tz);
			$checkdate = $date->format('Y-m-d');
		}
		
		$this->render('decodes.views.extra.ArtCheck', array(
			'date' => $mdate,
			'ships' => KFile::readJSON('data/master/'.$mdate.'/ship/_summary.json'),
			'graphs' => $graphIndexed,
			'checkdate' => $checkdate,
		));
	}
	
	public function actionVoicecheck(){
		$this->layout = 'listing';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		
		$versions = KFile::getVersions();
		$mdate = $versions[count($versions)-1];
		
		$allGraphs = KFile::readJSON('data/master/'.$mdate.'/shipgraph/_raw.json');
		$graphIndexed = array();
		foreach($allGraphs as $allGraph){
			$graphIndexed[ $allGraph->api_id ] = $allGraph->api_filename;
		}
		
		if(isset($_REQUEST['checkdate'])){
			$checkdate = $_REQUEST['checkdate'];
		}else{
			$tz = new DateTimeZone('Asia/Tokyo');
			$date = new DateTime();
			$date->setTimezone($tz);
			$checkdate = $date->format('Y-m-d');
		}
		
		if(file_exists('data/voices/dates/'.$checkdate.'.json')){
			$changes = KFile::readJSON('data/voices/dates/'.$checkdate.'.json');
		}else{
			$changes = array();
		}
		
		$this->render('decodes.views.extra.VoiceCheck', array(
			'date' => $mdate,
			'ships' => KFile::readJSON('data/master/'.$mdate.'/ship/_summary.json'),
			'graphs' => $graphIndexed,
			'checkdate' => $checkdate,
			'changes' => $changes,
		));
	}
	
	public function actionVoicemd5(){
		$graph = $_REQUEST['graph'];
		$num = $_REQUEST['num'];
		echo md5_file('http://203.104.209.71/kcs/sound/kc'.$graph.'/'.$num.'.mp3?version='.time());
	}
	
	public function actionLastmod(){
		$graph = $_REQUEST['graph'];
		$num = $_REQUEST['num'];
		$headers = get_headers('http://203.104.209.71/kcs/sound/kc'.$graph.'/'.$num.'.mp3?version='.time());
		
		if(strpos($headers[3], "Last-Modified") === false){
			foreach($headers as $header){
				if(strpos($header, "Last-Modified") !== false){
					echo $this->processDate(substr($header, 14)); return true;
				}
			}
		}else{
			echo $this->processDate(substr($headers[3], 14));
		}
	}
	
	public function actionLastmodCG(){
		$graph = $_REQUEST['graph'];
		$server = (isset($_REQUEST['server']))?$_REQUEST['server']:'203.104.209.71';
		$headers = get_headers('http://'.$server.'/kcs/resources/swf/ships/'.$graph.'.swf?VERSION='.time());
		
		if(strpos($headers[3], "Last-Modified") === false){
			foreach($headers as $header){
				if(strpos($header, "Last-Modified") !== false){
					echo $this->processDate(substr($header, 14)); return true;
				}
			}
		}else{
			echo $this->processDate(substr($headers[3], 14));
		}
	}
	
	private function processDate($dateStr){
		$tz = new DateTimeZone('Asia/Tokyo');
		$date = new DateTime($dateStr);
		$date->setTimezone($tz);
		return $date->format('Y-m-d');
	}
	
}