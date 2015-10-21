<?php

class ErrorController extends KController {

	public function actionIndex(){
		$error = Yii::app()->errorHandler->error;
		if($error){
			Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/error.css');
			$this->render('site.views.error', array('error'=>$error));
		}else{
			$this->redirect($this->createUrl("/"));
		}
	}
	
}