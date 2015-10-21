<?php

class HomeController extends KController {
	
	public function actionIndex($world='summer2014'){
		
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/home.css');
		$this->render('event.views.home', array(
			
		));
	}
	
}