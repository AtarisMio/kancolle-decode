<?php

class HomeController extends KController {

	public function actionIndex(){
		$db = Yii::app()->db;
		$latest = $db->createCommand("SELECT rb.*,u.username FROM report_build rb, user u WHERE rb.user=u.id ORDER BY created DESC LIMIT 0,25")->queryAll();
		
		$this->pagetitle = 'Construction';
		Yii::app()->params['pageName'] = 'Construction';
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/home.css');
		$this->render('build.views.home', array(
			'latest' => $latest,
			'shipNames' => KFile::readJSON('data/json/shipName.json'),
		));
	}
	
}