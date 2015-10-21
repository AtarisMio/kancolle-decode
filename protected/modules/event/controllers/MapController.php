<?php

class MapController extends KController {
	
	public function actionIndex($world, $number){
		
		
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/map.css');
		Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().'/map.js', CClientScript::POS_END);
		$this->render('event.views.map', array(
		
		));
	}
	
}