<?php

class GraphController extends KController {

	public function actionIndex($german=false){
		$start = '2014-07-04';
		$minReport = 100;
		
		$db = Yii::app()->db;
		
		if($german){
			$recipes = $db->createCommand("SELECT CONCAT(res1,'/',res2,'/',res3,'/',res4,'/',devmats) AS recipe, COUNT(*) as reports FROM `report_build` WHERE created>='".$start."' AND res1>0 AND res2>0 AND res3>0 AND res4>0 AND devmats>0 AND flag_id IN (174,310,179,175,311,180) GROUP BY recipe HAVING reports>".$minReport." ORDER BY reports DESC LIMIT 0,20")->queryAll();
		}else{
			$recipes = $db->createCommand("SELECT CONCAT(res1,'/',res2,'/',res3,'/',res4,'/',devmats) AS recipe, COUNT(*) as reports FROM `report_build` WHERE created>='".$start."' AND res1>0 AND res2>0 AND res3>0 AND res4>0 AND devmats>0 AND flag_id NOT IN (174,310,179,175,311,180) GROUP BY recipe HAVING reports>".$minReport."  ORDER BY reports DESC LIMIT 0,20")->queryAll();
		}
		
		$recipeList = array();
		$summary = array();
		foreach($recipes as $recipe){
			$recipeList[] = $recipe['recipe'];
			$summary[ $recipe['recipe'] ] = array(
				'count' => $recipe['reports'],
				'ships' => array(),
			);
		}
		
		if($german){
			$reportShips = $db->createCommand("SELECT CONCAT(res1,'/',res2,'/',res3,'/',res4,'/',devmats) AS recipe, result, COUNT(result) as reports FROM `report_build` WHERE created>='".$start."' AND res1>0 AND res2>0 AND res3>0 AND res4>0 AND devmats>0 AND flag_id IN (174,310,179,175,311,180) GROUP BY recipe,result HAVING recipe IN ('".implode("','",$recipeList)."')")->queryAll();
		}else{
			$reportShips = $db->createCommand("SELECT CONCAT(res1,'/',res2,'/',res3,'/',res4,'/',devmats) AS recipe, result, COUNT(result) as reports FROM `report_build` WHERE created>='".$start."' AND res1>0 AND res2>0 AND res3>0 AND res4>0 AND devmats>0 AND flag_id NOT IN (174,310,179,175,311,180) GROUP BY recipe,result HAVING recipe IN ('".implode("','",$recipeList)."')")->queryAll();
		}
		
		$shipNames = KFile::readJSON('data/json/shipName.json');
		$shipColors = KFile::readJSON('data/json/shipColors.json');
		
		$merges = array(
			'78' => array('id'=>501, 'name'=>'Kongo-class', 'color'=>'#7A7777'),
			'79' => array('id'=>501, 'name'=>'Kongo-class', 'color'=>'#7A7777'),
			'85' => array('id'=>501, 'name'=>'Kongo-class', 'color'=>'#7A7777'),
			'86' => array('id'=>501, 'name'=>'Kongo-class', 'color'=>'#7A7777'),
			'74' => array('id'=>502, 'name'=>'CVL', 'color'=>'#928484'),
			'75' => array('id'=>502, 'name'=>'CVL', 'color'=>'#928484'),
			'76' => array('id'=>502, 'name'=>'CVL', 'color'=>'#928484'),
			'92' => array('id'=>502, 'name'=>'CVL', 'color'=>'#928484'),
			'26' => array('id'=>503, 'name'=>'BBV', 'color'=>'#928484'),
			'27' => array('id'=>503, 'name'=>'BBV', 'color'=>'#928484'),
			'77' => array('id'=>503, 'name'=>'BBV', 'color'=>'#928484'),
			'87' => array('id'=>503, 'name'=>'BBV', 'color'=>'#928484'),
			'71' => array('id'=>503, 'name'=>'CA', 'color'=>'#5C5C5C'),
			'72' => array('id'=>503, 'name'=>'CA', 'color'=>'#5C5C5C'),
		);
		
		foreach($reportShips as $index=>$reportShip){
			if(isset($merges[$reportShip['result']])){
				$mergeData = $merges[$reportShip['result']];
				if(!isset($summary[ $reportShip['recipe'] ]['ships'][ $mergeData['id'] ])){
					$summary[ $reportShip['recipe'] ]['ships'][ $mergeData['id'] ] = array(
						'name' => $mergeData['name'],
						'reports' => 0,
						'percent' => 0,
						'color' => $mergeData['color'],
					);
				}
				$summary[ $reportShip['recipe'] ]['ships'][ $mergeData['id'] ]['reports'] += $reportShip['reports'];
				$summary[ $reportShip['recipe'] ]['ships'][ $mergeData['id'] ]['percent'] += ($reportShip['reports'] / $summary[ $reportShip['recipe'] ]['count'])*100;
			}else{
				$summary[ $reportShip['recipe'] ]['ships'][ $reportShip['result'] ] = array(
					'name' => $shipNames->{$reportShip['result']},
					'reports' => $reportShip['reports'],
					'percent' => ($reportShip['reports'] / $summary[ $reportShip['recipe'] ]['count'])*100,
					'color' => $shipColors[$reportShip['result']],
				);
			}
		}
		
		foreach($recipes as $recipe){
			$shipList = &$summary[ $recipe['recipe'] ]['ships'];
			// usort($shipList,"cmp");
			if(isset($shipList['153'])){ $shipList = array('153' => $shipList['153']) + $shipList; }
			if(isset($shipList['131'])){ $shipList = array('131' => $shipList['131']) + $shipList; }
		}
		
		Yii::app()->theme = 'blank';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/graph.css');
		$this->render('build.views.graph', array(
			'summary' => $summary,
			'german' => $german,
			'date_start' => ($start=='0000-00-00')?'ever since':$start,
		));
	}
	
}

// function cmp($a, $b) { return -($a['percent'] - $b['percent']); }